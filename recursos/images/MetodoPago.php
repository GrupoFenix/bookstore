<?php
require_once SYS . DIRECTORY_SEPARATOR . "Modelo.php";
require_once "TablaInterface.php";
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";

class MetodoPago extends Modelo implements TablaInterface { 
    private $_idMetodoPago; #Clave Primaria}
    private $_metodoPago;
    private $_bd;
    const TABLA="MetodoPago";
    #Contructor
    public function __construct($idMetodoPago=null,$metodoPago=""){
        $this->_idMetodoPago = $idMetodoPago;
        $this->_metodoPago = $metodoPago;
        $this->_bd = new BaseDeDatos(new MySQL());
    }
    public function nuevo(){
        $sql ="INSERT INTO ". self::TABLA
        ."(idMetodoPago, metodoPago) VALUES (".
            $this->_idMetodoPago . ",'". $this->_metodoPago ."'"
        .");";
        return $this->_bd->ejecutar($sql);
    }
    public function eliminar(){
        $sql ="DELETE FROM ". self::TABLA 
             ." WHERE idMetodoPago=".$this->_idMetodoPago.";";
        return $this->_bd->ejecutar($sql);
    }
    public function editar(){
        $sql ="UPDATE ". self::TABLA 
            . " SET metodoPago='".$this->_metodoPago."'"
            ." WHERE idMetodoPago=".$this->_idMetodoPago.";";
        return $this->_bd->ejecutar($sql);
    }
    public function leer($todo=true){ 
        $sql ="SELECT * FROM ". self::TABLA ; 
        if (!$todo) 
            $sql .=" WHERE idMetodoPago=".$this->_idMetodoPago.";";
        $datos=$this->_bd->ejecutar($sql); 
        if (!$todo) 
            $this->setPropiedades($datos[0]); 
        return $datos; 
    }
    #Devolvemos las propiedades 
    public function getId(){ 
        return $this->_idMetodoPago; 
    } 
    public function getMetodoPago(){ 
        return $this->_metodoPago; 
    } 
    private function setPropiedades ($registro){ 
        $this->_idMetodoPago= $registro["idMetodoPago"]; 
        $this->_metodoPago= $registro["metodoPago"]; 
    } 
}