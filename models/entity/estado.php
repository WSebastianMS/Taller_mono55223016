<?php
namespace App\models\entity;

use App\models\queries\TareasQuery;
use App\models\db\Database;

class Estado {
    private $id;
    private $nombre;

    function set($prop, $value) {
        $this->{$prop} = $value;
    }

    function get($prop) {
        return $this->{$prop};
    }

    static function all() {
        $sql = TareasQuery::allEstados();
        $db = new Database();
        $result = $db->query($sql);
        $estados = [];
        while($row = $result->fetch_assoc()) {
            $estado = new Empleado();
            $estado->set('id', $row['id']);
            $estado->set('nombre', $row['nombre']);
            array_push($estados, $estado);
        }
        $db->close();
        return $estados;
    }
}
