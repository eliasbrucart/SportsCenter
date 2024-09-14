<?php

class CuotasController{
    static public function ShowCuotas(){
        $table = "cuotas";

        $response = CuotasModel::ShowCuotas($table);

        return $response;
    }

    static public function ShowCuota($data){
        $table = "cuotas";

        $response = CuotasModel::ShowCuota($table, $data);

        return $response;
    }

    static public function ShowCuotaByNameAndDays($data){
        $table = "cuotas";

        $response = CuotasModel::ShowCuotaByNameAndDays($table, $data);

        return $response;
    }

    static public function UploadCuota($data){
        $table = "cuotas";

        $checkCuota = CuotasController::ShowCuota($data);

        if($checkCuota["id_activity"] == $data["id"] && $checkCuota["days"] == $data["days"] && $checkCuota["price"] == $data["price"]){
            return false;
        }else{
            $response = CuotasModel::UploadCuota($table, $data);

            if($response == "ok"){
                return true;
            }else{
                return false;
            }
        }

    }

    static public function GetDays(){
        $table = "days";

        $response = CuotasModel::GetDays($table);

        return $response;
    }

    static public function EditCuota($data){
        $table = "cuotas";

        $response = CuotasModel::EditCuota($table, $data);

        return $response;
    }

    static public function DeleteCuota($idCuotaToDelete){
        $table = "cuotas";

        $response = CuotasModel::DeleteCuota($table, $idCuotaToDelete);

        return $response;
    }

    static public function CheckActivityCuotas($idToCheckCuotas){
        $table = "cuotas";

        $response = CuotasModel::CheckActivityCuotas($table, $idToCheckCuotas);

        return $response;
    }

    static public function GetCuotaByNameAndDays($activitySelected, $days){
        $table = "cuotas";

        $response = CuotasModel::GetCuotaByNameAndDays($table, $activitySelected, $days);

        return $response;
    }
}

?>