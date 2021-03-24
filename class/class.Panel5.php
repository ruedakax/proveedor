<?php
error_reporting(E_ALL);
require_once("./class/class.Validation.php");
require_once("./class/class.View.php");
require_once("./class/class.ComAccionaria.php");
require_once("./class/class.ComSociedad.php");
require_once("./class/class.ProContacto.php");
require_once("./class/class.Contacto.php");

class Panel5{
  
  const DISPLAY_NONE = 'oculto';
  //
  public $conn;

  private $comAccionaria;
  private $comSociedad;
  private $proContacto;
  private $contacto;

  function setComplemento(){
    $this->comAccionaria = new RefBancarias;
    $this->comAccionaria->conn = $this->conn;
    $this->comSociedad = new RefExperiencia;
    $this->comSociedad->conn = $this->conn;    
    $this->proContacto = new ProContacto;
    $this->proContacto->conn = $this->conn;
    $this->contacto = new Contacto;
    $this->contacto->conn = $this->conn;
  }
  
  public function preparar($datos){
    $res = $this->consultar(array($datos['i']));    
    ///Preparacion de datos para la vista segun las condiciones del formulario    
    $res_preparados = $res['res']!='error'?$this->prepareVariables($res,$datos['i']):array();
    
    //
    $view = new View;
    // asignar datos
    $view->data['datos'] = $res_preparados;
    // render
    $html = $view->render('./views/view.panel5.php');
    //
    return $html;
  }

  public function guardar($datos){
    $respuesta = ['res'=>'','mensaje'=>'','validaciones'=>[],'panel'=>[]];
    $res = $this->validar($datos);
    if(!is_array($res)){
      $res = $this->execGuardar($datos);
      if($res==FALSE){
        $nit = base64_decode($datos['nit']);
        if($datos['tipoPersona']==='juridica'){
          $comAccionaria = $this->comAccionaria->extraer($datos);
          $res = $this->execActualizar($datos)!=FALSE?$this->comAccionaria->actualizar($comAccionaria,$nit):FALSE;
          $comSociedad = $this->comSociedad->extraer($datos);
          $res = $res!=FALSE?$this->comSociedad->actualizar($comAccionaria,$nit):FALSE;
        }        
        $proContacto = $this->proContacto->extraer($datos);
        $res = $res!=FALSE?$this->proContacto->actualizar($proContacto,$nit):FALSE;
        $contacto = $this->contacto->extraer($datos);
        $res = $res!=FALSE?$this->contacto->actualizar($contacto,$nit):FALSE;
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
        if($datos['tipoPersona']==='juridica'){
          $comAccionaria = $this->comAccionaria->extraer($datos);
          $this->comAccionaria->guardar($refBancarias,$datos['nit']);
          $comSociedad = $this->comSociedad->extraer($datos);
          $this->comSociedad->guardar($refExperiencia,$datos['nit']);
        }        
        $proContacto = $this->proContacto->comAccionaria->extraer($datos);
        $this->proContacto->guardar($proContacto,$datos['nit']);
        $contacto = $this->contacto->extraer($datos);
        $this->contacto->guardar($contacto,$datos['nit']);
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
    $query_string = "INSERT INTO dbo.registroUnicoP2
    (nit    
    ,tipo_actividad
    ,nro_empleados    
    ,regimen
    ,cuenta_banco
    ,cuenta
    ,cuenta_tipo
    ,i2_p6_check
    ,i2_p6_empresas
    ,i2_p7_check
    ,i2_p7_plazo
    ,i2_p8_check
    ,i2_p9_check
    ,i2_p9_postventa	
    ,ip_origen
    ,usuarioCrea
    ,fechaCrea)
    VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')";    
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

  private function execActualizar($datos){
    //preparar datos
    $datos_organizados = $this->organizarDatos($datos,'actualizar');
    //
    $query_string = "UPDATE dbo.registroUnicoP2 SET tipo_actividad = '%s'    
    ,nro_empleados = '%s'
    ,regimen = '%s'
    ,cuenta_banco = '%s'
    ,cuenta = '%s'
    ,cuenta_tipo = '%s'
    ,i2_p6_check = '%s'
    ,i2_p6_empresas = '%s'
    ,i2_p7_check = '%s'
    ,i2_p7_plazo = '%s'
    ,i2_p8_check = '%s'
    ,i2_p9_check = '%s'
    ,i2_p9_postventa = '%s'    
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
    $query_string = "SELECT [nit]
    ,[i5_p1_check]
    ,[i5_p2_check]
    ,[i5_p3_representante]
    ,[i5_p3_representado]
    ,[i5_p4_fuentes]
    ,[ip_origen]
    ,[usuarioCrea]
    ,[fechaCrea]
    FROM dbo.registroUnicoP5
    WHERE nit = '%s'";
    $query_string = sprintf($query_string,base64_decode($parametros[0]));
    $res;
    try {
      $sql = odbc_exec($this->conn,$query_string);
      $datos_panel = odbc_fetch_array($sql);
      //odbc_close($this->conn);
      if(!$datos_panel){
        $ok['mensaje'] = "No existe";
        $ok['datos'] = array('list_comAccionaria' => array(),'list_comSociedad' => array(),'list_proContacto' => array(),'list_contacto' => array());
      }else{
        $datos_panel['list_comAccionaria'] = $this->comAccionaria->consultar($datos_panel['nit']);
        $datos_panel['list_comSociedad'] = $this->comSociedad->consultar($datos_panel['nit']);
        $datos_panel['list_proContacto'] = $this->proContacto->consultar($datos_panel['nit']);
        $datos_panel['list_contacto'] = $this->contacto->consultar($datos_panel['nit']);
        $ok['datos'] = $datos_panel;
        var_dump($datos_panel);
      }     
      $res = $ok;
    } catch (\Throwable $th) {
      var_dump($th);
      $error['mensaje'] = 'Error en consulta';
      $error['validaciones'] = [];
      $res = $error;      
    }    
    return $res;
  }	
  
  private function validar($datos){    
    $val = new Validation();
    $val->name('nit')->value($datos['nit'])->required();
    $val->name('i5_p1_check')->value($datos['i5_p1_check'])->pattern('alpha')->required();
    $val->name('i5_p2_check')->value($datos['i5_p2_check'])->pattern('alpha')->required();
    $val->name('i5_p3_representante')->value($datos['i5_p3_representante'])->pattern('text')->required();
    $val->name('i5_p3_representado')->value($datos['i5_p3_representado'])->pattern('text')->required();
    $val->name('i5_p4_fuentes')->value($datos['i5_p4_fuentes'])->pattern('text')->required();    
    if($datos['tipoPersona'] == 'juridica'){
      $val->name('refban_sucursal_0')->value($datos['refban_sucursal_0'])->pattern('text')->required();
      $val->name('refban_banco_0')->value($datos['refban_banco_0'])->pattern('text')->required();
      $val->name('refban_cuenta_0')->value($datos['refban_cuenta_0'])->pattern('text')->required();
      $val->name('refban_telefono_0')->value($datos['refban_telefono_0'])->pattern('tel')->required();
      $val->name('refban_contacto_0')->value($datos['refban_contacto_0'])->pattern('text')->required();
      $val->name('refcom_empresa_0')->value($datos['refcom_empresa_0'])->pattern('text')->required();
      $val->name('refcom_contacto_0')->value($datos['refcom_contacto_0'])->pattern('text')->required();
      $val->name('refcom_cupos_0')->value($datos['refcom_cupos_0'])->pattern('text')->required();
    }
    if($datos['i2_p7_check'] == 'SI'){
      $val->name('i2_p7_plazo')->value($datos['i2_p7_plazo'])->pattern('int')->required();      
    }
    if($datos['i2_p9_check'] == 'SI'){
      $val->name('i2_p9_postventa')->value($datos['i2_p9_postventa'])->required();
    }
    //
    return $val->isSuccess()?true:$val->getErrors();    
  }

  private function prepareVariables($datos,$nit){
    $res = $datos['datos'];
    //
    $res['nit'] = base64_decode($nit);
    $res['clase'] = self::DISPLAY_NONE;
    $res['i5_p1_check'] = isset($res['i5_p1_check'])?$res['i5_p1_check']:'NO';
    $res['i5_p2_check'] = isset($res['i5_p2_check'])?$res['i5_p2_check']:'NO';
    $res['inicial_comAccionaria'] = count($res['list_comAccionaria']) < 1?$this->comAccionaria->itemInicial():'';    
    $res['inicial_comSociedad'] = count($res['list_comSociedad']) < 1?$this->comSociedad->itemInicial():'';
    $res['inicial_proContacto'] = count($res['list_proContacto']) < 1?$this->proContacto->itemInicial():'';
    $res['inicial_contacto'] = count($res['list_contacto']) < 1?$this->contacto->itemInicial():'';
    $res['list_comAccionaria'] = isset($res['list_comAccionaria'])?$res['list_comAccionaria']:array();
    $res['list_comSociedad'] =  isset($res['list_comSociedad'])?$res['list_comSociedad']:array();
    $res['list_proContacto'] = isset($res['list_proContacto'])?$res['list_proContacto']:array();
    $res['list_contacto'] = isset($res['list_contacto'])?$res['list_contacto']:array();
    return $res;  
  }

  private function organizarDatos($datos,$tipo = 'guardar'){    
    $datos_organizados = [
      $datos['nit'] = base64_decode($datos['nit']),
      $datos['tipo_actividad'],
      $datos['nro_empleados'],
      $datos['regimen'],
      $datos['cuenta_banco'],
      $datos['cuenta'],
      $datos['cuenta_tipo'],
      $datos['i2_p6_check'],
      $datos['i2_p6_empresas'],
      $datos['i2_p7_check'],
      $datos['i2_p7_plazo'],
      $datos['i2_p8_check'],
      $datos['i2_p9_check'],
      $datos['i2_p9_postventa'],
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



