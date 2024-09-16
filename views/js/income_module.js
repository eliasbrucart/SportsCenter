$(function(){
    $('.customerData').hide();
});

var incomeInput = document.getElementById("documentCustomerInput");
incomeInput.addEventListener("keypress", function(event) {
  if(event.key === "Enter") {
    event.preventDefault();
    document.getElementById("incomeButton").click();
  }
});

function Inocme(){
    var document = $('#documentCustomerInput').val();

    var validateData = new FormData();
    validateData.append("incomeCustomer", true);
    validateData.append("documentIncomeCustomer", document);

    $.ajax({
		url:hiddenPath+"ajax/admin_module_ajax.php",
		method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
		success:(response)=>{

      $('.customerData').show();

			console.log("Inocme ", response);

      var parseJSON = JSON.parse(response);

      $('.customerName').text(parseJSON.name+" "+parseJSON.lastname);

      var actualDate = new Date();

	    const formatter = new Intl.DateTimeFormat('en-US', { day: '2-digit', month: '2-digit', year: 'numeric' });

      //const actualDateFormatted = formatter.format(actualDate);

      console.log("actualDate " + actualDate.getDate());

      const customerExpiration = new Date(parseJSON.expiration);

      console.log("customerExpiration " + customerExpiration.getDate());

      console.log("DaysBetween " + DaysBetween(actualDate, customerExpiration));

      $('.customerDaysLeft').text("Dias restantes " + DaysBetween(actualDate, customerExpiration));

      $('.customerExpiration').text("Tu pase se vence el: " + parseJSON.expiration);

      $('.customerAmount').text("Proximo monto a pagar: " + parseJSON.amount);
		}
	});
}

function DaysBetween(date1, date2) {

    // The number of milliseconds in one day
    const ONE_DAY = 1000 * 60 * 60 * 24;

    // Calculate the difference in milliseconds
    const differenceMs = Math.abs(date1 - date2);

    // Convert back to days and return
    return Math.round(differenceMs / ONE_DAY);

}