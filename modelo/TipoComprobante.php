<?php
require_once SYS . DIRECTORY_SEPARATOR . "Modelo.php";
require_once "TablaInterface.php";
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";

class TipoComprobante extends Modelo implements TablaInterface { 
    private $_idTipoComprobante; #Clave Primaria}
    private $_tipo;
    private $_numeroComprobante;
    private $_bd;
    const TABLA="TipoComprobante";
    #Contructor
    public function __construct($idTipoComprobante=null,$tipo="",$numeroComprobante=""){
        $this->_idTipoComprobante = $idTipoComprobante;
        $this->_tipo = $tipo;
        $this->_numeroComprobante = $numeroComprobante;
        $this->_bd = new BaseDeDatos(new MySQL());
    }
    public function nuevo(){
        $sql ="INSERT INTO ". self::TABLA
        ."(idTipoComprobante, tipo, numeroComprobante) VALUES (".
            $this->_idTipoComprobante . ",'". $this->_tipo ."','". $this->_numeroComprobante ."'"
        .");";
        return $this->_bd->ejecutar($sql);
    }
    public function eliminar(){
        $sql ="DELETE FROM ". self::TABLA 
             ." WHERE idTipoComprobante=".$this->_idTipoComprobante.";";
        return $this->_bd->ejecutar($sql);
    }
    public function editar(){
        $sql ="UPDATE ". self::TABLA 
            . " SET tipo='".$this->_tipo."',"
            ." numeroComprobante='". $this->_numeroComprobante."'"
            ." WHERE idTipoComprobante=".$this->_idTipoComprobante.";";
        return $this->_bd->ejecutar($sql);
    }
    public function leer($todo=true){ 
        $sql ="SELECT * FROM ". self::TABLA ; 
        if (!$todo) 
            $sql .=" WHERE idTipoComprobante=".$this->_idTipoComprobante.";";
        $datos=$this->_bd->ejecutar($sql); 
        if (!$todo) 
            $this->setPropiedades($datos[0]); 
        return $datos; 
    }
    #Devolvemos las propiedades 
    public function getId(){ 
        return $this->_idTipoComprobante; 
    } 
    public function getTipo(){ 
        return $this->_tipo; 
    } 
    public function getNumeroComprobante(){
        return $this->_numeroComprobante;
    }
    private function setPropiedades ($registro){ 
        $this->_idTipoComprobante= $registro["idTipoComprobante"]; 
        $this->_tipo= $registro["tipo"];
        $this->_numeroComprobante= $registro["numeroComprobante"]; 
    } 
}