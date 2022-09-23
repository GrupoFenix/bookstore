<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Cursos</title>
</head>
<body>
    <h3><?=$encabezado?></h3>
    <form action="?ctrl=CtrlCurso&accion=guardarNuevo" method="post">
        id : <input type="text" name="id" value=""><br>
        nombre: <input type="text" name="nombre" value=""><br>
        créditos: <input type="text" name="creditos" value=""><br>
        duración: <input type="text" name="duracion" value=""> <br>
        <input type="submit" value="Guardar">
    </form>
</body>
</html>