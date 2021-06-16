<?php
session_start();
//error_reporting(E_ALL);
require_once("./class/class.Validation.php");
require_once("./class/class.View.php");
require_once("./class/class.Archivo.php");

class Evidencias{

  const DISPLAY_NONE = 'oculto';
  const TARGET_DIR = "./uploads/%/evidencias";
  //
  public $conn;
  
  public function preparar($datos,$soloMostrar=FALSE){
    /*$res = $this->consultar($datos);
    $info = $this->consultarGeneral($datos);
    //*/
    $view = new View;
    // asignar datos
    $view->data['nit'] = base64_decode($datos['i']);
    /*$view->data['general'] = $info;
    $view->data['tipoPersona'] = isset($datos['tipoPersona'])?$datos['tipoPersona']:NULL;
    $view->data['tipoRegistro'] = isset($datos['tipoRegistro'])?$datos['tipoRegistro']:NULL;*/
    // render
    $template = $soloMostrar==FALSE?'./views/view.evidencias.php':'./views/view.evidencias.php';
    $html = $view->render($template);
    //
    return $html;    
  }
  
  public function guardar($datos,$archivos){
    $respuesta = ['res'=>'','mensaje'=>'','validaciones'=>[],'archivo'=>[]];
    //    
    $nit = base64_decode($datos['nit']);
    $source = $datos['fuente'];
    $folder = sprintf(self::TARGET_DIR,$nit);
    $fechaExpira = $datos['desc'];//no se requiere fecha pero se usa el campo para pasar la descripcion (shame on me)
    if(!file_exists($folder)){
      mkdir($folder);
    }    
    $myFile = new Archivo($archivos[$source],$nit,$source,$fechaExpira);
    if($myFile->validate($folder)){
      $myFile->fileArray['tmp_name'] = '';
      $res = $this->execGuardar($myFile);
      if($res==FALSE){
        $res = $this->execActualizar($myFile);
        if($res){
          $respuesta['mensaje'] = 'El Archivo Ha Sido Actualizado';
          $respuesta['validaciones'] = [];
          $respuesta['archivo'] = $myFile;
          $respuesta['res'] = "success";
        }else{
          $respuesta['mensaje'] = 'Error al Registrar el Archivo';
          $respuesta['validaciones'] = [];          
          $respuesta['res'] = "error";
        }
      }else{
        $respuesta['mensaje'] = 'El Archivo Ha Sido Guardado';
        $respuesta['validaciones'] = [];
        $respuesta['res'] = "success";
        $respuesta['archivo'] = $myFile;
      } 
    }else{
      $respuesta['mensaje'] = '<strong>El archivo cargado presenta dificultades:</strong>';
      $respuesta['validaciones'] = $myFile->getErrors();
      $respuesta['archivo'] = $myFile;
      $respuesta['res'] = "error";
    }
    return $respuesta;
  }

  private function execGuardar($objArchivo){
    //preparar datos
    $ruta = sprintf(self::TARGET_DIR,$objArchivo->nit)."/file_".$objArchivo->source.".".$objArchivo->extension;
    $datos_organizados = array($objArchivo->nit
                              ,$objArchivo->source
                              ,$objArchivo->fechaExpira
                              ,$objArchivo->fileArray["type"]
                              ,$ruta
                              ,$_SESSION['USUARIO']
                          );
    //
    $query_string = "INSERT INTO dbo.[ruEvidencias]
    (nit
    ,fuente
    ,descripcion
    ,tipo
    ,ruta    
    ,usuarioCrea)    
    VALUES('%s','%s','%s','%s','%s','%s')";
    $query_string = vsprintf($query_string,$datos_organizados);
    //echo $query_string;
    $sql;
    try {
      $sql = @odbc_exec($this->conn,$query_string);
      //odbc_close($this->conn);
    } catch (\Throwable $th) {
      $sql = false;      
    }
    return $sql;
  }
  
  private function execActualizar($objArchivo){
    //preparar datos
    $ruta = self::TARGET_DIR.$objArchivo->nit."/".$objArchivo->source.".".$objArchivo->extension;
    $ip_origen = $_SERVER['REMOTE_ADDR'];
    $datos_organizados = array($objArchivo->fileArray["type"]
                              ,$ruta
                              ,$objArchivo->fechaExpira                              
                              ,$_SESSION['USUARIO']
                              ,$objArchivo->nit
                              ,$objArchivo->source);
    //
    $query_string = "UPDATE dbo.[ruEvidencias] SET 
    tipo = '%s'
    ,ruta = '%s'
    ,descripcion = '%s'    
    ,usuarioCrea = '%s'
    WHERE nit = '%s' AND fuente = '%s'";
    //
    $query_string = vsprintf($query_string,$datos_organizados);    
    //echo $query_string;
    $sql;
    try {
      $sql = odbc_exec($this->conn,$query_string);
      //odbc_close($this->conn);
    } catch (\Throwable $th) {
      $sql = false;
    }
    return $sql;
  }    

  public function consultar($parametros){
    $ok = ['res'=>'OK','res_bool'=>TRUE,'mensaje'=>'Consulta exitosa','datos'=>[]];
    $error = ['res'=>'ERROR','res_bool'=>FALSE,'mensaje'=>'','validaciones'=>[]];
    //
    $query_string = "SELECT nit
    ,fuente
    ,tipo
    ,ruta
    ,fecha_expira    
    FROM dbo.[ruAnexos]
    WHERE nit = '%s'";
    $query_string = sprintf($query_string,base64_decode($parametros['i']));
    $res;
    $archivos = array();
    try {      
      $sql = odbc_exec($this->conn,$query_string);
      while($datos_panel = odbc_fetch_array($sql)){                
        $fuente = $datos_panel['fuente'];
        $archivos[$fuente] = $datos_panel;
      }
      //odbc_close($this->conn);
      if(count($archivos)<=0){
        $ok['mensaje'] = "No Hay Archivos Asociados";
        $ok['datos'] = [];
      }else{                
        $ok['datos'] = $archivos;
      }     
      $res = $ok;
    } catch (\Throwable $th) {
      $error['mensaje'] = 'Error en consulta';
      $error['validaciones'] = [];
      $res = $error;      
    }    
    return $res;
  }	

  public function consultarGeneral($parametros){
    $query_string = "SELECT *
    FROM dbo.registroUnicoP1  A 
    LEFT JOIN dbo.registroUnicoP2  C ON (A.nit = C.nit) 
    LEFT JOIN dbo.registroUnicoP3  D ON (A.nit = D.nit) 
    LEFT JOIN dbo.registroUnicoP5  E ON (A.nit = E.nit) 
    LEFT JOIN dbo.registroUnicoP6  F ON (A.nit = F.nit) 
    LEFT JOIN dbo.registroUnicoP7  G ON (A.nit = G.nit) 
    LEFT JOIN dbo.registroUnicoP8  H ON (A.nit = H.nit)     
    WHERE A.nit = '%s'";
    $query_string = sprintf($query_string,base64_decode($parametros['i']));
    $res;    
    try{
      $sql = odbc_exec($this->conn,$query_string);
      $res = odbc_fetch_array($sql);
      //odbc_close($this->conn);      
    }catch (\Throwable $th){
      $res = [];      
    }
    return $res;
  }	
}//end class



