<?php
require_once SYS . DIRECTORY_SEPARATOR . "Modelo.php";
require_once "TablaInterface.php";
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";

class Vacuna extends Modelo implements TablaInterface {
    private $_id;   # Nuestro (PK)
    private $_fecha;
    private $_lugar;
    private $_departamento;
    private $_tipo;
    private $_dosis;
    private $_persona;
    private $_bd;
    const TABLA = 'vacunas';
    #Constructor
    public function __construct($id=null, $fecha=null,$lugar=null,
                    $departamento=null,$tipo=null,$persona=null,dosis=null){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_id = $id;
        $this->_fecha = $fecha; 
        $this->_lugar = $lugar; 
        $this->_departamento = new Departamento($departamento); 
        $this->_tipo = new TipoVacuna($tipo); 
        $this->_persona = new Persona($persona); 
        $this->_dosis = $dosis; 
    }
    # Implementamos lo que dice la INTERFACE
    public function nuevo(){
        $sql = "INSERT INTO ". self::TABLA 
            ." (idvacunas, fecha, lugar, idtiposvacunas, iddepartamentos, idpersonas, dosis) VALUES ("
                . $this->_id .",'". $this->_fecha ."','"
                . $this->_lugar ."',". $this->_departamento->gedId() .",". $this->_departamento->gedId() .","
                . $this->_persona->gedId() .",'" . $this->_dosis ."'";
            .");";
        return $this->_bd->ejecutar($sql);
    }
    public function editar(){
        $sql ="UPDATE ". self::TABLA 
            . " SET fecha='".$this->_fecha."'"
            .", lugar='".$this->_lugar."'"
            .", idtiposvacunas='".$this->_tipo->gedId() .","."'"
            .", iddepartamentos='".$this->_departamento->gedId() .","."'"
            .", idpersonas='".$this->_persona->gedId() .","."'"
            .", dosis='".$this->_dosis."'"
            ." WHERE idvacunas=".$this->_id.";";
        return $this->_bd->ejecutar($sql);
    }
    public function eliminar(){
        $sql ="DELETE FROM ". self::TABLA 
            ." WHERE idvacunas=".$this->_id.";";
        return $this->_bd->ejecutar($sql);
    }
    public function leer($todo=true){
        $sql ="SELECT v.fecha, v.lugar, t.tipo, d.nombre, v.dosis FROM ". self::TABLA ." v " 
            . "INNER JOIN tipovacunas t ON t.idtiposvacunas=v.idtiposvacunas "
            . "INNER JOIN departamentos d ON d.iddepartamentos=v.iddepartamentos";
        if (!$todo)
            $sql .=" WHERE idvacunas=".$this->_id.";";
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
        return $this->_fecha;
    }
    private function setPropiedades ($registro){
        $this->_id= $registro["idvacunas"];
        $this->_fecha=$registro["tipo"];
    }
    public function setPersona(Persona $p){
        $this->_persona=$p;
    }
    public function getVacunasPersona(){
        $sql ="SELECT v.fecha, v.lugar, t.tipo, d.nombre, v.dosis FROM ". self::TABLA ." v " 
            . "INNER JOIN tipovacunas t ON t.idtiposvacunas=v.idtiposvacunas "
            . "INNER JOIN departamentos d ON d.iddepartamentos=v.iddepartamentos";
            $sql .=" WHERE v.idpersonas=".$this->_persona->getId().";";
        return $this->_bd->ejecutar($sql);
    }
}
