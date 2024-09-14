<div class="container-fluid">
    <div class="col-sm-12 col-xl-6 align-items-center justify-content-center uploadModule">
        <div class="bg-secondary rounded h-100 p-4 uploadCustomerInputBox container-fluid clearfix" id="uploadCustomerInputBox">
            <h6 class="mb-4">Agregar usuario</h6>
            <!--<form method="post">-->
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nameCustomerInput"
                        name="nameCustomerInput" placeholder="name@example.com">
                    <label for="floatingName">Nombre</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="lastNameCustomerInput"
                        name="lastNameCustomerInput" placeholder="Apellido">
                    <label for="floatingLastName">Apellido</label>
                </div>
                <!--<div class="form-floating mb-3">
                    <input type="text" class="form-control" id="phoneCustomerInput"
                        name="phoneCustomerInput" placeholder="Telefono">
                    <label for="floatingPhone">Telefono</label>
                </div>-->
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="documentCustomerInput"
                        name="documentCustomerInput" placeholder="Documento">
                    <label for="floatingPhone">Documento</label>
                </div>

                <div class="form-floating mb-3 containerActivity col-md-7 float-left">
                    <select class="form-select" id="selectActivityCustomer0" name="selectActivityCustomer0"
                        aria-label="Floating label select example">
                        <option selected>Abrir para seleccionar actividad</option>
                        <?php
                            $activities = new ActivitiesController();
                            $response = $activities->GetAllActivities();
                            foreach($response as $key => $value){
                                echo '<option id="Cuota'.$value["name"].'" name="'.$value["name"].'" value="'.$value["name"].'">'.$value["name"].'</option>';
                            }
                        ?>
                    </select>
                    <label for="floatingSelect">Seleccionar actividad</label>
                </div>
                <div class="form-floating mb-3 containerDays col-md-5 float-left">
                    <select class="form-select" id="selectDaysCustomer0" name="selectDaysCustomer0"
                        aria-label="Floating label select example">
                        <option selected>Abrir para seleccionar dias</option>
                        <?php
                            //modificar para que aparezcan solo los dias dispobiles de las actividades
                            $cuotas = new CuotasController();
                            $response = $cuotas->GetDays();
                            foreach($response as $key => $value){
                                echo '<option name="'.$value["number"].'-day" value="'.$value["number"].'">'.$value["number"].' dias</option>';
                            }
                        ?>
                    </select>
                    <label for="floatingSelect">Seleccionar dias</label>
                </div>
                <div class="clearfix addActivitiesAndCuotas float-left" id="addActivitiesAndCuotas">
                </div>
                <div id="actionsActivitiesInput">
                    <button class="btn btn-primary" onclick="AddActivitiesInput()"><i class="fa fa-plus"></i></button>
                    <button class="btn btn-primary" onclick="DeleteActivitiesInput()"><i class="fa fa-minus"></i></button>
                </div>
                <div class="form-group datePickerBox">
                    <div class="col-xs-12 col-sm-12 col-lg-12 col-xl-12">
                        <div class="input-group date col-xs-12" id="datepicker">
                            <input type="text" class="form-control">
                            <span class="input-group-append">
                                <span class="input-group-text bg-white d-block">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-floating mb-3 containerState col-md-12 float-left">
                    <select class="form-select" id="selectStateCustomer" name="selectStateCustomer"
                        aria-label="Floating label select example">
                        <option selected>Seleccionar estado</option>
                        <option name="payed" value="Pago">Pago</option>
                        <option name="no-payed" value="No Pago">No Pago</option>
                    </select>
                    <label for="floatingSelect">Seleccionar estado</label>
                </div>
                <!-- Quitar observaciones -->
                <!--<div class="form-floating mb-3 containerObservations col-xs-12 col-md-12 col-lg-12 col-xl-12 float-left">
                    <textarea class="form-control" placeholder="Deja alguna observacion aca"
                        name="observationsCustomerInput" id="observationsCustomerInput" style="height: 150px;"></textarea>
                    <label for="observationsCustomerInput">Observaciones</label>
                </div>-->
                <!-- <input type="submit" class="btn btn-lg btn-primary m-2" value="Agregar"> -->

                <button class="btn btn-lg btn-primary m-2" onclick="RegisterCustomer()">Agregar</button>

            <!--</form>-->
        </div>
    </div>
</div>