<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';

require_once MOD . DIRECTORY_SEPARATOR . 'TipoPersona.php';

/*
* Clase CtrlTipoPersona
*/
class CtrlTipoPersona extends Controlador {

    public function index(){
        # Mostramos los datos
        $tipoPersona = new TipoPersona();
        $datosModelo = $tipoPersona->leer();
        $datos = array(
                'titulo'=>'TipoPersonas',
                'encabezado'=>'Listado de Tipos de Personas',
                'datos'=>$datosModelo,
            );
        $this->mostrarVista('tipopersona/mostrar.php',$datos);
    }
    public function eliminar(){
        if (isset($_REQUEST['id'])) {
            $tipoPersona = new TipoPersona($_REQUEST['id']);
            $tipoPersona->eliminar();
            $this->index();
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
    public function guardarNuevo(){
        $tipoPersona = new TipoPersona (
                $_POST["id"],
                $_POST["tipo"],
                );
        $tipoPersona->nuevo();

        $this->index();
    }
    public function guardarEditar(){
        $tipoPersona = new TipoPersona (
                $_POST["id"],    #El id que enviamos
                $_POST["tipo"],
                );
        $tipoPersona->editar();

        $this->index();
    }
    public function nuevo(){
        #Mostramos el Formulario de Nuevo
        $datos=array(
            'encabezado'=>'Nuevo Tipo de Persona'
            );
         $this->mostrarVista('tipopersona/frmNuevo.php',$datos);
    }
    public function editar(){
        #Mostramos el Formulario de Editar
        if (isset($_REQUEST['id'])) {
            $tipoPersona = new TipoPersona($_REQUEST['id']);
            $tipoPersona->leer(false);
            $datos = array(
                'encabezado'=>'Editando Tipo de Persona: '. $_REQUEST['id'],
                'tipoPersona'=>$tipoPersona, 
               );
            $this->mostrarVista('tipopersona/frmEditar.php',$datos);
        } else {
            echo "...El Id a Editar es requerido";
        }
        
    }
}