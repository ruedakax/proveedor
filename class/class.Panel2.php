<?php
error_reporting(E_ALL);
require_once("./class/class.Validation.php");
require_once("./class/class.View.php");

class Panel2{
  
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
      if($res==FALSE){
        $nit = base64_decode($datos['nit']);
        $refBancarias = $this->extraerRefBancarias($datos);
        $res = $this->execActualizar($datos)!=FALSE?$this->actualizarRefBancarias($refBancarias,$nit):FALSE;
        $refExperiencia = $this->extraerRefExperiencia($datos);
        $res = $res!=FALSE?$this->actualizarRefExperiencia($refExperiencia,$nit):FALSE;
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
        $refBancarias = $this->extraerRefBancarias($datos);
        $this->guardarRefBancarias($refBancarias,$datos['nit']);
        $refExperiencia = $this->extraerRefExperiencia($datos);
        $this->guardarRefExperiencia($refExperiencia,$datos['nit']);
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

  private function extraerRefBancarias($datos){

    $suc_datos = array('banco'=>[],
                       'sucursal'=>[],
                       'cuenta'=>[],
                       'telefono'=>[],
                       'contacto'=>[],
                      );
    $datos_final = [];
    //obtencion de la información desde el REQUEST
    foreach ($datos as $key => $value){
        if(stripos($key,'refban_banco_')!==FALSE && $value !=''){
          array_push($suc_datos['banco'],$value);
        }else if(stripos($key,'refban_sucursal_')!==FALSE && $value !=''){
          array_push($suc_datos['sucursal'],$value);        
        }else if(stripos($key,'refban_cuenta_')!==FALSE && $value !=''){
          array_push($suc_datos['cuenta'],$value);
        }else if(stripos($key,'refban_telefono_')!==FALSE && $value !=''){
          array_push($suc_datos['telefono'],$value);
        }else if(stripos($key,'refban_contacto_')!==FALSE && $value !=''){
          array_push($suc_datos['contacto'],$value);
        }
    }
    //organizar información 
    for($i=0; $i < count($suc_datos['banco']); $i++){
      if(isset($suc_datos['banco'][$i]) && isset($suc_datos['sucursal'][$i]) && isset($suc_datos['cuenta'][$i])&& isset($suc_datos['telefono'][$i])&& isset($suc_datos['contacto'][$i]))
        $datos_final[$i] = ['banco'=>$suc_datos['banco'][$i],'sucursal'=>$suc_datos['sucursal'][$i],'cuenta'=>$suc_datos['cuenta'][$i],'telefono'=>$suc_datos['telefono'][$i],'contacto'=>$suc_datos['contacto'][$i]];
    }        
    return $datos_final;
  }  

  private function extraerRefExperiencia($datos){
    $suc_datos = array('empresa'=>[],
                       'contacto'=>[],
                       'cupos'=>[],
                      );
    $datos_final = [];
    //obtencion de la información desde el REQUEST
    foreach ($datos as $key => $value){
        if(stripos($key,'refcom_empresa_')!==FALSE && $value !=''){
          array_push($suc_datos['empresa'],$value);
        }else if(stripos($key,'refcom_contacto_')!==FALSE && $value !=''){
          array_push($suc_datos['contacto'],$value);
        }else if(stripos($key,'refcom_cupos_')!==FALSE && $value !=''){
          array_push($suc_datos['cupos'],$value);
        }
    }
    //organizar información 
    for($i=0; $i < count($suc_datos['empresa']); $i++){
      if(isset($suc_datos['empresa'][$i]) && isset($suc_datos['contacto'][$i]) && isset($suc_datos['cupos'][$i]))
        $datos_final[$i] = ['empresa'=>$suc_datos['empresa'][$i],'contacto'=>$suc_datos['contacto'][$i],'cupos'=>$suc_datos['cupos'][$i]];
    }        
    return $datos_final;
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
        $ok['datos'] = [];
      }else{        
        $datos_panel['list_refBancarias'] = $this->consultarRefBancarias($datos_panel['nit']);
        $datos_panel['list_refExperiencia'] = $this->consultarRefExperiencia($datos_panel['nit']);
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
    $res['inicial_refBancarias'] = isset($res['list_refBancarias'])?'':$this->refBancariasInicial();
    $res['inicial_refExperiencia'] = isset($res['list_refExperiencia'])?'':$this->RefExperienciaInicial();
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

  private function guardarRefBancarias($datos,$nit){
    $query_string = "INSERT INTO dbo.ruRefBancarias (nit,banco,sucursal,cuenta,telefono,contacto) VALUES('%s','%s','%s','%s','%s','%s')";
    $sql;
    try{
      foreach ($datos as $key => $value){
        $query = sprintf($query_string,$nit,$value['banco'],$value['sucursal'],$value['cuenta'],$value['telefono'],$value['contacto'],'proveedor');
        $sql = odbc_exec($this->conn,$query);
      }
      //odbc_close($this->conn);
    }catch (\Throwable $th){
      $sql = false;
    }
    return $sql;    
  }

  private function actualizarRefBancarias($datos,$nit){
    $query_string = "DELETE FROM  dbo.ruRefBancarias WHERE nit = '%s'";
    $sql;
    try{
        $query = sprintf($query_string,$nit);        
        $sql = odbc_exec($this->conn,$query)!=FALSE?$this->guardarRefBancarias($datos,$nit):FALSE;
    }catch (\Throwable $th) {
      $sql = false;
    }
    return $sql;    
  }

  private function consultarRefBancarias($nit){
    $query_string = "SELECT banco,sucursal,cuenta,telefono,contacto FROM dbo.ruRefBancarias WHERE nit = '%s'";
    $query_string = sprintf($query_string,$nit);    
    $referencias = [];
    try {
      $sql = odbc_exec($this->conn,$query_string);
      while($registro = odbc_fetch_array($sql)){
        $referencias[] = array('banco'=>$registro['banco'],'sucursal'=>$registro['sucursal'],'cuenta'=>$registro['cuenta'],'telefono'=>$registro['telefono'],'contacto'=>$registro['contacto']);
      }
      //odbc_close($this->conn);
    }catch (\Throwable $th) {
      
    }  
    return $referencias;    
  }

  private function guardarRefExperiencia($datos,$nit){
    $query_string = "INSERT INTO dbo.ruRefExperiencia (nit,empresa,contacto,cupos) VALUES('%s','%s','%s','%s')";
    $sql;
    try{
      foreach ($datos as $key => $value){
        $query = sprintf($query_string,$nit,$value['empresa'],$value['contacto'],$value['cupos'],'proveedor');
        $sql = odbc_exec($this->conn,$query);
      }
      //odbc_close($this->conn);
    }catch (\Throwable $th){
      $sql = false;
    }
    return $sql;    
  }

  private function actualizarRefExperiencia($datos,$nit){
    $query_string = "DELETE FROM  dbo.ruRefExperiencia WHERE nit = '%s'";
    $sql;
    try{
        $query = sprintf($query_string,$nit);        
        $sql = odbc_exec($this->conn,$query)!=FALSE?$this->guardarRefExperiencia($datos,$nit):FALSE;
        odbc_close($this->conn);
    }catch (\Throwable $th) {
      $sql = false;
    }
    return $sql;    
  }

  private function consultarRefExperiencia($nit){
    $query_string = "SELECT empresa,contacto,cupos FROM dbo.ruRefExperiencia WHERE nit = '%s'";
    $query_string = sprintf($query_string,$nit);    
    $referencias = [];
    try {
      $sql = odbc_exec($this->conn,$query_string);
      while($registro = odbc_fetch_array($sql)){
        $referencias[] = array('empresa'=>$registro['empresa'],'contacto'=>$registro['contacto'],'cupos'=>$registro['cupos']);
      }
      odbc_close($this->conn);
    }catch (\Throwable $th) {
      
    }  
    return $referencias;    
  }

  private function refBancariasInicial(){
    $item = '<div>     
              <div class="five-columns">
                <fieldset>
                    <label class="c-form-label negrita" for="refban_banco_0">Banco<span class="c-form-required"> *</span></label>
                    <input id="refban_banco_0" class="c-form-input" type="text" name="refban_banco_0" placeholder="Banco" value="">
                </fieldset>
                <fieldset>
                    <label class="c-form-label negrita" for="refban_sucursal_0">Sucursal<span class="c-form-required"> *</span></label>
                    <input id="refban_sucursal_0" class="c-form-input" type="text" name="refban_sucursal_0" placeholder="Sucursal" value="">
                </fieldset>
                <fieldset>
                    <label class="c-form-label negrita" for="refban_cuenta_0">Nro. Cuenta<span class="c-form-required"> *</span></label>
                    <input id="refban_cuenta_0" class="c-form-input" type="text" name="refban_cuenta_0" placeholder="Número de cuenta" value="">
                </fieldset>
                <fieldset>
                    <label class="c-form-label negrita" for="refban_telefono_0">Teléfono<span class="c-form-required"> *</span></label>
                    <input id="refban_telefono_0" class="c-form-input" type="text" name="refban_telefono_0" placeholder="Teléfono" value="">
                </fieldset>
                <fieldset>
                    <label class="c-form-label negrita" for="refban_contacto_0">Persona Contacto<span class="c-form-required"> *</span></label>
                    <input id="refban_contacto_0" class="c-form-input" type="text" name="refban_contacto_0" placeholder="Nombre del contacto" value="">
                </fieldset>
              </div>
            </div>';
    return $item;
  }

  private function RefExperienciaInicial(){
    $item = '<div>     
                <div class="three-columns">
                    <fieldset>
                        <label class="c-form-label negrita" for="refcom_empresa_0">Empresa<span class="c-form-required"> *</span></label>
                        <input id="refcom_empresa_0" class="c-form-input" type="text" name="refcom_empresa_0" placeholder="Banco" value="">
                    </fieldset>
                    <fieldset>
                        <label class="c-form-label negrita" for="refcom_contacto_0">Contacto<span class="c-form-required"> *</span></label>
                        <input id="refcom_contacto_0" class="c-form-input" type="text" name="refcom_contacto_0" placeholder="Sucursal" value="">
                    </fieldset>
                    <fieldset>
                        <label class="c-form-label negrita" for="refban_cuenta_0">Cupos<span class="c-form-required"> *</span></label>
                        <input id="refcom_cupos_0" class="c-form-input" type="text" name="refcom_cupos_0" placeholder="Cupos" value="">
                    </fieldset>
                </div>
            </div>';
    return $item;
  }
}//end class



