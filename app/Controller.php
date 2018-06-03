 <?php

 class Controller{


    public function registro() {
        $conBD = Model::singleton();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $conBD->inserta_usuario($_POST['nombre'], $_POST['email'], $_POST['pass']);      
            //header('refresh:3;url=index.php?ctl=anadir_alimento');
        }
        require __DIR__ . '/templates/identificacion.php';        
    }






    // public function identificacion($mensaje="") {        
    //     $mensaje;
    //     require __DIR__ . '/templates/identificacion.php';        
    // }

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

    // public function perfil_usuario() {
    //     session_destroy();
    //     echo "lkjdlkajdflksdjflkasdjlksjdkldkl";
    //     header('refresh:3;url=index.php?ctl=identificacion');
    // }

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
            "titulo" => "Inicio", 
            "resultado" => $conBD->buscarAlimento($_POST['buscar'], $_SESSION['id_usuario']));

        require __DIR__ . '/templates/inicio.php';
    }

    //AÑADIR NUEVO ALIMENT
    public function anadir_alimento(){
        $conBD = Model::singleton();
        $params = array("titulo" => "Nuevo alimento", "tipos" => $conBD->get_tipos(), "categorias" => $conBD->get_categorias($_SESSION['id_usuario']),
            /*'nombre' => '',
            'categoria' => '',
            'tipo' => '',
            'fecha_cad' => '',
            'imagen_ali' => '',*/
         );        

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nombre_img = self::subir_img($_FILES['imagen_ali']['tmp_name']);
                //$fecha = $_POST['fecha_cad'];
                //$fecha_format = date_create_from_format('Y-m-d', $_POST['fecha_cad']);
                //$fecha_cad = date_format($fecha_format, 'Y-m-d');

                $fecha_cad = date("Y-m-d", strtotime($_POST['fecha_cad']));
                
                
                //quizas con uno solo valdria, solo habria q comporbar  si viene congelado vacio o no y si es vacio ponerlo a null
                if( !isset($_POST['fecha_con']) || empty($_POST['fecha_con']) ){
                    $conBD->insertar_alimento($_POST['nombre_ali'], $_POST['categoria'],
                        $_POST['tipo'], $fecha_cad, $nombre_img, $_SESSION['id_usuario']);                          
                }else{

                    $fecha_con = date("Y-m-d", strtotime($_POST['fecha_con']));
                    //si es congelado la fecha cad no importa, de momento ponemosuna fecha automatica por defecto
                    //tb podria hacer el por defecto en la propia funcion
                    //$fecha_cad = "3000-01-01";
                    $fecha_cad = $_POST['fecha_cad'];
                    
                    $conBD->insertar_alimento_ConFechaCongelado($_POST['nombre_ali'], $_POST['categoria'],
                        $_POST['tipo'], $fecha_cad, $fecha_con, $nombre_img, $_SESSION['id_usuario']);                          
                        
                }

                        // var_dump($_POST);
                        // var_dump($_POST['fecha_cad']);
                        // var_dump($fecha_cad);
                //header('refresh:3;url=index.php?ctl=anadir_alimento');
        }
        require __DIR__ . '/templates/anadir_alimento.php';        
    }

    public function subir_img($img) {
        define("CREAR_DIR", "fotos"); 
		define("DIRECTORIO", "fotos/");	

		if (!is_dir('fotos')) {
			mkdir('fotos');
		}

		if (!is_uploaded_file($_FILES['imagen_ali']['tmp_name'])) {
            echo "hola";///////
		}else{
            move_uploaded_file($_FILES['imagen_ali']['tmp_name'], DIRECTORIO . $_FILES['imagen_ali']['name']);
            $nombre_img = $_FILES['imagen_ali']['name'];
            return $nombre_img;
        }        
    }


    public function filtrar(){
        
        $params = array("titulo" => "Filtrar");
        require __DIR__ . '/templates/filtrar.php';        
    }
    
    public function filtrarDatos(){
        $conBD = Model::singleton();

        //decide camino
        $numElementoEnArray = count($_REQUEST);

        //solo cuatro posibilidades o 4 elementos
        switch ($numElementoEnArray) {
            case 1:
                $params = array("titulo" => "FiltrarDatos1", "resultado"=> $conBD->resultadosFiltrados($_REQUEST, 1));
                break;
                
                case 2:
                $params = array("titulo" => "FiltrarDatos2", "resultado"=> $conBD->resultadosFiltrados($_REQUEST, 2));                
                break;
                
                case 3:
                $params = array("titulo" => "FiltrarDatos3", "resultado"=> $conBD->resultadosFiltrados($_REQUEST, 3));                
                break;
                
                case 4:
                $params = array("titulo" => "FiltrarDatos4", "resultado"=> $conBD->resultadosFiltrados($_REQUEST, 4));                
                break;
                
                default:
                # code...
                break;
        }

        require __DIR__ . '/templates/filtrar.php';        
    }

    public function caducados() {
        $conBD = Model::singleton();
        self::mandar_mail();
        $params = array(
            "titulo" => "Caducados", 
            "resultado" => $conBD->get_alimentos($_SESSION['id_usuario']));
        require __DIR__ . '/templates/caducados.php';        
    }

    public function mandar_mail() {
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
            if ($interval->format('%r%a días')<5 && $interval->format('%r%a días')>0) {
                echo $alimento['nombre'];
                try{
                    /*$mail=new PHPMailer(true);
                    $mail->CharSet = 'UTF-8';                
                    $body = 'Tu(s) $alimento["nombre"] va(n) a caducar próximamente.';                
                    $mail->IsSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port       = 587;
                    $mail->SMTPDebug  = 1;
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'caducidad_alimentos@gmail.com';
                    $mail->Password   = 'c4d4l1m3nt0s';
                    $mail->SetFrom('caducidad_alimentos@gmail.com', "admin");
                    $mail->AddReplyTo('no-reply@mycomp.com','no-reply');
                    $mail->Subject    = 'Tu alimento va a caducar';
                    $mail->MsgHTML($body);
                    
                    $mail->AddAddress($to, $nombre);
                    $mail->send();*/
                    $titulo = 'Tu alimento va a caducar';
                    $mensaje = 'Tu(s) $alimento["nombre"] va(n) a caducar próximamente.'; 
                    $cabeceras = 'From: caducidad.alimentos@gmail.com' . "\r\n" .
                        'Reply-To: caducidad.alimentos@gmail.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                    
                    mail($to, $titulo, $mensaje, $cabeceras);

                } catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: '/*, $mail->ErrorInfo*/;
                }
            }
        }

        var_dump($usuario);
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
    
    //AUXILIARES

    




    //EJEMPLOS ALIMENTOS
    public function insertarx(){
        $params = array(
            'x' => '',
         );

        $conBD = Model::singleton();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // comprobar campos formulario
            if ($conBD->validarDatos($_POST['x'])) {              
                   
                    $conBD->insertarAlimento($_POST['x']);
                    header('Location: index.php?ctl=listar');
                        
            } else {
                
                $params = array(
                    'x' => $_POST['x'],
                );
                $params['mensaje'] = '<span>Has introducido valores incorrectos o el alimento ya existe.</span>';
                 
            }
        }

        require __DIR__ . '/templates/formInsertar.php';
    }

    public function buscar_x(){
       
        $params = array(
        'x' => '',
        'resultado' => array(),
        );
        $conBD = Model::singleton();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $params['x'] = $_POST['x'];
            $params['resultado'] = $conBD->buscarx($_POST['x']);
        }

        $nom_alimentos = $conBD->autocompletar();
        
        //var_dump($nom_alimentos);
        require __DIR__ . '/templates/buscarx.php';
    }

    public function verEliminar(){

        $conBD = Model::singleton();
        $params = array(
        'resultado' => $conBD->dameAlimentos(),
        );
        //$alimento = $conBD->borrarAlimento($_GET['id']);
        require __DIR__ . '/templates/verTablaeliminar.php';
    }

    public function eliminar(){

        if (!isset($_POST['id'])) {
            throw new Exception('Página no encontrada');
        }
        $id = $_POST['id'];

        $conBD = Model::singleton();
        $conBD->borrarAlimento($id);
        $params = self::verEliminar();
        //require __DIR__ . '/templates/verTablaeliminar.php';
    }


    public function verModificar(){

        $conBD = Model::singleton();
        $params = array(
        'resultado' => $conBD->dameAlimentos(),
        );
        $conBD->modificarAlimento($_REQUEST);
        require __DIR__ . '/templates/mostrarModificar.php';
    }

    public function modificar(){

        $conBD = Model::singleton();
        $conBD->modificarAlimento($_REQUEST);
        $params = array(
        'resultado' => $conBD->dameAlimentos(),
        );
        
        require __DIR__ . '/templates/mostrarModificar.php';
    }

    public function cerrarSession(){

        //como el formu identificacion tiene un control en los inputs, aunq la sesion siga abierta al no 
        //ser borrada con la cookie, no permite entrar sin mas al darle al enviar, pero podria ser saltado quizas.
       // session_start();
        session_destroy();
        //setcookie("PHPSESSID","",time()); //no ve aki, en claaes funcionba
        // var_dump(session_name());
        // var_dump(session_id());  //devuelve valor coockie
        unset($_COOKIE['PHPSESSID']); //se presupone q borra la coocki pero solo la inicializa otro valor, tb esta bien
        // var_dump(session_name());
        // var_dump(session_id());  //devuelve valor coockie
        $mensaje = "Session cerrada"; //o dejarlo vacio o cambiar la impresion del mensaje a otro lugar, quiza arriba derecha
        include_once __DIR__ . '/../app/templates/identificacion.php'; 
        // var_dump($_SESSION);
    }
  

 }


