<?php

namespace App\models\entity;

use App\models\queries\TareasQuery;
use App\models\db\Database;

class Tarea
{
    private $id;
    private $titulo;
    private $descripcion;
    private $fechaCreacion;
    private $fechaActualizacion;
    private $fechaEstimadaFinalizacion;
    private $fechaFinalizacion;
    private $creadorTarea;
    private $idEmpleado;
    private $idEstado;
    private $idPrioridad;
    private $observaciones;

    function set($prop, $value)
    {
        $this->{$prop} = $value;
    }

    function get($prop)
    {
        return $this->{$prop};
    }

    static function all()
    {
        $sql = TareasQuery::all();
        $db = new Database();
        $result = $db->query($sql);
        $tareas = [];
        while ($row = $result->fetch_assoc()) {
            $tarea = new Tarea();
            $tarea->set('id', $row['id']);
            $tarea->set('titulo', $row['titulo']);
            $tarea->set('descripcion', $row['descripcion']);
            $tarea->set('fechaCreacion', $row['created_at']);
            $tarea->set('fechaActualizacion', $row['updated_at']);
            $tarea->set('fechaEstimadaFinalizacion', $row['fechaEstimadaFinalizacion']);
            $tarea->set('fechaFinalizacion', $row['fechaFinalizacion']);
            $tarea->set('creadorTarea', $row['creador']);
            $tarea->set('responsable', $row['responsable']);
            $tarea->set('estado', $row['estado']);
            $tarea->set('prioridad', $row['prioridad']);
            $tarea->set('observaciones', $row['observaciones']);
            array_push($tareas, $tarea);
        }
        $db->close();
        return $tareas;
    }



    function save(){
        $sql = TareasQuery::insert($this);
        $db = new Database();
        $result = $db->query($sql);
        $db->close();
        return $result;
    }

    static function find($id){
        $sql = TareasQuery::whereId($id);
        $db = new Database();
        $result = $db->query($sql);
        $tarea = new Tarea();
        while($row = $result->fetch_assoc()){
            $tarea->set('id', $row['id']);
            $tarea->set('titulo', $row['titulo']);
            $tarea->set('descripcion', $row['descripcion']);
            $tarea->set('fechaCreacion', $row['created_at']);
            $tarea->set('fechaActualizacion', $row['updated_at']);
            $tarea->set('fechaEstimadaFinalizacion', $row['fechaEstimadaFinalizacion']);
            $tarea->set('creadorTarea', $row['creadorTarea']);
            $tarea->set('idEmpleado', $row['idEmpleado']);
            $tarea->set('idEstado', $row['idEstado']);
            $tarea->set('idPrioridad', $row['idPrioridad']);
            $tarea->set('observaciones', $row['observaciones']);
        }
        $db->close();
        return $tarea;
    }

    function update(){
        $sql = TareasQuery::update($this);
        $db = new Database();
        $result = $db->query($sql);
        $db->close();
        return $result;
    }

    function delete()
    {
        $id = $this->get('id');
        $sql = TareasQuery::delete($id);
        $db = new Database();
        $result = $db->query($sql);
        $db->close();
        return $result;
    }
    
    
}
