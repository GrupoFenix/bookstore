<?php
require_once SYS . DIRECTORY_SEPARATOR . "Modelo.php";
require_once "TablaInterface.php";
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";
require_once "TipoCliente.php";
require_once "Estado.php";

class Cliente extends Modelo implements TablaInterface { 
    private $_idclientes; #Clave Primaria}
    private $_tipocliente; #objeto de tipo tipocliente
    private $_estado; #objeto de tipo estado
    private $_nombres;
    private $_apellidos;
    private $_direcciones;
    private $_telefonos;
    private $_dni;
    private $_ruc;
    private $_correoelectronico;
    private $_contraseñas;
    private $_bd;
    const TABLA="clientes";
    #Contructor
    public function __construct($idclientes=null, 
                $tipocliente=null, $estado=null, $nombres="", $apellidos="", $direcciones="", 
                $telefonos="", $dni="", $ruc="", $correoelectronico="", $contraseñas=""){
        $this->_idclientes = $idclientes;
        $this->_tipocliente = new TipoCliente($tipocliente);
        $this->_estado = new Estado($estado);
        $this->_nombres = $nombres;
        $this->_apellidos = $apellidos;
        $this->_direcciones = $direcciones;
        $this->_telefonos = $telefonos;
        $this->_dni = $dni;
        $this->_ruc = $ruc;
        $this->_correoelectronico = $correoelectronico;
        $this->_contraseñas= $contraseñas;
        $this->_bd = new BaseDeDatos(new MySQL());
    }
    #implementamos lo que dice la INTERFACE
    public function nuevo(){
        $sql ="INSERT INTO ". self::TABLA
        ."(idclientes, idtipos_clientes, idestado, nombres, apellidos, direcciones, telefonos, dni, ruc, correoelectronico, contraseñas) VALUES (".
            $this->_idclientes . ",". $this->_tipocliente->getId().",'"
            .$this->_estado->getId() ."','"
            .$this->_nombres ."','". $this->_apellidos ."','".
            $this->_direcciones ."','". $this->_telefonos ."','".
            $this->_dni ."','". $this->_ruc ."','".
            $this->_correoelectronico."','".
            $this->_contraseñas
        ."');"; 
       // var_dump($this->_tipoCliente->getId()); exit();
        return $this->_bd->ejecutar($sql);
    }
    public function eliminar(){
        $sql ="DELETE FROM ". self::TABLA 
             ." WHERE idclientes=".$this->_idclientes.";";
        return $this->_bd->ejecutar($sql);
    }
    public function editar(){
        $sql ="UPDATE ". self::TABLA 
            . " SET nombres='".$this->_nombres."',"
            ."idtipos_clientes=". $this->_tipocliente->getId().","
            ."idestado=". $this->_estado->getId().","
            ."apellidos='". $this->_apellidos."',"
            ."direcciones='". $this->_direcciones."',"
            ."telefonos='". $this->_telefonos."',"
            ."dni='". $this->_dni."',"
            ."ruc='". $this->_ruc."',"
            ."correoelectronico='". $this->_correoelectronico."',"
            ."contraseñas='". $this->_contraseñas."'"
            ." WHERE idclientes=".$this->_idclientes.";";
            //var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }
    public function leer($todo=true){ 
        $sql ="SELECT c.idclientes, c.idtipos_clientes, tp.tipocliente, c.idestado, e.estado, c.nombres, c.apellidos
                    , c.direcciones, c.telefonos, c.dni, c.ruc, c.correoelectronico, c.contraseñas FROM ". self::TABLA ." c"
                    . " INNER JOIN tipos_clientes tp ON c.idtipos_clientes=tp.idtipos_clientes
                    INNER JOIN estado e ON c.idestado=e.idestado"  ; 
        if (!$todo) #devuelve un solo registro
            $sql .=" WHERE c.idclientes=".$this->_idclientes.";";
            #var_dump($sql)
        $datos=$this->_bd->ejecutar($sql); 
        if (!$todo) 
            $this->setPropiedades($datos[0]); 
        return $datos; 
    }

    #Devolvemos las propiedades 
    public function getId(){ 
        return $this->_idclientes; 
    } 
    public function getNombre(){
        return $this->_nombres;
    }
    public function getApellido(){
        return $this->_apellidos;
    }
    public function getDireccion(){
        return $this->_direcciones;
    }
    public function getTelefono(){
        return $this->_telefonos;
    }
    public function getDNI(){
        return $this->_dni;
    }
    public function getRUC(){
        return $this->_ruc;
    }
    public function getCorreoElectronico(){
        return $this->_correoelectronico;
    }
    public function getContraseña(){
        return $this->_contraseñas;
    }
    public function getTipoCliente(){ #de la relacion con turno 
        return $this->_tipocliente; 
    } 
    public function getEstado(){ #de la relacion con turno 
        return $this->_estado; 
    } 
    private function setPropiedades ($registro){ 
        $this->_idclientes= $registro["idclientes"]; 
        $this->_tipocliente= new TipoCliente ($registro["idtipos_clientes"]);
        $this->_estado= new Estado ($registro["idestado"]);
        $this->_nombres= $registro["nombres"]; 
        $this->_apellidos= $registro["apellidos"];
        $this->_direcciones= $registro["direcciones"];
        $this->_telefonos= $registro["telefonos"];
        $this->_dni= $registro["dni"];
        $this->_ruc= $registro["ruc"];
        $this->_correoelectronico= $registro["correoelectronico"];
        $this->_correoelectronico= $registro["contraseñas"];
    } 
}
?>
