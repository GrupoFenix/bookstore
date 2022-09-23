<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD . DIRECTORY_SEPARATOR . 'TipoCliente.php';
/*
* Clase CtrlTipoCliente
*/
class CtrlTipoCliente extends Controlador {

    public function index(){
        # Mostramos los datos
        $tipocliente = new TipoCliente();
        $datosTipoCliente = $tipocliente->leer();
        /*$datos = array(
                'titulo'=>'Tipos de Cliente',
                'encabezado'=>'Listado de Tipos de Cliente',
                'datos'=>$datosTipoCliente,
            );
        $this->mostrarVista('tipocliente/mostrar.php',$datos);*/
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
                'datos'=>$datosTipoCliente,
            );

        $datos = array(
            'titulo'=>'Listado de Tipos de Cliente',
            'contenido'=>Vista::mostrar('tipocliente/mostrar.php',$datos1,true),
            'menu'=>$menu
        );
        
        $this->mostrarVista('template.php',$datos);
    }

    public function listadoJSON(){
        # Mostramos los datos
        $tipocliente = new TipoCliente();
        $datosTipoCliente = $tipocliente->leer();
        echo json_encode ($datosTipoCliente,JSON_UNESCAPED_UNICODE); exit();
    }
    public function eliminar(){
        if (isset($_REQUEST['idtipos_clientes'])) {
            $tipocliente = new TipoCliente($_REQUEST['idtipos_clientes']);
            $tipocliente->eliminar();
            $this->index();
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
    public function guardarNuevo(){
        $tipocliente = new TipoCliente (
                $_POST["idtipos_clientes"],
                $_POST["tipocliente"],
                );
        $tipocliente->nuevo();
        $this->index();
    }
    public function guardarEditar(){
        //var_dump($_REQUEST);
        $tipocliente = new TipoCliente (
                $_POST["idtipos_clientes"], #El id que enviamos
                $_POST["tipocliente"],
                );
        $tipocliente->editar();
        $this->index();
        //var_dump($sql);
    }   
    public function nuevo(){
        #Mostramos el Formulario de Nuevo
        $datos=array(
            'encabezado'=>'Nuevo Tipo de Cliente'
            );
        $this->mostrarVista('tipocliente/frmNuevo.php',$datos);
    }
    public function editar(){
        #Mostramos el Formulario de Editar
        if (isset($_REQUEST['idtipos_clientes'])) {
            $tipocliente = new TipoCliente($_REQUEST['idtipos_clientes']);
            $tipocliente->leer(false);
            $datos = array(
                'encabezado'=>'Editando Tipos de Clientes: '. $_REQUEST['idtipos_clientes'],
                'tipocliente'=>$tipocliente, 
                );
            $this->mostrarVista('tipocliente/frmEditar.php',$datos);
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
}