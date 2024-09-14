/*$.ajax({

 	url:hiddenPath+"ajax/admin_module_ajax.php",
 	success:function(respuesta){
		
 		console.log("respuesta", respuesta);
	}

})*/

var inputIndex = 0;
var inputEditActivity = 0;

$('.usersTable').DataTable({

    "ajax":hiddenPath+"ajax/table_admin_ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
    "language":{

        "sProcessing":     "Procesa ndo...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}
    }
});

//Agregar como parametro los datos de estado, dias y actividades

function EditCustomer(id, name, lastname, phone, document, activities, days){
	console.log("id customer: ", id);

	var validateData = new FormData();
	validateData.append("idCustomerGetActivities", id);

	var validateDaysCustomer = new FormData();
	validateDaysCustomer.append("idCustomerGetDays", id);

	var customerDays = [];

	var validateData2 = new FormData();
	validateData2.append("getActivities", true);

	var allActivitiesArray = [];
	var allDaysArray = [];

	$.ajax({
		url:hiddenPath+"ajax/admin_module_ajax.php",
		method: "POST",
		data: validateData2,
		cache: false,
		contentType: false,
		processData: false,
		success:(response) => {
			var parseActivitiesJson = JSON.parse(response);
			for(var i = 0; i < parseActivitiesJson.length; i++){
				allActivitiesArray[i] = parseActivitiesJson[i].name;
			}
		}
	});

	var validateDays = new FormData();
	validateDays.append("getDays", true);

	$.ajax({
		url:hiddenPath+"ajax/admin_module_ajax.php",
        method: "POST",
		data: validateDays,
		cache: false,
		contentType: false,
		processData: false,
		success:(response) => {
			var parseDaysJson = JSON.parse(response);
			for(var i = 0; i < parseDaysJson.length; i++){
				allDaysArray[i] = parseDaysJson[i].number;
			}
		}
	});

	$.ajax({
		url:hiddenPath+"ajax/admin_module_ajax.php",
		method: "POST",
		data: validateDaysCustomer,
		cache: false,
		contentType: false,
		processData: false,
		success:(response)=>{
			var parseResponseDays = JSON.parse(response);
			for(var i = 0; i < parseResponseDays.length; i++){
				customerDays[i] = parseResponseDays[i];
			}
		}
	});

	setTimeout(function(){
		$('#idCustomer').text(id);
		$('#newNameCustomer').val(name);
		$('#newLastNameCustomer').val(lastname);
		$('#newPhoneCustomer').val(phone);
		$('#newDocumentCustomer').val(document);

		$.ajax({
			url:hiddenPath+"ajax/admin_module_ajax.php",
			method: "POST",
			data: validateData,
			cache: false,
			contentType: false,
			processData: false,
			success:(response)=>{
				//console.log("response edit customer " + response);
				var parseResponseActivities = JSON.parse(response);
				for(var i = 0; i < parseResponseActivities.length; i++){
					console.log("inputEditActivity en for " + inputEditActivity);
					var activitiesInput = '<div class="form-floating mb-3 col-md-7 float-left" id="boxActivitiesCustomerEdit'+inputEditActivity+'">';
					activitiesInput += '<select class="form-select" id="selectActivityCustomerEdit'+inputEditActivity+'" name="selectActivityCustomerEdit'+inputEditActivity+'" aria-label="Floating label select example">';
					for(var j = 0; j < allActivitiesArray.length; j++){
						if(allActivitiesArray[j] != parseResponseActivities[i]){
							activitiesInput += '<option>'+allActivitiesArray[j]+'</option>';
						}else{
							activitiesInput += '<option selected>'+allActivitiesArray[j]+'</option>';
						}
					}
					activitiesInput += '</select>';
					activitiesInput += '<label for="floatingSelect">Seleccionar actividad</label>';
					activitiesInput += '</div>';

					var daysInput = '<div class="form-floating mb-3 containerDays col-md-5 float-left" id="boxDaysCustomerEdit'+inputEditActivity+'">';
					daysInput += '<select class="form-select" id="selectDaysCustomerEdit'+inputEditActivity+'" name="selectDaysCustomerEdit'+inputEditActivity+'" aria-label="Floating label select example">';
					for(var k = 0; k < allDaysArray.length; k++){
						if(allDaysArray[k] != customerDays[i]){
							daysInput += '<option>'+allDaysArray[k]+'</option>';
						}else{
							daysInput += '<option selected>'+allDaysArray[k]+'</option>';
						}
					}
					daysInput += '</select>';
					daysInput += '<label for="floatingSelect">Seleccionar dias</label>';
					daysInput += '</div>';

					$('#getActivitiesAndCuotas').append(activitiesInput);
					$('#getActivitiesAndCuotas').append(daysInput);

					inputEditActivity++;

					if(inputEditActivity == parseResponseActivities.length){
						inputEditActivity--;
					}
				}
			}
		});

		//Si hay tipo descomentar y pasar type por parametro
		//$('#newTypeCustomer').val(type);
		//Si hay observaciones descomentar y pasar observations por parametro
		//$('#newObservationsCustomer').val(observations);
	}, 2000);

	//consultar las actividades que tiene el usuario por id a travez de ajax
}

function AddActivitiesOnEdit(){
	inputEditActivity++;

	console.log("inputEditActivity en funcion " + inputEditActivity);

	var validateActivities = new FormData();
	validateActivities.append("getActivities", true);

	$.ajax({
		url:hiddenPath+"ajax/admin_module_ajax.php",
		method: "POST",
		data: validateActivities,
		cache: false,
		contentType: false,
		processData: false,
		success:(response) => {
			var parseActivitiesJson = JSON.parse(response);
			var divActivity = '<div class="form-floating mb-3 col-md-7 float-left" id="boxActivitiesCustomerEdit'+inputEditActivity+'">';
			divActivity += '<select class="form-select" id="selectActivityCustomerEdit'+inputEditActivity+'" name="selectActivityCustomerEdit'+inputEditActivity+'" aria-label="Floating label select example">';
			divActivity += '<option selected>Abrir para seleccionar actividad</option>';

			for(var i = 0; i < parseActivitiesJson.length; i++){
				divActivity += '<option name='+parseActivitiesJson[i].name+' value='+parseActivitiesJson[i].name+'>'+parseActivitiesJson[i].name+'</option>';
			}

			divActivity += '</select></div>';

			$('#getActivitiesAndCuotas').append(divActivity);
		}
	});

	var validateDays = new FormData();
	validateDays.append("getDays", true);

	$.ajax({
		url:hiddenPath+"ajax/admin_module_ajax.php",
        method: "POST",
		data: validateDays,
		cache: false,
		contentType: false,
		processData: false,
		success:(response) => {
			var parseDaysJson = JSON.parse(response);

			var divDays = '<div class="form-floating mb-3 col-md-5 float-left" id="boxDaysCustomerEdit'+inputEditActivity+'">';
			divDays += '<select class="form-select" id="selectDaysCustomerEdit'+inputEditActivity+'" name="selectDaysCustomerEdit'+inputEditActivity+'" aria-label="Floating label select example">';
			divDays += '<option selected>Abrir para seleccionar dias</option>';

			for(var i = 0; i < parseDaysJson.length; i++){
				divDays += '<option name="'+parseDaysJson[i].number+'-day" value="'+parseDaysJson[i].number+'">'+parseDaysJson[i].number+' dias</option>';
			}

			divDays += '</select></div>';

			$('#getActivitiesAndCuotas').append(divDays);

		}
	});
}

function DeleteActivitiesOnEdit(){
	if(inputEditActivity > 0){
		$('#getActivitiesAndCuotas').children('#boxActivitiesCustomerEdit'+inputEditActivity).remove();
		$('#getActivitiesAndCuotas').children('#boxDaysCustomerEdit'+inputEditActivity).remove();
		inputEditActivity--;
	}
}

function ClearEditModal(){
	$('#getActivitiesAndCuotas').empty();
}

function SendEditedCustomer(){
	var idCustomer = $('#idCustomer').text(); //Revisar si cambiar a text()
	var nameCustomer = $('#newNameCustomer').val();
	var lastNameCustomer = $('#newLastNameCustomer').val();
	//var phoneCustomer = $('#newPhoneCustomer').val();
	var documentCustomer = $('#newDocumentCustomer').val();
	//var typeCustomer = $('#newTypeCustomer').val();
	//var observationsCustomer = $('#newObservationsCustomer').val();

	//Lipiamos el texto para evitar que se suba mal a la base de datos
	//var cleanObservationsCustomer = observationsCustomer.replace(/([+*=/_-]|\r\n|\n|\r)/gm, " ");

	//console.log(cleanObservationsCustomer);

	const editedActivites = [];
	const editedDays = [];

	editedActivites[0] = $('#selectActivityCustomerEdit0').val();
	editedDays[0] = $('#selectDaysCustomerEdit0').val();

	console.log("EditedActivitiesArr 0 " + editedActivites[0]);
	console.log("EditedDaysArr 0 " + editedDays[0]);

	if(inputEditActivity > 0){
		for(var i = 1; i <= inputEditActivity; i++){
			editedActivites[i] = $('#selectActivityCustomerEdit'+i).val();
			editedDays[i] = $('#selectDaysCustomerEdit'+i).val();
			
			console.log("EditedActivitiesArr " + i + editedActivites[i]);
			console.log("EditedDaysArr " + i + editedDays[i]);
		}
	}

	var editedActivitiesCustomer = JSON.stringify(Object.assign({}, editedActivites));
	var editedDaysCustomer = JSON.stringify(Object.assign({}, editedDays));

	var validateData = new FormData();
	validateData.append("idToEdit", idCustomer);
	validateData.append("editedNameCustomer", nameCustomer);
	validateData.append("editedLastNameCustomer", lastNameCustomer);
	//validateData.append("editedPhoneCustomer", phoneCustomer);
	validateData.append("editedDocumentCustomer", documentCustomer);
	validateData.append("editedActivitiesCustomer", editedActivitiesCustomer);
	validateData.append("editedDaysCustomer", editedDaysCustomer);
	//validateData.append("editedTypeCustomer", typeCustomer);
	//validateData.append("editedObservationsCustomer", cleanObservationsCustomer);

	$.ajax({
		url:hiddenPath+"ajax/admin_module_ajax.php",
        method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
		success:function(response){
			if(response == "false"){
				setTimeout(function(){
                    swal({
                        title: "ERROR!",
                        text: "¡No se pudo editar el usuario, intentalo nuevamente",
                        type:"error",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                      });
                }, 2000);
			}else{
				console.log("respuesta " + response);
				setTimeout(function(){
                    swal({
                        title: "OK!",
                        text: "¡El usuario se edito con exito!",
                        type:"success",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                      });
                }, 2000);
			}
		}
	})
}

function ShowCustomerInfoToDelete(id, name, lastname, phone, document, type){
	setTimeout(function(){
		$('#idCustomerToDelete').text(id);
		$('#nameCustomerToDelete').text(name);
		$('#lastNameCustomerToDelete').text(lastname);
		$('#phoneCustomerToDelete').text(phone);
		$('#documentCustomerToDelete').text(document);
		$('#typeCustomerToDelete').text(type);
	}, 2000);
}

function DeleteCustomer(){
	var idCustomerToDelete = $('#idCustomerToDelete').text();

	var validateData = new FormData();
	validateData.append("idToDelete", idCustomerToDelete);

	$.ajax({
		url:hiddenPath+"ajax/admin_module_ajax.php",
        method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
		success:function(response){
			if(response == "false"){
				setTimeout(function(){
                    swal({
                        title: "ERROR!",
                        text: "¡No se pudo eliminar el usuario, intentalo nuevamente!",
                        type:"error",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                      });
                }, 2000);
			}else{
				console.log("respuesta " + response);
				setTimeout(function(){
                    swal({
                        title: "OK!",
                        text: "¡El usuario se elimino con exito!",
                        type:"success",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                      });
                }, 2000);
			}
		}
	});

}

function Pay(id){
	console.log("id cliente que pago: " + id);

	var validateData = new FormData();
	validateData.append("idCustomerPayed", id);
	validateData.append("statusCustomerPayed", "Pago");

	$.ajax({
		url:hiddenPath+"ajax/admin_module_ajax.php",
        method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
		success:function(response){
			if(response == "false"){
				setTimeout(function(){
                    swal({
                        title: "ERROR!",
                        text: "¡Surgio un error al marcar al usuario como pago, intentelo nuevamente!",
                        type:"error",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                      });
                }, 2000);
			}else{
				setTimeout(function(){
                    swal({
                        title: "OK!",
                        text: "¡El usuario se marco como pago exitosamente!",
                        type:"success",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                      });
                }, 2000);
			}
		}
	});

	//AddHistoryPaymentCustomer(id);
	PayActualMonth(id);

	var date = new Date();

	var convertMonthToCalendar = date.getMonth() + 1;

	var actualDate = convertMonthToCalendar+"/"+date.getDate()+"/"+date.getFullYear(); //Fecha de hoy

	CalculateNextExpiration(id, actualDate);
}

function AddHistoryPaymentCustomer(id, state){
	var validateData = new FormData();
	validateData.append("idCustomerPayed", id);
	//validateData.append("statusCustomerPayed", state);

	var months = [0,1,2,3,4,5,6,7,8,9,10,11];
	var states = [0,0,0,0,0,0,0,0,0,0,0,0];
	var dates = ["","","","","","","","","","","",""];
	var amounts = [0,0,0,0,0,0,0,0,0,0,0,0];

	var activitiesCustomerArray = [];
	var daysCustomerArray = [];
	
	const currentDate = new Date();
	
	const actualMonth = currentDate.getMonth();
	const actualMonthConverted = currentDate.getMonth() + 1;
	const actualDate = actualMonthConverted+"/"+currentDate.getDate()+"/"+currentDate.getFullYear();
	
	var validateAmountCustomer = new FormData();
	validateAmountCustomer.append("idCustomerGetAmount", id);
	
	var amountCustomer = 0;
	setTimeout(function(){
		$.ajax({
			url:hiddenPath+"ajax/admin_module_ajax.php",
			method: "POST",
			data: validateAmountCustomer,
			cache: false,
			contentType: false,
			processData: false,
			success: (response) => {
				console.log("respuesta get amount " + response);
				amountCustomer = response;
			}
		});
	}, 500);
	
	var stateToInt = 0;
	setTimeout(function(){
		switch(state){
			case "Pago":
				stateToInt = 2;
				dates[actualMonth] = actualDate;
				amounts[actualMonth] = amountCustomer;
				console.log("amounts array" + amounts[actualMonth]);
				break;
			case "No Pago":
				stateToInt = 1;
				amountCustomer = 0;
				break;
			default:
				stateToInt = 0;
				amountCustomer = 0;
				break;
		}
		states[actualMonth] = stateToInt;

		var monthsJson = JSON.stringify(Object.assign({}, months));
		var statesJson = JSON.stringify(Object.assign({}, states));
		var datesJson = JSON.stringify(Object.assign({}, dates));
		var amountsJson = JSON.stringify(Object.assign({}, amounts));

		//const actualMonth = currentDate.getMonth() + 1;

		//const actualDate = actualMonth+"/"+currentDate.getDate()+"/"+currentDate.getFullYear();

		validateData.append("monthsHistoryJson", monthsJson);
		validateData.append("statesHistoryJson", statesJson);
		validateData.append("datesHistoryJson", datesJson);
		validateData.append("amountsHistoryJson", amountsJson);

	}, 700);

	//console.log("activities in history ", activities);
	//console.log("days in history ", days);

	var validateActivities = new FormData();
	validateActivities.append("idCustomerGetActivities", id);

	setTimeout(function(){
		$.ajax({
			url:hiddenPath+"ajax/admin_module_ajax.php",
			method: "POST",
			data: validateActivities,
			cache: false,
			contentType: false,
			processData: false,
			success: (response) => {
				//activities = response;
				console.log("respuesta get activities " + response);
				var parseActivitiesJson = JSON.parse(response);
				for(var i = 0; i < parseActivitiesJson.length; i++){
					activitiesCustomerArray[i] = parseActivitiesJson[i];
				}
			}
		});
	}, 2000);

	var validateDaysCustomer = new FormData();
	validateDaysCustomer.append("idCustomerGetDays", id);

	setTimeout(function(){
		$.ajax({
			url:hiddenPath+"ajax/admin_module_ajax.php",
			method: "POST",
			data: validateDaysCustomer,
			cache: false,
			contentType: false,
			processData: false,
			success: (response) => {
				//days = response;
				console.log("respuesta get days " + response);
				var parseResponseDays = JSON.parse(response);
				for(var i = 0; i < parseResponseDays.length; i++){
					daysCustomerArray[i] = parseResponseDays[i];
				}
			}
		});
	}, 3500);

	var activitiesCustomer;
	var daysCustomer;

	setTimeout(function(){
		activitiesCustomer = JSON.stringify(Object.assign({}, activitiesCustomerArray));
		daysCustomer = JSON.stringify(Object.assign({}, daysCustomerArray));

		console.log("activities customer " + activitiesCustomer);
		console.log("days customer " + daysCustomer);

		validateData.append("activitiesCustomer", activitiesCustomer);
		validateData.append("daysCustomer", daysCustomer);

		const actualYear = currentDate.getFullYear();

		validateData.append("actualYear", actualYear);

		console.log("Actual year " + actualYear);

		$.ajax({
			url:hiddenPath+"ajax/history_payments_ajax.php",
			method: "POST",
			data: validateData,
			cache: false,
			contentType: false,
			processData: false,
			success:(response)=>{
				console.log("respuesta al crear el historial del usuario " + response);
			}
		});

	}, 4000);
}

function PayActualMonth(id){
	var date = new Date();
	var monthConvertedToCalendar = date.getMonth()+1;
	var actualDate = monthConvertedToCalendar+"/"+date.getDate()+"/"+date.getFullYear();
	var actualMonth = date.getMonth();

	console.log("Actual Date " + actualDate);
	console.log("Actual Month " + actualMonth);

	var validateData = new FormData();
	validateData.append("idCustomerToPayMonth", id);
	validateData.append("actualMonthToPay", actualMonth);
	validateData.append("actualDateToPay", actualDate);

	$.ajax({
		url:hiddenPath+"ajax/history_payments_ajax.php",
		method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
		success:(response)=>{
			console.log("El mes actual se marco como pago " + response);
		}
	});
}

function CalculateNextExpiration(id, actualDate){
	var nextExpiration = new Date(actualDate);
	nextExpiration.setDate(nextExpiration.getDate() + 30);

	const formatter = new Intl.DateTimeFormat('en-US', { day: '2-digit', month: '2-digit', year: 'numeric' });
	const formattedNewExpirationDate = formatter.format(nextExpiration);

	console.log("Proximo vencimiento " + formattedNewExpirationDate);

	//Actualizar proximo vencimiento

	var validateData = new FormData();
	validateData.append("idCustomerUpdateExpiration", id);
	validateData.append("newExpirationDateCustomer", formattedNewExpirationDate);

	$.ajax({
		url:hiddenPath+"ajax/admin_module_ajax.php",
		method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
		success:(response)=>{
			console.log("Se actualizo el proximo vencimiento " + response);
		}
	});
}

function RegisterCustomer(){
	var nameCustomer = $('#nameCustomerInput').val();
	var lastNameCustomer = $('#lastNameCustomerInput').val();
	var documentCustomer = $('#documentCustomerInput').val();
	var stateCustomer = $('#selectStateCustomer').val();
	var dayOfRegisterCustomer = $('#datepicker').children().val();
	//var activityCustomer = $('#selectActivityCustomer').val();
	//var daysCustomer = $('#selectDaysCustomer').val();
	//var expirationCustomer = $('#'); Habilitar esta linea y mandarlo por array cuando este el input para agregar fecha de expiracion

	const dateSelected = new Date(dayOfRegisterCustomer);
	const dateSelectedAux = new Date(dayOfRegisterCustomer);
	dateSelected.setDate(dateSelected.getDate() + 30);

	const formatter = new Intl.DateTimeFormat('en-US', { day: '2-digit', month: '2-digit', year: 'numeric' });
	const formattedDate = formatter.format(dateSelected);
	const formattedDateAux = formatter.format(dateSelectedAux);

	console.log("la expiracion es: " + formattedDate);

	const capturedActivities = [];
	const capturedDays = [];

	capturedActivities[0] = $('#selectActivityCustomer0').val();
	capturedDays[0] = $('#selectDaysCustomer0').val();

	//console.log("captured Activities 0 " + capturedActivities[0]);
	//console.log("captured days 0 " + capturedDays[0]);

	if(inputIndex > 0){
		for(var i = 1; i <= inputIndex; i++){
			capturedActivities[i] = $('#selectActivityCustomer'+i).val();
			capturedDays[i] = $('#selectDaysCustomer'+i).val();

			//console.log("captured Activities " + i + capturedActivities[i]);
			//console.log("captured days " + i + capturedDays[i]);
		}
	}

	//activityCustomer y daysCustomer hacerlos que almacenen un json con todas las actividades que se crearon

	var activitiesCustomer = JSON.stringify(Object.assign({}, capturedActivities));
	var daysCustomer = JSON.stringify(Object.assign({}, capturedDays));

	console.log("activityCustomer " + activitiesCustomer);
	console.log("capturedDays " + capturedDays);

	var validateData = new FormData();
	validateData.append("nameCustomerInput", nameCustomer);
	validateData.append("lastNameCustomerInput", lastNameCustomer);
	validateData.append("documentCustomerInput", documentCustomer);
	validateData.append("stateCustomer", stateCustomer);
	validateData.append("registrationDate", formattedDateAux);
	validateData.append("expirationDate", formattedDate);
	validateData.append("selectActivityCustomer", activitiesCustomer);
	validateData.append("selectDaysCustomer", daysCustomer);

	var registerCustomerState = true;

	$.ajax({
		url:hiddenPath+"ajax/admin_module_ajax.php",
        method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
		success:(response) => {
			console.log("respuesta " + response);
			if(response == "false" && response != "ok" && response != "null"){
				setTimeout(function(){
                    swal({
                        title: "ERROR!",
                        text: "¡Surgio un error al registrar el cliente!",
                        type:"error",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                      });
                }, 2000);
				registerCustomerState = false;
			}else if(response != "null" && response != "false"){
				setTimeout(function(){
                    swal({
                        title: "OK!",
                        text: "¡El usuario se registro correctamente!",
                        type:"success",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                      });
                }, 2000);
				registerCustomerState = true;
			}
			if(response != "ok" && response != "false" && response == "null"){
				alert("Debes completar los campos requeridos para registrar un cliente nuevo!");
			}
			//console.log("response " + response);
		}
	});

	if(registerCustomerState){
		//devolver el id del usuario que se acaba de crear chequeando que todos los datos que se acaban de ingresar sean iguales
		var idOfLastCustomerRegistered;
		validateData.append("getLastCustomerRegistered", true);

		setTimeout(function(){
			$.ajax({
				url:hiddenPath+"ajax/admin_module_ajax.php",
				method: "POST",
				data: validateData,
				cache: false,
				contentType: false,
				processData: false,
				success:(response)=>{
					//var parsedId = JSON.parse(response);
					console.log("id que obtuvimos despues de crear usuario " + response);
					idOfLastCustomerRegistered = response.replace(/\D/g,'');
					console.log("respuesta limpia de caracteres " + idOfLastCustomerRegistered);
				}
			})
		}, 2000);
		setTimeout(function(){
			AddHistoryPaymentCustomer(idOfLastCustomerRegistered, stateCustomer);
		}, 2500);

	}

	inputIndex = 0;
}

function AddActivitiesInput(){
	inputIndex++;

	/*if(inputIndex > 0){
		$('#actionsActivitiesInput').append('<button class="btn btn-primary" onclick="DeleteActivitiesInput('+inputIndex+')"><i class="fa fa-minus"></i></button>');
	}*/

	var validateData = new FormData();
	validateData.append("getActivities", true);

	$.ajax({
		url:hiddenPath+"ajax/admin_module_ajax.php",
        method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
		success:(response) => {
			var parseResponseActivities = JSON.parse(response);

			var divActivity = '<div class="form-floating mb-3 col-md-7 float-left" id="boxActivityCustomer'+inputIndex+'">';
			divActivity += '<select class="form-select" id="selectActivityCustomer'+inputIndex+'" name="selectActivityCustomer'+inputIndex+'" aria-label="Floating label select example">';
			divActivity += '<option selected>Abrir para seleccionar actividad</option>';

			for(var i = 0; i < parseResponseActivities.length; i++){
				divActivity += '<option name='+parseResponseActivities[i].name+' value='+parseResponseActivities[i].name+'>'+parseResponseActivities[i].name+'</option>';
			}

			divActivity += '</select></div>';

			$('#uploadCustomerInputBox').children('#addActivitiesAndCuotas').append(divActivity);
		}
	});

	var validateDays = new FormData();
	validateDays.append("getDays", true);

	$.ajax({
		url:hiddenPath+"ajax/admin_module_ajax.php",
        method: "POST",
		data: validateDays,
		cache: false,
		contentType: false,
		processData: false,
		success:(response)=>{
			var divDays = '<div class="form-floating mb-3 col-md-5 float-left" id="boxDaysCustomer'+inputIndex+'">';
			divDays += '<select class="form-select" id="selectDaysCustomer'+inputIndex+'" name="selectDaysCustomer'+inputIndex+'"aria-label="Floating label select example">';
			divDays += '<option selected>Abrir para seleccionar dias</option>';

			parseResponseDays = JSON.parse(response);

			for(var i = 0; i < parseResponseDays.length; i++){
				divDays += '<option name="'+parseResponseDays[i].number+'-day" value="'+parseResponseDays[i].number+'">'+parseResponseDays[i].number+' dias</option>';
			}

			divDays += '</select></div>';

			$('#uploadCustomerInputBox').children('#addActivitiesAndCuotas').append(divDays);

		}
	});

	console.log("inputIndex " + inputIndex);

}

function DeleteActivitiesInput(){
	if(inputIndex > 0){
		$('#addActivitiesAndCuotas').children('#boxActivityCustomer'+inputIndex).remove();
		$('#addActivitiesAndCuotas').children('#boxDaysCustomer'+inputIndex).remove();
		inputIndex--;
	}
}

$(function(){
	$('#datepicker').datepicker();
});

function ChangeExpirationCountValue(id, value){
	validateData = new FormData();
	validateData.append("ChangeExpirationCountValue", true);
	validateData.append("idCustomerChangeCountValue", id);
	var newValue = 0;
	if(value == 0){
		newValue = 1;
	}else{
		newValue = 0;
	}
	validateData.append("valueExpiration", newValue);

	$.ajax({
		url:hiddenPath+"ajax/admin_module_ajax.php",
		method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
		success:(response)=>{
			console.log("ChangeExpirationCountValue ", response);

			setTimeout(function(){
				location.reload();
			}, 500);
		}
	});
}