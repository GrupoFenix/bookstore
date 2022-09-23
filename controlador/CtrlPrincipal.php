<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';

/*
* Clase CtrlPrincipal
*/
class CtrlPrincipal extends Controlador {
    
    public function index(){
         $menu = array(
            'CtrlTipoCliente'=>'Tipos de Cliente',
            'CtrlCliente'=>'Lista de Clientes',
            'CtrlEstado'=>'Estados de usuarios',
            'CtrlPedidos'=>'Pedidos',
            'CtrlDepartamento'=>'Departamentos',
            'CtrlTipoVacuna'=>'Tipos de Vacunas',
            'CtrlPersona'=>'Personas (Estudiantes,...)',
            'CtrlVacuna'=>'Vacunas',
            );
        /*$datos = array(
                'encabezado'=> 'Sistema Administración Vacunas',
                'menu'=>$menu
            );
        */
        $datos = array(
            'titulo'=>'Sistema Administración de Bookstore',
            'contenido'=>Vista::mostrar('principal.php','',true),
            'menu'=>$menu
        );
        
        $this->mostrarVista('template.php',$datos);
    }
}