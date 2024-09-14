<?php

require_once "connection.php";

class CuotasModel{
    static public function ShowCuotas($table){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }

    static public function UploadCuota($table, $data){
        $stmt = Connection::Connect()->prepare("INSERT INTO $table(id_activity, name_activity, days, price) VALUES(:id_activity, :name_activity, :days, :price)");

        $stmt->bindParam(":id_activity", $data["id"], PDO::PARAM_INT);
        $stmt->bindParam(":name_activity", $data["name"], PDO::PARAM_STR);
        $stmt->bindParam(":days", $data["days"], PDO::PARAM_STR);
        $stmt->bindParam(":price", $data["price"], PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    static public function ShowCuota($table, $data){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table WHERE id_activity = :id AND days = :days AND price = :price");

        $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
        $stmt->bindParam(":days", $data["days"], PDO::PARAM_STR);
        $stmt->bindParam(":price", $data["price"], PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;
    }

    static public function ShowCuotaByNameAndDays($table, $data){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table WHERE name_activity = :name AND days = :days");

        $stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
        $stmt->bindParam(":days", $data["days"], PDO::PARAM_STR);
        //$stmt->bindParam(":price", $data["price"], PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchColumn(4); //4 es el indice de la columna price de la tabla cuotas

        $stmt->close();

        $stmt = null;
    }

    static public function GetDays($table){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }

    static public function EditCuota($table, $data){
        $stmt = Connection::Connect()->prepare("UPDATE $table SET days = :days, price = :price WHERE id = :id");

        $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
        $stmt->bindParam(":days", $data["days"], PDO::PARAM_STR);
        $stmt->bindParam(":price", $data["price"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    static public function DeleteCuota($table, $idCuotaToDelete){
        $stmt = Connection::Connect()->prepare("DELETE FROM $table WHERE id = :id");

        $stmt->bindParam(":id", $idCuotaToDelete, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        } else{
            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    static public function CheckActivityCuotas($table, $idToCheckCuotas){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table WHERE id_activity = :id");

        $stmt->bindParam(":id", $idToCheckCuotas, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }

    static public function GetCuotaByNameAndDays($table, $activitySelected, $days){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table WHERE name_activity = :name_activity AND days = :days");

        $stmt->bindParam(":name_activity", $activitySelected, PDO::PARAM_STR);
        $stmt->bindParam(":days", $days, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchColumn(4);

        $stmt->close();

        $stmt = null;
    }
}

?>