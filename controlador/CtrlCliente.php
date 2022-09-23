<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD . DIRECTORY_SEPARATOR . 'Cliente.php';
/*
* Clase CtrlCliente
*/
class CtrlCliente extends Controlador {
    public function index(){
        # Mostramos los datos
        $clientes = new Cliente();
        $datosclientes = $clientes->leer();
        /*$datos = array(
                'titulo'=>'Clientes',
                'encabezado'=>'Listado de Clientes',
                'datos'=>$datosclientes,
            );
        $this->mostrarVista('cliente/mostrar.php',$datos);*/
        $menu = array(
            'CtrlTipoCliente'=>'Tipos de Cliente',
            'CtrlCliente'=>'Lista de Clientes',
            'CtrlEstado'=>'Estados de cuenta',
            'CtrlBoleta'=>'Registro de Boletas',
            'CtrlDepartamento'=>'Departamentos',
            'CtrlTipoVacuna'=>'Tipos de Vacunas',
            'CtrlPersona'=>'Personas (Estudiantes,...)',
            'CtrlVacuna'=>'Vacunas',
            );

        $datos1 = array(
                'datos'=>$datosclientes,
            );

        $datos = array(
            'titulo'=>'Listado de Clientes',
            'contenido'=>Vista::mostrar('cliente/mostrar.php',$datos1,true),
            'menu'=>$menu
        );
        
        $this->mostrarVista('template.php',$datos);
    }

    public function listadoJSON(){
        # Mostramos los datos
        $clientes = new Cliente();
        $datosclientes = $clientes->leer();
        echo json_encode ($datosclientes,JSON_UNESCAPED_UNICODE); exit();
    }
    public function eliminar(){
        if (isset($_REQUEST['idclientes'])) {
            $clientes = new Cliente($_REQUEST['idclientes']);
            $clientes->eliminar();
            $this->index();
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
    public function guardarNuevo(){
        $clientes = new Cliente (
                $_POST["idclientes"],
                $_POST["idtipos_clientes"],
                $_POST["idestado"],
                $_POST["nombres"],
                $_POST["apellidos"],
                $_POST["direcciones"],
                $_POST["telefonos"],
                $_POST["dni"],
                $_POST["ruc"],
                $_POST["correoelectronico"],  
                $_POST["contraseñas"],              
                );
        $clientes->nuevo();
        $this->index();
    }
    public function guardarEditar(){
        //var_dump($_REQUEST);
        $clientes = new Cliente (
                $_POST["idclientes"],
                $_POST["idtipos_clientes"],
                $_POST["idestado"],
                $_POST["nombres"],
                $_POST["apellidos"],
                $_POST["direcciones"],
                $_POST["telefonos"],
                $_POST["dni"],
                $_POST["ruc"],
                $_POST["correoelectronico"], 
                $_POST["contraseñas"], 
                );
        $clientes->editar();
        $this->index();
    }   
    public function nuevo(){
        $clientes = new Cliente();
        #Mostramos el Formulario de Nuevo
        $datos=array(
            'encabezado'=>'Nuevo Cliente',
            'clientes'=>$clientes #enviamos el objeto
            );
        $this->mostrarVista('cliente/frmNuevo.php',$datos);
    }
    public function editar(){
        #Mostramos el Formulario de Editar
        if (isset($_REQUEST['idclientes'])) {
            $clientes = new Cliente($_REQUEST['idclientes']);
            $clientes->leer(false);
            $datos = array(
                'encabezado'=>'Editando Cliente: '. $_REQUEST['idclientes'],
                'clientes'=>$clientes, 
                );
            $this->mostrarVista('cliente/frmEditar.php',$datos);
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
}