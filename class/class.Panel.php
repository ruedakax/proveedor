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
        //
        SOConexion::stripInput($datos);
        //
        switch ($this->accion) {
            case 'consultar':
                return $this->instacia->consultar($datos);
            break;
            case 'guardar':                                
                return $this->instacia->guardar($datos);
            break;
            case 'preparar':                                
                return $this->instacia->preparar($datos);
            break;
            default:
                echo "ERROR CONSULTA AL ADMON";
                die;
            break;
        }
    }    
}