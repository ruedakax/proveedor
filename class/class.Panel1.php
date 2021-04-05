<?php
//error_reporting(E_ALL);
require_once("./class/class.Sucursales.php");
require_once("./class/class.Validation.php");
require_once("./class/class.View.php");

class Panel1{
  
  const DISPLAY_NONE = 'oculto';

  private $sucursales;
  //
  public $conn;

  function setComplemento(){
    $this->sucursales = new Sucursales;
    $this->sucursales->conn = $this->conn;
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
    $template = $soloMostrar==FALSE?'./views/view.panel1.php':'./views/view.displayPanel1.php';
    $html = $view->render($template);
    //
    return $html;
  }

  public function guardar($datos){    
    //
    $respuesta = ['res'=>'','mensaje'=>'','validaciones'=>[],'panel'=>[]];
    //
    $res = $this->validar($datos);
    if(!is_array($res)){
      $res = $this->execGuardar($datos);
      if($res==FALSE){
        $sucursales = $this->sucursales->extraer($datos);
        $res = $this->execActualizar($datos);
        if($datos['sucursales']=='SI' && $res){          
          $res = $this->sucursales->actualizar($sucursales,$datos['nit']);
        }
        if($res){
          $respuesta['mensaje'] = 'La Sección Uno Ha Sido ACTUALIZADA.';
          $respuesta['validaciones'] = [];
          $respuesta['res'] = "success";
        }else{
          $respuesta['mensaje'] = 'Error al Guardar';
          $respuesta['validaciones'] = [];
          $respuesta['panel'] = $datos;
          $respuesta['res'] = "error";
        }
      }else{
        if($datos['sucursales']=='SI'){//se guardan las sucursales          
          $sucursales = $this->sucursales->extraer($datos);
          $this->sucursales->guardar($sucursales,$datos['nit']);
        }
        $respuesta['mensaje'] = 'La Sección Uno Ha Sido GUARDADA.';
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
    $query_string = "INSERT INTO dbo.registroUnicoP1
    (nit
    ,tipo_registro
    ,nombre
    ,tipo_persona
    ,rep_legal
    ,rep_documento
    ,rep_email
    ,tipo_sociedad
    ,contacto_nombre
    ,contacto_celular
    ,contacto_email
    ,contacto_site
    ,contacto_telefono
    ,direccion
    ,pais
    ,ciudad
    ,sucursales
    ,reg_mercantil
    ,reg_fecha
    ,escritura_num
    ,escritura_fecha
    ,escritura_notaria
    ,escritura_ciudad
    ,autoretenedor
    ,retenedor_res
    ,ip_origen
    ,usuarioCrea
    ,fechaCrea)    
    VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',%s)";
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
    $query_string = "UPDATE dbo.registroUnicoP1 SET tipo_registro = '%s'
    ,nombre = '%s'
    ,tipo_persona = '%s'
    ,rep_legal = '%s'
    ,rep_documento = '%s'
    ,rep_email = '%s'
    ,tipo_sociedad = '%s'
    ,contacto_nombre = '%s'
    ,contacto_celular = '%s'
    ,contacto_email = '%s'
    ,contacto_site = '%s'
    ,contacto_telefono = '%s'
    ,direccion = '%s'
    ,pais = '%s'
    ,ciudad = '%s'
    ,sucursales = '%s'
    ,reg_mercantil = '%s'
    ,reg_fecha = '%s'
    ,escritura_num = '%s'
    ,escritura_fecha = '%s'
    ,escritura_notaria = '%s'
    ,escritura_ciudad = '%s'
    ,autoretenedor = '%s'
    ,retenedor_res = '%s'
    ,ip_origen    = '%s'
    ,usuarioCrea = '%s'
    ,fechaCrea = %s
    WHERE nit = '%s'
    ";
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
    //
    $ok = ['res'=>'OK','res_bool'=>TRUE,'mensaje'=>'Consulta exitosa','datos'=>[]];
    $error = ['res'=>'ERROR','res_bool'=>FALSE,'mensaje'=>'','validaciones'=>[]];
    //
    $query_string = "SELECT nit
    ,nombre
    ,tipo_registro
    ,tipo_persona
    ,rep_legal
    ,rep_documento
    ,rep_email
    ,tipo_sociedad
    ,contacto_nombre
    ,contacto_celular
    ,contacto_email
    ,contacto_site
    ,contacto_telefono
    ,direccion
    ,pais
    ,ciudad
    ,sucursales
    ,reg_mercantil
    ,reg_fecha
    ,escritura_num
    ,escritura_fecha
    ,escritura_notaria
    ,escritura_ciudad
    ,autoretenedor
    ,retenedor_res
    ,ip_origen
    ,usuarioCrea
    ,fechaCrea    
    FROM dbo.registroUnicoP1
    WHERE nit = '%s'";
    $query_string = sprintf($query_string,base64_decode($parametros[0]));
    $res;
    try {
      $sql = odbc_exec($this->conn,$query_string);
      $datos_panel = odbc_fetch_array($sql);
      //odbc_close($this->conn);
      if(!$datos_panel){
        $ok['mensaje'] = "No existe";
        $ok['datos'] = array('list_sucursales' => array());;
      }else{
        if($datos_panel['sucursales'] == 'SI'){
          $datos_panel['list_sucursales'] = $this->sucursales->consultar($datos_panel['nit']);
        }
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
    $val->name('nombre')->value($datos['nombre'])->pattern('text')->required();
    $val->name('tipo_persona')->value($datos['tipo_persona'])->pattern('text')->required();
    if($datos['tipo_persona'] == 'juridica'){
      $val->name('rep_legal')->value($datos['rep_legal'])->pattern('text')->required();
      $val->name('rep_documento')->value($datos['rep_documento'])->required();
      $val->name('rep_email')->value($datos['rep_email'])->pattern('email')->required();      
    }
    $val->name('contacto_nombre')->value($datos['contacto_nombre'])->pattern('text')->required();
    $val->name('contacto_celular')->value($datos['contacto_celular'])->pattern('tel')->required();
    $val->name('contacto_email')->value($datos['contacto_email'])->pattern('email')->required();
    $val->name('contacto_site')->value($datos['contacto_site'])->required();
    $val->name('contacto_telefono')->value($datos['contacto_telefono'])->pattern('tel')->required();
    $val->name('direccion')->value($datos['direccion'])->required();
    $val->name('pais')->value($datos['pais'])->pattern('text')->required();
    $val->name('ciudad')->value($datos['ciudad'])->pattern('text')->required();
    $val->name('reg_mercantil')->value($datos['reg_mercantil'])->required();
    $val->name('reg_fecha')->value($datos['reg_fecha'])->pattern('date_ymd')->required();
    $val->name('escritura_num')->value($datos['escritura_num'])->pattern('alphanum')->required();
    $val->name('escritura_fecha')->value($datos['escritura_fecha'])->pattern('date_ymd')->required();
    $val->name('escritura_notaria')->value($datos['escritura_notaria'])->required();
    $val->name('escritura_ciudad')->value($datos['escritura_ciudad'])->required();
    $val->name('autoretenedor')->value($datos['autoretenedor'])->pattern('alpha')->required();
    if($datos['autoretenedor'] == 'SI'){
      $val->name('retenedor_res')->value($datos['retenedor_res'])->required();
    }
    return $val->isSuccess()?true:$val->getErrors();
  }
  //
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
  //
  private function prepareVariables($datos,$nit){
    $res = $datos['datos'];
    $res['nit'] = base64_decode($nit);
    $res['clase'] = self::DISPLAY_NONE;
    $tipo_persona = isset($res['tipo_persona'])?$res['tipo_persona']:'natural';
    $res['tipo_persona_options'] = $this->prepareOptions(array('natural','juridica'),$tipo_persona);
    $res['tipo_sociedad'] = isset($res['tipo_sociedad'])?$res['tipo_sociedad']:'ESAL';
    $res['sucursales'] = isset($res['sucursales'])?$res['sucursales']:'NO';
    $res['list_sucursales'] = isset($res['list_sucursales'])?$res['list_sucursales']:array();
    $res['autoretenedor'] = isset($res['autoretenedor'])?$res['autoretenedor']:'NO';
    return $res;  
  }
  private function organizarDatos($datos,$tipo = 'guardar'){    
    $datos_organizados = [
      $datos['nit'],
      $datos['tipo_registro'],
      $datos['nombre'],
      $datos['tipo_persona'],
      $datos['rep_legal'],
      $datos['rep_documento'],
      $datos['rep_email'],
      $datos['tipo_sociedad'],
      $datos['contacto_nombre'],
      $datos['contacto_celular'],
      $datos['contacto_email'],
      $datos['contacto_site'],
      $datos['contacto_telefono'],
      $datos['direccion'],
      $datos['pais'],
      $datos['ciudad'],
      $datos['sucursales'],
      $datos['reg_mercantil'],
      $datos['reg_fecha'],
      $datos['escritura_num'],
      $datos['escritura_fecha'],
      $datos['escritura_notaria'],
      $datos['escritura_ciudad'],
      $datos['autoretenedor'],
      $datos['retenedor_res'],
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



