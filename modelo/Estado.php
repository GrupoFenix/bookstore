<?php
require_once SYS . DIRECTORY_SEPARATOR . "Modelo.php";
require_once "TablaInterface.php";
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";

class Estado extends Modelo implements TablaInterface { 
    private $_idestado; #Clave Primaria}
    private $_estado;
    private $_bd;
    const TABLA="estado";
    #Contructor
    public function __construct($idestado=null,$estado=""){
        $this->_idestado = $idestado;
        $this->_estado = $estado;
        $this->_bd = new BaseDeDatos(new MySQL());
    }
    public function nuevo(){
        $sql ="INSERT INTO ". self::TABLA
        ."(idestado, estado) VALUES (".
            $this->_idestado . ",'". $this->_estado ."'"
        .");";
        return $this->_bd->ejecutar($sql);
    }
    public function eliminar(){
        $sql ="DELETE FROM ". self::TABLA 
             ." WHERE idestado=".$this->_idestado.";";
        return $this->_bd->ejecutar($sql);
    }
    public function editar(){
        $sql ="UPDATE ". self::TABLA 
            . " SET estado='".$this->_estado."'"
            ." WHERE idestado=".$this->_idestado.";";
        return $this->_bd->ejecutar($sql);
    }
    public function leer($todo=true){ 
        $sql ="SELECT * FROM ". self::TABLA ; 
        if (!$todo) 
            $sql .=" WHERE idestado=".$this->_idestado.";";
        $datos=$this->_bd->ejecutar($sql); 
        if (!$todo) 
            $this->setPropiedades($datos[0]); 
        return $datos; 
    }
    #Devolvemos las propiedades 
    public function getId(){ 
        return $this->_idestado; 
    } 
    public function getEstado(){ 
        return $this->_estado; 
    } 
    private function setPropiedades ($registro){ 
        $this->_idestado= $registro["idestado"]; 
        $this->_estado= $registro["estado"]; 
    } 
}