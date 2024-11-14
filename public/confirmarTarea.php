<?php
require '../models/db/database.php';
require '../models/queries/tareasQuery.php';
require '../models/entity/tarea.php';
require '../models/entity/empleado.php';
require '../models/entity/estado.php';
require '../models/entity/prioridad.php';
require '../controllers/tareasController.php';
require '../views/tareasView.php';

use App\controllers\TareasController;
use App\views\TareasView;


$tareaController = new TareasController();
$tareasView = new TareasView();

$datosFormulario = $_POST;
$msg = $tareasView->getMsgConfirmarTarea($datosFormulario);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar accion</title>
</head>
<body>
    <header>
        <h1>Estado de la operacion</h1>
    </header>
    <section>
        <?php echo $msg; ?>
        <br>
        <a href="/tareasMvc/public/index.php">Volver a inicio</a>
    </section>
</body>
</html>