<?php
 // web/index.php
 session_start();
 // carga del modelo y los controladores
 require_once __DIR__ . '/../app/Config.php';
 require_once __DIR__ . '/../app/Model.php';
 require_once __DIR__ . '/../app/Controller.php';
 require_once __DIR__ . '/../app/vendor/autoload.php';
 require_once __DIR__ . '/../app/GoogleAuth.php';

 // enrutamiento
 $map = array(
     'registro'             => array('controller' =>'Controller','action' =>'registro'),
     'inicio'               => array('controller' =>'Controller','action' =>'inicio'),
     'identificacion'       => array('controller' =>'Controller','action' =>'identificacion'),          
     'comprobar_user'       => array('controller' =>'Controller','action' =>'comprobar_user'),
     'comprobarUserGoogle'  => array('controller' =>'Controller','action' =>'comprobarUserGoogle'),
     'anadir_alimento'      => array('controller' =>'Controller','action' =>'anadir_alimento'),
     'filtrar'              => array('controller' =>'Controller','action' =>'filtrar'),
     'filtrarDatos'         => array('controller' =>'Controller','action' =>'filtrarDatos'),
     'caducados'            => array('controller' =>'Controller','action' =>'caducados'),
     'categorias'           => array('controller' =>'Controller','action' =>'categorias'),
     'calendario'           => array('controller' =>'Controller','action' =>'calendario'),
     'perfil_usuario'       => array('controller' =>'Controller','action' =>'perfil_usuario'),
     'ajustes'              => array('controller' =>'Controller','action' =>'ajustes'),
 );
//var_dump($_REQUEST);
//var_dump($_SESSION);

 // Parseo de la ruta
 if (isset($_GET['ctl'])) {
     if (isset($map[$_GET['ctl']])) {
         $ruta = $_GET['ctl'];
     } else {
         header('Status: 404 Not Found');
         echo '<html><body><h1>Error 404: No existe la ruta <i>' .
                 $_GET['ctl'] .
                 '</p></body></html>';
         exit;
     }
 } else {
     
     $ruta = 'identificacion';
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
