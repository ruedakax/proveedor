<?php
//error_reporting(E_ALL); 
require_once("./class/class.Validation.php");
require_once("./class/class.View.php");
require_once("./class/PhpMailer/class.phpmailer.php");
require_once("./class/PhpMailer/class.smtp.php");

class Admin{
   
    //variable que espera el objeto conexion de base de datos
    public $conn;
    // email del revisor
    const EMAIL_REVISOR = 'desarrollo.tics@sp.com.co';



    public function agregar($datos){
        $respuesta = ['res'=>'','mensaje'=>'','validaciones'=>[],'panel'=>[]];
        //        
        $res = $this->validar($datos);
        if(!is_array($res)){
            $datos_organizados = $this->organizarDatos($datos);
            $registro = $this->consultar($datos['nit']);            
            $res = $registro===FALSE?$this->guardar($datos_organizados):$this->actualizar($datos_organizados,$datos['nit']);
            if($res){
                //enviar correo al responsable
                $nit = base64_encode($datos['nit']);
                $address = $datos['email'];
                $desc_address = "";
                $asunto = "Solicitud registro para clientes, proveedores o contratistas";
                $mensaje = "<p>Saludos,</p>
                            <p>SP Ingenieros amablemente le solicita completar el formulario de registro único para clientes, proveedores o contratistas que encontrará en el siguiente enlace:</p>
                            <p><a href='http://sw.sp.com.co:8080/cotizaciones_ayl/proveedor/registro.php?i=".$nit."'>Click Aquí</a></p>
                            <p>Tambien puede copiar y pegar la siguiente ruta en su navegador:</p>
                            <p>http://sw.sp.com.co:8080/cotizaciones_ayl/proveedor/registro.php?i=".base64_encode($datos['nit'])."</p>
                            <p>Gracias,</p>";
                $this->envioEmail($nit,$address,$desc_address,$asunto,$mensaje);
                //
                $respuesta['mensaje'] = '<p>Se ha programado el envio del formulario al email relacionado.</p>';                
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
        $datos['fecha_expira'] = $this->setFechaExpira();
        $datos_organizados = array($datos['nit'],
                                   $datos['estado'], 
                                   $datos['email'], 
                                   $datos['fase'], 
                                   $datos['fecha_expira'], 
                                   $datos['usuario_crea']);
        //
        return $datos_organizados;
    }   

    public function mostrar(){
        $view = new View;
        $template ='./views/view.displayAprobacion.php';
        $html = $view->render($template);
        //
        return $html;
    }

    public function aprobar($datos){
        $nit = isset($datos['i'])?base64_decode($datos['i']):NULL;
        $respuesta = ['res'=>'','mensaje'=>'','validaciones'=>[],'panel'=>[]];
        $registro = $this->consultar($nit);        
        $res = $registro?$this->execAprobar($nit):FALSE;        
        if($res){
            //enviar correo al responsable
            $nit = base64_encode($datos['nit']);
            $address = $datos['email'];
            $desc_address = "";
            $asunto = "Aprobación registro para clientes, proveedores o contratistas";
            $mensaje = "<p>Saludos,</p>
                        <p>SP Ingenieros amablemente le informa que su registro único para clientes, proveedores o contratistas, fue <strong>aprobado</strong>.</p>
                        <p>&nbsp;</p>                        
                        <p>Gracias,</p>";
            $this->envioEmail($nit,$address,$desc_address,$asunto,$mensaje);
            //
            $respuesta['mensaje'] = '<p>Se ha aprobado el proceso de registro.</p>';
            $respuesta['validaciones'] = [];
            $respuesta['res'] = "success";
        }else{
            $respuesta['mensaje'] = $registro===FALSE?'El NIT no ha sido programado':'Error al Guardar';
            $respuesta['validaciones'] = [];
            $respuesta['panel'] = $datos;
            $respuesta['res'] = "error";
        }
        return $respuesta;
     
    }

    private function execAprobar($nit){        
        $query_string = "UPDATE dbo.ruAdmin SET  fase = 'ok'
                        ,estado = 'D' 
                        ,fechaCrea = ".date("Y-m-d")."
                        WHERE nit = '%s'";
        //
        $query_string = vsprintf($query_string,$nit);
        $sql = FALSE;
        try {
            $sql = odbc_exec($this->conn,$query_string);
        //odbc_close($this->conn);
        } catch (\Throwable $th) {
            //$sql = false;
        }
        return $sql;
    }

    public function revisar($datos){
        $nit = isset($datos['i'])?base64_decode($datos['i']):NULL;
        $observaciones = isset($datos['observaciones'])?$datos['observaciones']:NULL;
        $respuesta = ['res'=>'','mensaje'=>'','validaciones'=>[],'panel'=>[]];
        //        
        $date = $this->setFechaExpira();
        //        
        $parametros = array($date,$observaciones,$nit);
        $res = $this->execRevisar($parametros);
        
        if($res && isset($observaciones)){
             //enviar correo al responsable           
             $registro = $this->consultar($nit);
             $address = $registro['email']; 
             $desc_address = "";
             $asunto = "Solicitud: revisar y actualizar registro para clientes, proveedores o contratistas";
             $mensaje = "<p>Saludos,</p>
                         <p>SP Ingenieros amablemente le solicita revisar la información ingresada en el registro único para clientes, proveedores o contratistas, basado en las siguientes observaciones:</p>
                         <p>".$observaciones."</p>
                         <p>&nbsp;</p>
                         <p>Recuerde que para actualizar la información puede ingresar en el siguiente enlace:</p>
                         <p><a href='http://sw.sp.com.co:8080/cotizaciones_ayl/proveedor/registro.php?i=".$nit."'>Click Aquí</a></p>
                         <p>Tambien puede copiar y pegar la siguiente ruta en su navegador:</p>
                         <p>http://sw.sp.com.co:8080/cotizaciones_ayl/proveedor/registro.php?i=".base64_encode($nit)."</p>
                         <p>Gracias,</p>";
             $this->envioEmail($nit,$address,$desc_address,$asunto,$mensaje);
             //
            $respuesta['mensaje'] = '<p>Se han enviado las observaciones al proveedor.</p>';
            $respuesta['validaciones'] = [];
            $respuesta['res'] = "success";
        }else{
            $respuesta['mensaje'] = is_null($observaciones)?'Error : No incluyó las observaciones':'Error al guardar';
            $respuesta['validaciones'] = [];
            $respuesta['panel'] = $datos;
            $respuesta['res'] = "error";
        }
        return $respuesta;
    }

    private function execRevisar($datos){
        $query_string = "UPDATE dbo.ruAdmin SET fase = 'cliente'
                        ,estado = 'A' 
                        ,fecha_expira = '%s'
                        ,observaciones = '%s'
                        WHERE nit = '%s'";
        //
        $query_string = vsprintf($query_string,$datos);
        $sql = FALSE;
        try {
            $sql = odbc_exec($this->conn,$query_string);
            //odbc_close($this->conn);
        } catch (\Throwable $th) {

        }
        return $sql;
    }

    public function finalizar($datos){
        $nit = isset($datos['i'])?base64_decode($datos['i']):NULL;
        $respuesta = ['res'=>'','mensaje'=>'','validaciones'=>[],'panel'=>[]];
        $registro = $this->consultar($nit);        
        $res = $registro?$this->execFinalizar($nit):FALSE;             
        //
        if($res){
            //enviar correo al responsable
            $address = self::EMAIL_REVISOR;
            $desc_address = "SP Ingenieros";
            $asunto = "Registro Finalizado (AYL-F-017)";
            $mensaje = "<p>Saludos,</p>
                        <p>El usuario identificado con el número : <strong>".$nit."</strong>, ha finalizado su registro.
                        </p><p>El proceso de revisión del formato AYL-F-017 puede ser iniciado.</p>
                        <p>Gracias,</p>";
            $this->envioEmail($nit,$address,$desc_address,$asunto,$mensaje);
            //
            $respuesta['mensaje'] = '<p>¡Gracias por completar el registro!</p><p>Desde <strong>SP Ingenieros</strong> se verificará la información.</p><p>Pronto le haremos saber el resultado del mismo.</p>';
            $respuesta['validaciones'] = [];
            $respuesta['res'] = "success";
        }else{
            $respuesta['mensaje'] = $registro===FALSE?'<p>Su revisión no ha sido programada.</p><p>Comuniquese con el ADMON del sistema.</p>':'Error al guardar';
            $respuesta['validaciones'] = [];
            $respuesta['panel'] = $datos;
            $respuesta['res'] = "error";
        }
        return $respuesta;
    }

    private function execFinalizar($datos){
        $query_string = "UPDATE dbo.ruAdmin SET fase = 'revisor'
                        ,estado = 'D'                                                 
                        WHERE nit = '%s'";
        //
        $query_string = vsprintf($query_string,$datos);
        $sql = FALSE;
        try {
            $sql = odbc_exec($this->conn,$query_string);
            //odbc_close($this->conn);
        } catch (\Throwable $th) {

        }
        return $sql;
    }

    private function setFechaExpira(){
        $start_date = date("Y-m-d");
        $date = strtotime($start_date);
        $date = strtotime("+7 day", $date);
        $date = date('Y/m/d', $date);
        return $date;
    }

    public function envioEmail($nit,$address,$desc_address,$asunto,$mensaje){        
        $mail = new PHPMailer();
        $mail->IsSMTP(true);        
        ## SE DEBE HACER AUTENTICACIÓN SMTP.
        $mail->SMTPAuth = true;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        ## SE ENVIA CORREO DE NOTIFICACIÒN CADA VEZ QUE SE EJECUTA EL SERVICIO WEB
        $mail->SMTPSecure = "ssl";
        ## INDICO EL SERVIDOR DE GMAIL PARA SMTP.
        $mail->Host = "smtp.gmail.com";
        ## INDICO EL PUERTO QUE UTILIZA GMAIL.
        $mail->Port = 465;
        ## INDICO USUARIO Y CONTRASEÑA PARA LOS DATOS DEL CORREO DE DONDE SE VA A ENVIAR EL MENSAJE.
        $mail->Username = "spwebservices@sp.com.co";
        $mail->Password = "spweb9876543210";        
        $mail->SetFrom("spwebservices@sp.com.co", utf8_encode("SP ingenieros notifica."));
        $mail->AddReplyTo($address, $desc_address);
        $mail->IsHTML(true);
        $mail->Subject = $asunto;
        $mail->MsgHTML($mensaje);        
        $mail->AddAddress($address, $desc_address);                
        $res = $mail->Send();
        $mail->clearAddresses();                
        return $res;
        ///
    }

    private function setItem($registro){
        $nit_encoded = base64_encode($registro['nit']);        
        $link = $registro['fase']==='revisor'?'&nbsp;<a class="status-saved" href="./visualizar.php?i='.$nit_encoded.'">(Revisar)</a>':'';
        $item = '<div class="four-columns">
                    <fieldset>
                        <input class="item-list" name="nits" type="radio" id="'.$registro['nit'].'" value="'.$registro['email'].'">&nbsp;<label class="c-form-label">'.$registro['nit'].'</label>
                    </fieldset>
                    <fieldset>
                        <label class="c-form-label">'.$registro['email'].'</label>
                    </fieldset>                    
                    <fieldset>
                        <label class="c-form-label">'.$registro['fase'].$link.'</label>
                    </fieldset>              
                    <fieldset>
                        <label class="c-form-label">'.date("Y-m-d", strtotime($registro['fecha_expira'])).'</label>
                    </fieldset>                                
                </div>';
        return $item;
    }

    public function checkDate($fecha){
        $start_date = date("Y-m-d");
        $actual = strtotime($start_date);
        $fecha = strtotime($fecha);        
        return $actual > $fecha?FALSE:TRUE;
    }
}//end class




