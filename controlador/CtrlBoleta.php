<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';

require_once MOD . DIRECTORY_SEPARATOR . 'Boleta.php';

/*
* Clase CtrlCarrera
*/
class CtrlBoleta extends Controlador {
    
    public function index(){
        # Mostramos los datos
        $boleta = new Boleta();
        $datosboleta = $boleta->leer();
        /*$datos = array(
                'titulo'=>'Boletas',
                'encabezado'=>'Listado de Boletas',
                'datos'=>$datosboleta,
            );
        $this->mostrarVista('boleta/mostrar.php',$datos);*/
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
                'datos'=>$datosboleta,
            );

        $datos = array(
            'titulo'=>'Registros de Boleta',
            'contenido'=>Vista::mostrar('boleta/mostrar.php',$datos1,true),
            'menu'=>$menu
        );
        
        $this->mostrarVista('template.php',$datos);  
    }
    public function listadoJSON(){
        # Mostramos los datos
        $boleta = new Boleta();
        $datosboleta = $boleta->leer();
        echo json_encode ($datosboleta,JSON_UNESCAPED_UNICODE); exit();
    }
    public function eliminar(){
        if (isset($_REQUEST['idboletas'])) {
            $boleta = new Boleta($_REQUEST['idboletas']);
            $boleta->eliminar();
            $this->index();
        } else 
            echo "...El Id a ELIMINAR es requerido";
    }
    public function guardarNuevo(){
        $boleta = new Boleta (
                $_POST["idboletas"],
                $_POST["idclientes"],
                $_POST["numero"],
                $_POST["fecha"],
                $_POST["total"],
                $_POST["igv"],
                );
        $boleta->nuevo();
        $this->index();
        
    }
    public function guardarEditar(){
        $boleta = new Boleta (
                $_POST["idboletas"], 
                $_POST["idclientes"],
                $_POST["numero"],
                $_POST["fecha"],
                $_POST["total"],
                $_POST["igv"],
                );
        $boleta->editar();

        $this->index();
    }
    public function nuevo(){
        $boleta = new Boleta();
        #Mostramos el Formulario de Nuevo
        $datos=array(
            'encabezado'=>'Nueva Boleta',
            'boleta'=>$boleta  #Enviamos el OBJETO
            );
         $this->mostrarVista('boleta/frmNuevo.php',$datos);
    }
    public function editar(){
        #Mostramos el Formulario de Editar
        if (isset($_REQUEST['idboletas'])) {
            $boleta = new Boleta($_REQUEST['idboletas']);
            $boleta->leer(false);
            $datos = array(
                'encabezado'=>'Editando Boleta: '. $_REQUEST['idboletas'],
                'boleta'=>$boleta, 
                );
            $this->mostrarVista('boleta/frmEditar.php',$datos);
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
    /*public function mostrarPorTurno(){
        if (isset($_REQUEST['turno'])) {
            $carrera = new Carrera();
            $datoscarrera = $carrera->consultaPorTurno($_REQUEST['turno']);
            var_dump($datoscarrera);
            # echo json_encode($datoscarrera);
        }
    }*/
}