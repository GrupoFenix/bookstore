<!DOCTYPE html>
<html lang="en">
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
    <h1><?=$encabezado?></h1>
    <a href="?ctrl=CtrlCurso&accion=nuevo" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> 
        Insertar Nuevo Curso</a>
    <br><br>
    <table class="table table-striped">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Créditos</th>
            <th>Duración</th>
            <th>Operaciones</th>
        </tr>

    <?php 
    foreach ($datos as $c) { ?>
        <tr>
            <td><?=$c["id"]?></td>
            <td><?=$c["nombre"]?></td>
            <td><?=$c["creditos"]?></td>
            <td><?=$c["duracion"]?></td>
            <td>
                <a href="?ctrl=CtrlCurso&accion=editar&id=<?=$c["id"]?>">
                    <i class="bi bi-pencil-square"></i> Editar </a>
                / 
                <a href="?ctrl=CtrlCurso&accion=eliminar&id=<?=$c["id"]?>">
                    <i class="bi bi-trash"></i> Eliminar </a>
            </td>
        </tr>
    <?php }    ?>
    </table>

    <br><a href="?ctrl=CtrlCurso" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</body>
</html>