<?php
error_reporting(E_ALL);
//
class ProContacto{
    public $conn;

    public function extraer($datos){
        $suc_datos = array('contacpro_nombre'=>[],
                           'contacpro_identificacion'=>[],
                           'contacpro_telefono'=>[],
                           'contacpro_email'=>[]                       
                          );
        $datos_final = [];
        //obtencion de la información desde el REQUEST
        foreach ($datos as $key => $value){
            if(stripos($key,'contacpro_nombre_')!==FALSE && $value !=''){
              array_push($suc_datos['contacpro_nombre'],$value);
            }else if(stripos($key,'contacpro_identificacion_')!==FALSE && $value !=''){
              array_push($suc_datos['contacpro_identificacion'],$value);        
            }else if(stripos($key,'contacpro_telefono_')!==FALSE && $value !=''){
              array_push($suc_datos['contacpro_telefono'],$value);
            }else if(stripos($key,'contacpro_email_')!==FALSE && $value !=''){
              array_push($suc_datos['contacpro_email'],$value);
            }        
        }
        //organizar información 
        for($i=0; $i < count($suc_datos['contacpro_nombre']); $i++){
          if(isset($suc_datos['contacpro_nombre'][$i]) && isset($suc_datos['contacpro_identificacion'][$i]) && isset($suc_datos['contacpro_telefono'][$i])&& isset($suc_datos['contacpro_email'][$i]))
            $datos_final[$i] = ['contacpro_nombre'=>$suc_datos['contacpro_nombre'][$i],'contacpro_identificacion'=>$suc_datos['contacpro_identificacion'][$i],'contacpro_telefono'=>$suc_datos['contacpro_telefono'][$i],'contacpro_email'=>$suc_datos['contacpro_email'][$i]];
        }        
        return $datos_final;
    }

    public function consultar($nit){
        $query_string = "SELECT [contacpro_nombre],[contacpro_identificacion],[contacpro_telefono],[contacpro_email] FROM dbo.ruProContacto WHERE nit = '%s'";
        $query_string = sprintf($query_string,$nit);    
        $referencias = [];
        try {
          $sql = odbc_exec($this->conn,$query_string);
          while($registro = odbc_fetch_array($sql)){
            $referencias[] = array('contacpro_nombre'=>$registro['contacpro_nombre'],'contacpro_identificacion'=>$registro['contacpro_identificacion'],'contacpro_telefono'=>$registro['contacpro_telefono'],'contacpro_email'=>$registro['contacpro_email']);
          }
          //odbc_close($this->conn);
        }catch (\Throwable $th) {
          
        }  
        return $referencias;    
    }

    public function guardar($datos,$nit){
        $query_string = "INSERT INTO dbo.[ruProContacto] (nit,contacpro_nombre,contacpro_identificacion,contacpro_telefono,contacpro_mail) VALUES('%s','%s','%s','%s','%s')";
        $sql;
        try{
          foreach ($datos as $key => $value){
            $query = sprintf($query_string,$nit,$value['contacpro_nombre'],$value['contacpro_identificacion'],$value['contacpro_telefono'],$value['contacpro_mail']);
            $sql = odbc_exec($this->conn,$query);
          }
          //odbc_close($this->conn);
        }catch (\Throwable $th){
          $sql = false;
        }
        return $sql;    
    }

    public function actualizar($datos,$nit){
        $query_string = "DELETE FROM  dbo.ruProContacto WHERE nit = '%s'";
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
                    <label class="c-form-label negrita" for="contacpro_nombre_0">Nombre<span class="c-form-required"> *</span></label>
                    <input id="contacpro_nombre_0" class="c-form-input" type="text" name="contacpro_nombre_0" placeholder="Nombre Completo">
                  </fieldset>
                  <fieldset>
                    <label class="c-form-label negrita" for="contacpro_identificacion_0">No. de Identificación<span class="c-form-required"> *</span></label>
                    <input id="contacpro_identificacion_0" class="c-form-input" type="text" name="contacpro_identificacion_0" placeholder="Número Nit/CC">
                  </fieldset>
                  <fieldset>
                    <label class="c-form-label negrita" for="contacpro_telefono_0">Teléfono<span class="c-form-required"> *</span></label>
                    <input id="contacpro_telefono_0" class="c-form-input" type="text" name="contacpro_telefono_0" placeholder="Teléfono">
                  </fieldset>
                  <fieldset>
                    <label class="c-form-label negrita" for="contacpro_email_0">Correo Electrónico<span class="c-form-required"> *</span></label>
                    <input id="contacpro_email_0" class="c-form-input" type="text" name="contacpro_email_0" placeholder="email">
                  </fieldset>                    
                </div>';
        return $item;
    }
}