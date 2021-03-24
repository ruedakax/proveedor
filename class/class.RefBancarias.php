<?php
error_reporting(E_ALL);
//
class RefBancarias{
    public $conn;

    public function extraer($datos){

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

    public function guardar($datos,$nit){
        $query_string = "INSERT INTO dbo.ruRefBancarias (nit,banco,sucursal,cuenta,telefono,contacto) VALUES('%s','%s','%s','%s','%s','%s')";
        $sql;
        try{
          foreach ($datos as $key => $value){
            $query = sprintf($query_string,$nit,$value['banco'],$value['sucursal'],$value['cuenta'],$value['telefono'],$value['contacto'],'proveedor');
            $sql = odbc_exec($this->conn,$query);
          }
          //odbc_close($this->conn);
        }catch (\Throwable $th){
            var_dump($th);          
            $sql = false;
        }
        return $sql;    
    }
    
    public function actualizar($datos,$nit){
        $query_string = "DELETE FROM  dbo.ruRefBancarias WHERE nit = '%s'";
        $sql;
        try{
            $query = sprintf($query_string,$nit);        
            $sql = odbc_exec($this->conn,$query)!=FALSE?$this->guardar($datos,$nit):FALSE;
        }catch (\Throwable $th) {
            var_dump($th);
            $sql = false;
        }
        return $sql;    
      }
    
      public function consultar($nit){
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
            var_dump($th);          
        }  
        return $referencias;    
    }

    public function itemInicial(){
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
}