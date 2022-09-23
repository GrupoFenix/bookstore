<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';

require_once MOD . DIRECTORY_SEPARATOR . 'Consultas.php';

/*
* Clase CtrlConsulta
*/
class CtrlConsulta extends Controlador {
    
    public function index(){
        $dni = $_GET['dni'];
        $consulta = new Consultas ($dni);
        $respuesta = $consulta->leer();

        echo json_encode ($respuesta);
    }
    public function cargarCSV(){
        
    }
}