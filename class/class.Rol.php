<?php
//error_reporting(E_ALL); 
require_once("./class/class.Validation.php");
require_once("./class/class.View.php");
require_once("./class/PhpMailer/class.phpmailer.php");
require_once("./class/PhpMailer/class.smtp.php");

class Rol{
    //variable que espera el objeto conexion de base de datos
    public $conn;

    private $menu = array('panel_1'=>'Panel Uno',
                        'panel_2'=>'Panel Dos',
                        'panel_3'=>'Panel Tres',
                        'panel_5'=>'Panel Cinco',
                        'panel_6'=>'Panel Seis',
                        'panel_7'=>'Panel Siete',
                        'panel_8'=>'Panel Ocho',
                        'panel_9'=>'Panel Nueve',
                        'evidencias'=>'Evidencias',
                        'administracion'=>'Administración',
    );

    public function listar(){
        $query_string = "SELECT username,nombre,email,permisos
                         FROM dbo.ruRol
                         ORDER BY username";
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

    private function setItem($registro){        
        $item = '<div class="five-columns">
                    <fieldset>
                        <input class="item-list" name="usernames" type="radio" id="'.$registro['username'].'" value="'.$registro['permisos'].'">&nbsp;<label class="c-form-label">'.$registro['username'].'</label>
                    </fieldset>
                    <fieldset>
                        <label class="c-form-label">'.$registro['nombre'].'</label>
                    </fieldset>                    
                    <fieldset>
                        <label class="c-form-label">'.$registro['email'].'</label>
                    </fieldset>                    
                    <fieldset>
                        <label class="c-form-label">'.$registro['permisos'].'</label>
                    </fieldset>                                  
                    <fieldset>
                        <button class="myButton eliminar" type="button" value="'.$registro['username'].'">X</button>
                    </fieldset>
                </div>';
        return $item;
    }

    public function listarUsuarios(){
        $query_string = "SELECT UPPER(name) + ' ' + UPPER(last_name) as nombre,user_name
                         FROM BPMS.dbo.users 
                         WHERE name not in ('admin','user','superuser') 
                         AND name not like '%ADMINISTRA%'
                         GROUP BY UPPER(name) + ' ' + UPPER(last_name),user_name";
        $registros = '';
        try {
            $sql = odbc_exec($this->conn,$query_string);
            while($registro = odbc_fetch_array($sql)){              
              $registros .= sprintf('<option value="%s">%s</option>',$registro['user_name'],$registro['nombre']);
            }         
        }catch (\Throwable $th) {
            var_dump($th);
        }
        return $registros;
    }

    public function getUsuarioBMPS($userName){
        $query_string = "SELECT TOP 1 UPPER(name) + ' ' + UPPER(last_name) as nombre, email, user_name
                         FROM BPMS.dbo.users 
                         WHERE name not in ('admin','user','superuser') 
                         AND name not like '%ADMINISTRA%'
                         AND user_name = '".$userName."'";
        try {
            $sql = odbc_exec($this->conn,$query_string);
            $registro = odbc_fetch_array($sql);            
        }catch (\Throwable $th) {
            var_dump($th);
        }
        return $registro;
    }

    public function agregar($datos){
        $respuesta = ['res'=>'','mensaje'=>'','validaciones'=>[],'panel'=>[]];
        //        
        $res = $this->validar($datos);
        $usuarioExiste = $this->getUsuarioBMPS($datos['usuario']);
        //
        if(!is_array($res) && $usuarioExiste !==false){
            $datos_organizados = $this->organizarDatos($datos,$usuarioExiste);
            $registro = $this->consultar($datos['usuario']);
            $res = $registro===FALSE?$this->guardar($datos_organizados):$this->actualizar($datos_organizados,$datos['usuario']);
            if($res){
                $respuesta['mensaje'] = '<p>Se ha creado el usuarios y sus permisos</p>';
                $respuesta['res'] = "success";
            }else{
                $respuesta['mensaje'] = 'Error al Guardar';
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

    public function eliminar($datos){
        $respuesta = ['res'=>'','mensaje'=>'','validaciones'=>[],'panel'=>[]];
        //        
        $res = $this->execEliminar($datos['usuario']);
        if($res){
            $respuesta['mensaje'] = '<p>Se ha eliminado el usuario</p>';
            $respuesta['res'] = "success";
        }else{
            $respuesta['mensaje'] = 'Error al Guardar';
            $respuesta['panel'] = $datos;
            $respuesta['res'] = "error";
        }        
        return $respuesta;
    }
    

    private function organizarDatos($datos,$datosBPMS){
        $datos['nombre'] = $datosBPMS['nombre'];
        $datos['email'] = $datosBPMS['email'];
        $datos['usuario_crea'] = 'revisor';
        //        
        $datos_organizados = array($datos['usuario'],
                                   $datos['nombre'],                              
                                   $datos['email'],
                                   $datos['permisos'],                                   
                                   $datos['usuario_crea']);
        //
        return $datos_organizados;
    }

    public function consultar($usuario){
        $query_string = "SELECT *
                         FROM dbo.ruRol 
                         WHERE username = '%s'";
        $query_string = sprintf($query_string,$usuario);
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

    public function guardar($datos){
        $query = "INSERT INTO dbo.ruRol (username,nombre,email,permisos,usuarioCrea) VALUES('%s','%s','%s','%s','%s')";
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

    public function execEliminar($usuario){
        $query_string = "DELETE FROM dbo.ruRol WHERE username = '%s'";        
        $sql;
        try {
            $query = sprintf($query_string,$usuario);
            $sql = odbc_exec($this->conn,$query);            
        }catch (\Throwable $th) {
            var_dump($th);
        }        
        return $sql;
    }

    public function actualizar($datos,$usuario){    
        $query_string = "DELETE FROM  dbo.ruRol WHERE username = '%s'";
        $sql;
        try{
            $query = sprintf($query_string,$usuario);
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
        $val->name('usuario')->value($datos['usuario'])->pattern('text')->required();
        $val->name('email')->value($datos['permisos'])->pattern('text')->required();
        //
        return $val->isSuccess()?true:$val->getErrors();
    }  

    public function buscar($datos){
        $registros = '';
        if(empty($datos['busqueda']) || ctype_space($datos['busqueda'])){
            $registros = $this->listar();
        }else{            
            $indicioBusqueda = $datos['busqueda'];
            $query_string = "SELECT username,nombre,email,permisos
                             FROM dbo.ruRol                             
                             WHERE username like '%".$indicioBusqueda."%' OR nombre like '%".$indicioBusqueda."%'
                             ORDER BY username";                    
            try {
                $sql = odbc_exec($this->conn,$query_string);
                while($registro = odbc_fetch_array($sql)){                
                    $registros .= $this->setItem($registro);
                }         
            }catch (\Throwable $th) {
                var_dump($th);
            }
        }        
        return $registros;
    }

    public function menu($permisos){
        $menu ='';
        $items = explode(',',$permisos['permisos']);        
        foreach($items as $valor){
           $menu .= $valor!='administracion'?'<button class="tablinks" id="'.$valor.'">'.$this->menu[$valor].'</button>':'<button class="tablinks" id="aprobacion">Revisión</button>';           
        }        
        $menu .= '<button class="tablinks" id="administracion">Administrar</button>';
        return $menu;
    }
}//end class




