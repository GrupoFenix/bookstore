<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';

require_once MOD . DIRECTORY_SEPARATOR . 'Semestre.php';

/*
* Clase CtrlSemestre
*/
class CtrlSemestre extends Controlador {

    public function index(){
        # Mostramos los datos
        $semestre = new Semestre();
        $datosModelo = $semestre->leer();
        $datos = array(
                'titulo'=>'Semestres',
                'encabezado'=>'Listado de Semestres',
                'datos'=>$datosModelo,
            );
        $this->mostrarVista('semestre/mostrar.php',$datos);
    }
    public function eliminar(){
        if (isset($_REQUEST['id'])) {
            $semestre = new Semestre($_REQUEST['id']);
            $semestre->eliminar();
            $this->index();
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
    public function guardarNuevo(){
        $semestre = new Semestre (
                $_POST["id"],
                $_POST["semestre"],
                );
        $semestre->nuevo();

        $this->index();
    }
    public function guardarEditar(){
        $semestre = new Semestre (
                $_POST["id"],    #El id que enviamos
                $_POST["semestre"],
                );
        $semestre->editar();

        $this->index();
    }
    public function nuevo(){
        #Mostramos el Formulario de Nuevo
        $datos=array(
            'encabezado'=>'Nuevo Semestre'
            );
         $this->mostrarVista('semestre/frmNuevo.php',$datos);
    }
    public function editar(){
        #Mostramos el Formulario de Editar
        if (isset($_REQUEST['id'])) {
            $semestre = new Semestre($_REQUEST['id']);
            $semestre->leer(false);
            $datos = array(
                'encabezado'=>'Editando Semestre: '. $_REQUEST['id'],
                'semestre'=>$semestre, 
               );
            $this->mostrarVista('semestre/frmEditar.php',$datos);
        } else {
            echo "...El Id a Editar es requerido";
        }
        
    }
}