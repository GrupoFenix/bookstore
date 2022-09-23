<?php
require_once SYS . DIRECTORY_SEPARATOR . "Modelo.php";
require_once "TablaInterface.php";
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";

class Semestre extends Modelo implements TablaInterface {
    private $_id;   # Nuestro (PK)
    private $_nombre;
    private $_bd;
    const TABLA = 'Semestres';
    #Constructor
    public function __construct($id=null, $semestre=""){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_id = $id;
        $this->_nombre = $semestre; 
    }
    # Implementamos lo que dice la INTERFACE
    public function nuevo(){
        $sql = "INSERT INTO ". self::TABLA 
            ." (idsemestres, semestre) VALUES (".
                $this->_id .",'". $this->_nombre ."'"
            .");";
        return $this->_bd->ejecutar($sql);
    }
    public function editar(){
        $sql ="UPDATE ". self::TABLA 
            . " SET semestre='".$this->_nombre."'"
            ." WHERE idsemestres=".$this->_id.";";
        return $this->_bd->ejecutar($sql);
    }
    public function eliminar(){
        $sql ="DELETE FROM ". self::TABLA 
            ." WHERE idsemestres=".$this->_id.";";
        return $this->_bd->ejecutar($sql);
    }
    public function leer($todo=true){
        $sql ="SELECT * FROM ". self::TABLA ;
        if (!$todo)
            $sql .=" WHERE idsemestres=".$this->_id.";";
        $datos=$this->_bd->ejecutar($sql);
        if (!$todo)
            $this->setPropiedades($datos[0]);
        return $datos;
    }

    #Devolvemos las propiedades
    public function getId(){
        return $this->_id;
    }
    public function getSemestre(){
        return $this->_nombre;
    }
    private function setPropiedades ($registro){
        $this->_id= $registro["idsemestres"];
        $this->_nombre=$registro["semestre"];
    }
}
