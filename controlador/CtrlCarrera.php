<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';

require_once MOD . DIRECTORY_SEPARATOR . 'Carrera.php';

/*
* Clase CtrlCarrera
*/
class CtrlCarrera extends Controlador {
    
    public function index(){
        # Mostramos los datos
        $carrera = new Carrera();
        $datoscarrera = $carrera->leer();
        $datos = array(
                'titulo'=>'Carreras',
                'encabezado'=>'Listado de Carreras',
                'datos'=>$datoscarrera,
            );
        $this->mostrarVista('carrera/mostrar.php',$datos);
    }
    public function eliminar(){
        if (isset($_REQUEST['id'])) {
            $carrera = new carrera($_REQUEST['id']);
            $carrera->eliminar();
            $this->index();
        } else 
            echo "...El Id a ELIMINAR es requerido";
    }
    public function guardarNuevo(){
        $carrera = new carrera (
                $_POST["id"],
                $_POST["nombre"],
                $_POST["sigla"],
                $_POST["idturno"],
                );
        $carrera->nuevo();
        $this->index();
    }
    public function guardarEditar(){
        $carrera = new carrera (
                $_POST["id"],    #El id que enviamos
                $_POST["nombre"],
                $_POST["sigla"],
                $_POST["idturno"],
                );
        $carrera->editar();

        $this->index();
    }
    public function nuevo(){
        $carrera = new Carrera();
        #Mostramos el Formulario de Nuevo
        $datos=array(
            'encabezado'=>'Nuevo carrera',
            'carrera'=>$carrera  #Enviamos el OBJETO
            );
         $this->mostrarVista('carrera/frmNuevo.php',$datos);
    }
    public function editar(){
        #Mostramos el Formulario de Editar
        if (isset($_REQUEST['id'])) {
            $carrera = new Carrera($_REQUEST['id']);
            $carrera->leer(false);
            $datos = array(
                'encabezado'=>'Editando Carrera: '. $_REQUEST['id'],
                'carrera'=>$carrera, 
               );
            $this->mostrarVista('carrera/frmEditar.php',$datos);
        } else 
            echo "...El Id a EDITAR es requerido";
    }
    public function mostrarPorTurno(){
        if (isset($_REQUEST['turno'])) {
            $carrera = new Carrera();
            $datoscarrera = $carrera->consultaPorTurno($_REQUEST['turno']);
            var_dump($datoscarrera);
            # echo json_encode($datoscarrera);
        }
    }
}