<?php

class Model{

    protected $conexion;
    private static $instancia;
    public function __construct(){
        try {

        $this->conexion = new PDO(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave);
        $this->conexion->exec(Config::$caract);
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
        } catch (Exception $e) {
         die("Error: " . $e->getMessage());
        }
    }

    public static function singleton(){
        
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

    public function __clone(){
        
        trigger_error("La clonación de este objeto no está permitida", E_USER_ERROR);
    }

    ///////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////


    public function inserta_usuario($n, $e, $c) {
        try{
            $sql = "insert into usuarios (id, nombre, nombre_google, correo, contraseña, fecha_alta) 
                    values (UUID(), :n, null, :e, :c, curdate())";
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute(array(":n" => $n, ":e" => $e, ":c" => $c));
            $consulta->closeCursor();
            $insertado = true;
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }  
    }

    public function identifica_usuario($user, $contra) {

        $sql = "select * from usuarios";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();
        $users = array();

        if ($consulta->rowCount()>0) {
            while ($registro=$consulta->fetch(PDO::FETCH_ASSOC)) {
                $users[]=$registro;
            }
        }else{
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

    public function get_categorias(){
        $sql = "select id, nombre from categorias"; //where id_usuario
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

}
