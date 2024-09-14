<?php

require_once "../controllers/users_controller.php";
require_once "../models/users_model.php";
require_once "../controllers/cuotas_controller.php";
require_once "../models/cuotas_model.php";

class TableAdmin{

    public $activities = "";
    public $days = "";
    public $activitiesCustomer = "";

    private function CleanString($string){
        $string = str_replace('\n', ' ', $string);

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }

    public function ProcessActivityArray($activitiesArr){
        if(is_array($activitiesArr)){
            for($j = 0; $j < count($activitiesArr); $j++){
                $activities = $activitiesArr[$j].", "; //mostramos ambos arrays
            }
            return $activities;
        }else{
            return $activities;
        }
    }

    public function ProcessActivities($activitiesArr, $daysArr){
        $result = "";
        if(is_array($activitiesArr) && is_array($daysArr)){
            for($i = 0; $i < count($activitiesArr); $i++){
                $result = $activitiesArr[$i];
                $result .= ": ";
                $result .= $daysArr[$i];
            }
            return $result;
        }else{
            return "NULL";
        }
    }

    public function ProcessDaysArray($daysArr){
        $days="";
        if(is_array($daysArr)){
            for($j = 0; $j < count($daysArr); $j++){
                return $daysArr[$j]; //mostramos ambos arrays
                //return $days[$j];
            }
        }else{
            return $days;
        }
    }

    public function ShowTableAdmin(){
        $customers = UsersController::ShowCustomers();

        $dataJson = '
        {
            "data":[';

                for($i = 0; $i < count($customers); $i++){

                    //Seguimos el orden de la tabla

                    $customerId = $customers[$i]["id"];

                    //Primero nombre del cliente
                    $customerName = $customers[$i]["name"];

                    $customerLastName = $customers[$i]["lastname"];

                    $customerPhone = $customers[$i]["phone"];
                    $customerDocument = $customers[$i]["documentNumber"];

                    $customerActivities = $customers[$i]["activity"];
                    $customerDays = $customers[$i]["daysOfActivity"];

                    $activitiesArr = json_decode($customers[$i]["activity"], true);
                    $daysArr = json_decode($customers[$i]["daysOfActivity"], true);

                    $activitiesAux = array();

                    if(is_array($activitiesArr) && is_array($daysArr)){
                        for($j = 0; $j < count($activitiesArr); $j++){
                            array_push($activitiesAux, $activitiesArr[$j]);
                            array_push($activitiesAux, $daysArr[$j]);
                            $this->activitiesCustomer = implode(", ", $activitiesAux);
                        }
                    }

                    //$activities = implode(",", $customerActivities);

                    $statusCustomer = $customers[$i]["state"];

                    $expirationDateCustomer = $customers[$i]["expiration"];

                    $customerPauseCount = $customers[$i]["pauseAdvise"];

                    $historyButton = "<button type='button' class='btn btn-primary m-2' data-toggle='modal' data-target='#paymentStory' onclick='GetHistoryPaymentCustomer(".$customerId.")'><i class='fa fa-history'></i></button>";

                    $amountCustomer = $customers[$i]["amount"];

                    $edit = "<button type='button' class='btn btn-info m-2 editCustomer' onclick='EditCustomer(";

                    //Agregar como parametros al boton de EditCustomer, los dias y actividades, trayendolos de manera dinamica de la Base de Datos.
                    $dataCustomer = $customerId.", "."`$customerName`".", "."`$customerLastName`".", "."`$customerPhone`".", "."`$customerDocument`"."";

                    $edit .= "$dataCustomer)' data-toggle='modal' data-target='#editCustomerModal'>Editar</button>";
                    //$edit = "<button type='button' class='btn btn-info m-2 editCustomer' onclick='EditCustomer(".$customerId.",".$customerName.",".$customerLastName.",".$customerPhone.",".$customerType.",".$customerObservations.")' data-toggle='modal' data-target='#editCustomerModal'>Editar</button>";

                    $advisePay = "<button type='button' class='btn btn-warning m-2' onclick='SMSSendMessage()'>Avisar Pago</button>";

                    $stopCount = "";

                    if($customerPauseCount == 0){
                        $stopCount = "<button type='button' value='".$customerPauseCount."' class='btn btn-light m-2' onclick='ChangeExpirationCountValue(".$customerId.",".$customerPauseCount.")'>Pausar Conteo</button>";
                    }else{
                        $stopCount = "<button type='button' value='".$customerPauseCount."' class='btn btn-light m-2' onclick='ChangeExpirationCountValue(".$customerId.",".$customerPauseCount.")'>Despausar Conteo</button>";
                    }

                    $pay = "<button type='button' class='btn btn-success m-2' onclick='Pay(".$customerId.")'>Pago</button>";

                    $delete = "<button type='button' class='btn btn-danger m-2' onclick='ShowCustomerInfoToDelete(";

                    $dataToDelete = $customerId.", "."`$customerName`".", "."`$customerLastName`".", "."`$customerPhone`".", "."`$customerDocument`"."";
                    
                    $delete .= "$dataToDelete)' data-toggle='modal' data-target='#deleteCustomerModal'>Eliminar</button>";

                    $dataJson .= '[
                        "'.$customerName.'",
                        "'.$customerLastName.'",
                        "'.$customerDocument.'",
                        "'.$this->activitiesCustomer.'",
                        "'.$statusCustomer.'",
                        "'.$amountCustomer.'",
                        "'.$expirationDateCustomer.$historyButton.'",
                        "'.$edit.$stopCount.$pay.$delete.'"
                    ],';

                }

                $dataJson = substr($dataJson, 0, -1);

                $dataJson .= ']
            
                }';

                echo $dataJson;
    }
}

$showTable = new TableAdmin();
$showTable->ShowTableAdmin();

?>