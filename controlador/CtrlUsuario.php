<?php
// Si la sesión no está iniciada, iníciala
if (!isset($_SESSION)) 
    session_start();
// Si no existe nadie logeado en la sesion, mándalo a logearse
if (!isset($_SESSION["logeado"])) {
    header("location: ?CtrlUsuario&accion=login");
    exit;
}
// Si la sesión existe, rescata y asigna los valores 
if (isset($_SESSION)) {
    $id         = $_SESSION["id"];
    $usuario   = $_SESSION["usuario"];
}

require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';

require_once MOD . DIRECTORY_SEPARATOR . 'Usuario.php';

/*
* Clase CtrlUsuario
*/
class CtrlUsuario extends Controlador {
    
    public function index(){
        # Mostramos los datos
        $obj = new Usuario();
        $datosobj = $obj->leer();
        $datos = array(
                'titulo'=>'Usuarios',
                'encabezado'=>'Listado de Usuarios',
                'datos'=>$datosobj,
            );
        $this->mostrarVista('usuario/mostrar.php',$datos);
    }
    public function eliminar(){
        if (isset($_REQUEST['id'])) {
            $obj = new Usuario($_REQUEST['id']);
            $obj->eliminar();
            $this->index();
        } else 
            echo "...El Id a ELIMINAR es requerido";
    }
    public function guardarNuevo(){
        $obj = new Usuario (
                $_POST["id"],
                $_POST["nombre"],
                $_POST["sigla"],
                $_POST["idturno"],
                );
        $obj->nuevo();
        $this->index();
    }
    public function guardarEditar(){
        $obj = new Usuario (
                $_POST["id"],    #El id que enviamos
                $_POST["nombre"],
                $_POST["sigla"],
                $_POST["idturno"],
                );
        $obj->editar();

        $this->index();
    }
    public function nuevo(){
        $obj = new Usuario();
        #Mostramos el Formulario de Nuevo
        $datos=array(
            'encabezado'=>'Nuevo carrera',
            'carrera'=>$obj  #Enviamos el OBJETO
            );
         $this->mostrarVista('usuario/frmNuevo.php',$datos);
    }
    public function editar(){
        #Mostramos el Formulario de Editar
        if (isset($_REQUEST['id'])) {
            $obj = new Usuario($_REQUEST['id']);
            $obj->leer(false);
            $datos = array(
                'encabezado'=>'Editando Usuario: '. $_REQUEST['id'],
                'carrera'=>$obj, 
               );
            $this->mostrarVista('usuario/frmEditar.php',$datos);
        } else 
            echo "...El Id a EDITAR es requerido";
    }
    public function mostrarPorTurno(){
        if (isset($_REQUEST['turno'])) {
            $obj = new Usuario();
            $datosobj = $obj->consultaPorTurno($_REQUEST['turno']);
            var_dump($datosobj);
            # echo json_encode($datoscarrera);
        }
    }
    public function validarLogin(){
        if (!isset($_SESSION["logeado"])) {
            header("location: ?ctrl=CtrlUsuario&accion=login");
            exit;
        } else {
            header("location: ?ctrl=CtrlPrincipal");
            exit;
        }
    }
    public function login(){
        $datos = array(
                
                );
        $this->mostrarVista('login/frmLogin.php',$datos);
    }
}