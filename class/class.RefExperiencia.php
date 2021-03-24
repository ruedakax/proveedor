<?php
error_reporting(E_ALL);
class RefExperiencia{

    public $conn;

    public function extraer($datos){
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

    public function guardar($datos,$nit){
        $query_string = "INSERT INTO dbo.ruRefExperiencia (nit,empresa,contacto,cupos) VALUES('%s','%s','%s','%s')";
        $sql;
        try{
          foreach ($datos as $key => $value){
            $query = sprintf($query_string,$nit,$value['empresa'],$value['contacto'],$value['cupos'],'proveedor');
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
        $query_string = "DELETE FROM  dbo.ruRefExperiencia WHERE nit = '%s'";
        $sql;
        try{
            $query = sprintf($query_string,$nit);        
            $sql = odbc_exec($this->conn,$query)!=FALSE?$this->guardar($datos,$nit):FALSE;
            odbc_close($this->conn);
        }catch (\Throwable $th) {
            var_dump($th);     
            $sql = false;
        }
        return $sql;        
    }

    public function consultar($nit){
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
            var_dump($th);          
        }
        return $referencias;
    }  

    public function itemInicial(){
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

}