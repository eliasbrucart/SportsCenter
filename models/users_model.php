<?php

require_once "connection.php";

class UsersModel{
    static public function RegisterUser($table, $data){
        $stmt = Connection::Connect()->prepare("INSERT INTO $table(name, lastname, email, encryptedEmail, password, isSuper, permissions) VALUES(:name, :lastname, :email, :encryptedEmail, :password, :isSuper, :permissions)");

        $stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
        $stmt->bindParam(":lastname", $data["lastName"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
        $stmt->bindParam(":encryptedEmail", $data["encryptedEmail"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
        $stmt->bindParam(":isSuper", $data["isSuper"], PDO::PARAM_STR);
        $stmt->bindParam(":permissions", $data["permissions"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    static public function ShowUser($table, $item, $value){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table WHERE $item=:$item");

        $stmt->bindParam(":".$item, $value, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;
    }

    static public function RegisterCustomer($table, $data){
        $stmt = Connection::Connect()->prepare("INSERT INTO $table(name, lastname, documentNumber, state, amount, registrationDate, expiration, activity, daysOfActivity) VALUES(:name, :lastname, :documentNumber, :state, :amount, :registrationDate, :expiration, :activity, :daysOfActivity)");

        $stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
        $stmt->bindParam(":lastname", $data["lastName"], PDO::PARAM_STR);
        //$stmt->bindParam(":phone", $data["phone"], PDO::PARAM_STR);
        $stmt->bindParam(":documentNumber", $data["document"], PDO::PARAM_INT);
        $stmt->bindParam(":state", $data["state"], PDO::PARAM_STR);
        $stmt->bindParam(":amount", $data["amount"], PDO::PARAM_INT);
        $stmt->bindParam(":registrationDate", $data["registrationDate"], PDO::PARAM_STR);
        $stmt->bindParam(":expiration", $data["expiration"], PDO::PARAM_STR);
        //Descomentar esto si necesitamos type y observations. Agregarlo a la sentencia SQL tambien
        //$stmt->bindParam(":type", $data["type"], PDO::PARAM_STR);
        //$stmt->bindParam(":observations", $data["observations"], PDO::PARAM_STR);
        $stmt->bindParam(":activity", $data["activity"], PDO::PARAM_STR);
        $stmt->bindParam(":daysOfActivity", $data["daysOfActivity"], PDO::PARAM_STR);
        //$stmt->bindParam(":state", $data["state"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();

        $stmt = null;

    }

    static public function ShowCustomer($table, $item, $item2, $value, $value2){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table WHERE $item=:$item AND $item2=:$item2");

        $stmt->bindParam(":".$item, $value, PDO::PARAM_STR);
        $stmt->bindParam(":".$item2, $value2, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;
    }

    static public function ShowCustomerOverloaded($table, $item, $value){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table WHERE $item=:$item");

        $stmt->bindParam(":".$item, $value, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;
    }

    static public function ShowCustomers($table){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }

    static public function GetCustomersActivities($table){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }

    static public function EditCustomer($table, $data){
        $stmt = Connection::Connect()->prepare("UPDATE $table SET name = :name, lastname = :lastname, documentNumber = :documentNumber, amount = :amount, activity = :activity, daysOfActivity = :days WHERE id = :id");

        $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
        $stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
        $stmt->bindParam(":lastname", $data["lastname"], PDO::PARAM_STR);
        //$stmt->bindParam(":phone", $data["phone"], PDO::PARAM_STR);
        $stmt->bindParam(":documentNumber", $data["document"], PDO::PARAM_INT);
        $stmt->bindParam(":activity", $data["activity"], PDO::PARAM_STR);
        $stmt->bindParam(":days", $data["days"], PDO::PARAM_STR);
        $stmt->bindParam(":amount", $data["amount"], PDO::PARAM_STR);
        //$stmt->bindParam(":type", $data["type"], PDO::PARAM_STR);
        //$stmt->bindParam(":observations", $data["observations"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    static public function DeleteCustomer($table, $id){
        $stmt = Connection::Connect()->prepare("DELETE FROM $table WHERE id = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        } else{
            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    static public function SetCustomerPayed($table, $data){
        $stmt = Connection::Connect()->prepare("UPDATE $table SET state = :state WHERE id = :id");

        $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
        $stmt->bindParam(":state", $data["status"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    static public function GetcustomerActivities($table, $idCustomerGetActivities){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table WHERE id = :id");

        $stmt->bindParam(":id", $idCustomerGetActivities, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;
    }

    static public function GetCustomerDays($table, $idCustomerGetDays){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table WHERE id = :id");

        $stmt->bindParam(":id", $idCustomerGetDays, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;
    }

    static public function GetCustomerAmount($table, $idCustomerGetAmount){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table WHERE id = :id");

        $stmt->bindParam(":id", $idCustomerGetAmount, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchColumn(6); //tabla amount

        $stmt->close();

        $stmt = null;
    }

    static public function SetCustomerAmount($table, $idCustomer, $amount){
        $stmt = Connection::Connect()->prepare("UPDATE $table SET amount = :amount WHERE id = :id");

        $stmt->bindParam(":id", $idCustomer, PDO::PARAM_INT);
        $stmt->bindParam(":amount", $amount, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    static public function GetLastCustomerRegistered($table, $data){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table WHERE name = :name AND lastname = :lastname");

        $stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
        $stmt->bindParam(":lastname", $data["lastName"], PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchColumn(0);

        $stmt->close();

        $stmt = null;
    }

    static public function UpdateNextExpiration($table, $idCustomerUpdateNextExpiration, $newExpirationDateCustomer){
        $stmt = Connection::Connect()->prepare("UPDATE $table SET expiration = :expiration WHERE id = :id");

        $stmt->bindParam(":id", $idCustomerUpdateNextExpiration, PDO::PARAM_INT);
        $stmt->bindParam(":expiration", $newExpirationDateCustomer, PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    static public function SetCustomerExpired($table, $idCustomerSetExpired, $expiredValue){
        $stmt = Connection::Connect()->prepare("UPDATE $table SET state = :state WHERE id = :id");

        $stmt->bindParam(":id", $idCustomerSetExpired, PDO::PARAM_INT);
        $stmt->bindParam(":state", $expiredValue, PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    static public function ChangeExpirationCountValue($table, $idCustomerChangeCountValue, $valueExpiration){
        $stmt = Connection::Connect()->prepare("UPDATE $table SET pauseAdvise = :pauseAdvise WHERE id = :id");

        $stmt->bindParam(":id", $idCustomerChangeCountValue, PDO::PARAM_INT);
        $stmt->bindParam(":pauseAdvise", $valueExpiration, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();

        $stmt = null;
    }
}

?>