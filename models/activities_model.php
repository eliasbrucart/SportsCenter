<?php

require_once "connection.php";

class ActivitiesModel{
    static public function UploadActivity($table, $nameActivity){
        $stmt = Connection::Connect()->prepare("INSERT INTO $table(name) VALUES(:name)");

        $stmt->bindParam(":name", $nameActivity, PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    static public function ShowActivity($table, $item, $value){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table WHERE $item=:$item");

        $stmt->bindParam(":".$item, $value, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;
    }

    static public function GetAllActivities($table){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }

    static public function EditActivity($table, $data){
        $stmt = Connection::Connect()->prepare("UPDATE $table SET name = :name WHERE id = :id");

        $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
        $stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    static public function DeleteActivity($table, $idActivityToDelete){
        $stmt = Connection::Connect()->prepare("DELETE FROM $table WHERE id = :id");

        $stmt->bindParam(":id", $idActivityToDelete, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        } else{
            return "error";
        }

        $stmt->close();

        $stmt = null;
    }
}

?>