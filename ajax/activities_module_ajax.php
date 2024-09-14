<?php

require_once "../controllers/activities_controller.php";
require_once "../models/activities_model.php";

require_once "../controllers/cuotas_controller.php";
require_once "../models/cuotas_model.php";

class ActivitiesModuleAjax{
    public $nameActivity;
    public function UploadActivityAjax(){
        $response = ActivitiesController::UploadActivity($this->nameActivity);

        echo json_encode($response);
    }

    public $idActivity;
    public $nameCuota;
    public $cuotaDays;
    public $cuotaPrice;
    public function UploadCuota(){
        $data = array("id"=>$this->idActivity,
                      "name"=>$this->nameCuota,
                      "days"=>$this->cuotaDays,
                      "price"=>$this->cuotaPrice
        );

        $response = CuotasController::UploadCuota($data);

        echo json_encode($response);
    }

    public $idActivityToEdit;
    public $nameActivityToEdit;
    public function EditActivity(){
        $data = array("id"=>$this->idActivityToEdit,
                      "name"=>$this->nameActivityToEdit
        );
        
        $response = ActivitiesController::EditActivity($data);

        echo json_encode($response);
    }

    public $idActivityToDelete;
    public function DeleteActivity(){
        $response = ActivitiesController::DeleteActivity($this->idActivityToDelete);

        echo json_encode($response);
    }

    public $idCuotaToEdit;
    public $daysCuotaToEdit;
    public $priceCuotaToEdit;
    public function EditCuota(){
        $data = array("id"=>$this->idCuotaToEdit,
                      "days"=>$this->daysCuotaToEdit,
                      "price"=>$this->priceCuotaToEdit
        );

        $response = CuotasController::EditCuota($data);

        echo json_encode($response);
    }

    public $idCuotaToDelete;
    public function DeleteCuota(){
        $response = CuotasController::DeleteCuota($this->idCuotaToDelete);

        echo json_encode($response);
    }

    public $idToCheckCuotas;
    public function CheckActivityCuotas(){
        $response = CuotasController::CheckActivityCuotas($this->idToCheckCuotas);

        echo json_encode($response);
    }
}

if(isset($_POST["nameActivity"])){
    $activity = new ActivitiesModuleAjax();
    $activity->nameActivity = $_POST["nameActivity"];
    $activity->UploadActivityAjax();
}

if(isset($_POST["idActivity"]) || isset($_POST["nameCuota"]) || isset($_POST["cuotaDays"]) || isset($_POST["cuotaPrice"])){
    $cuota = new ActivitiesModuleAjax();
    $cuota->idActivity = $_POST["idActivity"];
    $cuota->nameCuota = $_POST["nameCuota"];
    $cuota->cuotaDays = $_POST["cuotaDays"];
    $cuota->cuotaPrice = $_POST["cuotaPrice"];
    $cuota->UploadCuota();
}

if(isset($_POST["idActivityToEdit"]) || isset($_POST["newNameActivity"])){
    $activityToEdit = new ActivitiesModuleAjax();
    $activityToEdit->idActivityToEdit = $_POST["idActivityToEdit"];
    $activityToEdit->nameActivityToEdit = $_POST["newNameActivity"];
    $activityToEdit->EditActivity();
}

if(isset($_POST["idActivityToDelete"])){
    $activityToDelete = new ActivitiesModuleAjax();
    $activityToDelete->idActivityToDelete = $_POST["idActivityToDelete"];
    $activityToDelete->DeleteActivity();
}

if(isset($_POST["idCuotaToEdit"])){
    $cuotaToEdit = new ActivitiesModuleAjax();
    $cuotaToEdit->idCuotaToEdit = $_POST["idCuotaToEdit"];
    $cuotaToEdit->daysCuotaToEdit = $_POST["newDaysCuota"];
    $cuotaToEdit->priceCuotaToEdit = $_POST["newPriceCuota"];
    $cuotaToEdit->EditCuota();
}

if(isset($_POST["idCuotaToDelete"])){
    $cuotaToDelete = new ActivitiesModuleAjax();
    $cuotaToDelete->idCuotaToDelete = $_POST["idCuotaToDelete"];
    $cuotaToDelete->DeleteCuota();
}

if(isset($_POST["idToCheckCuotas"])){
    $checkActivityCuotas = new ActivitiesModuleAjax();
    $checkActivityCuotas->idToCheckCuotas = $_POST["idToCheckCuotas"];
    $checkActivityCuotas->CheckActivityCuotas();
}

?>