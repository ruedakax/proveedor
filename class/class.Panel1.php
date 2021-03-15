<?php
error_reporting(E_ALL);
require_once("./class/class.Validation.php");

class Panel1{
  public $conn;      
  
  private function prepararPanel(){

  }  

  public function guardar($datos){
    $ok = ['res'=>'OK','mensaje'=>'Información General Guardada con Éxito','validaciones'=>[]];
    $error = ['res'=>'ERROR','mensaje'=>'','validaciones'=>[]];
    $res = $this->validar($datos);
    if($res===TRUE){
      $res = $this->execGuardar($datos);
      if($res===TRUE){
        $res = $ok;
      }else{
        $error['mensaje'] = 'Error al guardar';
        $error['validaciones'] = [];
        $res = $error;
      }
    }else{
      $error['mensaje'] = 'Algunos datos no son válidos';
      $error['validaciones'] = $res->errors;
      $res = $error;
    }
    
    return $res;
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
    $query_string = "INSERT INTO [dbo].[registroUnicoP1]
    ([nit]
    ,[tipo_registro]
    ,[nombre]
    ,[tipo_persona]
    ,[rep_legal]
    ,[rep_documento]
    ,[rep_email]
    ,[tipo_sociedad]
    ,[contacto_nombre]
    ,[contacto_celular]
    ,[contacto_email]
    ,[contacto_site]
    ,[contacto_telefono]
    ,[direccion]
    ,[pais]
    ,[ciudad]
    ,[sucursales]
    ,[reg_mercantil]
    ,[reg_fecha]
    ,[escritura_num]
    ,[escritura_fecha]
    ,[escritura_notaria]
    ,[escritura_ciudad]
    ,[autoretenedor]
    ,[retenedor_res]
    ,[ip_origen]    
    ,[usuarioCrea]
    ,[fechaCrea])    
    VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',%s)";
    $query_string = vsprintf($query_string,$datos_organizados);
    //echo $query_string;
    $sql;
    try {
      $sql = odbc_exec($this->conn,$query_string);    
    } catch (\Throwable $th) {
      $sql = false;
    }    
    return $sql;
  }    

  public function consultar($parametros){
    $ok = ['res'=>'OK','mensaje'=>'Consulta exitosa','datos'=>[]];
    $error = ['res'=>'ERROR','mensaje'=>'','validaciones'=>[]];
    $query_string = "SELECT nit
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
    ,fechaCrea    
    FROM dbo.registroUnicoP1
    WHERE nit = '%s'";
    $query_string = sprintf($query_string,base64_decode($parametros[0]));
    $res;
    try {
      $sql = odbc_exec($this->conn,$query_string);
      $datos_panel = odbc_fetch_array($sql);
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
    $val->name('nombre')->value($datos['nombre'])->pattern('words')->required();
    $val->name('tipo_persona')->value($datos['tipo_persona'])->pattern('words')->required();
    if($datos['tipo_persona'] == 'juridica'){
      $val->name('rep_legal')->value($datos['rep_legal'])->pattern('words')->required();
      $val->name('rep_documento')->value($datos['rep_documento'])->pattern('alpha')->required();
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
    	//return $val->getErrors();
      return $val;
    }
  }
}