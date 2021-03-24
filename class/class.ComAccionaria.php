<?php
error_reporting(E_ALL);
//
class ComAccionaria{
    public $conn;

    public function extraer($datos){

        $suc_datos = array('acci_nombre'=>[],
                           'acci_nit'=>[],
                           'acci_porcentaje'=>[],
                           'acci_vinculado'=>[]                       
                          );
        $datos_final = [];
        //obtencion de la información desde el REQUEST
        foreach ($datos as $key => $value){
            if(stripos($key,'acci_nombre_')!==FALSE && $value !=''){
              array_push($suc_datos['acci_nombre'],$value);
            }else if(stripos($key,'acci_nit_')!==FALSE && $value !=''){
              array_push($suc_datos['acci_nit'],$value);        
            }else if(stripos($key,'acci_porcentaje_')!==FALSE && $value !=''){
              array_push($suc_datos['acci_porcentaje'],$value);
            }else if(stripos($key,'acci_vinculado_')!==FALSE && $value !=''){
              array_push($suc_datos['acci_vinculado'],$value);
            }        
        }
        //organizar información 
        for($i=0; $i < count($suc_datos['acci_nombre']); $i++){
          if(isset($suc_datos['acci_nombre'][$i]) && isset($suc_datos['acci_nit'][$i]) && isset($suc_datos['acci_porcentaje'][$i])&& isset($suc_datos['acci_vinculado'][$i]))
            $datos_final[$i] = ['acci_nombre'=>$suc_datos['acci_nombre'][$i],'acci_nit'=>$suc_datos['acci_nit'][$i],'acci_porcentaje'=>$suc_datos['acci_porcentaje'][$i],'acci_vinculado'=>$suc_datos['acci_vinculado'][$i]];
        }        
        return $datos_final;
    }  

    public function consultar($nit){
        $query_string = "SELECT [acci_nombre],[acci_nit],[acci_porcentaje],[acci_vinculado] FROM dbo.ruComAccionaria WHERE nit = '%s'";
        $query_string = sprintf($query_string,$nit);    
        $referencias = [];
        try {
          $sql = odbc_exec($this->conn,$query_string);
          while($registro = odbc_fetch_array($sql)){
            $referencias[] = array('acci_nombre'=>$registro['acci_nombre'],'acci_nit'=>$registro['acci_nit'],'acci_porcentaje'=>$registro['acci_porcentaje'],'acci_vinculado'=>$registro['acci_vinculado']);
          }
          //odbc_close($this->conn);
        }catch (\Throwable $th) {
            var_dump($th);
        }
        return $referencias;
    }

    public function guardar($datos,$nit){
        $query_string = "INSERT INTO dbo.ruComAccionaria (nit,acci_nombre,acci_nit,acci_porcentaje,acci_vinculado) VALUES('%s','%s','%s','%s','%s')";
        $sql;
        try{
          foreach ($datos as $key => $value){
            $query = sprintf($query_string,$nit,$value['acci_nombre'],$value['acci_nit'],$value['acci_porcentaje'],$value['acci_vinculado']);
            $sql = odbc_exec($this->conn,$query);
          }
          //odbc_close($this->conn);
        }catch (\Throwable $th){
          $sql = false;
        }
        return $sql;    
    }

    public function actualizar($datos,$nit){
        $query_string = "DELETE FROM  dbo.ruComAccionaria WHERE nit = '%s'";
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
    
    private function itemInicial(){
        $item = '<div>              
                  <div class="four-columns">
                    <fieldset>
                      <label class="c-form-label negrita" for="acci_nombre_0">Nombre<span class="c-form-required"> *</span></br></br></label>
                      <input id="acci_nombre_0" class="c-form-input" type="text" name="acci_nombre_0" placeholder="Nombre" value="">
                    </fieldset>
                    <fieldset>
                      <label class="c-form-label negrita" for="acci_nit_0">NIT/CC<span class="c-form-required"> *</span></br></br></label>
                      <input id="acci_nit_0" class="c-form-input" type="text" name="acci_nit_0" placeholder="Número Nit/CC" value="">
                    </fieldset>
                    <fieldset>
                      <label class="c-form-label negrita" for="acci_porcentaje_0">% de Participación<span class="c-form-required"> *</span></br></br></label>
                      <input id="acci_porcentaje_0" class="c-form-input" type="text" name="acci_porcentaje_0"  placeholder="" value="">
                    </fieldset>
                    <fieldset>
                      <label class="c-form-label negrita" for="acci_vinculado_0">Es Persona Públicamente Expuesta o Vinculada con una de Ellas<span class="c-form-required"> *</span></label>
                      <input id="acci_vinculado_0" class="c-form-input" type="text" name="acci_vinculado_0" placeholder="escriba SI ó NO y NOMBRE DEL VINCULADO" value="">
                    </fieldset>                    
                  </div>
                </div>';
        return $item;
    }
}