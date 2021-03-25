<?php
//error_reporting(E_ALL);
//
class Comsociedad{
    public $conn;
    public function extraer($datos){
        $suc_datos = array('socied_nombre'=>[],
                           'socied_identificacion'=>[],
                           'socied_empresa'=>[],
                           'socied_porcentaje'=>[]                       
                          );
        $datos_final = [];
        //obtencion de la información desde el REQUEST
        foreach ($datos as $key => $value){
            if(stripos($key,'socied_nombre_')!==FALSE && $value !=''){
              array_push($suc_datos['socied_nombre'],$value);
            }else if(stripos($key,'socied_identificacion_')!==FALSE && $value !=''){
              array_push($suc_datos['socied_identificacion'],$value);        
            }else if(stripos($key,'socied_empresa_')!==FALSE && $value !=''){
              array_push($suc_datos['socied_empresa'],$value);
            }else if(stripos($key,'socied_porcentaje_')!==FALSE && $value !=''){
              array_push($suc_datos['socied_porcentaje'],$value);
            }        
        }
        //organizar información 
        for($i=0; $i < count($suc_datos['socied_nombre']); $i++){
          if(isset($suc_datos['socied_nombre'][$i]) && isset($suc_datos['socied_identificacion'][$i]) && isset($suc_datos['socied_empresa'][$i])&& isset($suc_datos['socied_porcentaje'][$i]))
            $datos_final[$i] = ['socied_nombre'=>$suc_datos['socied_nombre'][$i],'socied_identificacion'=>$suc_datos['socied_identificacion'][$i],'socied_empresa'=>$suc_datos['socied_empresa'][$i],'socied_porcentaje'=>$suc_datos['socied_porcentaje'][$i]];
        }        
        return $datos_final;
    }

    public function consultar($nit){
        $query_string = "SELECT [socied_nombre],[socied_identificacion],[socied_empresa],[socied_porcentaje] FROM dbo.ruComsociedad WHERE nit = '%s'";
        $query_string = sprintf($query_string,$nit);    
        $referencias = [];
        try {
          $sql = odbc_exec($this->conn,$query_string);
          while($registro = odbc_fetch_array($sql)){
            $referencias[] = array('socied_nombre'=>$registro['socied_nombre'],'socied_identificacion'=>$registro['socied_identificacion'],'socied_empresa'=>$registro['socied_empresa'],'socied_porcentaje'=>$registro['socied_porcentaje']);
          }
          //odbc_close($this->conn);
        }catch (\Throwable $th) {
          
        }  
        return $referencias;        
    }

    public function guardar($datos,$nit){
        $query_string = "INSERT INTO dbo.ruComsociedad (nit,socied_nombre,socied_identificacion,socied_empresa,socied_porcentaje) VALUES('%s','%s','%s','%s','%s')";
        $sql;
        try{
          foreach ($datos as $key => $value){
            $query = sprintf($query_string,$nit,$value['socied_nombre'],$value['socied_identificacion'],$value['socied_empresa'],$value['socied_porcentaje']);
            $sql = odbc_exec($this->conn,$query);
          }
          //odbc_close($this->conn);
        }catch (\Throwable $th){
          $sql = false;
        }
        return $sql;    
    }

    public function actualizar($datos,$nit){
        $query_string = "DELETE FROM  dbo.ruComsociedad WHERE nit = '%s'";
        $sql;
        try{
            $query = sprintf($query_string,$nit);        
            $sql = odbc_exec($this->conn,$query)!=FALSE?$this->guardar($datos,$nit):FALSE;
            //odbc_close($this->conn);
        }catch (\Throwable $th) {
          $sql = false;
        }
        return $sql;        
    }

    public function itemInicial(){
        $item = '<div class="four-columns">                   
                  <fieldset>
                    <label class="c-form-label negrita" for="socied_nombre_0">Nombre Accionista<span class="c-form-required"> *</span></label>
                    <input id="socied_nombre_0" class="c-form-input" type="text" name="socied_nombre_0" placeholder="Nombre">
                  </fieldset>
                  <fieldset>
                    <label class="c-form-label negrita" for="socied_identificacion_0">No. de Identificación<span class="c-form-required"> *</span></label>
                    <input id="socied_identificacion_0" class="c-form-input" type="text" name="socied_identificacion_0" placeholder="Número Nit/CC">
                  </fieldset>
                  <fieldset>
                    <label class="c-form-label negrita" for="socied_empresa_0">Empresa de la cual es Accionista<span class="c-form-required"> *</span></label>
                    <input id="socied_empresa_0" class="c-form-input" type="text" name="socied_empresa_0" placeholder="Nombre de la empresa">
                  </fieldset>
                  <fieldset>
                    <label class="c-form-label negrita" for="socied_porcentaje_0">% de Participación<span class="c-form-required"> *</span></label>
                    <input id="socied_porcentaje_0" class="c-form-input" type="text" name="socied_porcentaje_0" placeholder="%">
                  </fieldset>                    
                </div>';
        return $item;
      }
}
