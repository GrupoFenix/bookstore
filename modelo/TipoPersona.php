<?php
require_once SYS . DIRECTORY_SEPARATOR . "Modelo.php";
require_once "TablaInterface.php";
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";

class TipoPersona extends Modelo implements TablaInterface {
    private $_id;   # Nuestro (PK)
    private $_tipo;
    private $_bd;
    const TABLA = 'tipos';
    #Constructor
    public function __construct($id=null, $tipo=""){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_id = $id;
        $this->_tipo = $tipo; 
    }
    # Implementamos lo que dice la INTERFACE
    public function nuevo(){
        $sql = "INSERT INTO ". self::TABLA 
            ." (idtipos, tipo) VALUES (".
                $this->_id .",'". $this->_tipo ."'"
            .");";
        return $this->_bd->ejecutar($sql);
    }
    public function editar(){
        $sql ="UPDATE ". self::TABLA 
            . " SET tipo='".$this->_tipo."'"
            ." WHERE idtipos=".$this->_id.";";
        return $this->_bd->ejecutar($sql);
    }
    public function eliminar(){
        $sql ="DELETE FROM ". self::TABLA 
            ." WHERE idtipos=".$this->_id.";";
        return $this->_bd->ejecutar($sql);
    }
    public function leer($todo=true){
        $sql ="SELECT * FROM ". self::TABLA ;
        if (!$todo)
            $sql .=" WHERE idtipos=".$this->_id.";";
        $datos=$this->_bd->ejecutar($sql);
        if (!$todo)
            $this->setPropiedades($datos[0]);
        return $datos;
    }

    #Devolvemos las propiedades
    public function getId(){
        return $this->_id;
    }
    public function getTipo(){
        return $this->_tipo;
    }
    private function setPropiedades ($registro){
        $this->_id= $registro["idtipos"];
        $this->_tipo=$registro["tipo"];
    }
}
