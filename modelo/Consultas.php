<?php
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";

class Consultas { 
    private $_DNI;
    public function __construct($dni){
        $this->_DNI = $dni;
    } 
    public function leer(){
        $sql ="SELECT * FROM ". self::TABLA 
        $sql .=" WHERE dni=".$this->_DNI.";";
        $r = $this->_bd->ejecutar($sql);
        if (is_array($r)){    # Se encontró información
            $retorno = array(
                'nombre'=>$r['nombre'],
                'dosis1'=>$r['nombre'],  // Agregar todo lo que devuelva la consulta
                'mensaje'=>'Datos encontrados',
                'estado'='1'
            );
        } else {    
            if (is_null($r)) {    # No encontro nada
                $r=$this->agregarRegistro();
                $retorno = array(
                'mensaje'=>'DNI no encontrado',
                'estado'='0'
            );
        } else {    
            
            }
        }
        return $retorno;
    }
    public function agregarRegistro(){

    }
    public function sincronizarDatosCSV(){
        
    }
}
