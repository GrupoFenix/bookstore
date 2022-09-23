<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Cliente</title>
    <!--CSS only-->
    <link rel="stylesheet" href="recursos/css/bootstrap.min.css" >
    <link rel="stylesheet" href="recursos/icons/bootstrap-icons.css">
</head>
<body>
    <h3><?=$encabezado?></h3>
    <form action="?ctrl=CtrlCliente&accion=guardarNuevo" method="post">
        <div class="row mb-3">
        <div class="col-md-6">
            <label for="inputID" class="form-label">Id:</label>
            <input type="text" class="form-control"
                name="idclientes" value="" id="inputID">
        </div>
        <div class="col-md-6">
            <label for="inputNombres" class="form-label">Nombre de Cliente:</label>
            <input type="text" class="form-control"
                name="nombres" value="" id="inputNombres">
        </div>
        <div class="col-md-6">
            <label for="inputApellidos" class="form-label">Apellido:</label>
            <input type="text" class="form-control"
                name="apellidos" value="" id="inputApellidos">
        </div>
        <div class="col-md-6">
            <label for="inputDireccion" class="form-label">Dirección:</label>
            <input type="text" class="form-control"
                name="direcciones" value="" id="inputDireccion">
        </div>
        <div class="col-md-6">
            <label for="inputTelefonos" class="form-label">Teléfono:</label>
            <input type="text" class="form-control"
                name="telefonos" value="" id="inputTelefonos">
        </div>
        <div class="col-md-6">
            <label for="inputDNI" class="form-label">DNI:</label>
            <input type="text" class="form-control"
                name="dni" value="" id="inputDNI">
        </div>
        <div class="col-md-6">
            <label for="inputRUC" class="form-label">RUC:</label>
            <input type="text" class="form-control"
                name="ruc" value="" id="inputRUC">
        </div>
        <div class="col-md-6">
            <label for="inputCorreoelectronico" class="form-label">Correo Electrónico:</label>
            <input type="text" class="form-control"
                name="correoelectronico" value="" id="inputCorreoelectronico">
        </div>
        <div class="col-md-6">
            <label for="inputcontraseñas" class="form-label">Contraseñas:</label>
            <input type="text" class="form-control"
                name="contraseñas" value="" id="inputcontraseñas">
        </div>
        <div class="col-md-6">
            <label for="inputIdtipos_clientes" class="form-label">Tipo de Cliente:</label>
            <select name="idtipos_clientes" class="form-select" value="" id="inputIdtipos_clientes">
                <?php
                    $tipocliente = $clientes->getTipoCliente()->leer();
                    foreach ($tipocliente as $tp) { ?>
                    <option value="<?=$tp["idtipos_clientes"]?>"><?=$tp["tipocliente"]?></option>
                    <?php } ?>
            </select>
        </div>
        <div class="col-md-6">
            <label for="inputidestado" class="form-label">Estado de Cuenta:</label>
            <select name="idestado" class="form-select" value="" id="inputidestado">
                <?php
                    $estado = $clientes->getEstado()->leer();
                    foreach ($estado as $e) { ?>
                    <option value="<?=$e["idestado"]?>"><?=$e["estado"]?></option>
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
