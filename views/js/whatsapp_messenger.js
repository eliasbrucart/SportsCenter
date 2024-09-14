function WhatsappSendMessage(){
    var validateData = new FormData();

    validateData.append("whatsappSendMessage", true);

    $.ajax({
        url:hiddenPath+"ajax/whatsapp_messenger_ajax.php",
        method: "POST",
        data: validateData,
        cache: false,
        contentType: false,
        processData: false,
        success:(response)=>{
            console.log("Se mando el mensaje por whatsapp ", response);
        }
    });
}