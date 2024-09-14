<?php 

require_once "connection.php";

class HistoryPaymentsModel{
    static public function AddHistoryPaymentCustomer($table, $data){
        $stmt = Connection::Connect()->prepare("INSERT INTO $table(id_customer, months, state, amounts, daysOfPayment, activitiesCustomer, daysCustomer, year) VALUES(:id_customer, :months, :state, :amounts, :daysOfPayment, :activitiesCustomer, :daysCustomer, :year)");

        $stmt->bindParam(":id_customer", $data["id"], PDO::PARAM_INT);
        $stmt->bindParam(":months", $data["months"], PDO::PARAM_STR);
        $stmt->bindParam(":state", $data["states"], PDO::PARAM_STR);
        $stmt->bindParam(":amounts", $data["amounts"], PDO::PARAM_STR);
        $stmt->bindParam(":daysOfPayment", $data["dates"], PDO::PARAM_STR);
        $stmt->bindParam(":activitiesCustomer", $data["activities"], PDO::PARAM_STR);
        $stmt->bindParam(":daysCustomer", $data["days"], PDO::PARAM_STR);
        $stmt->bindParam(":year", $data["actualYear"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    static public function GetStateMonth($table, $idCustomerHistory){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table WHERE id_customer = :id_customer");

        $stmt->bindParam(":id_customer", $idCustomerHistory, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchColumn(3); //columna state

        $stmt->close();

        $stmt = null;
    }

    static public function GetCustomerPayedDays($table, $idCustomerToPayMonth){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table WHERE id_customer = :id_customer");

        $stmt->bindParam(":id_customer", $idCustomerToPayMonth, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchColumn(4); //columna daysOfPayment

        $stmt->close();

        $stmt = null;
    }

    static public function ChangeStateMonth($table, $idCustomerToChangeState, $stateMonthChanged, $datesMonthsChanged, $amountMonthsChanged){
        $stmt = Connection::Connect()->prepare("UPDATE $table SET state = :state, amounts = :amounts, daysOfPayment = :daysOfPayment WHERE id_customer = :id_customer");

        $stmt->bindParam(":id_customer", $idCustomerToChangeState, PDO::PARAM_INT);
        $stmt->bindParam(":state", $stateMonthChanged, PDO::PARAM_STR);
        $stmt->bindParam(":daysOfPayment", $datesMonthsChanged, PDO::PARAM_STR);
        $stmt->bindParam(":amounts", $amountMonthsChanged, PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    static public function PayMonth($table, $idCustomerToPayMonth, $payDateChanged){
        $stmt = Connection::Connect()->prepare("UPDATE $table SET daysOfPayment = :daysOfPayment WHERE id_customer = :id_customer");

        $stmt->bindParam(":id_customer", $idCustomerToPayMonth, PDO::PARAM_INT);
        $stmt->bindParam(":daysOfPayment", $payDateChanged, PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    /*static public function GetAmountPayedInMonth($table, $idCustomerGetAmount){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table WHERE id_customer = :id_customer");

        $stmt->bindParam(":id_customer", $idCustomerGetAmount, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchColumn(4); //columna amounts

        $stmt->close();

        $stmt = null;
    }*/

    static public function GetDaysOfPayment($table, $idCustomerGetDays){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table WHERE id_customer = :id_customer");

        $stmt->bindParam(":id_customer", $idCustomerGetDays, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchColumn(5); //columna daysOfPayment

        $stmt->close();

        $stmt = null;
    }

    static public function GetAmountByMonth($table, $idCustomerGetAmount){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table WHERE id_customer = :id_customer");

        $stmt->bindParam(":id_customer", $idCustomerGetAmount, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchColumn(4); //columna amounts

        $stmt->close();

        $stmt = null;
    }

    static public function ChangeAmount($table, $idCustomerAmount, $amountsArrayChanged){
        $stmt = Connection::Connect()->prepare("UPDATE $table SET amounts = :amounts WHERE id_customer = :id_customer");

        $stmt->bindParam(":id_customer", $idCustomerAmount, PDO::PARAM_INT);
        $stmt->bindParam(":amounts", $amountsArrayChanged, PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    //Excepcion

    static public function GetCustomerAmount($table, $id){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table WHERE id = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchColumn(6); //columna amount

        $stmt->close();

        $stmt = null;
    }

    static public function GetDatesMonths($table, $idCustomerToChangeDate){
        $stmt = Connection::Connect()->prepare("SELECT * FROM $table WHERE id_customer = :id_customer");

        $stmt->bindParam(":id_customer", $idCustomerToChangeDate, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchColumn(5); //columna daysOfPayments

        $stmt->close();

        $stmt = null;
    }
}

?>