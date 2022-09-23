<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';

require_once MOD . DIRECTORY_SEPARATOR . 'Vacuna.php';

/*
* Clase CtrlVacuna
*/
class CtrlVacuna extends Controlador {
    
    public function index(){
        # Mostramos los datos
        $vacuna = new Vacuna();
        $datosVacuna = $vacuna->leer();
        $datos = array(
                'titulo'=>'Vacunas',
                'encabezado'=>'Listado de Vacunas',
                'datos'=>$datosVacuna,
            );
        $this->mostrarVista('vacuna/mostrar.php',$datos);
    }
    public function eliminar(){
        if (isset($_REQUEST['id'])) {
            $vacuna = new Vacuna($_REQUEST['id']);
            $vacuna->eliminar();
            $this->index();
        } else 
            echo "...El Id a ELIMINAR es requerido";
    }
    public function guardarNuevo(){
        $vacuna = new Vacuna (
                $_POST["id"],
                $_POST["fecha"],
                $_POST["lugar"],
                $_POST["idtiposvacunas"],
                $_POST["iddepartamentos"],
                $_POST["idpersonas"],
                );
        $vacuna->nuevo();
        $this->index();
    }
    public function guardarEditar(){
        $vacuna = new Vacuna (
                $_POST["id"],
                $_POST["fecha"],
                $_POST["lugar"],
                $_POST["idtiposvacunas"],
                $_POST["iddepartamentos"],
                $_POST["idpersonas"],
                );
        $vacuna->editar();

        $this->index();
    }
    public function nuevo(){
        $vacuna = new Vacuna();
        #Mostramos el Formulario de Nuevo
        $datos=array(
            'encabezado'=>'Nuevo Vacuna',
            'Vacuna'=>$vacuna  #Enviamos el OBJETO
            );
         $this->mostrarVista('vacuna/frmNuevo.php',$datos);
    }
    public function editar(){
        #Mostramos el Formulario de Editar
        if (isset($_REQUEST['id'])) {
            $vacuna = new Vacuna($_REQUEST['id']);
            $vacuna->leer(false);
            $datos = array(
                'encabezado'=>'Editando Vacuna: '. $_REQUEST['id'],
                'Vacuna'=>$vacuna, 
               );
            $this->mostrarVista('vacuna/frmEditar.php',$datos);
        } else 
            echo "...El Id a EDITAR es requerido";
    }
}