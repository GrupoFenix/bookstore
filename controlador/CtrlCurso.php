<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';

require_once MOD . DIRECTORY_SEPARATOR . 'Curso.php';

/*
* Clase CtrlCurso
*/
class CtrlCurso extends Controlador {
    
    public function index(){
        # Mostramos los datos
        $curso = new Curso();
        $datosCurso = $curso->mostrar();
        $datos = array(
                'titulo'=>'Cursos',
                'encabezado'=>'Listado de Cursos',
                'datos'=>$datosCurso,
            );
        $this->mostrarVista('curso/index.php',$datos);
    }
    public function eliminar(){
        if (isset($_REQUEST['id'])) {
            $curso = new Curso($_REQUEST['id']);
            $curso->eliminar();
            $this->index();
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
    public function guardarNuevo(){
        $curso = new Curso (
                $_POST["id"],
                $_POST["nombre"],
                $_POST["creditos"],
                $_POST["duracion"]
                );
        $curso->nuevo();

        $this->index();
    }
    public function guardarEditar(){
       // var_dump($_REQUEST);
        $curso = new Curso (
                $_POST["id"],    #El id que enviamos
                $_POST["nombre"],
                $_POST["creditos"],
                $_POST["duracion"]
                );
        $curso->editar();

        $this->index();
    }
    public function nuevo(){
        #Mostramos el Formulario de Nuevo
        $datos=array(
            'encabezado'=>'Nuevo Curso'
            );
         $this->mostrarVista('curso/frmNuevo.php',$datos);
    }
    public function editar(){
        #Mostramos el Formulario de Editar
        if (isset($_REQUEST['id'])) {
            $curso = new Curso($_REQUEST['id']);
            $datosCurso = $curso->mostrar();
            $datos = array(
                'encabezado'=>'Editando Curso: '. $_REQUEST['id'],
                'datos'=>$datosCurso, 
               );
            $this->mostrarVista('curso/frmEditar.php',$datos);
        } else 
            echo "...El Id a EDITAR es requerido";
    }
}