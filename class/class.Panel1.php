<?php
error_reporting(E_ALL);

class Panel1{
  public $conn;
      
  //public $datos;

  private function prepararPanel(){

  }

  public function guardar($datos){      
      return json_encode($datos);
  }    

  public function consultar($parametros){    
    
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
    ,usuarioModifica
    ,fechaModifica
    FROM dbo.registroUnicoP1
    WHERE nit = %s";
    $query_string = sprintf($query_string,base64_decode($parametros[0]));
    $sql = odbc_exec($this->conn,$query_string);
    $datos_panel = odbc_fetch_array($sql);
    return $datos_panel?json_encode($datos_panel):false;      
  }	
}