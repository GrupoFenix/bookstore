<?php
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";

class Usuario { 
    private $_id; #Clave Primaria}
    private $_nombre;
    private $_apellido;
    private $login;
    private $password;
    private $_email;
    private $_tipo;
    private $_estado;
    private $_bd;
    const TABLA="usuario";
    #Contructor
    public function __construct($id=null,$nombre=null,$apellido=null,
            $login=null,$password=null,$email=null,$tipo=null,$estado=null){
        $this->_bd = new BaseDeDatos(new MySQL());
        
        $this->_id=$id;
        $this->_nombre=$nombre;
        $this->_apellido=$apellido;
        $this->_login=$login;
        $this->_password=md5($password); #Seguridad MD5
        $this->_email=$email;
        $this->_tipo=$tipo;
        $this->_estado=$estado;
    }
    public function leer($todo=true){
        $sql ="SELECT * FROM ". self::TABLA ;
        if (!$todo) #devuelve un solo Registro
            $sql .=" WHERE id=".$this->_id.";";
        return $this->_bd->ejecutar($sql);
    }

    public function eliminar(){
        $sql ="DELETE FROM ". self::TABLA 
            ." WHERE id=".$this->_id.";";
        return $this->_bd->ejecutar($sql);
    }

    public function editar(){
        $sql ="UPDATE ". self::TABLA 
            . " SET nombre='".$this->_nombre."', apellido='".$this->_apellido
            . "', login='".$this->_login ."', email='".$this->_email
            . "', password='".$this->_password ."', tipo=".$this->_tipo
            . ", estado=".$this->_estado 
            ." WHERE id=".$this->_id.";";
        //var_dump($sql);
        return $this->_bd->ejecutar($sql);
    }
    public function activarCuenta($estado=1){
        $sql ="UPDATE ". self::TABLA 
            . " SET estado=".$estado." WHERE id=".$this->_id.";";
        //var_dump($sql);
        return $this->_bd->ejecutar($sql);
    }

    public function nuevo(){
        $sql = "INSERT INTO ". self::TABLA 
            ." (id, nombre, apellido, login,password, email, tipo, estado) VALUES (".
                $this->_id .",'". $this->_nombre ."',"
                .$this->_apellido .",'".$this->_login ."','"
                .$this->_password ."','".$this->_email ."',"
                .$this->_tipo .",".$this->_estado 
            .");";
        return $this->_bd->ejecutar($sql);
    }
    public function verificarLogin($login,$password){
        $sql = "SELECT * FROM ". self::TABLA 
            ." WHERE login='".$login ."' and password=md5(".$password .")";
        $result = $this->_bd->ejecutar($sql);
        if (is_array($result){
            if (!isset($_SESSION))
                session_start();
            $_SESSION['logueado']=true;
            $_SESSION['usuario']=$result[0]['nombre'] . " " .$result[0]['apellido'];
            $_SESSION['id']=$result[0]['id'];
        }else {
            session_unset();
        }
    }
}