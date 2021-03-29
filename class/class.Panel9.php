<?php
//error_reporting(E_ALL);
require_once("./class/class.Validation.php");
require_once("./class/class.View.php");
require_once("./class/class.Archivo.php");

class Panel9{

  const DISPLAY_NONE = 'oculto';
  const TARGET_DIR = "./uploads/";
  //
  public $conn;
  
  public function preparar($datos){
    $res = $this->consultar($datos);
    //
    $view = new View;
    // asignar datos    
    $view->data['datos'] = $res['datos'];
    // render
    $html = $view->render('./views/view.panel9.php');
    //
    return $html;    
  }
  
  public function guardar($datos,$archivos){
    $respuesta = ['res'=>'','mensaje'=>'','validaciones'=>[],'panel'=>[]];
    //    
    $nit = base64_decode($datos['nit']);
    $folder = self::TARGET_DIR.$nit;
    if(!file_exists($folder)){
      mkdir($folder);
    }
    $source = $datos['fuente'];
    $fechaExpira = isset($datos['fechaExpira'])?$datos['fechaExpira']:NULL;
    $myFile = new Archivo($archivos[$source],$nit,$source,$fechaExpira);
    if($myFile->validate(self::TARGET_DIR)){
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
    $ruta = self::TARGET_DIR.$objArchivo->nit."/".$objArchivo->source.".".$objArchivo->extension;
    $ip_origen = $_SERVER['REMOTE_ADDR'];
    $datos_organizados = array($objArchivo->nit
                              ,$objArchivo->source
                              ,$objArchivo->fileArray["type"]
                              ,$ruta
                              ,$objArchivo->fechaExpira
                              ,$ip_origen
                              ,'proveedor');
    //
    $query_string = "INSERT INTO dbo.[ruAnexos]
    (nit
    ,fuente
    ,tipo
    ,ruta
    ,fecha_expira    
    ,ip_origen
    ,usuarioCrea)    
    VALUES('%s','%s','%s','%s','%s','%s','%s')";
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
                              ,$ip_origen
                              ,'proveedor'
                              ,$objArchivo->nit
                              ,$objArchivo->source);
    //
    $query_string = "UPDATE dbo.[ruAnexos] SET 
    tipo = '%s'
    ,ruta = '%s'
    ,fecha_expira = '%s'
    ,ip_origen = '%s'
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
}//end class



