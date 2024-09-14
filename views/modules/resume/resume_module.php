<div class="container-fliud clearfix">

    <!--<div class="container">

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 resumeActivity float-left">
                
                <h3>Musculacion</h3>

                <h4>Aqui se muestra el monto total que genera cada actividad</h4>

                <h5>Total: <span id="totalActivity"></span></h5>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 resumeActivity float-left">
                
                <h3>x55</h3>

                <h4>Aqui se muestra el monto total que genera cada actividad</h4>

                <h5>Total: <span id="totalActivity"></span></h5>

            </div>

        </div>

    </div>-->

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 align-items-center justify-content-center">

        <div class="bg-secondary rounded h-100 p-4 resumeActivityBox">

            <h4>Seleccione actividad para ver el resumen</h4>

            <div class="form-floating mb-3">
                <select class="form-select" id="selectActivityResume" name="selectActivityResume"
                aria-label="Floating label select example">
                    <option selected>Abrir para seleccionar actividad</option>
                    <?php 
                    
                        $activities = new ActivitiesController();
                        $response = $activities->GetAllActivities();
                        foreach ($response as $key => $value) {
                            echo '<option value="'.$value["name"].'">'.$value["name"].'</option>';
                        }
                    
                    ?>
                </select>
                <label for="">Actividad</label>
            </div>
            
            <p>Resumen: <span class="resumeText"></span></p>

        </div>

    </div>

</div>