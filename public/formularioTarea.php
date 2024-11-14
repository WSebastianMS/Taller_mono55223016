<?php
require '../models/db/database.php';
require '../models/queries/tareasQuery.php';
require '../models/entity/tarea.php';
require '../models/entity/empleado.php';
require '../models/entity/estado.php';
require '../models/entity/prioridad.php';
require '../controllers/tareasController.php';

use App\controllers\TareasController;

$titulo = empty($_GET['cod']) ? 'Crear tarea' : 'Modificar tarea';
$tareaController = new TareasController();
$tarea = new \App\models\entity\Tarea();
$titulotarea = '';
$descripcion = '';
$observaciones = '';
$empleados = $tareaController->getAllEmpleados();
$estados = $tareaController->getAllEstados();
$prioridades = $tareaController->getAllPrioridades();

if (!empty($_GET['cod'])) {
    $tarea = $tareaController->getTarea($_GET['cod']);
    $titulotarea = $tarea->get('titulo');
    $descripcion = $tarea->get('descripcion');;
    $observaciones = $tarea->get('observaciones');;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/modales.css">
    <title><?php echo $titulo; ?></title>
</head>
<body>
    <h1><?php echo $titulo; ?></h1>
    <section>
        <form action="confirmarTarea.php" method="post">
            <?php 
            if (!empty($_GET['cod'])){
                echo '<input type="hidden" name="cod" value="'.$_GET['cod'].'">';
            }
            ?>
            <div>
                <label>Título:</label>
                <input type="text" name="titulo" value="<?php echo $titulotarea ?>" required>
            </div>

            <div>
                <label>Descripción:</label>
                <textarea name="descripcion" required><?php echo $descripcion ?></textarea>
            </div>

            <div>
                <label>Empleado Responsable:</label>
                <select name="idEmpleado" required>
                    <?php foreach ($empleados as $empleado): ?>
                        <option value="<?php echo $empleado->get('id'); ?>" 
                            <?php echo $empleado->get('id') == $tarea->get('idEmpleado') ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($empleado->get('nombre')); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label>Creador de la tarea:</label>
                <select name="creadorTarea" required>
                    <?php foreach ($empleados as $empleado): ?>
                        <option value="<?php echo $empleado->get('id'); ?>" 
                            <?php echo $empleado->get('id') == $tarea->get('creadorTarea') ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($empleado->get('nombre')); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label>Estado:</label>
                <select name="idEstado" required>
                    <?php foreach ($estados as $estado): ?>
                        <option value="<?php echo $estado->get('id'); ?>" 
                            <?php echo $estado->get('id') == $tarea->get('idEstado') ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($estado->get('nombre')); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label>Prioridad:</label>
                <select name="idPrioridad" required>
                    <?php foreach ($prioridades as $prioridad): ?>
                        <option value="<?php echo $prioridad->get('id'); ?>" 
                            <?php echo $prioridad->get('id') == $tarea->get('idPrioridad') ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($prioridad->get('nombre')); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label>Fecha Estimada de Finalización:</label>
                <input type="date" name="fechaEstimadaFinalizacion" value="<?php echo $tarea->get('fechaEstimadaFinalizacion'); ?>" required>
            </div>

            <div>
                <label>Observaciones:</label>
                <textarea name="observaciones"><?php echo $observaciones?></textarea>
            </div>

            <div>
                <button type="submit">Guardar</button>
            </div>
        </form>
    </section>
</body>
</html>
