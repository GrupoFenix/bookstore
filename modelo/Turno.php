<?php
require_once SYS . DIRECTORY_SEPARATOR . "Modelo.php";
require_once "TablaInterface.php";
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";

class Turno extends Modelo implements TablaInterface {
    private $_id;   # Nuestro (PK)
    private $_turno;
    private $_bd;
    const TABLA = 'Turnos';
    #Constructor
    public function __construct($id=null, $turno=""){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_id = $id;
        $this->_turno = $turno; 
    }
    # Implementamos lo que dice la INTERFACE
    public function nuevo(){
        $sql = "INSERT INTO ". self::TABLA 
            ." (idturnos, turno) VALUES (".
                $this->_id .",'". $this->_turno ."'"
            .");";
        return $this->_bd->ejecutar($sql);
    }
    public function editar(){
        $sql ="UPDATE ". self::TABLA 
            . " SET turno='".$this->_turno."'"
            ." WHERE idturnos=".$this->_id.";";
        return $this->_bd->ejecutar($sql);
    }
    public function eliminar(){
        $sql ="DELETE FROM ". self::TABLA 
            ." WHERE idturnos=".$this->_id.";";
        return $this->_bd->ejecutar($sql);
    }
    public function leer($todo=true){
        $sql ="SELECT * FROM ". self::TABLA ;
        if (!$todo)
            $sql .=" WHERE idturnos=".$this->_id.";";
        $datos=$this->_bd->ejecutar($sql);
        if (!$todo)
            $this->setPropiedades($datos[0]);
        return $datos;
    }

    #Devolvemos las propiedades
    public function getId(){
        return $this->_id;
    }
    public function getTurno(){
        return $this->_turno;
    }
    private function setPropiedades ($registro){
        $this->_id= $registro["idturnos"];
        $this->_turno=$registro["turno"];
    }
}
