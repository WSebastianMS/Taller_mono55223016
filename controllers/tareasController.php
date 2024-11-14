<?php
namespace App\controllers;

use App\models\entity\Tarea;
use App\models\entity\Prioridad;
use App\models\entity\Estado;
use App\models\entity\Empleado;

class TareasController {
    
    // Obtener todas las tareas
    function allTareas() {
        return Tarea::all();
    }
    

    // Crear una nueva tarea usando un array de datos
    function saveTarea($datos) {
        $tarea = new Tarea();

        // Establecer las propiedades para la nueva tarea
        $tarea->set('titulo', $datos['titulo']);
        $tarea->set('descripcion', $datos['descripcion']);
        $tarea->set('fechaEstimadaFinalizacion', $datos['fechaEstimadaFinalizacion']);
        $tarea->set('creadorTarea', $datos['creadorTarea']);
        $tarea->set('idEmpleado', $datos['idEmpleado']);
        $tarea->set('idEstado', $datos['idEstado']);
        $tarea->set('idPrioridad', $datos['idPrioridad']);
        $tarea->set('observaciones', $datos['observaciones']);

        // Guardar la nueva tarea
        return $tarea->save();
    }

    // Actualizar una tarea existente usando un array de datos
    function updateTarea($datos) {
        $tarea = new Tarea();

        // Establecer las propiedades, incluyendo el ID de la tarea
        $tarea->set('id', $datos['cod']);
        $tarea->set('titulo', $datos['titulo']);
        $tarea->set('descripcion', $datos['descripcion']);
        $tarea->set('fechaEstimadaFinalizacion', $datos['fechaEstimadaFinalizacion']);
        $tarea->set('creadorTarea', $datos['creadorTarea']);
        $tarea->set('idEmpleado', $datos['idEmpleado']);
        $tarea->set('idEstado', $datos['idEstado']);
        $tarea->set('idPrioridad', $datos['idPrioridad']);
        $tarea->set('observaciones', $datos['observaciones']);

        // Actualizar la tarea existente
        return $tarea->update();
    }

    // Obtener una tarea por ID
    function getTarea($id) {
        return Tarea::find($id);
    }

    // Obtener todos los empleados
    function getAllEmpleados() {
        return Empleado::all();
    }

    // Obtener todos los estados
    function getAllEstados() {
        return Estado::all();
    }

    // Obtener todas las prioridades
    function getAllPrioridades() {
        return Prioridad::all();
    }

    // Eliminar una tarea por ID
    function deleteTarea($id) {
        $tarea = new Tarea();
        $tarea->set('id', $id);
        return $tarea->delete();
    }

    
}
