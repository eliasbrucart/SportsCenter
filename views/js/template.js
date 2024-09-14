var hiddenPath = $("#hiddenPath").val();

var actualPage = location.href; //se llama actualPage para diferenciarla del item de HardGameStore

$(".buttonLogin, .buttonRegister").click(function(){

	localStorage.setItem("actualPage", actualPage);

});

$('#panelBtn').on('click', function(){
	$('#panelBtn').addClass('active');
});

function CalculateExpiration(){
	var date = new Date();

	const actualDateToDBFormat = date.toLocaleDateString("en-US", { // you can use undefined as first argument
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
    });

	var validateData = new FormData();
	validateData.append("getAllCustomers", true);
	$.ajax({
		url:hiddenPath+"ajax/admin_module_ajax.php",
		method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
		success: (response)=>{
			console.log("Calculate Expiration " + response);

			var parseResponse = JSON.parse(response);

			console.log("pause Advise " + parseResponse[0].pauseAdvise);

			for(var i = 0; i < parseResponse.length; i++){
				if(parseResponse[i].pauseAdvise == 0){
					if(parseResponse[i].expiration <= actualDateToDBFormat && parseResponse[i].state == "Pago"){
						console.log("El usuario "+parseResponse[i].id+" tiene vencida la cuota!");
						SetCustomerExpired(parseResponse[i].id);
					}
				}else{
					console.log("El usuario "+parseResponse[i].id+" tiene pausado el aviso!");
				}

				CalculateCustomerAmounts(parseResponse[i].id);
			}
		}
	});
}

function SetCustomerExpired(id){
	var validateData = new FormData();
	validateData.append("setCustomerExpired", true);
	validateData.append("idCustomerSetExpired", id);
	validateData.append("expiredValue", "No Pago");

	$.ajax({
		url:hiddenPath+"ajax/admin_module_ajax.php",
		method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
		success: (response)=>{
			console.log("SetCustomerExpired " + response);
		}
	});
}


function CalculateCustomerAmounts(id){
	var validateData = new FormData();
	validateData.append("calculateCustomerAmounts", true);
	validateData.append("idCustomerToCalculate", id);

	$.ajax({
		url:hiddenPath+"ajax/admin_module_ajax.php",
		method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
		success: (response)=>{
			console.log("CalculateCustomerAmounts " + response);
		}
	});
}