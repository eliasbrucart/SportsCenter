<div class="col-sm-12 col-xl-6 align-items-center float-left justify-content-center uploadModule">
    <div class="bg-secondary rounded h-100 p-4 container-fluid clearfix">
        <h6 class="mb-4">Agregar actividad</h6>
        <form method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control nameActivityInput" id="nameActivityInput"
                    name="nameActivityInput" placeholder="name@example.com">
                <label for="floatingName">Nombre</label>
            </div>
            <!--<button class="btn btn-lg btn-primary m-2 uploadActivity" onclick="UploadActivity()" id="uploadActivity">Agregar</button>-->
            <input type="submit" class="btn btn-lg btn-primary m-2 uploadActivity" onclick="UploadActivity()" id="uploadActivityBtn" value="Agregar">
        </form>
    </div>
</div>

<div class="container-fluid clearfix">
    <?php
        $activities = ActivitiesController::GetAllActivities();
        $cuotas = CuotasController::ShowCuotas();
        if(is_array($activities)){
            foreach($activities as $key => $value){
                echo '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 float-left align-items-center justify-content-center uploadCuotaModule">
                <div class="bg-secondary rounded h-100 p-4 container-fluid clearfix">
                    <h2 class="activityInfoTitle">Informacion de la Actividad</h2>
                    <div class="boxNameActivity clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 float-left">
                            <h4 class="activityTitle" id="activityTitle"><small>'.$value["name"].'</small></h4>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 float-right">
                            <button class="btn btn-warning m-2" onclick="ShowActivityData(\''.$value["id"].'\',\''.$value["name"].'\')" data-toggle="modal" data-target="#editActivity">Editar Nombre</button>
                            <button class="btn btn-primary m-2" onclick="ShowActivityToDelete(\''.$value["id"].'\',\''.$value["name"].'\')" data-toggle="modal" data-target="#deleteActivity">Eliminar Actividad</button>
                        </div>
                    </div>
                    <input type="hidden" id="idActivityInput" name="idActivityInput" value="'.$value["id"].'">
                    <h6 class="cuotasTitle">Cuotas</h6>';
                    foreach($cuotas as $key => $value2){
                        if($value["id"] == $value2["id_activity"]){
                            echo'<div class="cuotasInfoBox container clearfix">
                                <p class="col-xs-12 col-sm-12 col-md-2 float-left">'.$value2["days"].' dias</p>
                                <p class="col-xs-12 col-sm-12 col-md-2 float-left">$'.$value2["price"].'</p>
                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 float-left text-center">
                                    <button class="editCuotaBtn btn btn-warning" onclick="ShowCuotaToEdit(\''.$value2["id"].'\',\''.$value2["days"].'\',\''.$value2["price"].'\')" data-toggle="modal" data-target="#editCuota"><i class="fa fa-pen" aria-hidden="true"></i></button>
                                    <button class="deleteCuotaBtn btn btn-primary" onclick="ShowCuotaToDelete(\''.$value2["id"].'\',\''.$value2["days"].'\',\''.$value2["price"].'\',\''.$value2["name_activity"].'\')" data-toggle="modal" data-target="#deleteCuota"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </div>
                            </div>';
                        }
                    }
                    /*<div class="cuotasInfoBox container clearfix">
                        <p class="col-xs-12 col-sm-12 col-md-2 float-left">1 Dias</p>
                        <p class="col-xs-12 col-sm-12 col-md-2 float-left">$3000</p>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 float-left text-center">
                            <button class="editCuotaBtn btn btn-warning" data-toggle="modal" data-target="#editCuota"><i class="fa fa-pen" aria-hidden="true"></i></button>
                            <button class="deleteCuotaBtn btn btn-primary" data-toggle="modal" data-target="#deleteCuota"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                    </div>*/

                    echo '
                    <hr>
                    <h6 class="addCuotaTitle">Agregar cuota</h6>
                    <div class="form-floating mb-3 containerDays">
                        <select class="form-select selectCuotaDays" id="selectCuotaDays'.$value["id"].'" name="cuotaDays"
                            aria-label="Floating label select example">
                            <option selected>Abrir para seleccionar dias</option>
                            <option name="one-day" value="1">1</option>
                            <option name="two-day" value="2">2</option>
                            <option name="three-day" value="3">3</option>
                            <option name="four-day" value="4">4</option>
                            <option name="five-day" value="5">5</option>
                        </select>
                        <label for="floatingSelect">Seleccionar dias</label>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">$</span>
                        <input type="text" class="form-control form-control-lg cuotaPriceInput" id="cuotaPriceInput'.$value["id"].'" name="cuotaPriceInput" aria-label="Amount (to the nearest dollar)">
                        <span class="input-group-text">.00</span>
                    </div>
                    <button onclick="UploadCuota(\''.$value["id"].'\',\''.$value["name"].'\')" class="btn btn-lg btn-primary m-2 uploadCuotaBtn float-left" name="uploadCuotaBtn" id="uploadCuotaBtn">Agregar</button>
                </div>
            </div>';
            }
        }
    ?>
    <!--<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 float-left align-items-center justify-content-center uploadCuotaModule">
        <div class="bg-secondary rounded h-100 p-4 container-fluid clearfix">
            <h3 class="activityInfoTitle">Informacion de la Actividad</h3>
            <h4 class="activityTitle">Actividad: <small>Musculacion</small></h4>
            <h6 class="cuotasTitle">Cuotas</h6>
            <div class="cuotasInfoBox container clearfix">
                <p class="col-md-6 float-left">1 Dias</p>
                <p class="col-md-6 float-left">$3000</p>
            </div>
            <hr>
            <h6 class="addCuotaTitle">Agregar cuota</h6>
            <div class="form-floating mb-3 containerDays">
                <select class="form-select" id="floatingSelect" name="selectTypeCustomer"
                    aria-label="Floating label select example">
                    <option selected>Abrir para seleccionar dias</option>
                    <option name="one" value="one">1</option>
                    <option name="two" value="two">2</option>
                    <option name="three" value="three">3</option>
                    <option name="four" value="four">4</option>
                    <option name="five" value="five">5</option>
                </select>
                <label for="floatingSelect">Seleccionar dias</label>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">$</span>
                <input type="text" class="form-control form-control-lg" aria-label="Amount (to the nearest dollar)">
                <span class="input-group-text">.00</span>
            </div>
            <input onclick="UploadCuota()" class="btn btn-lg btn-primary m-2 uploadCuotaBtn float-left" name="uploadCuotaBtn" id="uploadCuotaBtn" value="Agregar">
            <input type="submit" class="btn btn-lg btn-primary m-2 uploadCuotaBtn float-left" id="uploadCuotaBtn" value="Agregar">
        </div>
    </div>-->

</div>

<div id="editActivity" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header" style="background:#4b4b4b; color:white">

                <h3 class="modal-title">Editar Actividad</h3>
                
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>

            <div class="modal-body" style="background:#252525;">

                <div class="box-body">

                    <div class="form-group">

                        <p class="" name="idActivityEdit">Identificador: <span id="idActivityToEdit"></span></p>

                        <div class="form-floating mb-3">

                            <input type="text" class="form-control" id="newNameActivity" name="newNameActivity" placeholder="Nombre"
                            value="">

                            <label for="newNameActivity">Nombre</label>

                        </div>

                        <!--<div class="form-floating mb-3 containerDays">
                            <select class="form-select selectCuotaDays" id="newCuotaDays" name="newCuotaDays"
                                aria-label="Floating label select example">
                                <option selected>Abrir para seleccionar dias</option>
                                <?php 
                                    /*$days = new CuotasController();
                                    $response = $days->GetDays();
                                    foreach($response as $key => $value){
                                        echo '<option name="'.$value["number"].'-day" value="'.$value["number"].'">'.$value["number"].'</option>';
                                    }*/
                                ?>
                            </select>
                            <label for="floatingSelect">Seleccionar dias</label>
                        </div>

                        <div class="form-floating mb-3">

                            <input type="text" class="form-control" id="newCuotaPrice" name="newCuotaPrice" placeholder="Precio"
                            value="">

                            <label for="newPhoneCustomer">Precio</label>

                        </div>-->
                    </div>

                </div>

            </div>

            <div class="modal-footer" style="background:#252525;">
                
                <button class="btn btn-lg btn-success m-2 saveEditedActivity" onclick="EditActivity()" id="saveEditedActivity">Guardar</button>

            </div>

        </div>

    </div>

</div>

<!-- El delete activity tambien tiene que eliminar las cuotas asociadas -->
<div id="deleteActivity" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header" style="background:#4b4b4b; color:white">

                <h3 class="modal-title">Eliminar Actividad</h3>

                <button onclick="CleanActivityDivs()" type="button" class="close" data-dismiss="modal">&times;</button>

            </div>

            <div class="modal-body" style="background:#252525;">

                <div class="box-body">

                    <p>Identificador <span id="idActivityToDelete"></span></p>
                    <p>Nombre: <span id="nameActivityToDelete"></span></p>
                    <h5>Cuotas asociadas a la actividad</h5>
                    <div class="cuotasInfoBox container clearfix" id="cuotasInfoBox">
                        <!--<p class="col-md-6 float-left"><span id="daysCuotaAsociated"></span> Dias</p>
                        <p class="col-md-6 float-left">$<span id="priceCuotaAsociated"></span></p>-->
                    </div>

                </div>

            </div>

            <div class="modal-footer" style="background:#252525;">

                <button type="button" class="btn btn-primary m-2 deleteCustomer" onclick="DeleteActivity()">Eliminar</button>

            </div>

        </div>

    </div>

</div>

<div id="editCuota" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header" style="background:#4b4b4b; color:white">

                <h3 class="modal-title">Editar Cuota</h3>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>

            <div class="modal-body" style="background:#252525;">

                <div class="box-body">

                    <p>Identificador <span id="idCuotaToEdit"></span></p>

                    <div class="form-floating mb-3 containerDays">
                        <select class="form-select selectNewCuotaDays" id="selectNewCuotaDays" name="newCuotaDays"
                            aria-label="Floating label select example">
                            <option selected>Abrir para seleccionar dias</option>
                            <option name="one-day" value="1">1</option>
                            <option name="two-day" value="2">2</option>
                            <option name="three-day" value="3">3</option>
                            <option name="four-day" value="4">4</option>
                            <option name="five-day" value="5">5</option>
                        </select>
                        <label for="floatingSelect">Seleccionar dias</label>
                    </div>

                    <div class="form-floating mb-3">

                        <input type="text" class="form-control" id="newPriceCuota" name="newPriceCuota" placeholder="Precio"
                        value="">

                        <label for="newPriceCuota">Precio</label>

                    </div>

                </div>

            </div>

            <div class="modal-footer" style="background:#252525;">
                
                <button class="btn btn-lg btn-success m-2 saveEditedCuota" onclick="EditCuota()" id="saveEditedCuota">Guardar</button>

            </div>

        </div>

    </div>

</div>

<div id="deleteCuota" class="modal fade" role="dialog">

    <div class="modal-dialog">

       <div class="modal-content">

            <div class="modal-header" style="background:#4b4b4b; color:white">

                <h3 class="modal-title">Eliminar Cuota</h3>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>

            <div class="modal-body" style="background:#252525;">

                <div class="box-body">

                    <p>Identificador <span id="idCuotaToDelete"></span></p>
                    <p>Pertenece a: <span id="fatherActivity"></span></p>
                    <h5>Cuota a eliminar</h5>
                    <div class="cuotasInfoBox container clearfix">
                        <p class="col-md-6 float-left"><span id="daysCuotaToDelete"></span> Dias</p>
                        <p class="col-md-6 float-left">$<span id="priceCuotaToDelete"></span></p>
                    </div>

                </div>

            </div>

            <div class="modal-footer" style="background:#252525;">
                
                <button class="btn btn-lg btn-primary m-2 deleteCuota" onclick="DeleteCuota()" id="deleteCuota">Eliminar</button>

            </div>

       </div>

    </div>

</div>