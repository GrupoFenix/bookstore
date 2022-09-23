<?php
require_once SYS . DIRECTORY_SEPARATOR . "Modelo.php";
require_once "TablaInterface.php";
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";

class Departamento extends Modelo implements TablaInterface {
    private $_id;   # Nuestro (PK)
    private $_nombre;
    private $_bd;
    const TABLA = 'Departamentos';
    #Constructor
    public function __construct($id=null, $departamento=""){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_id = $id;
        $this->_nombre = $departamento; 
    }
    # Implementamos lo que dice la INTERFACE
    public function nuevo(){
        $sql = "INSERT INTO ". self::TABLA 
            ." (iddepartamentos, nombre) VALUES (".
                $this->_id .",'". $this->_nombre ."'"
            .");";
        return $this->_bd->ejecutar($sql);
    }
    public function editar(){
        $sql ="UPDATE ". self::TABLA 
            . " SET nombre='".$this->_nombre."'"
            ." WHERE iddepartamentos=".$this->_id.";";
        return $this->_bd->ejecutar($sql);
    }
    public function eliminar(){
        $sql ="DELETE FROM ". self::TABLA 
            ." WHERE iddepartamentos=".$this->_id.";";
        return $this->_bd->ejecutar($sql);
    }
    public function leer($todo=true){
        $sql ="SELECT * FROM ". self::TABLA ;
        if (!$todo)
            $sql .=" WHERE iddepartamentos=".$this->_id.";";
        $datos=$this->_bd->ejecutar($sql);
        if (!$todo)
            $this->setPropiedades($datos[0]);
        return $datos;
    }

    #Devolvemos las propiedades
    public function getId(){
        return $this->_id;
    }
    public function getDepartamento(){
        return $this->_nombre;
    }
    private function setPropiedades ($registro){
        $this->_id= $registro["iddepartamentos"];
        $this->_nombre=$registro["nombre"];
    }
}
