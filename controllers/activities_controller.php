<?php 

class ActivitiesController{

    static public function UploadActivity($nameActivity){
        $table = "activities";

        $item = "name";
        $value = $nameActivity;

        if($value != "" || $value != null){

            $response = ActivitiesModel::ShowActivity($table, $item, $value);

            if($response["name"] == $value){
                return false;
            }else{
                $response2 = ActivitiesModel::UploadActivity($table, $value);

                if($response2 == "ok"){
                    return $response2;
                }
                return $response2;
            }

        }else{
            return null;
        }

    }


    static public function UploadActivityy($nameActivity){
        $table = "activities";

        $item = "name";
        $value = $nameActivity;

        $response = ActivitiesModel::ShowActivity($table, $item, $value);

        if($response){

            var_dump($response);

            echo $response;

            return;

            echo '<script>
                swal({
                    title: "¡ERROR!",
                    text: "¡Ya existe la actividad en el sistema! La misma aparecera en el sistema.",
                    type:"error",
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                });
                </script>';
        }else{
            $response2 = ActivitiesModel::UploadActivity($table, $value);
            
            var_dump($response2);

            echo $response2;

            return;

            if($response2 == "ok"){
                echo '<script>
                    swal({
                        title: "OK!",
                        text: "La actividad se agrego con exito!",
                        type:"success",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });
                    </script>';
            }else{
                echo '<script>
                swal({
                    title: "¡ERROR!",
                    text: "¡Se produjo un error al subir la actividad!",
                    type:"error",
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                });
                </script>';
            }
        }

    }

    static public function GetAllActivities(){
        $table = "activities";

        $response = ActivitiesModel::GetAllActivities($table);

        return $response;
    }

    static public function EditActivity($data){
        $table = "activities";

        $response = ActivitiesModel::EditActivity($table, $data);

        return $response;
    }

    static public function DeleteActivity($idActivityToDelete){
        $table = "activities";

        $response = ActivitiesModel::DeleteActivity($table, $idActivityToDelete);

        return $response;
    }
    
}

?>