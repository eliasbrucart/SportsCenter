<?php

require_once "connection.php";

class TemplateModel{

    public function GetTemplateStyle($table){
        //consulta a la BD

        $stmt = Connection::Connect()->prepare("SELECT * FROM $table");

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;
    }
}

?>