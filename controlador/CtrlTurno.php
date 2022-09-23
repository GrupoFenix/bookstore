<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';

require_once MOD . DIRECTORY_SEPARATOR . 'Turno.php';

/*
* Clase CtrlTurno
*/
class CtrlTurno extends Controlador {
    
    public function index(){
        # Mostramos los datos
        $turno = new Turno();
        $datosTurno = $turno->leer();
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
            'CtrlTurno'=>'Turnos',
            'CtrlCarrera'=>'Carreras Profesionales',
            'CtrlTipoPersona'=>'Tipos de Persona',
            'CtrlSemestre'=>'Semestres Académicos',
            'CtrlDepartamento'=>'Departamentos',
            'CtrlTipoVacuna'=>'Tipos de Vacunas',
            'CtrlPersona'=>'Personas (Estudiantes,...)',
            'CtrlVacuna'=>'Vacunas',
            );

        $datos1 = array(
                'datos'=>$datosTurno,
            );

        $datos = array(
            'titulo'=>'Listado de Turnos',
            'contenido'=>Vista::mostrar('turno/mostrar.php',$datos1,true),
            'menu'=>$menu
        );
        
        $this->mostrarVista('template.php',$datos);


        
    }
    public function listadoJSON(){
        # Mostramos los datos
        $turno = new Turno();
        $datosTurno = $turno->leer();
        echo json_encode ($datosTurno,JSON_UNESCAPED_UNICODE); exit();
    }
    public function eliminar(){
        if (isset($_REQUEST['id'])) {
            $turno = new Turno($_REQUEST['id']);
            $turno->eliminar();
            $this->index();
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
    public function guardarNuevo(){
        $turno = new Turno (
                $_POST["id"],
                $_POST["turno"],
                );
        $turno->nuevo();

        $this->index();
    }
    public function guardarEditar(){
        $turno = new Turno (
                $_POST["id"],    #El id que enviamos
                $_POST["turno"],
                );
        $turno->editar();

        $this->index();
    }
    public function nuevo(){
        #Mostramos el Formulario de Nuevo
        $datos=array(
            'encabezado'=>'Nuevo Turno'
            );
         $this->mostrarVista('turno/frmNuevo.php',$datos);
    }
    public function editar(){
        #Mostramos el Formulario de Editar
        if (isset($_REQUEST['id'])) {
            $turno = new Turno($_REQUEST['id']);
            $turno->leer(false);
            $datos = array(
                'encabezado'=>'Editando Turno: '. $_REQUEST['id'],
                'turno'=>$turno, 
               );
            $this->mostrarVista('turno/frmEditar.php',$datos);
        } else {
            echo "...El Id a Editar es requerido";
        }
        
    }
}