<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD . DIRECTORY_SEPARATOR . 'Comprobante.php';
/*
* Clase CtrlCliente
*/
class CtrlComprobante extends Controlador {
    public function index(){
        # Mostramos los datos
        $comprobante = new Comprobante();
        $datoscomprobante = $comprobante->leer();
        $datos = array(
                'titulo'=>'Comprobantes',
                'encabezado'=>'Listado de Comprobantes',
                'datos'=>$datoscomprobante,
            );
        $this->mostrarVista('comprobante/mostrar.php',$datos);
    }
    public function eliminar(){
        if (isset($_REQUEST['nroComprobante'])) {
            $comprobante = new Comprobante($_REQUEST['nroComprobante']);
            $comprobante->eliminar();
            $this->index();
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
    public function guardarNuevo(){
        $comprobante = new Comprobante (
                $_POST["nroComprobante"],
                $_POST["idCliente"],
                $_POST["idTipoComprobante"],
                $_POST["idMetodoPago"],
                $_POST["fecha"],
                $_POST["subTotal"],
                $_POST["IGV"],
                $_POST["total"],                
                );
        $comprobante->nuevo();
        $this->index();
    }
    public function guardarEditar(){
        //var_dump($_REQUEST);
        $comprobante = new Comprobante (
                $_POST["nroComprobante"],
                $_POST["idCliente"],
                $_POST["idTipoComprobante"],
                $_POST["idMetodoPago"],
                $_POST["fecha"],
                $_POST["subTotal"],
                $_POST["IGV"],
                $_POST["total"],   
                );
        $comprobante->editar();
        $this->index();
    }   
    public function nuevo(){
        $comprobante = new Comprobante();
        #Mostramos el Formulario de Nuevo
        $datos=array(
            'encabezado'=>'Nuevo Comprobante',
            'comprobante'=>$comprobante #enviamos el objeto
            );
        $this->mostrarVista('comprobante/frmNuevo.php',$datos);
    }
    public function editar(){
        #Mostramos el Formulario de Editar
        if (isset($_REQUEST['nroComprobante'])) {
            $comprobante = new Comprobante($_REQUEST['nroComprobante']);
            $comprobante->leer(false);
            $datos = array(
                'encabezado'=>'Editando Comprobante: '. $_REQUEST['nroComprobante'],
                'comprobante'=>$comprobante, 
                );
            $this->mostrarVista('comprobante/frmEditar.php',$datos);
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
}