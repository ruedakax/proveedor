<?php
error_reporting(E_ALL);
require_once("./class/class.Validation.php");
require_once("./class/class.View.php");

class Panel3{
  
  const DISPLAY_NONE = 'oculto';
  //
  public $conn;
  
  public function preparar($datos){
    $res = $this->consultar(array($datos['i']));    
    ///Preparacion de datos para la vista segun las condiciones del formulario
    $res_preparados = $this->prepareVariables($res,$datos['i']);
    //
    $view = new View;
    // asignar datos
    $view->data['datos'] = $res_preparados;
    // render
    $html = $view->render('./views/view.panel3.php');
    //
    return $html;    
  }

  public function guardar($datos){        
    $respuesta = ['res'=>'','mensaje'=>'','validaciones'=>[],'panel'=>[]];
    $datos['i3_p1_certificados'] = isset($datos['i3_p1_certificados'])?$datos['i3_p1_certificados']:'';
    $res = $this->validar($datos);    
    if(!is_array($res)){
      $res = $this->execGuardar($datos);
      if($res==FALSE){ 
        $res = $this->execActualizar($datos);       
        if($res){
          $respuesta['mensaje'] = 'La Información Comercial Fue ACTUALIZADA.';
          $respuesta['validaciones'] = [];
          $respuesta['res'] = "success";
        }else{
          $respuesta['mensaje'] = 'Error al Guardar';
          $respuesta['validaciones'] = [];
          $respuesta['panel'] = $datos;
          $respuesta['res'] = "error";
        }
      }else{                
        $respuesta['mensaje'] = 'La Información Comercial Fue GUARDADA.';
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
    $query_string = "INSERT INTO dbo.registroUnicoP3
    (nit    
    ,i3_p1_check
    ,i3_p1_certificados
    ,gi3_p1_check
    ,i3_p1_ec_asesora
    ,gi3_p1_control_calidad
    ,gi3_p2_check
    ,gi3_p2_sellos
    ,gi3_p3_check
    ,gi3_p4_check
    ,gi3_p5_check
    ,gi3_p6_check
    ,gi3_p7_check
    ,gi3_p8_check
    ,gi3_p9_check
    ,gi3_p10_check
    ,ip_origen
    ,usuarioCrea
    ,fechaCrea)
    VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')";
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
    $query_string = "UPDATE dbo.registroUnicoP3 SET i3_p1_check = '%s'
    ,i3_p1_certificados = '%s'    
    ,gi3_p1_check = '%s'
    ,i3_p1_ec_asesora = '%s'
    ,gi3_p1_control_calidad = '%s'
    ,gi3_p2_check = '%s'
    ,gi3_p2_sellos = '%s'
    ,gi3_p3_check = '%s'
    ,gi3_p4_check = '%s'
    ,gi3_p5_check = '%s'
    ,gi3_p6_check = '%s'
    ,gi3_p7_check = '%s'
    ,gi3_p8_check = '%s'
    ,gi3_p9_check = '%s'
    ,gi3_p10_check = '%s'
    ,ip_origen = '%s'
    ,usuarioCrea = '%s'
    ,fechaCrea = %s
    WHERE nit = '%s'";
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
    ,i3_p1_check
    ,i3_p1_certificados
    ,gi3_p1_check    
    ,i3_p1_ec_asesora
    ,gi3_p1_control_calidad
    ,gi3_p2_check
    ,gi3_p2_sellos
    ,gi3_p3_check
    ,gi3_p4_check
    ,gi3_p5_check
    ,gi3_p6_check
    ,gi3_p7_check
    ,gi3_p8_check
    ,gi3_p9_check
    ,gi3_p10_check
    ,ip_origen
    ,usuarioCrea
    ,fechaCrea    
    FROM dbo.registroUnicoP3
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
    $val->name('i3_p1_check')->value($datos['i3_p1_check'])->pattern('alpha')->required();
    if($datos['i3_p1_check'] == 'SI'){
      $val->name('i3_p1_certificados')->value($datos['i3_p1_certificados'])->pattern('text')->required();
      if(strpos($datos['i3_p1_certificados'],'enCertificacion')!==FALSE){
        $val->name('i3_p1_ec_asesora')->value($datos['i3_p1_ec_asesora'])->pattern('text')->required();    
      }
    }else{
      $val->name('gi3_p1_check')->value($datos['gi3_p1_check'])->pattern('alpha')->required();
      if($datos['i3_p1_check'] == 'SI'){
        $val->name('gi3_p1_control_calidad')->value($datos['gi3_p1_control_calidad'])->pattern('text')->required();
      }
      $val->name('gi3_p2_check')->value($datos['gi3_p2_check'])->pattern('alpha')->required();
      if($datos['gi3_p2_check'] == 'SI'){
        $val->name('gi3_p2_sellos')->value($datos['gi3_p2_sellos'])->pattern('text')->required();
      }
      $val->name('gi3_p3_check')->value($datos['gi3_p3_check'])->pattern('alpha')->required();
      $val->name('gi3_p4_check')->value($datos['gi3_p4_check'])->pattern('alpha')->required();
      $val->name('gi3_p5_check')->value($datos['gi3_p5_check'])->pattern('alpha')->required();
      $val->name('gi3_p6_check')->value($datos['gi3_p6_check'])->pattern('alpha')->required();
      $val->name('gi3_p7_check')->value($datos['gi3_p7_check'])->pattern('alpha')->required();
      $val->name('gi3_p8_check')->value($datos['gi3_p8_check'])->pattern('alpha')->required();
      $val->name('gi3_p9_check')->value($datos['gi3_p9_check'])->pattern('alpha')->required();
      $val->name('gi3_p10_check')->value($datos['gi3_p10_check'])->pattern('alpha')->required();
    }
    //
    return $val->isSuccess()?true:$val->getErrors();
  }  

  private function prepareVariables($datos,$nit){
    $res = $datos['datos'];
    $res['nit'] = base64_decode($nit);
    $res['clase'] = self::DISPLAY_NONE;    
    $res['i3_p1_check'] = isset($res['i3_p1_check'])?$res['i3_p1_check']:'NO';
    $res['i3_p1_certificados'] = isset($res['i3_p1_certificados'])?$res['i3_p1_certificados']:'';
    $res['gi3_p1_check'] = isset($res['gi3_p1_check'])?$res['gi3_p1_check']:'NO';
    $res['gi3_p2_check'] = isset($res['gi3_p2_check'])?$res['gi3_p2_check']:'NO';
    $res['gi3_p3_check'] = isset($res['gi3_p3_check'])?$res['gi3_p3_check']:'NO';
    $res['gi3_p4_check'] = isset($res['gi3_p4_check'])?$res['gi3_p4_check']:'NO';
    $res['gi3_p5_check'] = isset($res['gi3_p5_check'])?$res['gi3_p5_check']:'NO';
    $res['gi3_p6_check'] = isset($res['gi3_p6_check'])?$res['gi3_p6_check']:'NO';
    $res['gi3_p7_check'] = isset($res['gi3_p7_check'])?$res['gi3_p7_check']:'NO';
    $res['gi3_p8_check'] = isset($res['gi3_p8_check'])?$res['gi3_p8_check']:'NO';
    $res['gi3_p9_check'] = isset($res['gi3_p9_check'])?$res['gi3_p9_check']:'NO';
    $res['gi3_p10_check'] = isset($res['gi3_p10_check'])?$res['gi3_p10_check']:'NO';
    return $res;  
  }

  private function organizarDatos($datos,$tipo = 'guardar'){
    $datos_organizados = [
      $datos['nit'] = base64_decode($datos['nit']),
      $datos['i3_p1_check'],
      $datos['i3_p1_certificados'],
      $datos['gi3_p1_check'],
      $datos['i3_p1_ec_asesora'],
      $datos['gi3_p1_control_calidad'],
      $datos['gi3_p2_check'],
      $datos['gi3_p2_sellos'],
      $datos['gi3_p3_check'],
      $datos['gi3_p4_check'],
      $datos['gi3_p5_check'],
      $datos['gi3_p6_check'],      
      $datos['gi3_p7_check'],
      $datos['gi3_p8_check'],
      $datos['gi3_p9_check'],
      $datos['gi3_p10_check'],
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



