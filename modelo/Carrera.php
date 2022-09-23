<?php
require_once SYS . DIRECTORY_SEPARATOR . "Modelo.php";
require_once "TablaInterface.php";
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";
require_once "Turno.php";
class Carrera extends Modelo implements TablaInterface {
    private $_id;   # Nuestro (PK)
    private $_nombre;
    private $_sigla;
    private $_turno; #Objeto de tipo Turno
    private $_bd;
    const TABLA = 'Carreras';
    #Constructor
    public function __construct($id=null, $nombre=""
                            , $sigla="", $turno=null){
        $this->_bd = new BaseDeDatos(new MySQL());
        
        $this->_id = $id;
        $this->_nombre = $nombre;
        $this->_sigla = $sigla;
        $this->_turno = new Turno($turno);  
    }
    # Implementamos lo que dice la INTERFACE
    public function nuevo(){
        $sql = "INSERT INTO ". self::TABLA 
            ." (idcarreras, nombre, siglas, idturnos) VALUES (".
                $this->_id .",'". $this->_nombre ."','"
                . $this->_sigla ."',". $this->_turno->getId() 
            .");";
        // var_dump($sql);
        return $this->_bd->ejecutar($sql);
    }
    public function editar(){
        $sql ="UPDATE ". self::TABLA 
            . " SET nombre='".$this->_nombre."',"
            . "siglas='". $this->_sigla."',"
            . "idturnos=". $this->_turno->getId()
            . " WHERE idcarreras=".$this->_id.";";
        // var_dump($sql);
        return $this->_bd->ejecutar($sql);
    }
    public function eliminar(){
        $sql ="DELETE FROM ". self::TABLA 
            ." WHERE idcarreras=".$this->_id.";";
        return $this->_bd->ejecutar($sql);
    }
    public function leer($todo=true){
        $sql ="SELECT c.idcarreras,c.nombre, c.siglas
                    , c.idturnos, t.turno FROM ". self::TABLA ." c"
                    . " INNER JOIN turnos t ON c.idturnos=t.idturnos" ;
        if (!$todo) #devuelve un solo Registro
            $sql .=" WHERE c.idcarreras=".$this->_id.";";
        $datos = $this->_bd->ejecutar($sql);
        if (!$todo)
            $this->setPropiedades($datos[0]);
            return $datos;
    }
    public function consultaPorTurno($turno){
        $sql ="SELECT c.idcarreras,c.nombre, c.siglas
                    , c.idturnos, t.turno FROM ". self::TABLA ." c"
                    . " INNER JOIN turnos t ON c.idturnos=t.idturnos" ;
            $sql .=" WHERE c.idturnos=".$turno.";";
        $datos = $this->_bd->ejecutar($sql);
        return $datos;
    }
    #Devolvemos las propiedades
    public function getId(){
        return $this->_id;
    }
    public function getNombre(){
        return $this->_nombre;
    }
    public function getSigla(){
        return $this->_sigla;
    }
    public function getTurno (){ # De la relación con Turno
        return $this->_turno;
    }
    private function setPropiedades ($registro){
        $this->_id= $registro["idcarreras"];
        $this->_nombre=$registro["nombre"];
        $this->_sigla = $registro["siglas"];
        $this->_turno = new Turno($registro["idturnos"]); 
    }
}