<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editando Curso</title>
</head>
<body>
    <h3><?=$encabezado?></h3>
    <form action="?ctrl=CtrlCurso&accion=guardarEditar" method="post">
        id : <input type="text" readonly="readonly" 
            name="id" value="<?=$datos[0]["id"]?>"><br>
        nombre: <input type="text" name="nombre" 
            value="<?=$datos[0]["nombre"]?>"><br>
        créditos: <input type="text" name="creditos" 
            value="<?=$datos[0]["creditos"]?>"><br>
        duración: <input type="text" name="duracion" 
            value="<?=$datos[0]["duracion"]?>"> <br>
        <input type="submit" value="Guardar">
    </form>
</body>
</html>