<?php

namespace App\models\queries;

class TareasQuery
{
static function all()
{
    return "SELECT 
                t.id, 
                t.titulo, 
                t.descripcion, 
                t.created_at, 
                t.updated_at, 
                t.fechaEstimadaFinalizacion, 
                t.fechaFinalizacion, 
                c.nombre AS creador, 
                e.nombre AS responsable, 
                p.nombre AS prioridad, 
                s.nombre AS estado,
                t.observaciones
            FROM tareas t
            LEFT JOIN empleados c ON t.creadorTarea = c.id
            LEFT JOIN empleados e ON t.idEmpleado = e.id
            LEFT JOIN prioridades p ON t.idPrioridad = p.id
            LEFT JOIN estados s ON t.idEstado = s.id
            ORDER BY t.idPrioridad ASC, t.fechaEstimadaFinalizacion ASC";
}

        static function allEmpleados() {
        return "SELECT * FROM empleados";
    }

    static function allEstados() {
        return "SELECT * FROM estados";
    }

    static function allPrioridades() {
        return "SELECT * FROM prioridades";
    }
    static function insert($tarea) {
        return "INSERT INTO tareas (titulo, descripcion, fechaEstimadaFinalizacion, creadorTarea, idEmpleado, idEstado, idPrioridad, observaciones, created_at) 
                VALUES ('{$tarea->get('titulo')}', '{$tarea->get('descripcion')}', '{$tarea->get('fechaEstimadaFinalizacion')}', '{$tarea->get('creadorTarea')}', 
                '{$tarea->get('idEmpleado')}', '{$tarea->get('idEstado')}', '{$tarea->get('idPrioridad')}', '{$tarea->get('observaciones')}', NOW())";
    }


    // Obtener una tarea por su ID
    static function whereId($id)
    {
        return "SELECT * FROM tareas WHERE id=$id";
    }

    // Actualizar una tarea existente
    static function update($tarea)
{
    $id = $tarea->get('id');
    $titulo = $tarea->get('titulo');
    $descripcion = $tarea->get('descripcion');
    $fechaEstimacion = $tarea->get('fechaEstimadaFinalizacion');
    $fechaActualizacion = date('Y-m-d H:i:s');
    $creadorTarea = $tarea->get('creadorTarea');
    $idEmpleado = $tarea->get('idEmpleado');
    $idEstado = $tarea->get('idEstado');
    $idPrioridad = $tarea->get('idPrioridad');
    $observaciones = $tarea->get('observaciones');

        if($idEstado != 3){
            return "UPDATE tareas SET 
            titulo = '$titulo',
            descripcion = '$descripcion',
            fechaEstimadaFinalizacion = '$fechaEstimacion',
            creadorTarea = '$creadorTarea',
            idEmpleado = '$idEmpleado',
            idEstado = '$idEstado',
            idPrioridad = '$idPrioridad',
            observaciones = '$observaciones',
            updated_at = NOW()
        WHERE id = $id";
        }else{
            $fechaFinalizacion = $tarea->get('fechaFinalizacion');
            return "UPDATE tareas SET 
            titulo = '$titulo',
            descripcion = '$descripcion',
            fechaEstimadaFinalizacion = '$fechaEstimacion',
            fechaFinalizacion = NOW(),
            creadorTarea = '$creadorTarea',
            idEmpleado = '$idEmpleado',
            idEstado = '$idEstado',
            idPrioridad = '$idPrioridad',
            observaciones = '$observaciones',
            updated_at = NOW()
        WHERE id = $id";
        }
}


    // Eliminar una tarea
    static function delete($id)
    {
        return "DELETE FROM tareas WHERE id=$id";
    }

    // Filtrar tareas por prioridad, fecha y responsable
    static function filter($filtros)
    {
        $where = "WHERE 1=1";
        if (!empty($filtros['prioridad'])) {
            $where .= " AND prioridad = '{$filtros['prioridad']}'";
        }
        if (!empty($filtros['responsable'])) {
            $where .= " AND responsable LIKE '%{$filtros['responsable']}%'";
        }
        if (!empty($filtros['fecha_inicio']) && !empty($filtros['fecha_fin'])) {
            $where .= " AND fecha_estimacion BETWEEN '{$filtros['fecha_inicio']}' AND '{$filtros['fecha_fin']}'";
        }
        return "SELECT * FROM tareas $where ORDER BY prioridad DESC, fecha_estimacion ASC";
    }
}
