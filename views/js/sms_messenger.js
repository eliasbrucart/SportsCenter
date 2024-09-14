function SMSSendMessage(){
    var validateData = new FormData();

    validateData.append("smsSendMessage", true);

    $.ajax({
        url:hiddenPath+"ajax/sms_messenger_ajax.php",
        method: "POST",
        data: validateData,
        cache: false,
        contentType: false,
        processData: false,
        success:(response)=>{
            console.log("Se mando el mensaje por sms ", response);
        }
    });
}