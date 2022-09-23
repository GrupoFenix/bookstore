
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <!--CSS ONLY-->
    <link rel="stylesheet" href="recursos/css/bootstrap.min.css" >
    <link rel="stylesheet" href="recursos/icons/bootstrap-icons.css">
</head>
<body>
    <h3><?=$encabezado?></h3>
    <form action="?ctrl=CtrlCliente&accion=guardarEditar" method="post">
        <div class="row mb-3">
        <div class="col-md-6">
            <label for="inputID" class="form-label">Id:</label>
            <input type="text" class="form-control"
                name="idclientes" value="<?=$clientes->getId()?>" id="inputID">
        </div>
        <div class="col-md-6">
            <label for="inputNombres" class="form-label">Nombre de Cliente:</label>
            <input type="text" class="form-control"
                name="nombres" value="<?=$clientes->getNombre()?>" id="inputNombres">
        </div>
        <div class="col-md-6">
            <label for="inputApellidos" class="form-label">Apellido:</label>
            <input type="text" class="form-control"
                name="apellidos" value="<?=$clientes->getApellido()?>" id="inputApellidos">
        </div>
        <div class="col-md-6">
            <label for="inputDireccion" class="form-label">Dirección:</label>
            <input type="text" class="form-control"
                name="direcciones" value="<?=$clientes->getDireccion()?>" id="inputDireccion">
        </div>
        <div class="col-md-6">
            <label for="inputTelefonos" class="form-label">Teléfono:</label>
            <input type="text" class="form-control"
                name="telefonos" value="<?=$clientes->getTelefono()?>" id="inputTelefonos">
        </div>
        <div class="col-md-6">
            <label for="inputDNI" class="form-label">DNI:</label>
            <input type="text" class="form-control"
                name="dni" value="<?=$clientes->getDNI()?>" id="inputDNI">
        </div>
        <div class="col-md-6">
            <label for="inputRUC" class="form-label">RUC:</label>
            <input type="text" class="form-control"
                name="ruc" value="<?=$clientes->getRUC()?>" id="inputRUC">
        </div>
        <div class="col-md-6">
            <label for="inputCorreoelectronico" class="form-label">Correo Electrónico:</label>
            <input type="text" class="form-control"
                name="correoelectronico" value="<?=$clientes->getCorreoElectronico()?>" id="inputCorreoelectronico">
        </div>
        <div class="col-md-6">
            <label for="inputcontraseñas" class="form-label">Contraseña:</label>
            <input type="password" class="form-control"
                name="contraseñas" value="<?=$clientes->getContraseña()?>" id="inputcontraseñas">
        </div>
        
        <div class="col-md-6">
            <label for="inputid_tipos_clientes" class="form-label">Tipo de Cliente:</label>
            <select name="idtipos_clientes" class="form-select" value="" id="inputid_tipos_clientes">
                <?php
                    $tipoclientes = $clientes->getTipoCliente()->leer();
                    $tipocliente = $clientes->getTipoCliente()->getId();
                    foreach ($tipoclientes as $tp) { 
                        if ($tp["idtipos_clientes"]==$tipocliente)
                            $seleccionado="selected";
                        else
                            $seleccionado="";
                ?>
            <option <?=$seleccionado?>
            value="<?=$tp["idtipos_clientes"]?>"><?=$tp["tipocliente"]?></option>
        <?php } ?>
    </select>
        </div>
            <div class="col-md-6">
                    <label for="inputidestado" class="form-label">Estado de Cuenta:</label>
                    <select name="idestado" class="form-select" value="" id="inputidestado">
                        <?php
                            $estados = $clientes->getEstado()->leer();
                            $estado = $clientes->getEstado()->getId();
                            foreach ($estados as $e) { 
                                if ($e["idestado"]==$estado)
                                    $seleccionado="selected";
                                else
                                    $seleccionado="";
                        ?>
                    <option <?=$seleccionado?>
                    value="<?=$e["idestado"]?>"><?=$e["estado"]?></option>
                <?php } ?>
            </select>
            </div>
        </div>

    <div class="col-md-3">
    <button type="submit" class="form-control btn btn-primary">
        <i class="bi bi-save2"></i> Guardar</button>
    </div>
    </form>
    <br><a href="?ctrl=CtrlCliente" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</body>
</html>   
