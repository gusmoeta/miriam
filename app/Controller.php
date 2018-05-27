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

    public function identificacion($mensaje="") {        
        $mensaje;
        require __DIR__ . '/templates/identificacion.php';        
    }

    public function comprobar_user() {
        //session_start();
        $user = $_POST['usuario'];
        $contra = $_POST['contra'];

        $_SESSION['usuario'] = $user;
        $_SESSION['contra'] = $contra;
        $conBD = Model::singleton();
        $resultado = $conBD->identifica_usuario($user, $contra);

        if ($resultado) {
            //self::user_session($user);
            self::inicio();            
        }else{
            $mensaje = "Datos incorrectos.";
            self::identificacion($mensaje);
        }
    }

   /* public function user_session($user) {
        $conBD = Model::singleton();
        $resultado = $conBD->get_user($user);
    }*/

    public function perfil_usuario() {
        session_destroy();
        header('refresh:3;url=index.php?ctl=identificacion');
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
            "titulo" => "Inicio", 
            "resultado" => $conBD->buscarAlimento($_POST['buscar'], $_SESSION['id_usuario']));

        require __DIR__ . '/templates/inicio.php';
    }

    //AÑADIR NUEVO ALIMENTO
    public function anadir_alimento(){
        $conBD = Model::singleton();
        $params = array("titulo" => "Nuevo alimento", "tipos" => $conBD->get_tipos(), "categorias" => $conBD->get_categorias(),
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
                    $fecha_cad = "3000-01-01";

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
            $nombre_img = DIRECTORIO . $_FILES['imagen_ali']['name'];
            return $nombre_img;
        }        
    }


    public function filtrar(){
        $params = array("titulo" => "Filtrar");
        require __DIR__ . '/templates/filtrar.php';        
    }

    public function caducados(){
        $params = array("titulo" => "Caducados");
        require __DIR__ . '/templates/caducados.php';        
    }

    public function categorias(){
        $params = array("titulo" => "Categorías");
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
  

 }


