<?php
require_once SYS . DIRECTORY_SEPARATOR . "Modelo.php";
require_once "TablaInterface.php";
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";
require_once "TipoCliente.php";

class Cliente extends Modelo implements TablaInterface { 
    private $_idCliente; #Clave Primaria}
    private $_tipoCliente; #objeto de tipo tipocliente
    private $_nombre;
    private $_apellido;
    private $_DNI;
    private $_telefono;
    private $_RUC;
    private $_direccion;
    private $_correoElectronico;
    private $_bd;
    const TABLA="Cliente";
    #Contructor
    public function __construct($idCliente=null, 
                $tipoCliente=null, $nombre="", $apellido="", $DNI="", 
                $telefono="", $RUC="", $direccion="", $correoElectronico=""){
        $this->_idCliente = $idCliente;
        $this->_tipoCliente = new TipoCliente($tipoCliente);
        $this->_nombre = $nombre;
        $this->_apellido = $apellido;
        $this->_DNI = $DNI;
        $this->_telefono = $telefono;
        $this->_RUC = $RUC;
        $this->_direccion = $direccion;
        $this->_correoElectronico = $correoElectronico;
        $this->_bd = new BaseDeDatos(new MySQL());
    }
    #implementamos lo que dice la INTERFACE
    public function nuevo(){
        $sql ="INSERT INTO ". self::TABLA
        ."(idCliente, idTipoCliente, nombre, apellido, DNI, telefono, RUC, direccion, correoElectronico) VALUES (".
            $this->_idCliente . ",". $this->_tipoCliente->getId().",'"
            .$this->_nombre ."','". $this->_apellido ."','".
            $this->_DNI ."','". $this->_telefono ."','".
            $this->_RUC ."','". $this->_direccion ."','".
            $this->_correoElectronico 
        ."');"; 
       // var_dump($this->_tipoCliente->getId()); exit();
        return $this->_bd->ejecutar($sql);
    }
    public function eliminar(){
        $sql ="DELETE FROM ". self::TABLA 
             ." WHERE idCliente=".$this->_idCliente.";";
        return $this->_bd->ejecutar($sql);
    }
    public function editar(){
        $sql ="UPDATE ". self::TABLA 
            . " SET nombre='".$this->_nombre."',"
            ."idTipoCliente=". $this->_tipoCliente->getId().","
            ."apellido='". $this->_apellido."',"
            ."DNI='". $this->_DNI."',"
            ."telefono='". $this->_telefono."',"
            ."RUC='". $this->_RUC."',"
            ."direccion='". $this->_direccion."',"
            ."correoElectronico='". $this->_correoElectronico."'"
            ." WHERE idCliente=".$this->_idCliente.";";
            //var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }
    public function leer($todo=true){ 
        $sql ="SELECT c.idCliente, c.idTipoCliente, tp.tipoCliente, c.nombre, c.apellido
                    , c.DNI, c.telefono, c.RUC, c.direccion, c.correoElectronico FROM ". self::TABLA ." c"
                    . " INNER JOIN TipoCliente tp ON c.idTipoCliente=tp.idTipoCliente"  ; 
        if (!$todo) #devuelve un solo registro
            $sql .=" WHERE c.idCliente=".$this->_idCliente.";";
            #var_dump($sql)
        $datos=$this->_bd->ejecutar($sql); 
        if (!$todo) 
            $this->setPropiedades($datos[0]); 
        return $datos; 
    }
    public function revisar($todo=true){ 
        $sql ="SELECT c.idCliente, c.idTipoCliente, tp.tipoCliente, c.nombre, c.correoElectronico FROM ". self::TABLA ." c"
                    . " INNER JOIN TipoCliente tp ON c.idTipoCliente=tp.idTipoCliente"  ; 
        if (!$todo) #devuelve un solo registro
            $sql .=" WHERE c.idCliente=".$this->_idCliente.";";
            #var_dump($sql)
        $datos=$this->_bd->ejecutar($sql); 
        if (!$todo) 
            $this->setPropiedades($datos[0]); 
        return $datos; 
    }
    #Devolvemos las propiedades 
    public function getId(){ 
        return $this->_idCliente; 
    } 
    public function getNombre(){
        return $this->_nombre;
    }
    public function getApellido(){
        return $this->_apellido;
    }
    public function getDNI(){
        return $this->_DNI;
    }
    public function getTelefono(){
        return $this->_telefono;
    }
    public function getRUC(){
        return $this->_RUC;
    }
    public function getDireccion(){
        return $this->_direccion;
    }
    public function getCorreoElectronico(){
        return $this->_correoElectronico;
    }
    public function getTipoCliente(){ #de la relacion con turno 
        return $this->_tipoCliente; 
    } 
    private function setPropiedades ($registro){ 
        $this->_idCliente= $registro["idCliente"]; 
        $this->_tipoCliente= new TipoCliente ($registro["idTipoCliente"]);
        $this->_nombre= $registro["nombre"]; 
        $this->_apellido= $registro["apellido"];
        $this->_DNI= $registro["DNI"];
        $this->_telefono= $registro["telefono"];
        $this->_RUC= $registro["RUC"];
        $this->_direccion= $registro["direccion"];
        $this->_correoElectronico= $registro["correoElectronico"];
    } 
}
?>
