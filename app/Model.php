<?php
class Model{

    protected $conexion;
    private static $instancia = null;

    //  El constructor establece la conección con la BBDD
    private function __construct(){
        try {

            $this->conexion = new PDO(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave);
            $this->conexion->exec(Config::$caract);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
        } catch (Exception $e) {
         die("Error: " . $e->getMessage());
        }
    }
    // Uso del pratron singleton para reducir el número de conecciones y uso de memoria
    public static function singleton(){
        
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

    // Evitamos clonacion de
    public function __clone(){
        
        trigger_error("La clonación de este objeto no está permitida", E_USER_ERROR);
    }

    ///////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////


    public function inserta_usuario_temp($n, $e, $c, $co) {
        try{
            $sql = "insert into usuarios_temporal (id, nombre, correo, contraseña, fecha_reg_temp, codigo, hora_reg) 
                    values (UUID(), :n, :e, :c, curdate(), :co, curtime())";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute(array(":n" => $n, ":e" => $e, ":c" => $c, ":co" => $co));
            $consulta->closeCursor();
            $insertado = true;
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }  
    }

    public function inserta_usuario($i, $n, $e, $c, $f) {
        try{
            $sql = "insert into usuarios (id, nombre, correo, nombre_google, contraseña, fecha_alta) 
                    values (:i, :n, :e, null, :c, :f)";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute(array(":i" => $i, ":n" => $n, ":e" => $e, ":c" => $c, ":f" => $f));
            $consulta->closeCursor();
            $insertado = true;
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }  
    }

    public function get_usuarios(){
        $sql = "select * from usuarios";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();
        $res = array();        
        if ($consulta->rowCount()>0) {
            while ($registro=$consulta->fetch(PDO::FETCH_ASSOC)) {
                $res[]=$registro;
            }
        }else{
            $res = "No hay registros en esta tabla";
        }
        return $res;
    }

    public function get_usuario_temp($c){
        $sql = "select * from usuarios_temporal where codigo = :c";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute(array(":c" => $c));
        $res = array();        
        if ($consulta->rowCount()>0) {
            while ($registro=$consulta->fetch(PDO::FETCH_ASSOC)) {
                $res[]=$registro;
            }
        }else{
            $res = "No hay registros en esta tabla";
        }
        return $res;
    }

    public function get_usuarios_temp(){
        $sql = "select * from usuarios_temporal";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();
        $res = array();        
        if ($consulta->rowCount()>0) {
            while ($registro=$consulta->fetch(PDO::FETCH_ASSOC)) {
                $res[]=$registro;
            }
        }else{
            $res = "No hay registros en esta tabla";
        }
        return $res;
    }

    public function eliminar_user_temp($c){
        $sql = "delete from usuarios_temporal WHERE codigo = :c";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute(array(":c" => $c));
    }

    public function identifica_usuario($user, $contra) {
        //hay 3 res pero sola y sobra uno, el mensaje segurament
        $sql = "select * from usuarios";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();
        $users = array();

        if ($consulta->rowCount()>0) {
            while ($registro=$consulta->fetch(PDO::FETCH_ASSOC)) {
                $users[]=$registro;
            }
        }else{
            //sobra
            $res = "No se ha encontrado ningún usuario";
        }

        $res=false;
        for ($i=0; $i < count($users); $i++) { 
            if ($contra==$users[$i]["contraseña"] && $user==$users[$i]['nombre']) {
                $res = true;
                $_SESSION['id_usuario'] = $users[$i]["id"];
                break;
            }
        }
        return $res;
    }
    
    //opciones de usuario
    public function mod_contra($c, $i){
        $sql = "update usuarios set contraseña = :c WHERE id = :i";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute(array(":c" => $c, ":i" => $i));
    }

    public function mod_email($e, $i){
        $sql = "update usuarios set correo = :e WHERE id = :i";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute(array(":e" => $e, ":i" => $i));
    }

    public function eliminar_user($i){
        $sql = "delete from usuarios WHERE id = :i";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute(array(":i" => $i));
    }

    public function get_usuario($id_user){
        $sql = "select * from usuarios where id = '$id_user'";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();
        $res = array();        
        if ($consulta->rowCount()>0) {
            while ($registro=$consulta->fetch(PDO::FETCH_ASSOC)) {
                $res[]=$registro;
            }
        }else{
            $res = "No hay registros en esta tabla";
        }
        return $res;
    }

    //alimentos
    public function get_alimentos($id_user){
        $sql = "select * from alimentos_users where id_usuario = '$id_user'";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();
        $res = array();        
        if ($consulta->rowCount()>0) {
            while ($registro=$consulta->fetch(PDO::FETCH_ASSOC)) {
                $res[]=$registro;
            }
        }else{
            $res = "No hay registros en esta tabla";
        }
        return $res;
    }

    public function buscarAlimento($nombre, $id_user){       
    
        $sql = "select * from alimentos_users where nombre like concat('%',:nom,'%' ) and id_usuario = '$id_user'";  
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute(array(":nom" => $nombre));
        $x = array();

        if ($consulta->rowCount()>0) {
            while ($registro=$consulta->fetch(PDO::FETCH_ASSOC)) {
                $x[]=$registro;
            }
        }else{
            $res = "No hay registros en esta tabla";
        }

        $consulta->closeCursor();
        return $x;
    }

    public function get_tipos(){
        $sql = "select id, nombre from tipos";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();
        $res = array();        
        if ($consulta->rowCount()>0) {
            while ($registro=$consulta->fetch(PDO::FETCH_ASSOC)) {
                $res[]=$registro;
            }
        }else{
            $res = "No hay registros en esta tabla";
        }
        return $res;
    }

    public function get_categorias($id_user){
        $sql = "select id, nombre from categorias where id_usuario = '$id_user' order by nombre"; //where id_usuario
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();
        $res = array();        
        if ($consulta->rowCount()>0) {
            while ($registro=$consulta->fetch(PDO::FETCH_ASSOC)) {
                $res[]=$registro;
            }
        }else{
            $res = "No hay registros en esta tabla";
        }
        return $res;
    }

    //2 funciontes hermanas
    //en el execute no se controla la fecha, supongo q no es necesario?
    //abajo el insertado tru no vale si no se retorna, usarolo o no y habrtia q controlar errores.....!!
    public function insertar_alimento($n, $c, $t, $fc, $f, $i){
        try{
            $sql = "insert into alimentos_users (nombre, id_categoria, id_tipo, fecha_caducidad, foto, id_usuario, id, fecha_reg_alimento) 
                    values (:n, :c, :t, '$fc', :f, :i, UUID(), curdate())";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute(array(":n" => $n, ":c" => $c, ":t" => $t, ":f" => $f, ":i" => $i));
            $consulta->closeCursor();
            $insertado = true;
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }            
    }
    
    public function insertar_alimento_ConFechaCongelado($n, $c, $t, $fc, $fcg, $f, $i){
        try{
            $sql = "insert into alimentos_users (nombre, id_categoria, id_tipo, fecha_caducidad, fecha_congelado,  foto, id_usuario, id, fecha_reg_alimento) 
                    values (:n, :c, :t, '$fc', '$fcg', :f, :i, UUID(), curdate())";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute(array(":n" => $n, ":c" => $c, ":t" => $t, ":f" => $f, ":i" => $i));
            $consulta->closeCursor();
            $insertado = true;
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }            
    }

    public function insertar_categoria($n, $i){
        try{
            $sql = "insert into categorias (id, nombre, id_usuario) 
                    values (UUID(), :n, :i)";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute(array(":n" => $n, ":i" => $i));
            $consulta->closeCursor();
            $insertado = true;
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }            
    }

    public function eliminar_alimento($id_ali, $id_usuario){

            $sql = "delete from alimentos_users where id = :id and id_usuario = :id_u";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute(array(":id" => $id_ali, ":id_u" => $id_usuario));
            $consulta->closeCursor();
       
    }

    public function get_alimento($id_ali, $id_user){
        $sql = "select * from alimentos_users where id = '$id_ali' and id_usuario = '$id_user'";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();
        $res = array();        
        if ($consulta->rowCount()>0) {
            while ($registro=$consulta->fetch(PDO::FETCH_ASSOC)) {
                $res[]=$registro;
            }
        }else{
            $res = "No hay registros en esta tabla";
        }
        return $res;
    }

    public function editar_alimento($n, $c, $t, $fc, $f, $i_u, $i){

        $sql = "update alimentos_users set nombre = :n, id_categoria = :c, id_tipo = :t, fecha_caducidad = :fc, foto = :f  WHERE id_usuario = :i_u and id = :i";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute(array(":n" => $n, ":c" => $c, ":t" => $t, ":fc" => $fc, ":f" => $f, ":i_u" => $i_u, ":i" => $i));

    }

    //ESTE METODO NO ESTA EN USO
    public function editar_alimento_congelado($n, $c, $t, $fc, $f, $i_u, $i){

        $sql = "update alimentos_users set nombre = :n, id_categoria = :c, id_tipo = :t, fecha_congelado = :fc, foto = :f  WHERE id_usuario = :i_u and id = :i";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute(array(":n" => $n, ":c" => $c, ":t" => $t, ":fc" => $fc, ":f" => $f, ":i_u" => $i_u, ":i" => $i));

    }




    /**/


    public function xx($n){

        $sql = "select count(*) cuenta from alimentos where nombre like :nom ";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute(array(":nom" => $n));
        $registro=$consulta->fetch(PDO::FETCH_ASSOC);

        if ($registro['cuenta'] > 0) {
            $res=false;
        }else{
            $res=true;
        }            
        return $res;
    }

    public function xxx(){
 
        $sql = "insert into x () values (:no,)";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute(array(":x" => $x, ));

        $consulta->closeCursor();
        return var_dump($n_alimentos);
    }

    public function buscarx($nombre){       
    
        $sql = "select * from x where nombre like concat(:nom,'%' ) order by energia desc";  
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute(array(":nom" => $nombre));
        $x = array();

        if ($consulta->rowCount()>0) {
            while ($registro=$consulta->fetch(PDO::FETCH_ASSOC)) {
                $x[]=$registro;
            }
        }else{
            $res = "No hay registros en esta tabla";
        }

        $consulta->closeCursor();
        return $x;
    }

    public function buscarCombinada($kcal,$opcion){

        //$kcal = htmlspecialchars($kcal);
        switch ($opcion) {
            case 'igual':
                $sql = "select * from alimentos where energia = :kc order by energia desc";
                break;
            case 'mayor':
                $sql = "select * from alimentos where energia > :kc order by energia desc";
                break;
            case 'menor':
                $sql = "select * from alimentos where energia < :kc order by energia desc";           
        }
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute(array(":kc" => $kcal));
        $x = array();

        if ($consulta->rowCount()>0) {
            while ($registro=$consulta->fetch(PDO::FETCH_ASSOC)) {
                $x[]=$registro;
            }
        }else{
            $res = "No hay registros en esta tabla";
        }

        $consulta->closeCursor();
        return $x;
    }

    public function borrarx($id){

        for ($i=0; $i < count($id); $i++) { 
            $nid = $id[$i];
            $sql = "delete from x where id = :id";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute(array(":id" => $nid));
            $consulta->closeCursor();
        }
        
    }

    public function modificarx($request){
        
        array_shift($request);
        array_pop($request);
        //var_dump($request);            

        foreach ($request as $modcampo => $ar_interno) {
            foreach ($ar_interno as $id => $vcampo) {
                
                // echo "  key2->  " . $id . "<br>";
                // echo "  value2->  " . $vcampo . "<br>";
                // echo "  key->  " . $modcampo . "<br";
                $sql = "update alimentos set $modcampo = :c  WHERE id = :i";
                $consulta = $this->conexion->prepare($sql);
                $consulta->execute(array(":c" => $vcampo, ":i" => $id));
            }
        }
    }

    public function autocompletar(){

        $sql = "select nombre from alimentos";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();


        $nalimentos = "";
        if ($consulta->rowCount()>0) {
            while ($registro=$consulta->fetch(PDO::FETCH_ASSOC)) {
                $nalimentos .= '"' . $registro['nombre'] . '",';
            }
        }

        return $nalimentos;
    }




    public function resultadosFiltrados($sentencia){
        $sql = $sentencia;
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();
        $res = array();        
        if ($consulta->rowCount()>0) {
            while ($registro=$consulta->fetch(PDO::FETCH_ASSOC)) {
                $res[]=$registro;
            }
        }else{
            $res = "No hay registros en esta tabla";
        }
        return $res;
    }


}
?>