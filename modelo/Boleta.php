<?php
require_once SYS . DIRECTORY_SEPARATOR . "Modelo.php";
require_once "TablaInterface.php";
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";
require_once "Cliente.php";

class Boleta extends Modelo implements TablaInterface {
    private $_idboletas;   # Nuestro (PK)
    private $_nombres; #Objeto de Cliente
    private $_numero;
    private $_fecha;
    private $_total;
    private $_igv;
    private $_bd;
    const TABLA = 'boletas';
    #Constructor
    public function __construct($idboletas=null, $nombres=null
                            , $numero="", $fecha="", $total="", $igv=""){
        $this->_idboletas = $idboletas;
        $this->_nombres = new Cliente($nombres);
        $this->_numero = $numero;
        $this->_fecha = $fecha;
        $this->_total = $total;
        $this->_igv = $igv;
        $this->_bd = new BaseDeDatos(new MySQL());
    }
    #implementamos lo que dice la INTERFACE
    public function nuevo(){
        $sql ="INSERT INTO ". self::TABLA
        ."(idboletas, idclientes, numero, fecha, total, igv) VALUES (".
            $this->_idboletas . ",". $this->_nombres->getId().",'"
            .$this->_numero ."','". $this->_fecha ."','".
            $this->_total ."','". $this->_igv
        ."');"; 
       /*var_dump($this->_nombres->getId()); exit();
        var_dump($sql); exit();*/
        return $this->_bd->ejecutar($sql);
       
    }
    public function eliminar(){
        $sql ="DELETE FROM ". self::TABLA 
             ." WHERE idboletas=".$this->_idboletas.";";
        return $this->_bd->ejecutar($sql);
    }
    public function editar(){
        $sql ="UPDATE ". self::TABLA 
            . " SET numero='".$this->_numero."',"
            ."idclientes=". $this->_nombres->getId().","#posible falla, se podrìa colocar getNombre
            ."fecha='". $this->_fecha."',"
            ."total='". $this->_total."',"
            ."igv='". $this->_igv."'"
            ." WHERE idboletas=".$this->_idboletas.";";
            //var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }
    public function leer($todo=true){ 
        $sql ="SELECT b.idboletas, b.idclientes, c.nombres, b.numero, b.fecha
                    , b.total, b.igv FROM ". self::TABLA ." b"
                    . " INNER JOIN clientes c ON b.idclientes=c.idclientes"  ; 
        if (!$todo) #devuelve un solo registro
            $sql .=" WHERE b.idboletas=".$this->_idboletas.";";
            #var_dump($sql)
        $datos=$this->_bd->ejecutar($sql); 
        if (!$todo) 
            $this->setPropiedades($datos[0]); 
        return $datos; 
    }

    #Devolvemos las propiedades 
    public function getId(){ 
        return $this->_idboletas; 
    } 
    public function getNumero(){
        return $this->_numero;
    }
    public function getFecha(){
        return $this->_fecha;
    }
    public function getTotal(){
        return $this->_total;
    }
    public function getIGV(){
        return $this->_igv;
    }
    public function getCliente(){ #de la relacion con cliente 
        return $this->_nombres; 
    } 
 
    private function setPropiedades ($registro){ 
        $this->_idboletas= $registro["idboletas"]; 
        $this->_nombres= new Cliente ($registro["idclientes"]);
        $this->_numero= $registro["numero"]; 
        $this->_fecha= $registro["fecha"];
        $this->_total= $registro["total"];
        $this->_igv= $registro["igv"];
    } 
}
?>