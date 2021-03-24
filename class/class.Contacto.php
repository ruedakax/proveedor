<?php
error_reporting(E_ALL);
//
class Contacto {
    public $conn;

    public function extraer($datos){
        $suc_datos = array('contacto_nombre'=>[],
                           'contacto_identificacion'=>[],
                           'contacto_telefono'=>[],
                           'contacto_email'=>[]                       
                          );
        $datos_final = [];
        //obtencion de la información desde el REQUEST
        foreach ($datos as $key => $value){
            if(stripos($key,'contacto_nombre_')!==FALSE && $value !=''){
              array_push($suc_datos['contacto_nombre'],$value);
            }else if(stripos($key,'contacto_identificacion_')!==FALSE && $value !=''){
              array_push($suc_datos['contacto_identificacion'],$value);        
            }else if(stripos($key,'contacto_telefono_')!==FALSE && $value !=''){
              array_push($suc_datos['contacto_telefono'],$value);
            }else if(stripos($key,'contacto_email_')!==FALSE && $value !=''){
              array_push($suc_datos['contacto_email'],$value);
            }        
        }
        //organizar información 
        for($i=0; $i < count($suc_datos['contacto_nombre']); $i++){
          if(isset($suc_datos['contacto_nombre'][$i]) && isset($suc_datos['contacto_identificacion'][$i]) && isset($suc_datos['contacto_telefono'][$i])&& isset($suc_datos['contacto_email'][$i]))
            $datos_final[$i] = ['contacto_nombre'=>$suc_datos['contacto_nombre'][$i],'contacto_identificacion'=>$suc_datos['contacto_identificacion'][$i],'contacto_telefono'=>$suc_datos['contacto_telefono'][$i],'contacto_email'=>$suc_datos['contacto_email'][$i]];
        }        
        return $datos_final;
    }
    
    public function consultar($nit){
        $query_string = "SELECT [contacto_nombre],[contacto_identificacion],[contacto_telefono],[contacto_email] FROM dbo.ruContacto WHERE nit = '%s'";
        $query_string = sprintf($query_string,$nit);    
        $referencias = [];
        try {
          $sql = odbc_exec($this->conn,$query_string);
          while($registro = odbc_fetch_array($sql)){
            $referencias[] = array('contacto_nombre'=>$registro['contacto_nombre'],'contacto_identificacion'=>$registro['contacto_identificacion'],'contacto_telefono'=>$registro['contacto_telefono'],'contacto_email'=>$registro['contacto_email']);
          }
          //odbc_close($this->conn);
        }catch (\Throwable $th) {
          
        }  
        return $referencias;    
    }

    public function guardar($datos,$nit){
        $query_string = "INSERT INTO dbo.[ruContacto] (nit,contacto_nombre,contacto_identificacion,contacto_telefono,contacto_email) VALUES('%s','%s','%s','%s','%s')";
        $sql;
        try{
          foreach ($datos as $key => $value){
            $query = sprintf($query_string,$nit,$value['contacto_nombre'],$value['contacto_identificacion'],$value['contacto_telefono'],$value['contacto_email']);
            $sql = odbc_exec($this->conn,$query);
          }
          //odbc_close($this->conn);
        }catch (\Throwable $th){
          $sql = false;
        }
        return $sql;    
    }

    public function actualizar($datos,$nit){
        $query_string = "DELETE FROM  dbo.ruContacto WHERE nit = '%s'";
        $sql;
        try{
            $query = sprintf($query_string,$nit);
            $sql = odbc_exec($this->conn,$query)!=FALSE?$this->guardar($datos,$nit):FALSE;
            odbc_close($this->conn);
        }catch (\Throwable $th) {
          $sql = false;
        }
        return $sql;
    }

    public function itemInicial(){
        $item = '<div class="four-columns">                   
                  <fieldset>
                    <label class="c-form-label negrita" for="contacto_nombre_0">Nombre<span class="c-form-required"> *</span></label>
                    <input id="contacto_nombre_0" class="c-form-input" type="text" name="contacto_nombre_0" placeholder="Nombre Completo">
                  </fieldset>
                  <fieldset>
                    <label class="c-form-label negrita" for="contacto_identificacion_0">No. de Identificación<span class="c-form-required"> *</span></label>
                    <input id="contacto_identificacion_0" class="c-form-input" type="text" name="contacto_identificacion_0" placeholder="Número Nit/CC">
                  </fieldset>
                  <fieldset>
                    <label class="c-form-label negrita" for="contacto_telefono_0">Teléfono<span class="c-form-required"> *</span></label>
                    <input id="contacto_telefono_0" class="c-form-input" type="text" name="contacto_telefono_0" placeholder="Teléfono">
                  </fieldset>
                  <fieldset>
                    <label class="c-form-label negrita" for="contacto_email_0">Correo Electrónico<span class="c-form-required"> *</span></label>
                    <input id="contacto_email_0" class="c-form-input" type="text" name="contacto_email_0" placeholder="email">
                  </fieldset>                   
                </div>';
        return $item;
    }
}