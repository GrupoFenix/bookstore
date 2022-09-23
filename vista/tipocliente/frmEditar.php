<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editando Tipo de Cliente</title>
    <link rel="stylesheet" href="recursos/css/bootstrap.min.css" >
    <link rel="stylesheet" href="recursos/icons/bootstrap-icons.css">
</head>
<body>
    <h3><?=$encabezado?></h3>
    <form action="?ctrl=CtrlTipoCliente&accion=guardarEditar" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text">Id:</span>
            <input type="text" name="idtipos_clientes" value="<?=$tipocliente->getId()?>"
            class="form-control">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Tipo de Cliente:</span>
            <input type="text" name="tipocliente" value="<?=$tipocliente->getTipoCliente()?>"
            class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
    </form>
    <br><a href="?ctrl=CtrlTipoCliente" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
            Retornar</a>
</body>
</html>