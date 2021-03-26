<?php
error_reporting(E_ALL);
//error_reporting(E_ERROR | E_PARSE);
require_once("./class/class.SOConexion.php");
require_once("./class/class.Panel1.php");
require_once("./class/class.Panel2.php");
require_once("./class/class.Panel3.php");
// require_once("./class/class.Panel4.php");
require_once("./class/class.Panel5.php");
require_once("./class/class.Panel6.php");
require_once("./class/class.Panel7.php");
require_once("./class/class.Panel8.php");
require_once("./class/class.Panel9.php");

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
                $this->instacia->setComplemento();
            break;
            case 'panel_2':
                $this->instacia  = new Panel2();
                $this->instacia->conn = SOConexion::conexion_db();
                $this->instacia->setComplemento();
            break;
            case 'panel_3':
                $this->instacia  = new Panel3();
                $this->instacia->conn = SOConexion::conexion_db();
            break;
            case 'panel_4':
                $this->instacia  = new Panel4();
                $this->instacia->conn = SOConexion::conexion_db();
            break;
            case 'panel_5':
                $this->instacia  = new Panel5();
                $this->instacia->conn = SOConexion::conexion_db();
                $this->instacia->setComplemento();
            break;
            case 'panel_6':
                $this->instacia  = new Panel6();
                $this->instacia->conn = SOConexion::conexion_db();
            break;
            case 'panel_7':
                $this->instacia  = new Panel7();
                $this->instacia->conn = SOConexion::conexion_db();
            break;
            case 'panel_8':
                $this->instacia  = new Panel8();
                $this->instacia->conn = SOConexion::conexion_db();
            break;
            case 'panel_9':
                $this->instacia  = new Panel9();
                $this->instacia->conn = SOConexion::conexion_db();
            break;
            default:
                echo "¡ERROR!: CONSULTE AL ADMON";
                die;
            break;
        }
    }

    public function callAccion($datos){
        //
        $datos = SOConexion::stripInput($datos);
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
                echo "ERROR CONSULTE AL ADMON";
                die;
            break;
        }
    }    
}