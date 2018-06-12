<?php

require_once 'Model.php';

    $conBD = Model::singleton();
    $alimentos = $conBD->get_alimentos();
    $usuario = $conBD->get_usuario();
    $to = $usuario[0]["correo"];
    $nombre = $usuario[0]["nombre"];
    foreach ($alimentos as $alimento){
        $fecha_cad = $alimento['fecha_caducidad'];
        $fecha_hoy = date("Y-m-d");
        $datetime1 = date_create($fecha_hoy);
        $datetime2 = date_create($fecha_cad);
        $interval = date_diff($datetime1, $datetime2);
        if ($interval->format('%r%a')<5 && $interval->format('%r%a')>0) {
            try{
                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->IsSMTP(); // enable SMTP
                $mail->CharSet = 'UTF-8';                
                $body = 'Tu(s) ' . strtolower($alimento["nombre"]) . ' va(n) a caducar en ' . $interval->format('%r%a día(s)');                
                $mail->Host       = 'smtp.sparkpostmail.com';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 2525;
                //$mail->SMTPDebug  = 1;
                $mail->SMTPAuth   = true;
                $mail->Username   = 'SMTP_Injection';
                $mail->Password   = 'edcda7fafff45e493d12fb825c972130347dc403';
                $mail->SetFrom('admin@caducidadalimentos.es', 'Caducali');
                $mail->AddReplyTo('no-reply@mycomp.com','no-reply');
                $mail->Subject    = 'Tu alimento va a caducar';
                $mail->MsgHTML($body);                    
                $mail->AddAddress($to, $nombre);
                $mail->send();
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
        }
    }
?>