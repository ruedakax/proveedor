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
require_once("./class/class.Evidencias.php");
require_once("./class/class.Admin.php");
require_once("./class/class.Rol.php");

class Panel{

    public $tipo = '';

    public $accion = '';    

    public $instacia;    

    //se configuran los paneles que tienen envio de archivo
    private $panelArchivos = array('panel_9','evidencias');

    function __construct($tipo=NULL,$accion=NULL){
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
            case 'evidencias':
                $this->instacia  = new Evidencias();
                $this->instacia->conn = SOConexion::conexion_db();
            break;
            default:
                echo "??ERROR!: CONSULTE AL ADMON";
                die;
            break;
        }
    }    

    public function callAccion($datos,$archivos = array()){
        //
        $datos = SOConexion::stripInput($datos);
        //
        switch ($this->accion) {
            case 'consultar':
                return $this->instacia->consultar($datos);
            break;
            case 'guardar':                                
                return in_array($this->tipo,$this->panelArchivos)?$this->instacia->guardar($datos,$archivos):$this->instacia->guardar($datos);
            break;
            case 'preparar':                                
                return $this->instacia->preparar($datos);
            break;
            case 'mostrar':                                
                return $this->instacia->preparar($datos,TRUE);
            break;
            default:
                echo "ERROR CONSULTE AL ADMON";
                die;
            break;
        }
    }

    public function callMethod($datos){
        $datos = SOConexion::stripInput($datos);
        $registro = new Admin();
        $registro->conn = SOConexion::conexion_db();
        $metodo = $datos['accion'];
        switch ($metodo) {
            case 'agregar':
                return $registro->agregar($datos);
            break;
            case 'listar':
                return $registro->listar();
            break;
            case 'buscar':
                return $registro->buscar($datos);
            break;
            case 'mostrar':
                return $registro->mostrar();
            break;            
            case 'aprobar':
                return $registro->aprobar($datos);
            break;            
            case 'revisar':
                return $registro->revisar($datos);
            break;            
            case 'finalizar':
                return $registro->finalizar($datos);
            break;            
            default:
                # code...
            break;
        }
    }
    
    public function callMethodRol($datos){
        $datos = SOConexion::stripInput($datos);
        $rol = new Rol();
        $tipo_bd = isset($datos['tipo_bd'])?$datos['tipo_bd']:'';                
        $rol->conn = $tipo_bd==='bpms'?SOConexion::conexion_db('c29mdGxhbmQ=','U3BhZG1pbjEzNQ==','BPMS'):SOConexion::conexion_db();
        $metodo = $datos['accion'];
        switch ($metodo) {
            case 'listarUsuarios':
                return $rol->listarUsuarios();
            break;
            case 'listar':
                return $rol->listar($datos);
            break;            
            case 'agregar':
                return $rol->agregar($datos);
            break;            
            case 'eliminar':
                return $rol->eliminar($datos);
            break;            
            case 'buscar':
                return $rol->buscar($datos);
            break;            
            case 'menu':
                return $rol->menu($datos);
            break;            
            case 'consultar':
                $respuesta = array('res'=>FALSE,'datos'=>array());
                $usuario = $rol->consultar($datos['usuario']);                
                if(!empty($usuario['username'])){
                    $respuesta['datos'] = $usuario;
                    $respuesta['res'] = TRUE;
                }
                return $respuesta;
            break;
            default:
                # code...
            break;
        }
    }
}