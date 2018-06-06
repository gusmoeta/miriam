<?php

session_start();
 //session_regenerate_id(true); //cada vez q entra cambia la coockie phpsessid de valor, seguridad
  // web/index.php
//  session_name("pc");




 // carga del modelo y los controladores
 require_once __DIR__ . '/../app/Config.php';
 require_once __DIR__ . '/../app/Model.php';
 require_once __DIR__ . '/../app/Controller.php';
//  require_once __DIR__ . '/../app/vendor/autoload.php';
//  require_once __DIR__ . '/../app/GoogleAuth.php';



 // enrutamiento
 $map = array(
    'registro'             => array('controller' =>'Controller','action' =>'registro'),
   //  'identificacion'       => array('controller' =>'Controller','action' =>'identificacion'),   
    // 'comprobar_user'       => array('controller' =>'Controller','action' =>'comprobar_user'),
     'comprobarUserGoogle'  => array('controller' =>'Controller','action' =>'comprobarUserGoogle'),
     'inicio'               => array('controller' =>'Controller','action' =>'inicio'),
     'buscar_alimento'      => array('controller' =>'Controller','action' =>'buscar_alimento'),
     'anadir_alimento'      => array('controller' =>'Controller','action' =>'anadir_alimento'),
     'filtrar'              => array('controller' =>'Controller','action' =>'filtrar'),
     'filtrarDatos'         => array('controller' =>'Controller','action' =>'filtrarDatos'),
     'caducados'            => array('controller' =>'Controller','action' =>'caducados'),
     'categorias'           => array('controller' =>'Controller','action' =>'categorias'),
     'calendario'           => array('controller' =>'Controller','action' =>'calendario'),
     'perfil_usuario'       => array('controller' =>'Controller','action' =>'perfil_usuario'),
     'ajustes'              => array('controller' =>'Controller','action' =>'ajustes'),
     'cerrarSession'        => array('controller' =>'Controller','action' =>'cerrarSession'),
 );

// echo "request<br><br>";
// var_dump($_REQUEST);
// echo "<br><br>session<br><br>";
// var_dump($_SESSION);
// echo "<br><br>sesion name<br><br>";
// var_dump(session_name());
// echo "<br><br>sesion id<br><br>";
// var_dump(session_id());
// echo "<br>";

// echo "sesion user " . $_SESSION['usuario'] . "<br>";
// echo "sesiin contra " . $_SESSION['contra'];



    if( empty( $_SESSION['usuario']) ){     
      
        $mensaje="";   
        // echo "sesion vacia";    
       require_once '../app/templates/identificacion.php';
       
    }else{ //si session llena
     
        // echo "sesion llena";   
            if (isset($_GET['ctl'])) {

                if (isset($map[$_GET['ctl']])) {
                    $ruta = $_GET['ctl'];
                } else {
                    header('Status: 404 Not Found');
                    echo '<html><body><h1>Error 404: No existe la ruta <i>' .
                            $_GET['ctl'] .
                            ' </i></body></html>';
                    exit;
                }

            } else {
                
                $ruta = 'inicio';
                       
            }

            $controlador = $map[$ruta];
            // Ejecución del controlador asociado a la ruta

            if (method_exists($controlador['controller'],$controlador['action'])) {
                call_user_func(array(
                new $controlador['controller'],
                $controlador['action'])
                );
            } else {

                header('Status: 404 Not Found');
                echo '<html><body><h1>Error 404: El controlador <i>' .
                        $controlador['controller'] .
                        '->' .
                        $controlador['action'] .
                        '</i> no existe</h1></body></html>';
            }


    }

    