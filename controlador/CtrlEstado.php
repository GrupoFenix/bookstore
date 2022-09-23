<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';

require_once MOD . DIRECTORY_SEPARATOR . 'Estado.php';

/*
* Clase CtrlTurno
*/
class CtrlEstado extends Controlador {
    
    public function index(){
        # Mostramos los datos
        $estado = new Estado();
        $datosestado = $estado->leer();
        # echo json_encode ($datosTurno,JSON_UNESCAPED_UNICODE); exit();
      /*  
        $datos = array(
                'titulo'=>'Turnos',
                'encabezado'=>'Listado de Turnos',
                'datos'=>$datosTurno,
            );
        $this->mostrarVista('turno/mostrar.php',$datos);
*/
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
                'datos'=>$datosestado,
            );

        $datos = array(
            'titulo'=>'Estados de cuenta',
            'contenido'=>Vista::mostrar('estado/mostrar.php',$datos1,true),
            'menu'=>$menu
        );
        
        $this->mostrarVista('template.php',$datos);


        
    }
    public function listadoJSON(){
        # Mostramos los datos
        $estado = new Estado();
        $datosestado = $estado->leer();
        echo json_encode ($datosestado,JSON_UNESCAPED_UNICODE); exit();
    }
    public function eliminar(){
        if (isset($_REQUEST['idestado'])) {
            $estado = new Estado($_REQUEST['idestado']);
            $estado->eliminar();
            $this->index();
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
    public function guardarNuevo(){
        $estado = new Estado (
                $_POST["idestado"],
                $_POST["estado"],
                );
        $estado->nuevo();

        $this->index();
    }
    public function guardarEditar(){
        $estado = new Estado (
                $_POST["idestado"],    #El id que enviamos
                $_POST["estado"],
                );
        $estado->editar();

        $this->index();
    }
    public function nuevo(){
        #Mostramos el Formulario de Nuevo
        $datos=array(
            'encabezado'=>'Nuevo Estado'
            );
         $this->mostrarVista('estado/frmNuevo.php',$datos);
    }
    public function editar(){
        #Mostramos el Formulario de Editar
        if (isset($_REQUEST['idestado'])) {
            $estado = new Estado($_REQUEST['idestado']);
            $estado->leer(false);
            $datos = array(
                'encabezado'=>'Editando Estado: '. $_REQUEST['idestado'],
                'estado'=>$estado, 
               );
            $this->mostrarVista('estado/frmEditar.php',$datos);
        } else {
            echo "...El Id a Editar es requerido";
        }
        
    }
}