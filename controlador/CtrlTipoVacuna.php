<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';

require_once MOD . DIRECTORY_SEPARATOR . 'TipoVacuna.php';

/*
* Clase CtrlTipoVacuna
*/
class CtrlTipoVacuna extends Controlador {

    public function index(){
        # Mostramos los datos
        $tipoVacuna = new TipoVacuna();
        $datosModelo = $tipoVacuna->leer();
        $datos = array(
                'titulo'=>'Tipo Vacunas',
                'encabezado'=>'Listado de Tipos de Vacunas',
                'datos'=>$datosModelo,
            );
        $this->mostrarVista('tipovacuna/mostrar.php',$datos);
    }
    public function eliminar(){
        if (isset($_REQUEST['id'])) {
            $tipoVacuna = new TipoVacuna($_REQUEST['id']);
            $tipoVacuna->eliminar();
            $this->index();
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
    public function guardarNuevo(){
        $tipoVacuna = new TipoVacuna (
                $_POST["id"],
                $_POST["tipo"],
                );
        $tipoVacuna->nuevo();

        $this->index();
    }
    public function guardarEditar(){
        $tipoVacuna = new TipoVacuna (
                $_POST["id"],    #El id que enviamos
                $_POST["tipo"],
                );
        $tipoVacuna->editar();

        $this->index();
    }
    public function nuevo(){
        #Mostramos el Formulario de Nuevo
        $datos=array(
            'encabezado'=>'Nuevo Tipo de Vacuna'
            );
         $this->mostrarVista('tipovacuna/frmNuevo.php',$datos);
    }
    public function editar(){
        #Mostramos el Formulario de Editar
        if (isset($_REQUEST['id'])) {
            $tipoVacuna = new TipoVacuna($_REQUEST['id']);
            $tipoVacuna->leer(false);
            $datos = array(
                'encabezado'=>'Editando Tipo de Vacuna: '. $_REQUEST['id'],
                'tipoVacuna'=>$tipoVacuna, 
               );
            $this->mostrarVista('tipovacuna/frmEditar.php',$datos);
        } else {
            echo "...El Id a Editar es requerido";
        }
        
    }
}