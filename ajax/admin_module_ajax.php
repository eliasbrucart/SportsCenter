<?php

require_once "../controllers/users_controller.php";
require_once "../models/users_model.php";
require_once "../controllers/activities_controller.php";
require_once "../models/activities_model.php";
require_once "../controllers/cuotas_controller.php";
require_once "../models/cuotas_model.php";

class AdminModule{
    public $idCustomer;
    public $nameCustomer;
    public $lastnameCustomer;
    public $phoneCustomer;
    public $documentCustomer;
    public $stateCustomer;
    public $registrationDate;
    public $expirationDate;
    public $activityCustomer;
    public $daysCustomer;
    public $amountCustomer;

    public function RegisterCustomer(){
        $data = array("name"=>$this->nameCustomer,
                      "lastName"=>$this->lastnameCustomer,
                      "document"=>$this->documentCustomer,
                      "state"=>$this->stateCustomer,
                      "amount"=>$this->amountCustomer,
                      "registrationDate"=>$this->registrationDate,
                      "expiration"=>$this->expirationDate,
                      "activity"=>$this->activityCustomer,
                      "daysOfActivity"=>$this->daysCustomer);

        $response = UsersController::RegisterCustomer($data);

        echo json_encode($response);
    }

    public $idToEdit;
    public $editedNameCustomer;
    public $editedLastNameCustomer;
    public $editedPhoneCustomer;
    public $editedDocumentCustomer;
    public $editedActivitiesCustomer;
    public $editedDaysCustomer;
    public $newAmount;
    //public $editedTypeCustomer;
    //public $editedObservationsCustomer;

    public function EditCustomer(){
        $data = array("id"=>$this->idToEdit,
                    "name"=>$this->editedNameCustomer,
                    "lastname"=>$this->editedLastNameCustomer,
                    //"phone"=>$this->editedPhoneCustomer,
                    "document"=>$this->editedDocumentCustomer,
                    "activity"=>$this->editedActivitiesCustomer,
                    "days"=>$this->editedDaysCustomer,
                    "amount"=>$this->newAmount);
                    //"type"=>$this->editedTypeCustomer,
                    //"observations"=>$this->editedObservationsCustomer);

        $response = UsersController::EditCustomer($data);

        echo json_encode($response);
    }

    public $idToDelete;

    public function DeleteCustomer(){
        $response = UsersController::DeleteCustomer($this->idToDelete);

        echo json_encode($response);
    }

    public $idCustomerPayed;
    public $statusCustomerPayed;

    public function SetCustomerPayed(){
        $data = array("id"=>$this->idCustomerPayed,
                    "status"=>$this->statusCustomerPayed);
        $response = UsersController::SetCustomerPayed($data);

        echo json_encode($response);
    }

    public function GetAllActivities(){
        $response = ActivitiesController::GetAllActivities();

        echo json_encode($response);
    }

    public function GetAllDays(){
        $response = CuotasController::GetDays();

        echo json_encode($response);
    }

    public $idCustomerGetActivities;
    public function GetcustomerActivities(){
        $response = UsersController::GetcustomerActivities($this->idCustomerGetActivities);

        //echo $response;

        echo json_encode($response);
    }

    public $idCustomerGetDays;
    public function GetCustomerDays(){
        $response = UsersController::GetCustomerDays($this->idCustomerGetDays);

        //echo $response;

        echo json_encode($response);
    }

    public $idCustomerGetAmount;
    public function GetCustomerAmount(){
        $response = UsersController::GetCustomerAmount($this->idCustomerGetAmount);

        echo json_encode($response);
    }

    //public $idLastCustomerRegistered;
    public $nameLastCustomerRegistered;
    public $lastNameLastCustomerRegistered;
    public function GetLastCustomerRegistered(){
        $data = array("name"=>$this->nameLastCustomerRegistered,
                      "lastName"=>$this->lastNameLastCustomerRegistered);

        $response = UsersController::GetLastCustomerRegistered($data);

        echo json_encode($response);
    }

    public $idCustomerUpdateNextExpiration;
    public $newExpirationDateCustomer;
    public function UpdateNextExpiration(){
        $response = UsersController::UpdateNextExpiration($this->idCustomerUpdateNextExpiration, $this->newExpirationDateCustomer);

        echo json_encode($response);
    }

    public function ShowCustomers(){
        $response = UsersController::ShowCustomers();

        echo json_encode($response);
    }

    public $idCustomerSetExpired;
    public $expiredValue;
    public function SetCustomerExpired(){
        $response = UsersController::SetCustomerExpired($this->idCustomerSetExpired, $this->expiredValue);

        echo json_encode($response);
    }

    public $idCustomerToCalculate;
    public function CalculateCustomerAmounts(){
        $customerActivities = UsersController::GetcustomerActivities($this->idCustomerToCalculate);

        $customerDays = UsersController::GetCustomerDays($this->idCustomerToCalculate);

        $amountArray = array();

        if(is_array($customerActivities) && is_array($customerDays)){
            for($i = 0; $i < count($customerActivities); $i++){
                $data = array("name"=>$customerActivities[$i],
                              "days"=>$customerDays[$i]);

                $cuotasResponse = CuotasController::ShowCuotaByNameAndDays($data);

                array_push($amountArray, $cuotasResponse);
            }
        }

        $amount = array_sum($amountArray);

        $response = UsersController::SetCustomerAmount($this->idCustomerToCalculate, $amount);

        echo json_encode($response);
    }

    public $idCustomerChangeCountValue;
    public $valueExpiration;
    public function ChangeExpirationCountValue(){
        $response = UsersController::ChangeExpirationCountValue($this->idCustomerChangeCountValue, $this->valueExpiration);

        echo json_encode($response);
    }
}

if(isset($_POST["idToEdit"]) || isset($_POST["editedNameCustomer"]) || isset($_POST["editedLastNameCustomer"]) || isset($_POST["editedPhoneCustomer"]) ||
    isset($_POST["editedTypeCustomer"]) || isset($_POST["editedObservationsCustomer"])){
    $editCustomer = new AdminModule();
    $editCustomer->idToEdit = $_POST["idToEdit"];
    $editCustomer->editedNameCustomer = $_POST["editedNameCustomer"];
    $editCustomer->editedLastNameCustomer = $_POST["editedLastNameCustomer"];
    //$editCustomer->editedPhoneCustomer = $_POST["editedPhoneCustomer"];
    $editCustomer->editedDocumentCustomer = $_POST["editedDocumentCustomer"];
    $editCustomer->editedActivitiesCustomer = $_POST["editedActivitiesCustomer"];
    $editCustomer->editedDaysCustomer = $_POST["editedDaysCustomer"];

    $getActivities = json_decode($_POST["editedActivitiesCustomer"], true);
    $getDays = json_decode($_POST["editedDaysCustomer"], true);

    $amountArray = array();

    if(is_array($getActivities) && is_array($getDays)){
        for($i = 0; $i < count($getActivities); $i++){
            $data = array("name"=>$getActivities[$i],
                          "days"=>$getDays[$i]);

            $cuotasResponse = CuotasController::ShowCuotaByNameAndDays($data);

            array_push($amountArray, $cuotasResponse);
        }
    }

    $editCustomer->newAmount = array_sum($amountArray);

    //$editCustomer->editedTypeCustomer = $_POST["editedTypeCustomer"];
    //$editCustomer->editedObservationsCustomer = $_POST["editedObservationsCustomer"];
    $editCustomer->EditCustomer();
}

if(isset($_POST["idToDelete"])){
    $deleteCustomer = new AdminModule();
    $deleteCustomer->idToDelete = $_POST["idToDelete"];
    $deleteCustomer->DeleteCustomer();
}

if(isset($_POST["idCustomerPayed"]) && isset($_POST["statusCustomerPayed"])){
    $customerPayed = new AdminModule();
    $customerPayed->idCustomerPayed = $_POST["idCustomerPayed"];
    $customerPayed->statusCustomerPayed = $_POST["statusCustomerPayed"];
    $customerPayed->SetCustomerPayed();
}

if(isset($_POST["nameCustomerInput"])){
    $registerCustomer = new AdminModule();
    $registerCustomer->nameCustomer = $_POST["nameCustomerInput"];
    $registerCustomer->lastnameCustomer = $_POST["lastNameCustomerInput"];
    //$registerCustomer->phoneCustomer = $_POST["phoneCustomerInput"];
    $registerCustomer->documentCustomer = $_POST["documentCustomerInput"];
    $registerCustomer->stateCustomer = $_POST["stateCustomer"];
    $registerCustomer->registrationDate = $_POST["registrationDate"];
    $registerCustomer->expirationDate = $_POST["expirationDate"];
    $registerCustomer->activityCustomer = $_POST["selectActivityCustomer"];
    $registerCustomer->daysCustomer = $_POST["selectDaysCustomer"];

    $getActivities = json_decode($_POST["selectActivityCustomer"], true);
    $getDays = json_decode($_POST["selectDaysCustomer"], true);

    $amountArray = array();

    if(is_array($getActivities) && is_array($getDays)){
        for($i = 0; $i < count($getActivities); $i++){
            $data = array("name"=>$getActivities[$i],
                          "days"=>$getDays[$i]);

            $cuotasResponse = CuotasController::ShowCuotaByNameAndDays($data);

            array_push($amountArray, $cuotasResponse);
        }
    }

    $registerCustomer->amountCustomer = array_sum($amountArray);
    $registerCustomer->RegisterCustomer();
}

if(isset($_POST["getActivities"])){
    $getActivities = new AdminModule();
    $getActivities->GetAllActivities();
}

if(isset($_POST["getDays"])){
    $getDays = new AdminModule();
    $getDays->GetAllDays();
}

if(isset($_POST["idCustomerGetActivities"])){
    $getCustomerActivities = new AdminModule();
    $getCustomerActivities->idCustomerGetActivities = $_POST["idCustomerGetActivities"];
    $getCustomerActivities->GetcustomerActivities();
}

if(isset($_POST["idCustomerGetDays"])){
    $getCustomerDays = new AdminModule();
    $getCustomerDays->idCustomerGetDays = $_POST["idCustomerGetDays"];
    $getCustomerDays->GetCustomerDays();
}

if(isset($_POST["idCustomerGetAmount"])){
    $getCustomerAmount = new AdminModule();
    $getCustomerAmount->idCustomerGetAmount = $_POST["idCustomerGetAmount"];
    $getCustomerAmount->GetCustomerAmount();
}

if(isset($_POST["getLastCustomerRegistered"])){
    $lastCustomerRegistered = new AdminModule();
    $lastCustomerRegistered->nameLastCustomerRegistered = $_POST["nameCustomerInput"];
    $lastCustomerRegistered->lastNameLastCustomerRegistered = $_POST["lastNameCustomerInput"];
    $lastCustomerRegistered->GetLastCustomerRegistered();
}

if(isset($_POST["idCustomerUpdateExpiration"])){
    $updateNextExpirationCustomer = new AdminModule();
    $updateNextExpirationCustomer->idCustomerUpdateNextExpiration = $_POST["idCustomerUpdateExpiration"];
    $updateNextExpirationCustomer->newExpirationDateCustomer = $_POST["newExpirationDateCustomer"];
    $updateNextExpirationCustomer->UpdateNextExpiration();
}

if(isset($_POST["getAllCustomers"]) && $_POST["getAllCustomers"]){
    $showCustomers = new AdminModule();
    $showCustomers->ShowCustomers();
}

if(isset($_POST["setCustomerExpired"]) && $_POST["setCustomerExpired"]){
    $customerExpired = new AdminModule();
    $customerExpired->idCustomerSetExpired = $_POST["idCustomerSetExpired"];
    $customerExpired->expiredValue = $_POST["expiredValue"];
    $customerExpired->SetCustomerExpired();
}

if(isset($_POST["calculateCustomerAmounts"]) && $_POST["calculateCustomerAmounts"]){
    $calculateCustomerAmounts = new AdminModule();
    $calculateCustomerAmounts->idCustomerToCalculate = $_POST["idCustomerToCalculate"];
    $calculateCustomerAmounts->CalculateCustomerAmounts();
}

if(isset($_POST["ChangeExpirationCountValue"]) && $_POST["ChangeExpirationCountValue"]){
    $changeExpirationCountValue = new AdminModule();
    $changeExpirationCountValue->idCustomerChangeCountValue = $_POST["idCustomerChangeCountValue"];
    $changeExpirationCountValue->valueExpiration = $_POST["valueExpiration"];
    $changeExpirationCountValue->ChangeExpirationCountValue();
}
?>