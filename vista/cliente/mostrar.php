<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$titulo?></title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

</head>
<body>
    <a href="?ctrl=CtrlCliente&accion=nuevo" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> 
        Insertar Nuevo Cliente</a>
    <br><br>
    <table class="table table-striped" style="zoom: 70%;">
        <tr>
            <th>Id</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Direcciones</th>
            <th>Telefonos</th>
            <th>DNI</th>
            <th>RUC</th>
            <th>Correo Electronico</th>
            <th>Contraseñas</th>
            <th>Tipo de Cliente</th>
            <th>Estado de Cuenta</th>
            <th>Operaciones</th>
        </tr>

    <?php 
    if (is_array($datos))
    foreach ($datos as $c) { ?>
        <tr>
            <td><?=$c["idclientes"]?></td>
            <td><?=$c["nombres"]?></td>
            <td><?=$c["apellidos"]?></td>
            <td><?=$c["direcciones"]?></td>
            <td><?=$c["telefonos"]?></td>
            <td><?=$c["dni"]?></td>
            <td><?=$c["ruc"]?></td>
            <td><?=$c["correoelectronico"]?></td>
            <td><?=$c["contraseñas"]?></td>
             <td><?=$c["tipocliente"]?></td>
             <td><?=$c["estado"]?></td>
            <td>
                <a href="?ctrl=CtrlCliente&accion=editar&idclientes=<?=$c["idclientes"]?>">
                    <i class="bi bi-pencil-square"></i> Editar </a>
                / 
                <a href="?ctrl=CtrlCliente&accion=eliminar&idclientes=<?=$c["idclientes"]?>">
                    <i class="bi bi-trash"></i> Eliminar </a>
            </td>
        </tr>
    <?php }    ?>
    </table>

    <br><a href="?" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</body>
</html>