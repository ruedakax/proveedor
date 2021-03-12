<?php
error_reporting(E_ALL);
require_once("./class/class.SOConexion.php");
require_once("./class/class.Panel1.php");

class Panel{

    public $tipo = '';

    public $accion = '';    

    public $instacia;    

    function __construct($tipo,$accion){
        $this->tipo = $tipo;
        $this->accion = $accion;
    }

    public function callPanel(){
        switch ($this->tipo) {
            case 'panel_1':                
                $this->instacia  = new Panel1();
                $this->instacia->conn = SOConexion::conexion_db();
            break;
            default:
                echo "¡ERROR!: CONSULTA AL ADMON";
                die;
            break;
        }
    }

    public function callAccion($datos){
        switch ($this->accion) {
            case 'consultar':
                $this->instacia->consultar($datos);
            break;
            case 'guardar':                                
                $this->instacia->guardar($datos);
            break;
            default:
                echo "ERROR CONSULTA AL ADMON";
                die;
            break;
        }
    }

    public function consultar($parametros){
        $entrada = SOConexion::stripInput($parametros);
        $this->instacia->consultar($entrada);
    }

    public function guardar($parametros){
        $entrada = SOConexion::stripInput($parametros);
        $this->instacia->guardar($entrada);
    }
}