<?php

 class Controller{

    //INSERT INTO `usuarios`(`id`, `nombre`, `nombre_google`, `correo`, `contraseña`, `fecha_alta`) VALUES ('17477b24-6ce3-11e8-8495-fcaa140c1e64', 'admin' , null, 'admin@admin.es', '1234', curdate())
    
    public function registro() {
        $conBD = Model::singleton();
        $usuarios = $conBD->get_usuarios();
        $codigo = uniqid();
        //echo $codigo;
        $enviar = true;
        //var_dump($_REQUEST);
        $usuarios_temp = $conBD->get_usuarios_temp();
        foreach($usuarios as $usuario){
            if ($usuario['nombre'] == $_POST['nombre']){
                $mensaje = "Ese nombre de usuario ya está en uso.";
                $enviar = false;
            }elseif ($usuario['correo'] == $_POST['email']){
                $mensaje = "Ya existe un usuario con ese email.";
                $enviar = false;
            }elseif ($_POST['pass'] != $_POST['passr']){
                $mensaje = "Las contraseñas no coinciden.";
                $enviar = false;
            }elseif (empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['passr'])){
                $mensaje = "Todos los campos son obligatios.";
                $enviar = false;
            }
        }            
        foreach($usuarios_temp as $usuario){
            if ($usuario['nombre'] == $_POST['nombre']){
                $mensaje = "Ese nombre de usuario ya está en uso.";
                $enviar = false;
            }elseif ($usuario['correo'] == $_POST['email']){
                $mensaje = "Ya existe un usuario con ese email.";
                $enviar = false;
            }elseif ($_POST['pass'] != $_POST['passr']){
                $mensaje = "Las contraseñas no coinciden.";
                $enviar = false;
            }elseif (empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['passr'])){
                $mensaje = "Todos los campos son obligatios.";
                $enviar = false;
            }
        }            
        if($enviar){
            $mensaje = "";
            $conBD->inserta_usuario_temp($_POST['nombre'], $_POST['email'], $_POST['pass'], $codigo);
            self::mandar_mail_registro($_POST['nombre'], $_POST['email'], $codigo);
        }
        require __DIR__ . '/templates/identificacion.php';        
    }

    public function mandar_mail_registro($nombre, $email, $codigo) {
        $to = $email;
        $nombre = $nombre;
        try{
            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->IsSMTP(); // enable SMTP
            $mail->CharSet = 'UTF-8';                
            $body = "Bienvenid@ " . ucfirst($nombre) . ", haz clic en el siguiente enlace para activar tu cuenta -> <a href='http://localhost/proyecto_caduca/web/index.php?ctl=activacion_usuario&cod=" . $codigo . "'>Activar cuenta</a>";                
            $mail->Host       = 'smtp.sparkpostmail.com';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 2525;
            //$mail->SMTPDebug  = 1;
            $mail->SMTPAuth   = true;
            $mail->Username   = 'SMTP_Injection';
            $mail->Password   = 'edcda7fafff45e493d12fb825c972130347dc403';
            $mail->SetFrom('admin@caducidadalimentos.es', 'Caducali');
            $mail->AddReplyTo('no-reply@mycomp.com','no-reply');
            $mail->Subject    = "Confirma tu email";
            $mail->MsgHTML($body);                    
            $mail->AddAddress($to, $nombre);
            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

    public function activacion_usuario(){
        $conBD = Model::singleton();
        //var_dump($_REQUEST);
        $user = $conBD->get_usuario_temp($_REQUEST['cod']);
            if($user != "No hay registros en esta tabla"){
                $conBD->inserta_usuario($user[0]['id'], $user[0]['nombre'], $user[0]['correo'], $user[0]['contraseña'], $user[0]['fecha_reg_temp']);
                $conBD->eliminar_user_temp($_REQUEST['cod']);
                $mensaje = "Usuario validado";
            }else{
                $mensaje = "El usuario no existe. Vuelve a registrarte";
            }
        require __DIR__ . '/templates/identificacion.php';        
    }


    public function identificacion() {   
        $mensaje = " ";     
         require __DIR__ . '/templates/identificacion.php';        
    }

    // public function comprobar_user() {
    //     //session_start();
    //     $user = $_POST['usuario'];
    //     $contra = $_POST['contra'];

    //     $_SESSION['usuario'] = $user;
    //     $_SESSION['contra'] = $contra;
    //     $conBD = Model::singleton();
    //     //devuelve true o false mirar porq tiene un errorsito
    //     $resultado = $conBD->identifica_usuario($user, $contra);

    //     if ($resultado) {
    //         //self::user_session($user);
    //         self::inicio();            
    //     }else{
    //         $mensaje = "Datos incorrectos.";
    //         self::identificacion($mensaje);
    //     }
    // }

   /* public function user_session($user) {
        $conBD = Model::singleton();
        $resultado = $conBD->get_user($user);
    }*/

    //OPCIONES DE USUARIO

    public function perfil_usuario() {
        $params = array("titulo" => "Perfil de usuario");
        $success = " ";
        $error = " ";
        require __DIR__ . '/templates/perfil_usuario.php';      
    }

    public function cambiar_contra(){
        $params = array("titulo" => "Perfil de usuario");
        $conBD = Model::singleton();
        $res = $conBD->get_usuario($_SESSION["id_usuario"]);
        $contraAntigua = $res[0]["contraseña"];
        $contraAntiguaConfirm = $_POST["contra_actual"];
        if ($contraAntigua == $contraAntiguaConfirm){
            if ($_POST["contra_nueva1"] == $_POST["contra_nueva2"]){
                $conBD->mod_contra($_POST["contra_nueva1"], $_SESSION['id_usuario']);
                $success = "Tu contraseña se ha actualizado";
                $error = "";
            }else{
                $error = "Tus contraseñas no coinciden.";
                $success ="";
            }
        }else{
            $error = "Tu contraseña actual no coincide.";
            $success ="";
        }        
        require __DIR__ . '/templates/perfil_usuario.php'; 
    }

    public function cambiar_correo(){
        $params = array("titulo" => "Perfil de usuario");
        $conBD = Model::singleton();
        $res = $conBD->get_usuario($_SESSION["id_usuario"]);
        $emailAntiguo = $res[0]["correo"];
        $emailAntiguoConfirm = $_POST["email_actual"];
        if ($emailAntiguo == $emailAntiguoConfirm){
            $conBD->mod_email($_POST["email_nuevo"], $_SESSION['id_usuario']);
            $success = "Tu email se ha actualizado";
            $error = "";
        }else{
            $error = "Tu email actual no coincide.";
            $success ="";
        }        
        require __DIR__ . '/templates/perfil_usuario.php'; 
    }

    public function eliminar_usuario(){
        $params = array("titulo" => "Perfil de usuario");
        $success = " ";
        $error = " ";
        $mensaje = " ";
        $conBD = Model::singleton();
        $res = $conBD->eliminar_user($_SESSION["id_usuario"]);
        
        header('refresh:5;url=index.php?ctl=identificacion');    
    }



    //VER ALIMENTOS 
    //vista por defecto de los alimentos
    public function inicio(){
        $conBD = Model::singleton();
        $params = array(
            "titulo" => "Inicio", 
            "resultado" => $conBD->get_alimentos($_SESSION['id_usuario']));

        require __DIR__ . '/templates/inicio.php';
    }

    //búsqueda de alimentos
    public function buscar_alimento(){
        $conBD = Model::singleton();
        $params = array(
            "titulo" => "Buscar", 
            "resultado" => $conBD->buscarAlimento($_POST['buscar'], $_SESSION['id_usuario']));

        require __DIR__ . '/templates/inicio.php';
    }

    //AÑADIR NUEVO ALIMENT
    public function anadir_alimento(){
        $conBD = Model::singleton();
        $params = array("titulo" => "Nuevo alimento", "tipos" => $conBD->get_tipos(), "categorias" => $conBD->get_categorias($_SESSION['id_usuario']),
        );        

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nombre_img = self::subir_img($_FILES['imagen_ali']['tmp_name']);
                $fecha_cad = date("Y-m-d", strtotime($_POST['fecha_cad']));          
                if( !isset($_POST['fecha_con']) || empty($_POST['fecha_con']) ){
                    $conBD->insertar_alimento($_POST['nombre_ali'], $_POST['categoria'],
                        $_POST['tipo'], $fecha_cad, $nombre_img, $_SESSION['id_usuario']);                          
                }else{
                    $fecha_con = date("Y-m-d", strtotime($_POST['fecha_con']));
                    $fecha_cad = $_POST['fecha_cad'];                    
                    $conBD->insertar_alimento_ConFechaCongelado($_POST['nombre_ali'], $_POST['categoria'],
                    $_POST['tipo'], $fecha_cad, $fecha_con, $nombre_img, $_SESSION['id_usuario']);                  
                }

        }
        require __DIR__ . '/templates/anadir_alimento.php';        
    }

    public function subir_img() {
        define("CREAR_DIR", "fotos"); 
		define("DIRECTORIO", "fotos/");	

		if (!is_dir('fotos')) {
			mkdir('fotos');
		}

		if (!is_uploaded_file($_FILES['imagen_ali']['tmp_name'])) {
            echo "prueba";///////
		}else{
            move_uploaded_file($_FILES['imagen_ali']['tmp_name'], DIRECTORIO . $_FILES['imagen_ali']['name']);
            $nombre_img = $_FILES['imagen_ali']['name'];
            return $nombre_img;
        }        
    }

    public function filtrar(){

        $conBD = Model::singleton();                
        $params = array("titulo" => "Filtrar", "tipos" => $conBD->get_tipos(), "categorias" => $conBD->get_categorias($_SESSION['id_usuario']) );
        require __DIR__ . '/templates/filtrar.php';        
    }
    
    public function filtrarDatos(){
        $conBD = Model::singleton();

        $numCamposElementosLlenos=0;
        array_shift($_REQUEST); //quito el valor del ctl
        foreach ($_REQUEST as $value) {
            if ( !empty($value) ) {
                $numCamposElementosLlenos++;
            }
        }
        //echo "$numCamposElementosLlenos numeo camps <br>";
        $id_user   = $_SESSION['id_usuario'];
        $cat       = $_REQUEST['categoria'];
        $tipo      = $_REQUEST['tipo'];
        $fecha_ini = $_REQUEST['fecha_ini'];
        $fecha_fin = $_REQUEST['fecha_fin'];


        $sentenciaIncompleta1 = "select * from alimentos_users where id_usuario = '$id_user'"; 
        //solo cuatro posibilidades o 4 elementos
        switch ($numCamposElementosLlenos) {
            case 1:
                switch(true)
                {
                    case !empty($_REQUEST['categoria']):

                        $sentenciaIncompleta2 = "and id_categoria = '$cat'";
                        $sentencia = $sentenciaIncompleta1 . $sentenciaIncompleta2;

                        $params = array("titulo" => "FiltrarDatos1/1", "resultado"=> $conBD->resultadosFiltrados( $sentencia ) ); 

                    break;
                    case !empty($_REQUEST['tipo']):

                        $sentenciaIncompleta2 = "and id_tipo = '$tipo'";
                        $sentencia = $sentenciaIncompleta1 . $sentenciaIncompleta2;

                        $params = array("titulo" => "FiltrarDatos1/2", "resultado"=> $conBD->resultadosFiltrados( $sentencia ) ); 

                    break;
                    case !empty($_REQUEST['fecha_ini']):

                        $sentenciaIncompleta2 = "and fecha_caducidad = '$fecha_ini'";
                        $sentencia = $sentenciaIncompleta1 . $sentenciaIncompleta2;

                        $params = array("titulo" => "FiltrarDatos1/3", "resultado"=> $conBD->resultadosFiltrados( $sentencia ) );                          
                    break;                
                    default:                        
                        //echo "switch1 <br>";
                        header('refresh:0;url=index.php?ctl=filtrar');
                        exit;
                }                
            break;
                
            case 2:
                switch(true){
                    case !empty( $_REQUEST['categoria'] ) && !empty( $_REQUEST['tipo'] ):
                                                
                        $sentenciaIncompleta2 = "and id_tipo = '$tipo' and id_categoria = '$cat'";
                        $sentencia = $sentenciaIncompleta1 . $sentenciaIncompleta2;

                        $params = array("titulo" => "FiltrarDatos2/1", "resultado"=> $conBD->resultadosFiltrados( $sentencia ) ); 
                                        
                    break;
                    case !empty( $_REQUEST['categoria'] ) && !empty( $_REQUEST['fecha_ini'] ):

                        $sentenciaIncompleta2 = "and id_categoria = '$cat' and fecha_caducidad = '$fecha_ini'";
                        $sentencia = $sentenciaIncompleta1 . $sentenciaIncompleta2;
                        $params = array("titulo" => "FiltrarDatos2/2", "resultado"=> $conBD->resultadosFiltrados( $sentencia ) ); 

                    break;
                    case !empty( $_REQUEST['tipo'] )      && !empty( $_REQUEST['fecha_ini'] ):

                        $sentenciaIncompleta2 = "and id_tipo = '$tipo' and fecha_caducidad = '$fecha_ini'";
                        $sentencia = $sentenciaIncompleta1 . $sentenciaIncompleta2;
                        $params = array("titulo" => "FiltrarDatos2/3", "resultado"=> $conBD->resultadosFiltrados( $sentencia ) );   

                    break;
                    case !empty( $_REQUEST['fecha_ini'] ) && !empty( $_REQUEST['fecha_fin'] ):

                        $sentenciaIncompleta2 = "and ( fecha_caducidad BETWEEN CAST('$fecha_ini' AS DATE) AND CAST('$fecha_fin' AS DATE) ) " ;                                                       

                        $sentencia = $sentenciaIncompleta1 . $sentenciaIncompleta2;
                        $params = array("titulo" => "FiltrarDatos2/4", "resultado"=> $conBD->resultadosFiltrados( $sentencia ) );

                    break;

                    default:
                    //echo "switch2 <br>";
                    header('refresh:0;url=index.php?ctl=filtrar');
                    exit;
                }            
            break;                
            case 3:
                switch(true){
                    case !empty( $_REQUEST['categoria']) && !empty($_REQUEST['tipo']) && !empty($_REQUEST['fecha_ini']):

                        $sentenciaIncompleta2 = "and id_tipo = '$tipo' and id_categoria = '$cat' and fecha_caducidad = '$fecha_ini'";
                        $sentencia = $sentenciaIncompleta1 . $sentenciaIncompleta2;

                        $params = array("titulo" => "FiltrarDatos3", "resultado"=> $conBD->resultadosFiltrados( $sentencia ));  
                    break;
                    default:
                    //echo "switch3 <br>";
                    header('refresh:0;url=index.php?ctl=filtrar');
                    exit;
                }                
            break;            
            case 4:
                switch(true){
                    case !empty( $_REQUEST['categoria']) && !empty($_REQUEST['tipo']) && !empty($_REQUEST['fecha_ini']) && !empty($_REQUEST['fecha_fin']):

                        $sentenciaIncompleta2 = "and id_tipo = '$tipo' and id_categoria = '$cat' and fecha_caducidad = '$fecha_ini' and ( fecha_caducidad BETWEEN CAST('$fecha_ini' AS DATE) AND CAST('$fecha_fin' AS DATE) ) " ; 
                        $sentencia = $sentenciaIncompleta1 . $sentenciaIncompleta2;
                        $params = array("titulo" => "FiltrarDatos3", "resultado"=> $conBD->resultadosFiltrados( $sentencia ));    
                    break;
                    default:
                    //echo "switch4 <br>";
                    header('refresh:0;url=index.php?ctl=filtrar');
                    exit;
                }                          
            break;            
            default:
                    //si no coincide el num param (o es 0) redirige a filtrar
                    //echo "switch  general <br>";
                    header('refresh:0;url=index.php?ctl=filtrar');
                    exit;                                       
        }
        require __DIR__ . '/templates/filtrarDatos.php';        
    }


    //ver caducados
    public function caducados() {
        $conBD = Model::singleton();        
        $params = array(
            "titulo" => "Caducados", 
            "resultado" => $conBD->get_alimentos($_SESSION['id_usuario']));
        require __DIR__ . '/templates/caducados.php';        
        //self::mandar_mail_caducidad();
    }

    public function mandar_mail_caducidad() {
        $conBD = Model::singleton();
        $alimentos = $conBD->get_alimentos($_SESSION['id_usuario']);
        $usuario = $conBD->get_usuario($_SESSION['id_usuario']);
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
        //var_dump($usuario);
    }

    //opciones de alimentos
    public function eliminar_alimento() {
        $conBD = Model::singleton();
        $conBD->eliminar_alimento($_GET['id_ali'], $_SESSION['id_usuario']);
        header('refresh:0;url=index.php?ctl=inicio');
    }

    //repito la funcion para poder enviar a la vista de caducados cuando se elimine desde caducados
    public function eliminar_caducado() {
        $conBD = Model::singleton();
        $conBD->eliminar_alimento($_GET['id_ali'], $_SESSION['id_usuario']);
        header('refresh:0;url=index.php?ctl=caducados');
    }

    public function editar_alimento() {
        $conBD = Model::singleton();
        $params = array("titulo" => "Editar alimento", "tipos" => $conBD->get_tipos(), "categorias" => $conBD->get_categorias($_SESSION['id_usuario']),
            "alimento" => $conBD->get_alimento($_REQUEST['id_ali'], $_SESSION['id_usuario'])
        );        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $fecha_cad = date("Y-m-d", strtotime($_POST['fecha_cad']));
                
                if (!isset($_FILES['imagen_ali']['tmp_name']) || empty($_FILES['imagen_ali']['tmp_name'])) {
                    $nombre_img = $_POST['imagen'];
                }else{
                    $nombre_img = self::subir_img($_FILES['imagen_ali']['tmp_name']);
                }
                                if (!isset($_POST['fecha_con']) || empty($_POST['fecha_con'])) {
                    $conBD->editar_alimento($_POST['nombre_ali'], $_POST['categoria'],
                        $_POST['tipo'], $fecha_cad, $nombre_img, $_SESSION['id_usuario'], $_POST['id_ali']);  
                        //header('refresh:0;url=index.php?ctl=inicio');                        
                }else{

                    $fecha_con = date("Y-m-d", strtotime($_POST['fecha_con']));
                    $fecha_cad = $_POST['fecha_cad'];                    
                    $conBD->editar_alimento($_POST['nombre_ali'], $_POST['categoria'],
                        $_POST['tipo'], $fecha_cad, $fecha_con, $nombre_img, $_SESSION['id_usuario'], $_POST['id_ali']);                           
                }
        }
        require __DIR__ . '/templates/editar_alimento.php';    
    }

    public function categorias() {
        $conBD = Model::singleton();
        $params = array("titulo" => "Categorías", "categorias" => $conBD->get_categorias($_SESSION['id_usuario']),
        );
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $conBD->insertar_categoria($_POST['nombre_cat'], $_SESSION['id_usuario']);
            header('refresh:0;url=index.php?ctl=categorias');
        }        
        require __DIR__ . '/templates/categorias.php';        
    }

    public function calendario(){
        $params = array("titulo" => "Calendario");
        require __DIR__ . '/templates/calendario.php';        
    }

    public function ajustes(){
        $params = array("titulo" => "Ajustes");
        require __DIR__ . '/templates/ajustes.php';        
    }

    public function cerrarSession(){
       
        session_destroy();       
        unset($_COOKIE['PHPSESSID']); 
        $mensaje = "Session cerrada"; 
        include_once __DIR__ . '/templates/identificacion.php';         
    }
  

 }
?>