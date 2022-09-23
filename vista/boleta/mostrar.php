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
    <a href="?ctrl=CtrlBoleta&accion=nuevo" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> 
        Insertar Nueva Boleta</a>
    <br><br>
    <table class="table table-striped" style="zoom: 70%;">
        <tr>
            <th>Id</th>
            <th>Numero</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>IGV</th>
            <th>Nombre de Cliente</th>
            <th>Operaciones</th>
        </tr>

    <?php 
    if (is_array($datos))
    foreach ($datos as $b) { ?>
        <tr>
            <td><?=$b["idboletas"]?></td>
            <td><?=$b["numero"]?></td>
            <td><?=$b["fecha"]?></td>
            <td><?=$b["total"]?></td>
            <td><?=$b["igv"]?></td>
             <td><?=$b["nombres"]?></td>
            <td>
                <a href="?ctrl=CtrlBoleta&accion=editar&idboletas=<?=$b["idboletas"]?>">
                    <i class="bi bi-pencil-square"></i> Editar </a>
                / 
                <a href="?ctrl=CtrlBoleta&accion=eliminar&idboletas=<?=$b["idboletas"]?>">
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