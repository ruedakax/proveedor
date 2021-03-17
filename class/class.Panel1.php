<?php
error_reporting(E_ALL);
require_once("./class/class.Validation.php");
require_once("./class/class.View.php");

class Panel1{
  
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
    $html = $view->render('./views/view.panel1.php');
    //
    return $html;    
  }

  public function guardar($datos){
    $respuesta = ['res'=>'','mensaje'=>'','validaciones'=>[],'panel'=>[]];
    //
    $res = $this->validar($datos);
    if(!is_array($res)){
      $res = $this->execGuardar($datos);
      if($res==FALSE){
        $respuesta['mensaje'] = 'Error al Guardar o el NIT ya existe.';
        $respuesta['validaciones'] = [];
        $respuesta['panel'] = $datos;
        $respuesta['res'] = "error";        
      }else{
        if($datos['sucursales']=='SI'){//se guardan las sucursales
          //dir_su_
          $sucursales = $this->extraerSucursales($datos);
          $this->guardarSucursales($sucursales,$datos['nit']);
        }
        $respuesta['mensaje'] = 'La Información General Fue Guardada.';
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

  private function guardarSucursales($datos,$nit){
    $query_string = "INSERT INTO dbo.ruSucursales (nit,direccion,pais,ciudad,usuarioCrea) VALUES('%s','%s','%s','%s','%s')";
    $sql;
    try{
      foreach ($datos as $key => $value) {
        $query = sprintf($query_string,$nit,$value['direccion'],$value['pais'],$value['ciudad'],'proveedor');        
        $sql = odbc_exec($this->conn,$query);
      }
      odbc_close($this->conn);
    }catch (\Throwable $th) {      
      $sql = false;
    }
    return $sql;    
  }

  private function consultarSucursales($nit){
    $query_string = "SELECT direccion,pais,ciudad FROM dbo.ruSucursales WHERE nit = '%s'";
    $query_string = sprintf($query_string,$nit);    
    $sucursales = [];
    try {
      $sql = odbc_exec($this->conn,$query_string);
      while($registro = odbc_fetch_array($sql)){
        $sucursales[] = array('direccion'=>$registro['direccion'],'pais'=>$registro['pais'],'ciudad'=>$registro['ciudad']);
      }
      odbc_close($this->conn);
    }catch (\Throwable $th) {
      
    }  
    return $sucursales;    
  }

  private function extraerSucursales($datos){
    $suc_datos = array('pais'=>[],
                       'ciudad'=>[],
                       'direccion'=>[],
                      );
    $datos_final = [];
    //obtencion de la información desde el REQUEST
    foreach ($datos as $key => $value){
        if(stripos($key,'pais_suc_')!==FALSE && $value !=''){
          array_push($suc_datos['pais'],$value);
        }else if(stripos($key,'ciudad_suc_')!==FALSE && $value !=''){
          array_push($suc_datos['ciudad'],$value);        
        }else if(stripos($key,'dir_suc_')!==FALSE && $value !=''){
          array_push($suc_datos['direccion'],$value);
        }        
    }
    //organizar información 
    for($i=0; $i < count($suc_datos['pais']); $i++){
      if(isset($suc_datos['pais'][$i]) && isset($suc_datos['ciudad'][$i]) && isset($suc_datos['direccion'][$i]))
        $datos_final[$i] = ['pais'=>$suc_datos['pais'][$i],'ciudad'=>$suc_datos['ciudad'][$i],'direccion'=>$suc_datos['direccion'][$i]];
    }        
    return $datos_final;
  }  

  private function execGuardar($datos){
    //preparar datos
    $datos_organizados = [
      'nit'=>$datos['nit'],
      'tipo_registro'=>$datos['tipo_registro'],
      'nombre'=>$datos['nombre'],
      'tipo_persona'=>$datos['tipo_persona'],
      'rep_legal'=>$datos['rep_legal'],
      'rep_documento'=>$datos['rep_documento'],
      'rep_email'=>$datos['rep_email'],
      'tipo_sociedad'=>$datos['tipo_sociedad'],
      'contacto_nombre'=>$datos['contacto_nombre'],
      'contacto_celular'=>$datos['contacto_celular'],
      'contacto_email'=>$datos['contacto_email'],
      'contacto_site'=>$datos['contacto_site'],
      'contacto_telefono'=>$datos['contacto_telefono'],
      'direccion'=>$datos['direccion'],
      'pais'=>$datos['pais'],
      'ciudad'=>$datos['ciudad'],
      'sucursales'=>$datos['sucursales'],
      'reg_mercantil'=>$datos['reg_mercantil'],
      'reg_fecha'=>$datos['reg_fecha'],
      'escritura_num'=>$datos['escritura_num'],
      'escritura_fecha'=>$datos['escritura_fecha'],
      'escritura_notaria'=>$datos['escritura_notaria'],
      'escritura_ciudad'=>$datos['escritura_ciudad'],
      'autoretenedor'=>$datos['autoretenedor'],
      'retenedor_res'=>$datos['retenedor_res'],
      'ip_origen'=>$_SERVER['REMOTE_ADDR'],      
      'usuarioCrea'=>'proveedor',//ToDo
      'fechaCrea'=>date('Y-m-d'),
    ];
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
        $ok['datos'] = [];
      }else{
        if($datos_panel['sucursales'] == 'SI'){
          $datos_panel['list_sucursales'] = $this->consultarSucursales($datos_panel['nit']);
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
    $val->name('nombre')->value($datos['nombre'])->pattern('words')->required();
    $val->name('tipo_persona')->value($datos['tipo_persona'])->pattern('words')->required();
    if($datos['tipo_persona'] == 'juridica'){
      $val->name('rep_legal')->value($datos['rep_legal'])->pattern('words')->required();
      $val->name('rep_documento')->value($datos['rep_documento'])->required();
      $val->name('rep_email')->value($datos['rep_email'])->pattern('email')->required();      
    }
    $val->name('contacto_nombre')->value($datos['contacto_nombre'])->pattern('words')->required();
    $val->name('contacto_celular')->value($datos['contacto_celular'])->pattern('tel')->required();
    $val->name('contacto_email')->value($datos['contacto_email'])->pattern('email')->required();
    $val->name('contacto_site')->value($datos['contacto_site'])->required();
    $val->name('contacto_telefono')->value($datos['contacto_telefono'])->pattern('tel')->required();
    $val->name('direccion')->value($datos['direccion'])->required();
    $val->name('pais')->value($datos['pais'])->pattern('words')->required();
    $val->name('ciudad')->value($datos['ciudad'])->pattern('words')->required();
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
    if($val->isSuccess()){
      return true;
    }else{
    	return $val->getErrors();      
    }
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
}//end class



