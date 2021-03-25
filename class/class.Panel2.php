<?php
//error_reporting(E_ALL);
require_once("./class/class.Validation.php");
require_once("./class/class.View.php");
require_once("./class/class.RefBancarias.php");
require_once("./class/class.RefExperiencia.php");

class Panel2{
  
  const DISPLAY_NONE = 'oculto';
  //
  public $conn;

  private $refBancarias;

  private $refExperiencia;

  function setComplemento(){
    $this->refBancarias = new RefBancarias;
    $this->refBancarias->conn = $this->conn;
    $this->refExperiencia = new RefExperiencia;
    $this->refExperiencia->conn = $this->conn;    
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
    $html = $view->render('./views/view.panel2.php');
    //
    return $html;    
  }

  public function guardar($datos){    
    $respuesta = ['res'=>'','mensaje'=>'','validaciones'=>[],'panel'=>[]];  
    $datos['i2_p9_postventa'] = isset($datos['i2_p9_postventa'])?$datos['i2_p9_postventa']:'';      
    $res = $this->validar($datos);        
    if(!is_array($res)){
      $res = $this->execGuardar($datos);
      $nit = base64_decode($datos['nit']);
      if($res==FALSE){                
        $refBancarias = $this->refBancarias->extraer($datos);
        $res = $this->execActualizar($datos)!=FALSE?$this->refBancarias->actualizar($refBancarias,$nit):FALSE;
        $refExperiencia = $this->refExperiencia->extraer($datos);
        $res = $res!=FALSE?$this->refExperiencia->actualizar($refExperiencia,$nit):FALSE;
        if($res){
          $respuesta['mensaje'] = 'La Sección dos Ha sido ACTUALIZADA.';
          $respuesta['validaciones'] = [];
          $respuesta['res'] = "success";
        }else{
          $respuesta['mensaje'] = 'Error al Guardar';
          $respuesta['validaciones'] = [];
          $respuesta['panel'] = $datos;
          $respuesta['res'] = "error";
        }
      }else{        
        $refBancarias = $this->refBancarias->extraer($datos);
        $this->refBancarias->guardar($refBancarias,$datos['nit']);
        $refExperiencia = $this->refExperiencia->extraer($datos);
        $this->refExperiencia->guardar($refExperiencia,$datos['nit']);
        $respuesta['mensaje'] = 'La Sección dos Ha sido GUARDADA.';
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
    $query_string = "SELECT nit
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
    ,fechaCrea    
    FROM dbo.registroUnicoP2
    WHERE nit = '%s'";
    $query_string = sprintf($query_string,base64_decode($parametros[0]));
    $res;
    try {
      $sql = odbc_exec($this->conn,$query_string);
      $datos_panel = odbc_fetch_array($sql);
      //odbc_close($this->conn);
      if(!$datos_panel){
        $ok['mensaje'] = "No existe";
        $ok['datos'] = array('list_refBancarias' => array(),'list_refExperiencia' => array());
      }else{        
        $datos_panel['list_refBancarias'] = $this->refBancarias->consultar($datos_panel['nit']);
        $datos_panel['list_refExperiencia'] = $this->refExperiencia->consultar($datos_panel['nit']);
        $ok['datos'] = $datos_panel;
      }     
      $res = $ok;
    } catch (\Throwable $th) {
      //ToDo : redireccinar a pagina de error?
      var_dump($th);
      $error['mensaje'] = 'Error en consulta';
      $error['validaciones'] = [];
      $error['datos'] = [];
      $res = $error;
    }    
    return $res;
  }	
  
  private function validar($datos){    
    $val = new Validation();
    $val->name('nit')->value($datos['nit'])->required();
    $val->name('tipo_actividad')->value($datos['tipo_actividad'])->pattern('alpha')->required();
    $val->name('nro_empleados')->value($datos['nro_empleados'])->pattern('text')->required();
    $val->name('regimen')->value($datos['regimen'])->pattern('text')->required();
    $val->name('cuenta_banco')->value($datos['cuenta_banco'])->pattern('text')->required();
    $val->name('cuenta')->value($datos['cuenta'])->pattern('text')->required();
    $val->name('cuenta_tipo')->value($datos['cuenta_tipo'])->pattern('alpha')->required();
    $val->name('refban_sucursal_0')->value($datos['refban_sucursal_0'])->pattern('text')->required();
    $val->name('refban_banco_0')->value($datos['refban_banco_0'])->pattern('text')->required();
    $val->name('refban_cuenta_0')->value($datos['refban_cuenta_0'])->pattern('text')->required();
    $val->name('refban_telefono_0')->value($datos['refban_telefono_0'])->pattern('tel')->required();
    $val->name('refban_contacto_0')->value($datos['refban_contacto_0'])->pattern('text')->required();
    $val->name('refcom_empresa_0')->value($datos['refcom_empresa_0'])->pattern('text')->required();
    $val->name('refcom_contacto_0')->value($datos['refcom_contacto_0'])->pattern('text')->required();
    $val->name('refcom_cupos_0')->value($datos['refcom_cupos_0'])->pattern('text')->required();
    if($datos['i2_p6_check'] == 'SI'){
      $val->name('i2_p6_empresas')->value($datos['i2_p6_empresas'])->pattern('text')->required();      
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

  private function prepareOptions($options,$selected){
    if(!empty($selected)){
      array_unshift($options, $selected);
      $options = array_unique($options);
    }
    $html = '';
    foreach ($options as $key => $value) {
      $selected = $key===0?'selected':'';
      $html .='<option value="'.$value.'" '.$selected.'>'.strtoupper($value).'</option>';
    }
    return $html;
  }

  private function prepareVariables($datos,$nit){    
    $res = $datos['datos'];
    $res['nit'] = base64_decode($nit);
    $res['clase'] = self::DISPLAY_NONE;
    $plazo = isset($res['i2_p7_plazo'])?$res['i2_p7_plazo']:'30';
    $res['i2_p7_plazo_options'] = $this->prepareOptions(array('30','60','90'),$plazo);
    $res['tipo_actividad'] = isset($res['tipo_actividad'])?$res['tipo_actividad']:'contratista';
    $res['nro_empleados'] = isset($res['nro_empleados'])?$res['nro_empleados']:'0_50';
    $res['regimen'] = isset($res['regimen'])?$res['regimen']:'gran contribuyente';    
    $res['cuenta_tipo'] = isset($res['cuenta_tipo'])?$res['cuenta_tipo']:'ahorros';
    $res['i2_p6_check'] = isset($res['i2_p6_check'])?$res['i2_p6_check']:'NO';
    $res['i2_p7_check'] = isset($res['i2_p7_check'])?$res['i2_p7_check']:'NO';
    $res['i2_p8_check'] = isset($res['i2_p8_check'])?$res['i2_p8_check']:'NO';
    $res['i2_p9_check'] = isset($res['i2_p9_check'])?$res['i2_p9_check']:'NO';
    $res['inicial_refBancarias'] = count($res['list_refBancarias']) < 1?$this->refBancarias->itemInicial():'';
    $res['inicial_refExperiencia'] = count($res['list_refExperiencia']) < 1?$this->refExperiencia->itemInicial():'';
    $res['list_refBancarias'] = isset($res['list_refBancarias'])?$res['list_refBancarias']:array();
    $res['list_refExperiencia'] = isset($res['list_refExperiencia'])?$res['list_refExperiencia']:array();
    $res['i2_p9_postventa'] = isset($res['i2_p9_postventa'])?$res['i2_p9_postventa']:'';    
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




