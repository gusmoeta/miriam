
<?php

session_start();

require_once __DIR__ . '/../app/Config.php';
 require_once __DIR__ . '/../app/Model.php';
 require_once __DIR__ . '/../app/Controller.php';
 require_once __DIR__ . '/../app/vendor/autoload.php';
 require_once __DIR__ . '/../app/GoogleAuth.php';

function comprobar_user() {
        //session_start();
        $user = $_POST['usuario'];
        $contra = $_POST['contra'];

        $_SESSION['usuario'] = $user;
        $_SESSION['contra'] = $contra;
        $conBD = Model::singleton();
        //devuelve true o false mirar porq tiene un errorsito
        $resultado = $conBD->identifica_usuario($user, $contra);

        if ($resultado) {
            //self::user_session($user);
            // self::inicio(); 

            $conBD = Model::singleton();
            $params = array(
                "titulo" => "Inicio", 
                "resultado" => $conBD->get_alimentos($_SESSION['id_usuario'])); 
            include_once __DIR__ . '/../app/templates/inicio.php'; 

        }else{
            $mensaje = "Datos incorrectos.";
            identificacion($mensaje);
        }
    }


function identificacion($mensaje="") {        
    $mensaje;
    include_once '../app/templates/identificacion.php';        
}

comprobar_user();




?>