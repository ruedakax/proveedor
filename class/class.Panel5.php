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
    $this->comAccionaria = new comAccionaria;
    $this->comAccionaria->conn = $this->conn;
    $this->comSociedad = new comSociedad;
    $this->comSociedad->conn = $this->conn;    
    $this->proContacto = new ProContacto;
    $this->proContacto->conn = $this->conn;
    $this->contacto = new Contacto;
    $this->contacto->conn = $this->conn;
  }
  
  public function preparar($datos,$soloMostrar=FALSE){
    $res = $this->consultar(array($datos['i']));    
    ///Preparacion de datos para la vista segun las condiciones del formulario    
    $res_preparados = $res['res']!='error'?$this->prepareVariables($res,$datos['i']):array();    
    //
    $view = new View;
    // asignar datos
    $view->data['datos'] = $res_preparados;
    // render
    $template = $soloMostrar==FALSE?'./views/view.panel5.php':'./views/view.displayPanel5.php';
    $html = $view->render($template);
    //
    return $html;
  }

  public function guardar($datos){
    $respuesta = ['res'=>'','mensaje'=>'','validaciones'=>[],'panel'=>[]];
    $res = $this->validar($datos);
    if(!is_array($res)){
      $res = $this->execGuardar($datos);
      $nit = base64_decode($datos['nit']);      
      if($res==FALSE){
        if($datos['tipoPersona']==='juridica'){
          $comAccionaria = $this->comAccionaria->extraer($datos);
          $res = $this->execActualizar($datos)!=FALSE?$this->comAccionaria->actualizar($comAccionaria,$nit):FALSE;
          $comSociedad = $this->comSociedad->extraer($datos);
          $res = $res!=FALSE?$this->comSociedad->actualizar($comSociedad,$nit):FALSE;
        }else{
          $res=TRUE;
        }
        $proContacto = $this->proContacto->extraer($datos);
        $res = $res!=FALSE?$this->proContacto->actualizar($proContacto,$nit):FALSE;        
        $contacto = $this->contacto->extraer($datos);
        $res = $res!=FALSE?$this->contacto->actualizar($contacto,$nit):FALSE;        
        if($res){
          $respuesta['mensaje'] = 'La Sección Cinco Ha Sido ACTUALIZADA.';
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
          $this->comAccionaria->guardar($comAccionaria,$nit);
          $comSociedad = $this->comSociedad->extraer($datos);
          $this->comSociedad->guardar($comSociedad,$nit);
        }        
        $proContacto = $this->proContacto->extraer($datos);
        $this->proContacto->guardar($proContacto,$nit);
        $contacto = $this->contacto->extraer($datos);
        $this->contacto->guardar($contacto,$nit);
        $respuesta['mensaje'] = 'La Sección Cinco Ha Sido GUARDADA.';
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
    $query_string = "INSERT INTO dbo.registroUnicoP5
    ([nit]
      ,[i5_p1_check]
      ,[i5_p2_check]
      ,[i5_p3_representante]
      ,[i5_p3_representado]
      ,[i5_p4_fuentes]
      ,[ip_origen]
      ,[usuarioCrea]
      ,[fechaCrea])
    VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s')";    
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
    $query_string = "UPDATE dbo.registroUnicoP5 SET i5_p1_check = '%s'
    ,i5_p2_check = '%s'
    ,i5_p3_representante = '%s'
    ,i5_p3_representado = '%s'
    ,i5_p4_fuentes = '%s'
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
    if($datos['tipoPersona'] == 'juridica'){
      //      
      $val->name('i5_p2_check')->value($datos['i5_p2_check'])->pattern('alpha')->required();
      $val->name('i5_p3_representante')->value($datos['i5_p3_representante'])->pattern('text')->required();
      $val->name('i5_p3_representado')->value($datos['i5_p3_representado'])->pattern('text')->required();
      $val->name('i5_p4_fuentes')->value($datos['i5_p4_fuentes'])->pattern('text')->required();    
      //
      $val->name('acci_nombre_0')->value($datos['acci_nombre_0'])->pattern('text')->required();
      $val->name('acci_nit_0')->value($datos['acci_nit_0'])->pattern('alphanum')->required();
      $val->name('acci_porcentaje_0')->value($datos['acci_porcentaje_0'])->pattern('text')->required();
      $val->name('acci_vinculado_0')->value($datos['acci_vinculado_0'])->pattern('text')->required();
      //
      $val->name('socied_nombre_0')->value($datos['socied_nombre_0'])->pattern('text')->required();
      $val->name('socied_identificacion_0')->value($datos['socied_identificacion_0'])->pattern('text')->required();
      $val->name('socied_empresa_0')->value($datos['socied_empresa_0'])->pattern('text')->required();
      $val->name('socied_porcentaje_0')->value($datos['socied_porcentaje_0'])->pattern('text')->required();      
      ///      
    }
    $val->name('contacpro_nombre_0')->value($datos['contacpro_nombre_0'])->pattern('text')->required();
    $val->name('contacpro_identificacion_0')->value($datos['contacpro_identificacion_0'])->pattern('text')->required();
    $val->name('contacpro_telefono_0')->value($datos['contacpro_telefono_0'])->pattern('tel')->required();
    $val->name('contacpro_email_0')->value($datos['contacpro_email_0'])->pattern('email')->required();
    //
    $val->name('contacto_nombre_0')->value($datos['contacto_nombre_0'])->pattern('text')->required();
    $val->name('contacto_identificacion_0')->value($datos['contacto_identificacion_0'])->pattern('text')->required();
    $val->name('contacto_telefono_0')->value($datos['contacto_telefono_0'])->pattern('tel')->required();
    $val->name('contacto_email_0')->value($datos['contacto_email_0'])->pattern('email')->required();          
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
      $datos['i5_p1_check'],
      $datos['i5_p2_check'],
      $datos['i5_p3_representante'],
      $datos['i5_p3_representado'],
      $datos['i5_p4_fuentes'],      
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



