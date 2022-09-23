<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';

require_once MOD . DIRECTORY_SEPARATOR . 'Departamento.php';

/*
* Clase CtrlDepartamento
*/
class CtrlDepartamento extends Controlador {
    
    public function index(){
        # Mostramos los datos
        $departamento = new Departamento();
        $datosDepartamento = $departamento->leer();
        $datos = array(
                'titulo'=>'Departamentos',
                'encabezado'=>'Listado de Departamentos',
                'datos'=>$datosDepartamento,
            );
        $this->mostrarVista('departamento/mostrar.php',$datos);
    }
    public function eliminar(){
        if (isset($_REQUEST['id'])) {
            $departamento = new Departamento($_REQUEST['id']);
            $departamento->eliminar();
            $this->index();
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
    public function guardarNuevo(){
        $departamento = new Departamento (
                $_POST["id"],
                $_POST["nombre"],
                );
        $departamento->nuevo();

        $this->index();
    }
    public function guardarEditar(){
        $departamento = new Departamento (
                $_POST["id"],    #El id que enviamos
                $_POST["nombre"],
                );
        $departamento->editar();

        $this->index();
    }
    public function nuevo(){
        #Mostramos el Formulario de Nuevo
        $datos=array(
            'encabezado'=>'Nuevo Departamento'
            );
         $this->mostrarVista('departamento/frmNuevo.php',$datos);
    }
    public function editar(){
        #Mostramos el Formulario de Editar
        if (isset($_REQUEST['id'])) {
            $departamento = new Departamento($_REQUEST['id']);
            $departamento->leer(false);
            $datos = array(
                'encabezado'=>'Editando Departamento: '. $_REQUEST['id'],
                'departamento'=>$departamento, 
               );
            $this->mostrarVista('departamento/frmEditar.php',$datos);
        } else {
            echo "...El Id a Editar es requerido";
        }
        
    }
}