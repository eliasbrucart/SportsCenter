<?php

class HistoryPaymentsController{
    static public function AddHistoryPaymentCustomer($data){
        $table = "history_payments";

        $response = HistoryPaymentsModel::AddHistoryPaymentCustomer($table, $data);

        return $response;
    }

    static public function GetStateMonth($idCustomerHistory){
        $table = "history_payments";

        $response = HistoryPaymentsModel::GetStateMonth($table, $idCustomerHistory);

        return $response;
    }

    static public function GetDatesMonths($idCustomerToChangeDate){
        $table = "history_payments";

        $response = HistoryPaymentsModel::GetDatesMonths($table, $idCustomerToChangeDate);

        return $response;
    }

    static public function ChangeStateMonth($idCustomerToChangeState, $monthToChangeState, $newStateMonth, $actualMonthDateChanged, $actualMonthCustomerAmount){
        $table = "history_payments";

        $getCustomerHistory = HistoryPaymentsModel::GetStateMonth($table, $idCustomerToChangeState);

        $getDatesHistory = self::GetDatesMonths($idCustomerToChangeState);

        $getAmountsMonths = self::GetAmountByMonth($idCustomerToChangeState);

        $datesMonthsArray = json_decode($getDatesHistory, true);

        $amountsMonthsArray = json_decode($getAmountsMonths, true);

        //logica del cambio de state
        $customerStateArray = json_decode($getCustomerHistory, true);

        if(is_array($customerStateArray)){
            $customerStateArray[$monthToChangeState] = $newStateMonth;
            var_dump($customerStateArray);
        }
        $stateMonthChanged = json_encode($customerStateArray);

        if(is_array($datesMonthsArray)){
            $datesMonthsArray[$monthToChangeState] = $actualMonthDateChanged;
            var_dump($datesMonthsArray);
        }

        if(is_array($amountsMonthsArray)){
            $amountsMonthsArray[$monthToChangeState] = $actualMonthCustomerAmount;
            var_dump($amountsMonthsArray);
        }

        $datesMonthsChanged = json_encode($datesMonthsArray);

        $amountMonthsChanged = json_encode($amountsMonthsArray);

        $response = HistoryPaymentsModel::ChangeStateMonth($table, $idCustomerToChangeState, $stateMonthChanged, $datesMonthsChanged, $amountMonthsChanged);

        return $response;
    }

    static public function PayMonth($idCustomerToPayMonth, $actualMonthToPay, $actualDateToPay){
        $table = "history_payments";

        $getCustomerPayedDays = HistoryPaymentsModel::GetCustomerPayedDays($table, $idCustomerToPayMonth);

        $payedDaysArray = json_decode($getCustomerPayedDays, true);

        if(is_array($payedDaysArray)){
            $payedDaysArray[$actualMonthToPay] = $actualDateToPay;
            var_dump($payedDaysArray);
        }

        $payDateChanged = json_encode($payedDaysArray);

        $response = HistoryPaymentsModel::PayMonth($table, $idCustomerToPayMonth, $payDateChanged); //fecha del dia de pago actualizada
        
        //obtener el monto del customer
        $customerAmount = HistoryPaymentsModel::GetCustomerAmount("customers", $idCustomerToPayMonth);
        
        $responseState = self::ChangeStateMonth($idCustomerToPayMonth, $actualMonthToPay, 2, $actualDateToPay, $customerAmount); //estado del mes actualizada

        $responseAmount = self::ChangeAmountOfMonth($idCustomerToPayMonth, $actualMonthToPay, $customerAmount);

        $globalResponse = "";

        if($response == "ok" && $responseState == "ok" && $responseAmount == "ok"){
            $globalResponse = "ok";
        }

        return $globalResponse;
    }

    static public function GetDaysOfPayment($idCustomerGetDays){
        $table = "history_payments";

        $response = HistoryPaymentsModel::GetDaysOfPayment($table, $idCustomerGetDays);

        return $response;
    }

    static public function ChangeAmountOfMonth($idCustomerAmount, $actualMonth, $amount){
        $table = "history_payments";

        $getAmounts = HistoryPaymentsModel::GetAmountByMonth($table, $idCustomerAmount);

        $amountsArray = json_decode($getAmounts, true);

        if(is_array($amountsArray)){
            $amountsArray[$actualMonth] = $amount;
            echo "tamos en ChangeAmountOfMonth";
            var_dump($amountsArray);
        }

        $amountsArrayChanged = json_encode($amountsArray);

        $response = HistoryPaymentsModel::ChangeAmount($table, $idCustomerAmount, $amountsArrayChanged);

        return $response;
    }

    static public function GetAmountByMonth($idCustomerGetAmount){
        $table = "history_payments";

        $response = HistoryPaymentsModel::GetAmountByMonth($table, $idCustomerGetAmount);

        return $response;
    }
}

?>