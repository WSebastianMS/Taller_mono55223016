<?php
namespace App\models\entity;

use App\models\queries\TareasQuery;
use App\models\db\Database;

class Prioridad {
    private $id;
    private $nombre;

    function set($prop, $value) {
        $this->{$prop} = $value;
    }

    function get($prop) {
        return $this->{$prop};
    }

    static function all() {
        $sql = TareasQuery::allPrioridades();
        $db = new Database();
        $result = $db->query($sql);
        $prioridades = [];
        while($row = $result->fetch_assoc()) {
            $prioridad = new Empleado();
            $prioridad->set('id', $row['id']);
            $prioridad->set('nombre', $row['nombre']);
            array_push($prioridades, $prioridad);
        }
        $db->close();
        return $prioridades;
    }
}
