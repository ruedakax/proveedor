<?php
error_reporting(E_ALL);
class Sucursales{

    public $conn;

    public function guardar($datos,$nit){    
        $query_string = "INSERT INTO dbo.ruSucursales (nit,direccion,pais,ciudad,usuarioCrea) VALUES('%s','%s','%s','%s','%s')";
        $sql=false;
        try{
          foreach ($datos as $key => $value){
            $query = sprintf($query_string,$nit,$value['direccion'],$value['pais'],$value['ciudad'],'proveedor');        
            $sql = odbc_exec($this->conn,$query);
          }
          odbc_close($this->conn);
        }catch (\Throwable $th) {      
          $sql = false;
        }
        return $sql;    
    }

    public function actualizar($datos,$nit){
        $query_string = "DELETE FROM  dbo.ruSucursales WHERE nit = '%s'";
        $sql;
        try{
            $query = sprintf($query_string,$nit);
            //var_dump(odbc_exec($this->conn,$query)!=FALSE);
            $sql = odbc_exec($this->conn,$query)!=FALSE?$this->guardar($datos,$nit):FALSE;
        }catch (\Throwable $th) {
          $sql = false;
        }
        return $sql;    
    }

    public function consultar($nit){
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
    /*recibe el request y toma de allí los datos relacionados con sucursales*/
    public function extraer($datos){
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
}