<?php
require_once SYS . DIRECTORY_SEPARATOR . "Modelo.php";
require_once "TablaInterface.php";
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";
require_once "Cliente.php";
require_once "TipoComprobante.php";
require_once "MetodoPago.php";

class Comprobante extends Modelo implements TablaInterface { 
    private $_nroComprobante; #Clave Primaria}
    private $_cliente; #objeto de tipo cliente
    private $_tipo; #objeto de tipo tipocomprobante
    private $_metodoPago; #objeto de tipo metodo pago
    private $_fecha;
    private $_subTotal;
    private $_IGV;
    private $_total;
    private $_bd;
    const TABLA="Comprobante";
    #Contructor
    public function __construct($nroComprobante=null, 
                $cliente=null, $tipo=null, $metodoPago=null, $fecha="", 
                $subTotal="", $IGV="", $total=""){
        $this->_nroComprobante = $nroComprobante;
        $this->_cliente = new Cliente($cliente);
        $this->_tipo = new TipoComprobante($tipo);
        $this->_metodoPago = new MetodoPago($metodoPago);
        $this->_fecha = $fecha;
        $this->_subTotal = $subTotal;
        $this->_IGV = $IGV;
        $this->_total = $total;
        $this->_bd = new BaseDeDatos(new MySQL());
    }
    #implementamos lo que dice la INTERFACE
    public function nuevo(){
        $sql ="INSERT INTO ". self::TABLA
        ."(nroComprobante, idCliente, idTipoComprobante, idMetodoPago, fecha, subTotal, IGV, total) VALUES (".
            $this->_nroComprobante . ",". $this->_cliente->getId().",'"
            .$this->_tipo->getId() ."','". $this->_metodoPago->getId() ."','".
            $this->_fecha ."','". $this->_subTotal ."','".
            $this->_IGV ."','". $this->_total 
        ."');"; 
       // var_dump($this->_tipoCliente->getId()); exit();
        return $this->_bd->ejecutar($sql);
    }
    public function eliminar(){
        $sql ="DELETE FROM ". self::TABLA 
             ." WHERE nroComprobante=".$this->_nroComprobante.";";
        return $this->_bd->ejecutar($sql);
    }
    public function editar(){
        $sql ="UPDATE ". self::TABLA 
            . " SET fecha='".$this->_fecha."',"
            ."idCliente=". $this->_cliente->getId().","
            ."idTipoComprobante=". $this->_tipo->getId().","
            ."idMetodoPago=". $this->_metodoPago->getId().","
            ."subTotal='". $this->_subTotal."',"
            ."IGV='". $this->_IGV."',"
            ."total='". $this->_total."'"
            ." WHERE nroComprobante=".$this->_nroComprobante.";";
            //var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }
    public function leer($todo=true){ 
        $sql ="SELECT nc.nroComprobante, nc.idCliente, c.nombre
                    , nc.idTipoComprobante, tc.tipo
                    , nc.idMetodoPago, mp.metodoPago
                    , nc.fecha, nc.subTotal
                    , nc.IGV, nc.total FROM ". self::TABLA ." nc"
                    . " INNER JOIN Cliente c ON nc.idCliente=c.idCliente
                    INNER JOIN TipoComprobante tc ON nc.idTipoComprobante=tc.idTipoComprobante
                    INNER JOIN MetodoPago mp ON nc.idMetodoPago=mp.idMetodoPago"  ;   
        if (!$todo) #devuelve un solo registro
            $sql .=" WHERE nc.nroComprobante=".$this->_nroComprobante.";";
            #var_dump($sql)
        $datos=$this->_bd->ejecutar($sql); 
        if (!$todo) 
            $this->setPropiedades($datos[0]); 
        return $datos; 
    }
    #Devolvemos las propiedades 
    public function getId(){ 
        return $this->_nroComprobante; 
    } 
    public function getFecha(){
        return $this->_fecha;
    }
    public function getSubTotal(){
        return $this->_subTotal;
    }
    public function getIGV(){
        return $this->_IGV;
    }
    public function getTotal(){
        return $this->_total;
    }
    public function getCliente(){ #de la relacion con cliente 
        return $this->_cliente; 
    } 
    public function getTipo(){ #de la relacion con tipocomprobante
        return $this->_tipo;
    }
    public function getMetodoPago(){ #de la relacion con metodopago
        return $this->_metodoPago;
    }
    private function setPropiedades ($registro){ 
        $this->_nroComprobante= $registro["nroComprobante"]; 
        $this->_cliente= new Cliente ($registro["idCliente"]);
        $this->_tipo= new TipoComprobante ($registro["idTipoComprobante"]); 
        $this->_metodoPago= new MetodoPago ($registro["idMetodoPago"]);
        $this->_fecha= $registro["fecha"];
        $this->_subTotal= $registro["subTotal"];
        $this->_IGV= $registro["IGV"];
        $this->_total= $registro["total"];
    } 
}
?>
