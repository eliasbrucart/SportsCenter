<?php

require_once "../controllers/history_payments_controller.php";
require_once "../models/history_payments_model.php";
require_once "../controllers/users_controller.php";
require_once "../models/users_model.php";

class HistoryPaymentsAjax{
    public $idCustomer;
    public $monthsJson; //Vamos a hacerle un push con el ultimo dato que viene desde js y convertirlo s json
    public $statesJson; //Vamos a hacerle un push con el ultimo dato que viene desde js y convertirlo s json
    public $amountsJson;
    public $datesJson; //Vamos a hacerle un push con el ultimo dato que viene desde js y convertirlo s json
    public $activitiesCustomer; //ya vienen como json
    public $daysCustomer; //ya vienen como json
    public $actualYear;
    public function AddHistoryPayment(){
        $data = array("id"=>$this->idCustomer,
                      "months"=>$this->monthsJson,
                      "states"=>$this->statesJson,
                      "amounts"=>$this->amountsJson,
                      "dates"=>$this->datesJson,
                      "activities"=>$this->activitiesCustomer,
                      "days"=>$this->daysCustomer,
                      "actualYear"=>$this->actualYear);

        $response = HistoryPaymentsController::AddHistoryPaymentCustomer($data);

        echo json_encode($response);
    }

    public $idCustomerHistory;
    public $monthSelected;
    public function CheckMonthSelected(){
        $response = HistoryPaymentsController::GetStateMonth($this->idCustomerHistory);
        $responseDays = HistoryPaymentsController::GetDaysOfPayment($this->idCustomerHistory);
        $responseAmounts = HistoryPaymentsController::GetAmountByMonth($this->idCustomerHistory);

        //Json Data to array
        $monthsArray = json_decode($response, true);
        $paymentDaysArray = json_decode($responseDays, true);
        $amountsArray = json_decode($responseAmounts, true);

        $stateMonth = $monthsArray[$this->monthSelected];
        $dayOfPaymentSelected = $paymentDaysArray[$this->monthSelected];
        $amountSelected = $amountsArray[$this->monthSelected];

        $stateToReturn = "";

        switch($stateMonth){
            case 0:
                $stateToReturn = "No hay registro";
                break;
            case 1:
                $stateToReturn = "No Pago";
                break;
            case 2:
                $stateToReturn = "Pago";
                break;
        }

        $dataToReturn = array("state"=>$stateToReturn,
                              "daysOfPayment"=>$dayOfPaymentSelected,
                              "amount"=>$amountSelected);

        echo json_encode($dataToReturn);
    }

    public $idCustomerToChangeState;
    public $monthToChangeState;
    public $newStateMonth;
    public $actualMonthDateChanged;
    public $actualMonthCustomerAmount;
    public function ChangeStateMonth(){
        $response = HistoryPaymentsController::ChangeStateMonth($this->idCustomerToChangeState, $this->monthToChangeState, $this->newStateMonth, $this->actualMonthDateChanged, $this->actualMonthCustomerAmount);

        echo json_encode($response);
    }

    public $idCustomerToPayMonth;
    public $actualMonthToPay;
    public $actualDateToPay;
    public function PayMonth(){
        $response = HistoryPaymentsController::PayMonth($this->idCustomerToPayMonth, $this->actualMonthToPay, $this->actualDateToPay);

        echo json_encode($response);
    }
}

if(isset($_POST["idCustomerPayed"])){
    $addHistoryPayments = new HistoryPaymentsAjax();
    $addHistoryPayments->idCustomer = $_POST["idCustomerPayed"];

    $addHistoryPayments->monthsJson = $_POST["monthsHistoryJson"];
    $addHistoryPayments->statesJson = $_POST["statesHistoryJson"];
    $addHistoryPayments->datesJson = $_POST["datesHistoryJson"];
    $addHistoryPayments->amountsJson = $_POST["amountsHistoryJson"];

    $addHistoryPayments->activitiesCustomer = $_POST["activitiesCustomer"];
    $addHistoryPayments->daysCustomer = $_POST["daysCustomer"];
    $addHistoryPayments->actualYear = $_POST["actualYear"];
    $addHistoryPayments->AddHistoryPayment();
}

if(isset($_POST["idCustomerHistory"]) && isset($_POST["monthSelectedToCheck"])){
    $monthToCheck = new HistoryPaymentsAjax();
    $monthToCheck->idCustomerHistory = $_POST["idCustomerHistory"];
    $monthToCheck->monthSelected = $_POST["monthSelectedToCheck"];
    $monthToCheck->CheckMonthSelected();
}

if(isset($_POST["idCustomerToChangeState"])){
    $changeStateMonth = new HistoryPaymentsAjax();
    $changeStateMonth->idCustomerToChangeState = $_POST["idCustomerToChangeState"];
    $changeStateMonth->monthToChangeState = $_POST["monthToChangeState"];
    $changeStateMonth->newStateMonth = $_POST["newStateMonth"];
    $changeStateMonth->actualMonthDateChanged = $_POST["actualMonthDateChanged"];
    $changeStateMonth->actualMonthCustomerAmount = $_POST["actualMonthCustomerAmount"];
    $changeStateMonth->ChangeStateMonth();
}

if(isset($_POST["idCustomerToPayMonth"])){
    $customerPayMonth = new HistoryPaymentsAjax();
    $customerPayMonth->idCustomerToPayMonth = $_POST["idCustomerToPayMonth"];
    $customerPayMonth->actualMonthToPay = $_POST["actualMonthToPay"];
    $customerPayMonth->actualDateToPay = $_POST["actualDateToPay"];
    $customerPayMonth->PayMonth();
}

?>