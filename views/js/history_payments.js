function GetHistoryPaymentCustomer(id){
    $('#paymentStateBox').hide();
    setTimeout(function(){
        $('#historyPaymentId').text(id);
    }, 2000);

    $('#selectMonths').on("change", function(){
        //alert("Cambio al mes de: " + $('#selectMonths').val());

        var monthSelected = $('#selectMonths').val();
    
        var validateData = new FormData();
        validateData.append("idCustomerHistory", id);
        validateData.append("monthSelectedToCheck", monthSelected);
    
        $.ajax({
            url:hiddenPath+"ajax/history_payments_ajax.php",
            method: "POST",
            data: validateData,
            cache: false,
            contentType: false,
            processData: false,
            success: (response) => {
                var parsedResponse = JSON.parse(response);
                console.log("month selected " + parsedResponse.state);

                $('#paymentStateBox').show();
                $('#stateText').text(parsedResponse.state);

                switch(parsedResponse.state){
                    case "Pago":
                        $('#stateText').css('color', 'green');
                        $('#datePayment').show();
                        $('#amountPayment').show();
                        $('#datePayment').text("Fecha de Pago: " + parsedResponse.daysOfPayment);
                        $('#amountPayment').text("Monto: " + parsedResponse.amount);
                        break;
                    case "No Pago":
                        $('#stateText').css('color', 'red');
                        $('#datePayment').hide();
                        $('#amountPayment').hide();
                        break;
                    case "No hay registro":
                        $('#stateText').css('color', 'red');
                        $('#datePayment').hide();
                        $('#amountPayment').hide();
                        break;
                }
            }
        })
    });
}

function ChangeStateMonth(state){
    var idCustomer = $('#historyPaymentId').text();
    var monthSelected = $('#selectMonths').val();

    var validateData = new FormData();
    validateData.append("idCustomerToChangeState", idCustomer);
    validateData.append("monthToChangeState", monthSelected);
    validateData.append("newStateMonth", state);

    var validateAmount = new FormData();
    validateAmount.append("idCustomerGetAmount", idCustomer);

    var actualDate = "";
    var amountCustomer = 0;
    //Registrar la fecha de hoy
    if(state == 2){
        var date = new Date();
        var monthConvertedToCalendar = date.getMonth()+1;
        actualDate = monthConvertedToCalendar+"/"+date.getDate()+"/"+date.getFullYear();

        console.log("Actual date ChangeStateMonth ", actualDate);

        setTimeout(function(){
            $.ajax({
                url:hiddenPath+"ajax/admin_module_ajax.php",
                method: "POST",
                data: validateAmount,
                cache: false,
                contentType: false,
                processData: false,
                success:(response)=>{
                    amountCustomer = response;
                    console.log("Customer amount on ChangeStateMonth ", amountCustomer);
                }
            });
        }, 500);
    }else{
        actualDate = "Null";
        amountCustomer = null;
    }

    setTimeout(function(){
    validateData.append("actualMonthDateChanged", actualDate);
    validateData.append("actualMonthCustomerAmount", amountCustomer);
        $.ajax({
            url:hiddenPath+"ajax/history_payments_ajax.php",
            method: "POST",
            data: validateData,
            cache: false,
            contentType: false,
            processData: false,
            success:(response)=>{
                console.log("Mes modificado " + response);
                if(response == "false"){
                    swal({
                        title: "ERROR!",
                        text: "¡Surgio un error al marcar el mes como pago!",
                        type:"error",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                      });
                }else{
                    swal({
                        title: "OK!",
                        text: "¡El mes se marco como pago!",
                        type:"success",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });
                }
            }
        });
    }, 1000);
}