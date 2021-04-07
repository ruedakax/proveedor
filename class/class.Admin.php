<?php
//error_reporting(E_ALL);
require_once("./class/class.Validation.php");
require_once("./class/class.View.php");

class Admin{
   
    public $conn;

    public function agregar($datos){
        $respuesta = ['res'=>'','mensaje'=>'','validaciones'=>[],'panel'=>[]];
        //        
        $res = $this->validar($datos);
        if(!is_array($res)){
            $datos_organizados = $this->organizarDatos($datos);
            $registro = $this->consultar($datos['nit']);            
            $res = $registro===FALSE?$this->guardar($datos_organizados):$this->actualizar($datos_organizados,$datos['nit']);
            if($res){
                $respuesta['mensaje'] = '<p>Se ha programado el envio del formulario al email relacionado.</p>';
                $respuesta['validaciones'] = [];
                $respuesta['res'] = "success";
            }else{
                $respuesta['mensaje'] = 'Error al Guardar';
                $respuesta['validaciones'] = [];
                $respuesta['panel'] = $datos;
                $respuesta['res'] = "error";
            }
        }else{
            $respuesta['mensaje'] = 'Algunos datos no son válidos : <strong>Revise los campos marcados.</strong>';
            $respuesta['validaciones'] = $res; //->getErrors();
            $respuesta['panel'] = $datos;
            $respuesta['res'] = "error";
        }
        return $respuesta;
    }

    public function consultar($nit){
        $query_string = "SELECT nit,estado,email,fase,fecha_expira FROM dbo.ruAdmin WHERE nit = '%s'";
        $query_string = sprintf($query_string,$nit);
        $registro = NULL;
        try {
          $sql = odbc_exec($this->conn,$query_string);
          $registro = odbc_fetch_array($sql);
          //odbc_close($this->conn);
        }catch (\Throwable $th) {
            var_dump($th);
        }
        return $registro;
    }

    public function listar(){
        $query_string = "SELECT nit,estado,email,fase,fecha_expira FROM dbo.ruAdmin ORDER BY nit";
        $registros = '';
        try {
            $sql = odbc_exec($this->conn,$query_string);
            while($registro = odbc_fetch_array($sql)){
              //$registros[] = array('nit'=>$registro['nit'],'estado'=>$registro['estado'],'email'=>$registro['email'],'fase'=>$registro['fase'],'fecha_expira'=>$registro['fecha_expira']);
              $registros .= $this->setItem($registro);
            }          
        }catch (\Throwable $th) {
            var_dump($th);
        }
        return $registros;
    }

    public function guardar($datos){        
        $query = "INSERT INTO dbo.ruAdmin (nit, estado, email, fase, fecha_expira, usuarioCrea) VALUES('%s','%s','%s','%s','%s','%s')";
        $query_string = vsprintf($query,$datos);
        //echo $query_string;
        $sql;
        try {
            $sql = odbc_exec($this->conn,$query_string);
            //odbc_close($this->conn);
          } catch (\Throwable $th) {
            $sql = false;      
          }
          return $sql;
    }

    public function actualizar($datos,$nit){        
        $query_string = "DELETE FROM  dbo.ruAdmin WHERE nit = '%s'";
        $sql;
        try{
            $query = sprintf($query_string,$nit);
            //echo $query;
            $sql = odbc_exec($this->conn,$query)!=FALSE?$this->guardar($datos):FALSE;
            //odbc_close($this->conn);
        }catch (\Throwable $th){
          $sql = false;
        }
        return $sql;    
    }
    
    private function validar($datos){
        $val = new Validation();
        $val->name('nit')->value($datos['nit'])->required();
        $val->name('email')->value($datos['email'])->pattern('email')->required();
        //
        return $val->isSuccess()?true:$val->getErrors();
    }  

    private function organizarDatos($datos){        
        $datos['estado'] = 'A';
        $datos['fase'] = 'cliente';
        $datos['usuario_crea'] = 'revisor';//ToDo: tomar el usuario desde Session
        //
        $start_date = date("Y-m-d");
        $date = strtotime($start_date);
        $date = strtotime("+7 day", $date);
        $date = date('Y/m/d', $date);
        $datos['fecha_expira'] = $date;        
        $datos_organizados = array($datos['nit'],
                                   $datos['estado'], 
                                   $datos['email'], 
                                   $datos['fase'], 
                                   $datos['fecha_expira'], 
                                   $datos['usuario_crea']);
        //
        return $datos_organizados;
    }

    private function setItem($registro){
        $item = '<div class="four-columns">
                    <fieldset>
                        <input class="item-list" name="nits" type="radio" id="'.$registro['nit'].'" value="'.$registro['email'].'">&nbsp;<label class="c-form-label">'.$registro['nit'].'</label>
                    </fieldset>
                    <fieldset>
                        <label class="c-form-label">'.$registro['email'].'</label>
                    </fieldset>                    
                    <fieldset>
                        <label class="c-form-label">'.$registro['fase'].'</label>
                    </fieldset>              
                    <fieldset>
                        <label class="c-form-label">'.date("Y-m-d", strtotime($registro['fecha_expira'])).'</label>
                    </fieldset>                                
                </div>';
        return $item;
    }

    public function mostrar(){
        $view = new View;
        $template ='./views/view.displayAprobacion.php';
        $html = $view->render($template);
        //
        return $html;
    }

    public function aprobar($datos){
        $respuesta = ['res'=>'','mensaje'=>'','validaciones'=>[],'panel'=>[]];
        return $respuesta;
     
    }

    private function execAprobar(){
        $query_string = "UPDATE dbo.ruAdmin SET  fase = 'ok'
                        ,estado = 'D' 
                        ,fechaCrea = ".date("Y-m-d")."
                        WHERE nit = '%s'";
        //
        $query_string = vsprintf($query_string,$datos_organizados);    
        $sql;
        try {
        $sql = odbc_exec($this->conn,$query_string);
        //odbc_close($this->conn);
        } catch (\Throwable $th) {
        $sql = false;
        }
        return $sql;
    }

    public function revisar(){
        $respuesta = ['res'=>'','mensaje'=>'','validaciones'=>[],'panel'=>[]];
        return $respuesta;
    }

    private function execRevisar(){

    }
}//end class




