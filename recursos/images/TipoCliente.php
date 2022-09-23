<?php
require_once SYS . DIRECTORY_SEPARATOR . "Modelo.php";
require_once "TablaInterface.php";
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";

class TipoCliente extends Modelo implements TablaInterface { 
    private $_idtipos_clientes; #Clave Primaria}
    private $_tipocliente;
    private $_bd;
    const TABLA="tipos_clientes";
    #Contructor
    public function __construct($idtipos_clientes=null,$tipocliente=""){
        $this->_idtipos_clientes = $idtipos_clientes;
        $this->_tipocliente = $tipocliente;
        $this->_bd = new BaseDeDatos(new MySQL());
    }
    public function nuevo(){
        $sql ="INSERT INTO ". self::TABLA
        ."(idtipos_clientes, tipocliente) VALUES (".
            $this->_idtipos_clientes . ",'". $this->_tipocliente ."'"
        .");";
        return $this->_bd->ejecutar($sql);
    }
    public function eliminar(){
        $sql ="DELETE FROM ". self::TABLA 
             ." WHERE idtipos_clientes=".$this->_idtipos_clientes.";";
        return $this->_bd->ejecutar($sql);
    }
    public function editar(){
        $sql ="UPDATE ". self::TABLA 
            . " SET tipocliente='".$this->_tipocliente."'"
            ." WHERE idtipos_clientes=".$this->_idtipos_clientes.";";
        return $this->_bd->ejecutar($sql);
    }
    public function leer($todo=true){ 
        $sql ="SELECT * FROM ". self::TABLA ; 
        if (!$todo) 
            $sql .=" WHERE idtipos_clientes=".$this->_idtipos_clientes.";";
        $datos=$this->_bd->ejecutar($sql); 
        if (!$todo) 
            $this->setPropiedades($datos[0]); 
        return $datos; 
    }
    #Devolvemos las propiedades 
    public function getId(){ 
        return $this->_idtipos_clientes; 
    } 
    public function getTipoCliente(){ 
        return $this->_tipocliente; 
    } 
    private function setPropiedades ($registro){ 
        $this->_idtipos_clientes= $registro["idtipos_clientes"]; 
        $this->_tipocliente= $registro["tipocliente"]; 
    } 
}