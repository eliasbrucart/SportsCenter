<?php

require "../controllers/users_controller.php";
require "../models/users_model.php";
require "../controllers/cuotas_controller.php";
require "../models/cuotas_model.php";

class ResumeAjax{
    public $activitySelected;
    public function GetResumeOfActivity(){
        $getAllUsersByActivity = UsersController::GetCustomersActivities();

        $customerActivitiesArray = array(); //si
        $customerDaysArray = array(); //si
        //$activitySelectedArray = array(); //si

        $resumeArray = array(); //si

        //var_dump($this->activitySelected);

        for($i = 0; $i < count($getAllUsersByActivity); $i++){
            $customerActivitiesArray[$i] = json_decode($getAllUsersByActivity[$i]["activity"], true);
            $customerDaysArray[$i] = json_decode($getAllUsersByActivity[$i]["daysOfActivity"], true);

            if(is_array($customerActivitiesArray[$i]) && is_array($customerDaysArray[$i])){
                for($j = 0; $j < count($customerActivitiesArray[$i]); $j++){
                    if($this->activitySelected == $customerActivitiesArray[$i][$j]){
                        $data = array("name"=>$customerActivitiesArray[$i][$j],
                                      "days"=>$customerDaysArray[$i][$j]);

                        $cuotasResponse = CuotasController::ShowCuotaByNameAndDays($data);

                        array_push($resumeArray, $cuotasResponse);
                    }
                }
                    
            }

        }

        $totalResume = array_sum($resumeArray);
                
        echo json_encode($totalResume);

    }
}


if(isset($_POST["activitySelected"])){
    $resumeActivity = new ResumeAjax();
    $resumeActivity->activitySelected = $_POST["activitySelected"];
    $resumeActivity->GetResumeOfActivity();
}

?>