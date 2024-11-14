<?php

namespace App\views;

use App\controllers\TareasController;

class TareasView
{
    private $tareasController;

    function __construct()
    {
        $this->tareasController = new TareasController();
    }
    

    function tablaTareas()
{
    $rows = '';
    $tareas = $this->tareasController->allTareas();
    if (count($tareas) > 0) {
        foreach ($tareas as $tarea) {
            $id = $tarea->get('id');
            $estado = $tarea->get('estado');
            $prioridad = $tarea->get('prioridad');
            $creador = $tarea->get('creadorTarea');
            $responsable = $tarea->get('responsable');
            $fechaEstimadaFinalizacion = $tarea->get('fechaEstimadaFinalizacion');
            $fechaCreacion = $tarea->get('fechaCreacion');
            $fechaActualizacion = $tarea->get('fechaActualizacion'); // Actualizado
            $fechaFinalizacion = $tarea->get('fechaFinalizacion');
            $descripcion = $tarea->get('descripcion');
            $observaciones = $tarea->get('observaciones');
            $claseEstado = ($estado === 'impedimento') ? 'estado-impedimento' : '';

            $rows .= "<tr class='{$claseEstado}'>";
            $rows .= "<td>{$tarea->get('titulo')}</td>";
            $rows .= "<td>{$creador}</td>";
            $rows .= "<td>{$responsable}</td>";
            $rows .= "<td>{$prioridad}</td>";
            $rows .= "<td>{$estado}</td>";
            $rows .= "<td>{$fechaCreacion}</td>";
            $rows .= "<td>{$fechaEstimadaFinalizacion}</td>";
            $rows .= "<td>{$fechaActualizacion}</td>"; // Actualizado
            $rows .= "<td>{$fechaFinalizacion}</td>";
            $rows .= "<td>{$descripcion}</td>";
            $rows .= "<td>{$observaciones}</td>";
            $rows .= "<td><button onclick=\"window.location.href='formularioTarea.php?cod={$id}'\">Modificar</button></td>";
            $rows .= '<td><button onClick="onDeleteTarea(' . $id . ')">Eliminar</button></td>';
            $rows .= '</tr>';
        }
    } else {
        $rows .= '<tr><td colspan="12">No hay tareas registradas</td></tr>';
    }

    $table = '<table>';
    $table .= '<thead><tr><th>Título</th><th>Creador</th><th>Responsable</th><th>Prioridad</th><th>Estado</th><th>Fecha Creación</th><th>Fecha Estimada</th><th>Fecha Modificación</th><th>Fecha Finalización Real</th><th>Descripcion</th><th>Observaciones</th><th>Modificar</th><th>Eliminar</th></tr></thead>';
    $table .= '<tbody>' . $rows . '</tbody>';
    $table .= '</table>';
    return $table;
}




    function getMsgConfirmarTarea($datosFormulario)
    {
        $datosGuardados = empty($datosFormulario['cod'])
            ? $this->tareasController->saveTarea($datosFormulario)
            : $this->tareasController->updateTarea($datosFormulario);
        if ($datosGuardados) {
            return '<P>Tarea asignada correctamente</P>';
        } else {
            return '<P>No se pudo guardar la tarea</P>';
        }
    }

    function getMsgEliminarTarea($id)
    {
        $datoEliminado = $this->tareasController->deleteTarea($id);
        if ($datoEliminado) {
            return '<P>Tarea eliminada</P>';
        } else {
            return '<P>No se pudo eliminar la tarea</P>';
        }
    }
    function tablaTareasPorEstado()
    {
    $estados = ['Pendiente', 'En Proceso', 'Terminada', 'Impedimento'];
    $output = '';

    foreach ($estados as $estado) {
        $output .= "<h2>Tareas - Estado: $estado</h2>";
        $tareas = $this->tareasController->tareasPorEstado($estado);
        $output .= $this->generarTabla($tareas);
    }

    return $output;
}

}

