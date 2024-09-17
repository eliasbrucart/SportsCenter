<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4 adminModule">
    <div class="col-md-4 col">
        <a href="<?php echo $url; ?>views/modules/reports/reports_module.php?report=customers">
            <button class="btn btn-success">Descargar reporte en Excel</button>
        </a>
    </div>
    <br>
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Usuarios</h6>
            <!--<a href="">Show All</a>-->
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0 usersTable">
                <thead>
                    <tr class="text-white">
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Actividades</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Monto</th>
                        <th scope="col">Vencimiento</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>

                <!--<tbody>
                    <tr>
                        <td>Elias</td>
                        <td>Brucart</td>
                        <td>+542392671348</td>
                        <td>Pago</td>
                        <td>
                            <button type="button" class="btn btn-info m-2">Editar</button>
                            <button type="button" class="btn btn-warning m-2">Avisar Pago</button>
                            <button type="button" class="btn btn-success m-2">Pago</button>
                            <button type="button" class="btn btn-danger m-2">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Lautaro</td>
                        <td>Brucart</td>
                        <td>+542392632080</td>
                        <td>Pago</td>
                        <td>
                            <button type="button" class="btn btn-info m-2">Editar</button>
                            <button type="button" class="btn btn-warning m-2">Avisar Pago</button>
                            <button type="button" class="btn btn-success m-2">Pago</button>
                            <button type="button" class="btn btn-danger m-2">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Andrea Fabiana</td>
                        <td>Bossa</td>
                        <td>+542392636637</td>
                        <td>Pago</td>
                        <td>
                            <button type="button" class="btn btn-info m-2">Editar</button>
                            <button type="button" class="btn btn-warning m-2">Avisar Pago</button>
                            <button type="button" class="btn btn-success m-2">Pago</button>
                            <button type="button" class="btn btn-danger m-2">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Lautaro</td>
                        <td>Brucart</td>
                        <td>+542392632080</td>
                        <td>Pago</td>
                        <td>
                            <button type="button" class="btn btn-info m-2">Editar</button>
                            <button type="button" class="btn btn-warning m-2">Avisar Pago</button>
                            <button type="button" class="btn btn-success m-2">Pago</button>
                            <button type="button" class="btn btn-danger m-2">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Lautaro</td>
                        <td>Brucart</td>
                        <td>+542392632080</td>
                        <td>Pago</td>
                        <td>
                            <button type="button" class="btn btn-info m-2">Editar</button>
                            <button type="button" class="btn btn-warning m-2">Avisar Pago</button>
                            <button type="button" class="btn btn-success m-2">Pago</button>
                            <button type="button" class="btn btn-danger m-2">Eliminar</button>
                        </td>
                    </tr>
                </tbody>-->
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->

<div id="editCustomerModal" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- Header modal -->
            <div class="modal-header" style="background:#4b4b4b; color:white">

                <h4 class="modal-title">Editar Usuario</h4>
                
                <button type="button" onclick="ClearEditModal()" class="close" data-dismiss="modal">&times;</button>

            </div>
            <!-- Fin Header modal -->

            
            <div class="modal-body" style="background:#252525;">

                <div class="box-body">

                    <div class="form-group">

                        <p class="" name="idCustomer">Identificador: <span id="idCustomer"></span></p>

                        <div class="form-floating mb-3">

                            <input type="text" class="form-control" id="newNameCustomer" name="newNameCustomer" placeholder="Nombre"
                            value="">

                            <label for="newNameCustomer">Nombre</label>

                        </div>

                        <div class="form-floating mb-3">

                            <input type="text" class="form-control" id="newLastNameCustomer" name="newLastNameCustomer" placeholder="Apellido"
                            value="">

                            <label for="newLastNameCustomer">Apellido</label>

                        </div>

                        <!--<div class="form-floating mb-3">

                            <input type="text" class="form-control" id="newPhoneCustomer" name="newPhoneCustomer" placeholder="Telefono"
                            value="">

                            <label for="newPhoneCustomer">Telefono</label>

                        </div>-->

                        <div class="form-floating mb-3">

                            <input type="text" class="form-control" id="newDocumentCustomer" name="newDocumentCustomer" placeholder="Documento"
                            value="">

                            <label for="newDocumentCustomer">Documento</label>

                        </div>

                        <div class="getActivitiesAndCuotas" id="getActivitiesAndCuotas">

                        </div>

                        <div class="AddOrDeleteActivities">
                            <button class="btn btn-primary" onclick="AddActivitiesOnEdit()"><i class="fa fa-plus"></i></button>
                            <button class="btn btn-primary" onclick="DeleteActivitiesOnEdit()"><i class="fa fa-minus"></i></button>
                        </div>

                        <!--<div class="form-floating mb-3">

                            <select class="form-select" id="newTypeCustomer" name="newTypeCustomer"
                            aria-label="Floating label select example">
                                <option selected>Abrir para seleccionar tipo</option>
                                <option name="alumno" value="alumno">Alumno</option>
                                <option name="profesor" value="profesor">Profesor</option>
                                <option name="owner" value="dueño">Dueño</option>
                            </select>
                            <label for="newTypeCustomer">Seleccionar tipo</label>

                        </div>-->

                        <!--<div class="form-floating mb-3">

                            <textarea class="form-control" placeholder="Observaciones"
                            name="newObservationsCustomer" id="newObservationsCustomer" style="height: 150px;"></textarea>
                            <label for="newObservationsCustomer">Observaciones</label>
                        </div>-->

                    </div>

                </div>

            </div>

            <div class="modal-footer" style="background:#252525;">

                <button type="button" onclick="SendEditedCustomer()" class="btn btn-success m-2 saveEditedCustomer" id="saveEditedCustomer">Guardar</button>

            </div>

        </div>

    </div>

</div>

<div id="deleteCustomerModal" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">
            <!-- Header modal -->
            <div class="modal-header" style="background:#4b4b4b; color:white">

                <h4 class="modal-title">Eliminar Usuario</h4>
                
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <!-- Fin Header modal -->

            <div class="modal-body" style="background:#252525;">

                <div class="box-body">

                    <h3>Usuario a eliminar: <span id="idCustomerToDelete"></span></h3>

                    <p class="text-white">Nombre: <span id="nameCustomerToDelete"></span></p>

                    <p class="text-white">Apellido: <span id="lastNameCustomerToDelete"></span></p>

                    <p class="text-white">Telefono: <span id="phoneCustomerToDelete"></span></p>

                    <p class="text-white">Documento: <span id="documentCustomerToDelete"></span></p>

                    <!-- Descomentar si es que se utiliza el tipo -->
                    <!--<p class="text-white">Tipo: <span id="typeCustomerToDelete"></span></p>-->

                </div>

            </div>

            <div class="modal-footer" style="background:#252525;">

                <button type="button" class="btn btn-danger m-2 deleteCustomer" onclick="DeleteCustomer()" id="deleteCustomer">Eliminar</button>

            </div>
        </div>

    </div>

</div>

<div id="paymentStory" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header" style="background:#4b4b4b; color:white">

                <h4 class="modal-title">Historial de Pagos</h4>

                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>

            </div>

            <div class="modal-body" style="background:#252525;">

                <p>Identificador: <span id="historyPaymentId"></span></p>

                <div class="form-floating mb-3">

                    <select class="form-select" id="selectMonths" name="selectMonths"
                        aria-label="Floating label select example">
                        <option selected>Abrir para seleccionar dias</option>
                        <?php
                            $monthsArray = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                            for($i = 0; $i < count($monthsArray); $i++){
                                echo '<option value="'.$i.'">'.$monthsArray[$i].'</option>';
                            }
                        ?>
                    </select>

                    <label for="floatingSelect">Seleccionar dias</label>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="paymentStateBox">
                    <h5>Estado <p style="color: green; text-align:center;" id="stateText"></p></h5>
                    <p id="datePayment"></p>
                    <p id="amountPayment"></p>
                    <div style="text-align:center;" class="buttonsContainer">
                        <button type="button" class="btn btn-success" onclick="ChangeStateMonth(2)">Marcar como Pago</button>
                        <button type="button" class="btn btn-primary" onclick="ChangeStateMonth(1)">Marcar como No Pago</button>
                    </div>
                </div>

            </div>

            <div class="modal-footer" style="background:#252525;">

                <button type="button" class="btn btn-success" id="saveCustomerHistory">Guardar</button>

            </div>

        </div>

    </div>

</div>