<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
require_once("../class/class.consultasModPedidos.php");
require_once("../class/class.consultaBPMS.php");
require('../class/Fpdf/fpdf.php');
require('../class/class.createPDF.php');

$consultas = new consultasModPedidos();
$consultaBPMS = new ConsultasBPMS();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($_POST['accion']==='ListadoOp'){    
    $datos = '';
    #CONSULTA DATOS DEL INDICADOR SOLICITADO
    $datosops = $consultas->queryData(array($_POST['empresa']),$_POST['accion']);
    while($datosOPReg = odbc_fetch_array($datosops)){        
        $datos .= '<option value="'.$datosOPReg['ORDEN_COMPRA'].'"/>';
    }    
    echo $datos;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else if($_POST['accion']==='consultarOP'){
    /////////////////////////////////////////////////////toma datos empresa
    $datos_obra = $consultas->queryData(array($_POST['empresa']),'obra');
    $datos_obra = odbc_fetch_array($datos_obra);    
    $logo_empresa = explode(".",$datos_obra['LOGO'])[0].'.png';
    $template = file_get_contents("../css/template/op.html");
    $template_pag2 = file_get_contents("../css/template/op2.html");
    #CONSULTA UNA ORDEN DE COMPRA ESPECIFICA
    $datosop = $consultas->queryData(array($_POST['empresa'],$_POST['id_op']),$_POST['accion']);    
    $lineas = '';
    $lineas_pag_dos = '<tr class="oscura"><td>Orden Compra</td><td>Descripción</td><td>Canti. Recibida</td><td>Precio Unitario</td><td>Total Compra</td><td>IVA %</td><td>Valor IVA</td><td>Total Impuesto</td><td>Valor Compra</td><td>Fecha</td><td>Fecha Max Destinación</td></tr>';
    $primer_registro = true;
    $datosGenerales = NULL;
    while($datosOPReg = odbc_fetch_array($datosop)){
        //se toman los datos Generales del primer registro
        if($primer_registro){
            $datosGenerales = $datosOPReg;
            $primer_registro = false;
        }
        $fila ='<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>$%s</td><td>%s</td><td>$%s</td></tr>';

        $fila_pag_dos = '<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>$%s</td><td>%s</td><td>%s</td></tr>';

        $datos_fila = array($datosOPReg['ARTICULO'],
                            $datosOPReg['DESCRIPCION'],
                            utf8_encode($datosOPReg['COMENTARIO']),
                            $datosOPReg['PRIORIDAD'],
                            $datosOPReg['BODEGA'],
                            $datosOPReg['CENTRO_COSTO'],
                            $datosOPReg['CANTIDAD_ORDENADA'],
                            $datosOPReg['UNIDAD_ALMACEN'],
                            number_format($datosOPReg['PRECIO_UNITARIO'], 2, '.', ','),
                            $datosOPReg['IVA'],
                            number_format($datosOPReg['TOTAL_MERCADERIA'], 2, '.', ','),
                      );

        $datos_fila_pg2 = array($datosOPReg['ORDEN_COMPRA'],
                      $datosOPReg['DESCRIPCION'],
                      utf8_encode($datosOPReg['CANTIDAD_ORDENADA']),
                      number_format($datosOPReg['PRECIO_UNITARIO'], 2, '.', ','),
                      number_format($datosOPReg['TOTAL_MERCADERIA'], 2, '.', ','),
                      number_format($datosOPReg['IVA'], 2, '.', ','),
                      number_format($datosOPReg['IVA_LINEA'], 2, '.', ','),
                      number_format($datosOPReg['IVA_LINEA'], 2, '.', ','),                      
                      number_format($datosOPReg['TOTAL'], 2, '.', ','),
                      $datosGenerales['FECHA_COTIZACION'],
                      $datosGenerales['FECHA_OFRECIDA'],
                    );

        $lineas .= vsprintf($fila,$datos_fila);
        $lineas_pag_dos .= vsprintf($fila_pag_dos,$datos_fila_pg2);
    }
    ///
    $pag2 = vsprintf($template_pag2,$lineas_pag_dos);
    ////
    $datos_formato = array( $logo_empresa,
                            $datos_obra['NOMBRE'],
                            $datos_obra['NIT'],
                            $datosGenerales['ORDEN_COMPRA'],
                            $datos_obra['TELEFONO'],
                            $datosGenerales['FECHA_COTIZACION'],
                            $datos_obra['DIREC1'],
                            $datosGenerales['FECHA_OFRECIDA'],
                            "Medellín - Antioquia",
                            utf8_encode($datosGenerales['NOMBRE']),                            
                            $datosGenerales['NIT'],                            
                            $datosGenerales['ESTADO'],                            
                            $datosGenerales['TELEFONO1'],
                            $datosGenerales['E_MAIL'],
                            $datosGenerales['APROBO'],
                            $datosGenerales['DIRECCION_PR'],
                            $datosGenerales['COMPRADOR'],
                            utf8_encode($datosGenerales['DIRECCION']),
                            $datosGenerales['CONDICION_PAGO'],
                            $datosGenerales['PRIORIDAD'],                            
                            $datosGenerales['OBRA'],
                            $lineas,                
                            utf8_encode($datosGenerales['OBSERVACIONES']),            
                            number_format($datosGenerales['TOTAL_OP'], 2, '.', ','),
                            number_format($datosGenerales['TOTAL_OP_IVA'], 2, '.', ','),
                            number_format($datosGenerales['TOTAL_OP_IVA'], 2, '.', ','),
                            number_format($datosGenerales['TOTAL_OP_IVA'], 2, '.', ','),
                            $pag2,
                        );
    ////////////////////////        
    $registros = $consultaBPMS->consultar(array(),'correos');
    $correos = "";
    $correo_verificacion = '';
    while($item = odbc_fetch_array($registros)){        
        if($item['user_name']===$_SESSION['USUARIO']){
            $correo_verificacion = $item['email'];
        }
        $correos .= '<option value="'.$item['email'].'"/>';
    }
    ///////////////////////
    if(!is_null($datosGenerales)){
        echo json_encode(array('html'=>vsprintf($template,$datos_formato),'email'=> $datos_formato[13],'correos'=>$correos,'email_verificacion'=>$correo_verificacion));
    }else{
        echo json_encode(array('html'=>'','email'=>'','correos'=>''));
    }
    
    ////////////////////////////////////////////////
}////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else if($_POST['accion']==='enviarOP'){
    /////////////////////////////////////////////////////////////////
    $res = array('respuesta'=>'','mensaje'=>'');
    $pdf = new FPDF();
    $ruta_final = "../pdfs/".$_POST['id_op']."_".date('Ymdhis').".pdf";
    ///////////////creacion del pdf
    $archivo_pdf = EnvioPDF::crearPDF($consultas,$_POST['id_op'],$_POST['empresa'],$ruta_final,$pdf);
    if($archivo_pdf){
        ///////////////////////////////    
        require("../class/PhpMailer/class.phpmailer.php");
        require("../class/PhpMailer/class.smtp.php");
        $mail = new PHPMailer();
        $mail->IsSMTP(true);
        //$mail->SMTPDebug = 4; ## PERMITE MODO DEBUG PARA VER MENSAJES DE LAS COSAS QUE VAN OCURRIENDO.
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
        $mail->SetFrom("spwebservices@sp.com.co", utf8_decode("Envío Orden Compra ".$_POST['empresa']));
        $mail->AddReplyTo($_POST['email_verificacion'], utf8_decode("Envío Orden Compra ".$_POST['empresa']));
        $mail->IsHTML(true);
        $mail->Subject = utf8_decode("Envío Orden Compra (".$_POST["id_op"].") - ".$_POST['empresa']);
        $mail->MsgHTML(utf8_decode("<p>Encuentre adjunto el documento relacionado a la Orden de Compra <strong>".$_POST["id_op"]."</strong> (".date("Y-m-d H:i:s").")</p>"));
        $mail->addStringAttachment($archivo_pdf, $_POST['id_op']."_".date('Ymdhis').".pdf");
        ## SE INDICAN LOS PROVEEDORES A LOS CUALES LES VA A APARECER LA NOTIFICACIÓN.
        $address = "desarrollo.tics@sp.com.co";
        $mail->AddAddress($_POST['email'], "");        
        $mail->AddAddress($_POST['email_verificacion'], "");
        if(!$mail->Send()){
            $res["respuesta"] = false;
            $res["mensaje"] = "Error al enviar: " . $mail->ErrorInfo;
        }else{
            $res["respuesta"] = true;
            $res["mensaje"] = "El mensaje fue enviado correctamente";
        }        
        $mail->clearAddresses();                
        ///
    }else{
        $res["respuesta"] = false;
        $res["mensaje"] = "Error al crear el pdf";
    }    
    echo json_encode($res);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////