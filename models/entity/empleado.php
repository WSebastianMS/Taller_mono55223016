<?php
namespace App\models\entity;

use App\models\queries\TareasQuery;
use App\models\db\Database;

class Empleado {
    private $id;
    private $nombre;

    function set($prop, $value) {
        $this->{$prop} = $value;
    }

    function get($prop) {
        return $this->{$prop};
    }

    static function all() {
        $sql = TareasQuery::allEmpleados();
        $db = new Database();
        $result = $db->query($sql);
        $empleados = [];
        while($row = $result->fetch_assoc()) {
            $empleado = new Empleado();
            $empleado->set('id', $row['id']);
            $empleado->set('nombre', $row['nombre']);
            array_push($empleados, $empleado);
        }
        $db->close();
        return $empleados;
    }
}
