<!-- Spinner Start -->
<div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<div class="container-fluid">
    <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <a href="#" class="">
                        <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Wellness Group</h3>
                    </a>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control documentCustomerInput" id="documentCustomerInput" name="documentCustomerInput" placeholder="Documento">
                    <label for="floatingInput">Documento</label>
                </div>
                <div class="form-floating mb-3 customerData">
                    <h3 class="customerName"></h3>
                    <p>Dias restantes: <span class="customerDaysLeft text-white"></span></p>
                    <p>Su pase vence el: <span class="customerExpiration text-white"></span></p>
                    <p>Proximo monto a pagar: <span class="customerAmount text-white"></span></p>
                </div>
                <div class="form-floating mb-3 customerDataError">
                    <h3 class="text-danger font-weight-bold customerDocumentError">Error al ingresar!</h3>
                    <p class="text-white">Revisa que el documento sea correcto!</p>
                </div>
                <button class="btn btn-primary py-3 w-100 mb-4" id="incomeButton" onclick="Inocme()">Ingresar</button>
            </div>
        </div>
    </div>
</div>
<!-- Spinner End -->