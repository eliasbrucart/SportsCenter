function UploadActivity(){
    var nameActivity = $("#nameActivityInput").val();

    var validateData = new FormData();
    validateData.append("nameActivity", nameActivity);

    $.ajax({
        url:hiddenPath+"ajax/activities_module_ajax.php",
        method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
        success:(response) => {
            if (response != "false" && response != "null") {
                alert("Actividad agregada correctamente!");
            } else if(response == "false" && response != "null") {
                alert("La actividad ya esta agregada!");
            }else if(response == "null"){
                alert("¡Error al agregar el usuario! Intentelo nuevamente!");
            }
        }
    });
}

//Error que edita siempre la primera
//Pasar por parametros el Id, nombre
//Ver como solucionamos el tema de seleccionar los dias y el precio
function UploadCuota(id, name){
    //var idActivity = $('#idActivityInput').val();
    //var nameCuotaInput = $('#activityTitle').text();
    //var selectCuotaDays = $('#selectCuotaDays'+id).val();
    //var cuotaPriceInput = $('#cuotaPriceInput').val();

    var selectCuotaDays = $('#selectCuotaDays'+id).val();
    var cuotaPriceInput = $('#cuotaPriceInput'+id).val();

    console.log("id ", id);
    console.log("name ", name);
    console.log("days ", selectCuotaDays);
    console.log("price ", cuotaPriceInput);

    var validateData = new FormData();
    validateData.append("idActivity", id);
    validateData.append("nameCuota", name);
    validateData.append("cuotaDays", selectCuotaDays);
    validateData.append("cuotaPrice", cuotaPriceInput);

    $.ajax({
        url:hiddenPath+"ajax/activities_module_ajax.php",
        method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
        success:(response) => { //De esta manera se puede escribir una funcion "flecha" que es mas simple
            console.log("respuesta " + response);
            if(response == "false"){
                console.log("respuesta " + response);
				setTimeout(function(){
                    swal({
                        title: "ERROR!",
                        text: "¡No se pudo agregar la cuota para la actividad! Intentelo nuevamente!",
                        type:"error",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                      }, function(){
                        location.reload();
                      });
                }, 2000);
			}else{
                console.log("respuesta " + response);
				setTimeout(function(){
                    swal({
                        title: "OK!",
                        text: "¡Se agrego con exito la cuota correspondiente!",
                        type:"success",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                      }, function(){
                        location.reload();
                      });
                }, 2000);
			}
        }
    });
}

function ShowActivityData(id, name){
    setTimeout(function(){
        $('#idActivityToEdit').text(id);
        $('#newNameActivity').val(name);
    }, 2000);
}

function EditActivity(){
    var idActivity = $('#idActivityToEdit').text();
    var nameActivity = $('#newNameActivity').val();

    var validateData = new FormData();
    validateData.append("idActivityToEdit", idActivity);
    validateData.append("newNameActivity", nameActivity);

    $.ajax({
        url:hiddenPath+"ajax/activities_module_ajax.php",
        method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
        success:(response) => {
            if(response == "false"){
                setTimeout(function(){
                    swal({
                        title: "ERROR!",
                        text: "¡No se pudo editar la actividad seleccionada!",
                        type:"error",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                      }, function(){
                        location.reload();
                      });
                }, 2000);
            }else{
                setTimeout(function(){
                    swal({
                        title: "OK!",
                        text: "¡La actividad se edito con exito!",
                        type:"success",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                      }, function(){
                        location.reload();
                      });
                }, 2000);
            }
        }
    });
}

function ShowActivityToDelete(id, name){
    var validateData = new FormData();
    validateData.append("idToCheckCuotas", id);

    $.ajax({
        url:hiddenPath+"ajax/activities_module_ajax.php",
        method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
        success:(response) => {
            var parseResponse = JSON.parse(response);
            for(var i = 0; i < parseResponse.length; i++){
                $('#cuotasInfoBox').append('<p class="col-md-6 float-left"><span id="daysCuotaAsociated">'+parseResponse[i].days+'</span> Dias</p>');
                $('#cuotasInfoBox').append('<p class="col-md-6 float-left">$<span id="priceCuotaAsociated">'+parseResponse[i].price+'</span></p>');
            }
        }
    });

    setTimeout(function(){
        $('#idActivityToDelete').text(id);
        $('#nameActivityToDelete').text(name);
    }, 2000);
}

function CleanActivityDivs(){
    $('#cuotasInfoBox').empty();
}

function DeleteActivity(){
    var idActivity = $('#idActivityToDelete').text();

    var validateData = new FormData();
    validateData.append("idActivityToDelete", idActivity);

    $.ajax({
        url:hiddenPath+"ajax/activities_module_ajax.php",
        method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
        success:(response) => {
            if(response == "false"){
                setTimeout(function(){
                    swal({
                        title: "ERROR!",
                        text: "¡No se pudo eliminar la actividad seleccionada!",
                        type:"error",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                      }, function(){
                        location.reload();
                      });
                }, 2000);
            }else{
                setTimeout(function(){
                    swal({
                        title: "OK!",
                        text: "¡La actividad se elimino con exito!",
                        type:"success",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                      }, function(){
                        location.reload();
                      });
                }, 2000);
            }
        }
    });
}

function ShowCuotaToEdit(id, days, price){
    setTimeout(function(){
        $('#idCuotaToEdit').text(id);
        $('#selectNewCuotaDays').val(days);
        $('#newPriceCuota').val(price);
    }, 2000);
}

function EditCuota(){
    var idCuota = $('#idCuotaToEdit').text();
    var daysCuota = $('#selectNewCuotaDays').val();
    var priceCuota = $('#newPriceCuota').val();

    var validateData = new FormData();
    validateData.append("idCuotaToEdit", idCuota);
    validateData.append("newDaysCuota", daysCuota);
    validateData.append("newPriceCuota", priceCuota);

    $.ajax({
        url:hiddenPath+"ajax/activities_module_ajax.php",
        method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
        success:(response) => {
            if(response == "false"){
                setTimeout(function(){
                    swal({
                        title: "ERROR!",
                        text: "¡No se pudo editar la cuota seleccionada!",
                        type:"error",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                      }, function(){
                        location.reload();
                      });
                }, 2000);
            }else{
                setTimeout(function(){
                    swal({
                        title: "OK!",
                        text: "¡La cuota se edito con exito!",
                        type:"success",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                      }, function(){
                        location.reload();
                      });
                }, 2000);
            }
        }
    });
}

function ShowCuotaToDelete(id, days, price, activity){
    setTimeout(function(){
        $('#idCuotaToDelete').text(id);
        $('#fatherActivity').text(activity);
        $('#daysCuotaToDelete').text(days);
        $('#priceCuotaToDelete').text(price);
    }, 2000);
}

function DeleteCuota(){
    var idCuotaToDelete = $('#idCuotaToDelete').text();

    var validateData = new FormData();
    validateData.append("idCuotaToDelete", idCuotaToDelete);

    $.ajax({
        url:hiddenPath+"ajax/activities_module_ajax.php",
        method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
        success:(response) => {
            if(response == "false"){
                setTimeout(function(){
                    swal({
                        title: "ERROR!",
                        text: "¡No se pudo eliminar la cuota seleccionada!",
                        type:"error",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                      }, function(){
                        location.reload();
                      });
                },2000);
            }else{
                setTimeout(function(){
                    swal({
                        title: "OK!",
                        text: "¡La cuota se elimino con exito!",
                        type:"success",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                      }, function(){
                        location.reload();
                      });
                }, 2000);
            }
        }
    });
}