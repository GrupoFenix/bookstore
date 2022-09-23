<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD . DIRECTORY_SEPARATOR . 'MetodoPago.php';
/*
* Clase CtrlTipoCliente
*/
class CtrlMetodoPago extends Controlador {

    public function index(){
        # Mostramos los datos
        $metodoPago = new MetodoPago();
        $datosMetodoPago = $metodoPago->leer();
        $datos = array(
                'titulo'=>'Métodos de pago',
                'encabezado'=>'Listado de Métodos de Pago',
                'datos'=>$datosMetodoPago,
            );
        $this->mostrarVista('metodopago/mostrar.php',$datos);
    }
    public function eliminar(){
        if (isset($_REQUEST['idMetodoPago'])) {
            $metodoPago = new MetodoPago($_REQUEST['idMetodoPago']);
            $metodoPago->eliminar();
            $this->index();
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
    public function guardarNuevo(){
        $metodoPago = new MetodoPago (
                $_POST["idMetodoPago"],
                $_POST["metodoPago"],
                );
        $metodoPago->nuevo();
        $this->index();
    }
    public function guardarEditar(){
        //var_dump($_REQUEST);
        $metodoPago = new MetodoPago (
                $_POST["idMetodoPago"], #El id que enviamos
                $_POST["metodoPago"],
                );
        $metodoPago->editar();
        $this->index();
        //var_dump($_REQUEST);
    }   
    public function nuevo(){
        #Mostramos el Formulario de Nuevo
        $datos=array(
            'encabezado'=>'Nuevo Metodo de Pago'
            );
        $this->mostrarVista('metodopago/frmNuevo.php',$datos);
    }
    public function editar(){
        #Mostramos el Formulario de Editar
        if (isset($_REQUEST['idMetodoPago'])) {
            $metodoPago = new MetodoPago($_REQUEST['idMetodoPago']);
            $metodoPago->leer(false);
            $datos = array(
                'encabezado'=>'Editando Métodos de Pago: '. $_REQUEST['idMetodoPago'],
                'metodoPago'=>$metodoPago, 
                );
            $this->mostrarVista('metodopago/frmEditar.php',$datos);
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
}