<?php

class UsersController{
    public function RegisterUser(){
        if(isset($_POST["nameInput"])){
            if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nameInput"]) &&
            preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["lastNameInput"]) &&
            preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailInput"]) &&
            preg_match('/^[a-zA-Z0-9]+$/', $_POST["passwordInput"])){
                $encrypt = crypt($_POST["passwordInput"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $encryptEmail = md5($_POST["emailInput"]);

                $data = array("name"=>$_POST["nameInput"],
                            "lastName"=>$_POST["lastNameInput"],
                            "password"=>$encrypt,
                            "email"=>$_POST["emailInput"],
                            "encryptedEmail"=>$encryptEmail,
                            "isSuper"=>"",
                            "permissions"=>"");

                $table = "superusers";

                $response = UsersModel::RegisterUser($table, $data);

                if($response == "ok"){

                    echo '<script> 

							swal({
								  title: "¡OK!",
								  text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["emailInput"].' para verificar la cuenta!",
								  type:"success",
								  confirmButtonText: "Cerrar",
								  closeOnConfirm: false
								},

								function(isConfirm){

									if(isConfirm){
										history.back();
									}
							});

						</script>';

                }else{

                    echo '<script> 

							swal({
								  title: "¡ERROR!",
								  text: "¡Ha ocurrido un problema registrandote! Porfavor revise que esten bien los datos.",
								  type:"error",
								  confirmButtonText: "Cerrar",
								  closeOnConfirm: false
								},

								function(isConfirm){

									if(isConfirm){
										history.back();
									}
							});

						</script>';

                }

            }
        }
        //return $response;
    }

    public function LoginUser(){
        if(isset($_POST["floatingInput"])){
            if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["floatingInput"]) &&
            preg_match('/^[a-zA-Z0-9]+$/', $_POST["floatingPassword"])){
                $encrypt = crypt($_POST["floatingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $table = "superusers";
                $item = "email";
                $value = $_POST["floatingInput"];

                $response = UsersModel::ShowUser($table, $item, $value);

                if($response["email"] == $_POST["floatingInput"] && $response["password"] == $encrypt){
                    //Condicion de chequeo si esta verificado
                    $_SESSION["validateSession"] = "ok";
					$_SESSION["id"] = $response["id"];
					$_SESSION["name"] = $response["name"];
					//$_SESSION["foto"] = $response["foto"]; Agregar despues
					$_SESSION["email"] = $response["email"];
					$_SESSION["password"] = $response["password"];
					//$_SESSION["modo"] = $response["modo"];

                    echo '<script> 

							swal({
								  title: "¡OK!",
								  text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["emailInput"].' para verificar la cuenta!",
								  type:"success",
								  confirmButtonText: "Cerrar",
								  closeOnConfirm: false
								},

								function(isConfirm){

									if(isConfirm){
										history.back();
									}
							});

						</script>';

                    echo '<script> //Objeto actualRoute pertenece a HardGames Store

                            window.location.assign("'.$url.'admin/");

					</script>';
                }else{
                    echo'<script>

                    swal({
                          title: "¡ERROR AL INGRESAR!",
                          text: "¡Por favor revise que el email exista o la contraseña coincida con la registrada!",
                          type: "error",
                          confirmButtonText: "Cerrar",
                          closeOnConfirm: false
                    },

                    /*function(isConfirm){
                            if (isConfirm) {	   
                                window.location = localStorage.getItem("actualRoute");
                            } 
                    });*/

                    </script>';
                }
            }
        }
    }

    static public function RegisterCustomer($data){
            if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $data["name"]) &&
            preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $data["lastName"]) &&
            preg_match('/^[0-9]+$/', $data["document"])){
                //Descomentar si se necesita observaciones
                /*preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["observationsCustomerInput"])){*/

                $table = "customers";
                /*$item = "name";
                $item2 = "lastname";
                $value = $data["name"];
                $value2 = $data["lastName"];*/

                $item = "documentNumber";
                $value = $data["document"];

                //$validateCustomer = UsersModel::ShowCustomer($table, $item, $item2, $value, $value2);
                $validateCustomer = UsersModel::ShowCustomerOverloaded($table, $item, $value);

                if(is_array($validateCustomer) && $value == $validateCustomer["documentNumber"]){
                    return false;
                    /*echo '<script>

							swal({
								  title: "¡ERROR!",
								  text: "Este usuario ya existe en el sistema!",
								  type:"error",
								  confirmButtonText: "Cerrar",
								  closeOnConfirm: false
								})

						</script>';*/
                }else{
                    /*$data = array("name"=>$_POST["nameCustomerInput"],
                                "lastName"=>$_POST["lastNameCustomerInput"],
                                "phone"=>$_POST["phoneCustomerInput"],
                                //"type"=>$_POST["selectTypeCustomer"],
                                "activity"=>$_POST["selectActivityCustomer"],
                                "daysOfActivity"=>$_POST["selectDaysCustomer"],
                                "state"=>$_POST["selectStateCustomer"]);*/

                                //Descomentar si agregamos observations
                                //"observations"=>$_POST["observationsCustomerInput"]);

                    $response = UsersModel::RegisterCustomer($table, $data);

                    return $response;

                    /*if($response == "ok"){
                        echo '<script> 

                                swal({
                                    title: "¡OK!",
                                    text: "Usuario Agregado correctamente!",
                                    type:"success",
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false
                                    })

                            </script>';
                    }else{
                        echo '<script> 

                                swal({
                                    title: "¡ERROR!",
                                    text: "¡Ha ocurrido un problema al registrar el usuario! Por favor verifique los datos!",
                                    type:"error",
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false
                                    });

                            </script>';
                    }*/
                    
                }
                return false;
            }
    }

    static public function ShowCustomers(){
        $table = "customers";

        $response = UsersModel::ShowCustomers($table);

        return $response;
    }

    static public function GetCustomersActivities(){
        $table = "customers";

        $response = UsersModel::GetCustomersActivities($table);

        return $response;
    }

    static public function EditCustomer($data){
        $table = "customers";

        $response = UsersModel::EditCustomer($table, $data);

        return $response;
    }

    static public function DeleteCustomer($id){
        $table = "customers";

        $response = UsersModel::DeleteCustomer($table, $id);

        return $response;
    }

    static public function SetCustomerPayed($data){
        $table = "customers";

        $response = UsersModel::SetCustomerPayed($table, $data);

        return $response;
    }

    static public function GetcustomerActivities($idCustomerGetActivities){
        $table = "customers";

        $response = UsersModel::GetcustomerActivities($table, $idCustomerGetActivities);

        $responseParsed = null;

        if(is_array($response)){
            $responseParsed = json_decode($response["activity"], true);
        }

        return $responseParsed;
    }

    static public function GetCustomerDays($idCustomerGetDays){
        $table = "customers";

        $response = UsersModel::GetCustomerDays($table, $idCustomerGetDays);

        $responseParsed = null;

        if(is_array($response)){
            $responseParsed = json_decode($response["daysOfActivity"], true);
        }

        //Devolver activities y days como string, no como json, eso ya lo hace el ajax

        return $responseParsed;
    }

    static public function GetCustomerAmount($idCustomerGetAmount){
        $table = "customers";

        $response = UsersModel::GetCustomerAmount($table, $idCustomerGetAmount);

        return $response;
    }

    static public function SetCustomerAmount($idCustomer, $amount){
        $table = "customers";

        $response = UsersModel::SetCustomerAmount($table, $idCustomer, $amount);

        return $response;
    }

    static public function GetLastCustomerRegistered($data){
        $table = "customers";

        $response = UsersModel::GetLastCustomerRegistered($table, $data);

        return $response;
    }

    static public function UpdateNextExpiration($idCustomerUpdateNextExpiration, $newExpirationDateCustomer){
        $table = "customers";

        $response = UsersModel::UpdateNextExpiration($table, $idCustomerUpdateNextExpiration, $newExpirationDateCustomer);

        return $response;
    }

    static public function SetCustomerExpired($idCustomerSetExpired, $expiredValue){
        $table = "customers";

        $response = UsersModel::SetCustomerExpired($table, $idCustomerSetExpired, $expiredValue);

        return $response;
    }

    static public function ChangeExpirationCountValue($idCustomerChangeCountValue, $valueExpiration){
        $table = "customers";

        $response = UsersModel::ChangeExpirationCountValue($table, $idCustomerChangeCountValue, $valueExpiration);

        return $response;
    }
}

?>