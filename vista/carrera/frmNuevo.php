<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Carrera</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="recursos/css/bootstrap.min.css" >
    <link rel="stylesheet" href="recursos/icons/bootstrap-icons.css">   
</head>
<body>
    <h3><?=$encabezado?></h3>
    <form action="?ctrl=CtrlCarrera&accion=guardarNuevo" method="post">
        <div class="row mb-3">
        <div class="col-md-6">
            <label for="inputID" class="form-label">Id:</label>
            <input type="text" class="form-control"
                name="id" value="" id="inputID">
        </div>
        <div class="col-md-6">
            <label for="inputNombre" class="form-label">Carrera:</label>
            <input type="text" class="form-control"
                name="nombre" value="" id="inputNombre">
        </div>
        <div class="col-md-6">
            <label for="inputSigla" class="form-label">Sigla:</label>
            <input type="text" class="form-control"
                name="sigla" value="" id="inputSigla">
        </div>
        <div class="col-md-6">
            <label for="inputIdTurno" class="form-label">Turno:</label>
            <select name="idturno" class="form-select" value="" id="inputIdTurno">
                <?php 
                    $turnos = $carrera->getTurno()->leer();
                    foreach ($turnos as $t) { ?>
                    <option value="<?=$t["idturnos"]?>"><?=$t["turno"]?></option>
                <?php } ?>
            </select>
        </div>
        </div>
        <div class="col-md-3">
        <button type="submit" class="form-control btn btn-primary">
            <i class="bi bi-save2"></i> Guardar</button>
        </div>
    </form>
    <br><a href="?ctrl=CtrlCarrera" class="btn btn-primary">
        <i class="bi bi-arrow-90deg-left"></i>
        Retornar</a>
</body>
</html>