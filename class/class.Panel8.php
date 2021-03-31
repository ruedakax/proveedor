<?php
//error_reporting(E_ALL);
require_once("./class/class.Validation.php");
require_once("./class/class.View.php");

class Panel8{
   
  const DISPLAY_NONE = 'oculto';
  //
  public $conn;
  
  public function preparar($datos){
    $res = $this->consultar(array($datos['i']));    
    ///Preparacion de datos para la vista segun las condiciones del formulario
    $res_preparados = $res['res']!='error'?$this->prepareVariables($res,$datos['i']):array();
    //
    $view = new View;
    // asignar datos
    $view->data['datos'] = $res_preparados;
    // render
    $html = $view->render('./views/view.panel8.php');
    //
    return $html;    
  }

  public function guardar($datos){        
    $respuesta = ['res'=>'','mensaje'=>'','validaciones'=>[],'panel'=>[]];    
    $res = $this->validar($datos);    
    if(!is_array($res)){
      $res = $this->execGuardar($datos);
      if($res==FALSE){
        $res = $this->execActualizar($datos);       
        if($res){
          $respuesta['mensaje'] = '<p>La sección ocho ha sido actualizada.</p><p>Usted ha completado la información requerida y será direccionado a la  sección de anexos.</p>';
          $respuesta['validaciones'] = [];
          $respuesta['res'] = "success";
        }else{
          $respuesta['mensaje'] = 'Error al Guardar';
          $respuesta['validaciones'] = [];
          $respuesta['panel'] = $datos;
          $respuesta['res'] = "error";
        }
      }else{              
        $respuesta['mensaje'] = '<p>La sección ocho ha sido guardada.</p><p>Usted ha completado la información requerida y será direccionado a la  sección de anexos.</p>';
        $respuesta['validaciones'] = [];
        $respuesta['res'] = "success";
      }
    }else{
      $respuesta['mensaje'] = 'Algunos datos no son válidos : <strong>Revise los campos marcados.</strong>';
      $respuesta['validaciones'] = $res; //->getErrors();
      $respuesta['panel'] = $datos;
      $respuesta['res'] = "error";
    }
    return $respuesta;
  }  

  private function execGuardar($datos){
    //preparar datos
    $datos_organizados = $this->organizarDatos($datos);
    //
    $query_string = "INSERT INTO dbo.registroUnicoP8
    (nit
    ,i8_p1_nombre    
    ,i8_p2_empresa    
    ,i8_p3_nit    
    ,ip_origen
    ,usuarioCrea
    ,fechaCrea)
    VALUES('%s','%s','%s','%s','%s','%s','%s')";
    $query_string = vsprintf($query_string,$datos_organizados);    
    $sql;
    try {
      $sql = @odbc_exec($this->conn,$query_string);
      //odbc_close($this->conn);
    } catch (\Throwable $th) {
      $sql = false;
    }
    return $sql;
  }

  private function execActualizar($datos){
    //preparar datos
    $datos_organizados = $this->organizarDatos($datos,'actualizar');        
    //
    $query_string = "UPDATE dbo.registroUnicoP8 SET i8_p1_nombre = '%s'
    ,i8_p2_empresa = '%s'
    ,i8_p3_nit = '%s'
    ,ip_origen = '%s'
    ,usuarioCrea = '%s'
    ,fechaCrea = %s WHERE nit = '%s'";    
    //
    $query_string = vsprintf($query_string,$datos_organizados);    
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
    ,i8_p1_nombre
    ,i8_p2_empresa
    ,i8_p3_nit
    ,ip_origen
    ,usuarioCrea
    ,fechaCrea    
    FROM dbo.registroUnicoP8
    WHERE nit = '%s'";
    $query_string = sprintf($query_string,base64_decode($parametros[0]));
    $res;
    try {
      $sql = odbc_exec($this->conn,$query_string);
      $datos_panel = odbc_fetch_array($sql);
      //odbc_close($this->conn);
      if(!$datos_panel){
        $ok['mensaje'] = "No existe";
        $ok['datos'] = [];
      }else{                
        $ok['datos'] = $datos_panel;
      }     
      $res = $ok;
    } catch (\Throwable $th) {
      $error['mensaje'] = 'Error en consulta';
      $error['validaciones'] = [];
      $res = $error;      
    }    
    return $res;
  }	
  
  private function validar($datos){
    $val = new Validation();
    $val->name('nit')->value($datos['nit'])->required();
    $val->name('i8_p1_nombre')->value($datos['i8_p1_nombre'])->pattern('text')->required();    
    $val->name('i8_p2_empresa')->value($datos['i8_p2_empresa'])->pattern('text')->required();    
    $val->name('i8_p3_nit')->value($datos['i8_p3_nit'])->pattern('text')->required();
    //
    return $val->isSuccess()?true:$val->getErrors();
  }  

  private function prepareVariables($datos,$nit){
    $res = $datos['datos'];    
    $res['nit'] = base64_decode($nit);
    $res['clase'] = self::DISPLAY_NONE;    
    $res['i8_p1_nombre'] = isset($res['i8_p1_nombre'])?$res['i8_p1_nombre']:'';    
    $res['i8_p2_empresa'] = isset($res['i8_p2_empresa'])?$res['i8_p2_empresa']:'';    
    $res['i8_p3_nit'] = isset($res['i8_p3_nit'])?$res['i8_p3_nit']:'';
    return $res;  
  }

  private function organizarDatos($datos,$tipo = 'guardar'){
    $datos_organizados = [
      $datos['nit'] = base64_decode($datos['nit']),
      $datos['i8_p1_nombre'],      
      $datos['i8_p2_empresa'],      
      $datos['i8_p3_nit'],      
      $_SERVER['REMOTE_ADDR'],      
      'proveedor',//ToDo
      date('Y-m-d'),
    ];    
    if($tipo == 'actualizar'){
      $nit = array_shift($datos_organizados);
      $datos_organizados[] = $nit;      
    }
    return $datos_organizados;
  } 
}//end class



