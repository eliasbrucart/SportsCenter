var hiddenPath = $("#hiddenPath").val();

function DeleteVideo(stringVideoID){
    //var result = stringVideoID.match(/\d+/);
    console.log("ID del boton: " + stringVideoID);
    //document.cookie = "VideoToDelete = " + $("#captureIDVideoToDelete").val(stringVideoID);//Importante esta linea, no borrar

    var validateData = new FormData();
    validateData.append("idVideoForDeleting", stringVideoID);

    $.ajax({
        url:hiddenPath+"ajax/deleteVideo.ajax.php",
        method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
        success:function(response){
            if(response == "false"){
                swal({
                    title: "ERROR!",
                    text: "¡No se pudo eliminar el video!",
                    type:"error",
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                  });
            } else {
                setTimeout(function(){
                    swal({
                        title: "OK!",
                        text: "¡El video se elimino con exito!",
                        type:"success",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                      });
                }, 2000);
            }
        }
    });
}

function EditVideo(id, title, description){
    console.log(id);

    //const myInterval = setInterval(FillVideoData, 2000, getID);

    //clearInterval(myInterval);
    
    setTimeout(function(){
        console.log("colocando datos en el modal");
        $(".idVideoToEdit").text(id);
        $(".editNameVideoInput").val(title);
        $(".editDescriptionVideoInput").val(description);
    }, 2000);
}

function SendEditedData(){
    var id = $(".idVideoToEdit").text();
    var titleEdited = $(".editNameVideoInput").val();
    var descriptionEdited = $(".editDescriptionVideoInput").val();

    var validateData = new FormData();
    validateData.append("idEdited", id);
    validateData.append("titleEdited", titleEdited);
    validateData.append("descriptionEdited", descriptionEdited);

    $.ajax({
        url:hiddenPath+"ajax/deleteVideo.ajax.php",
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
                        text: "¡No se pudo editar el video!",
                        type:"error",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                      });
                }, 2000);
            }else{
                setTimeout(function(){
                    swal({
                        title: "OK!",
                        text: "¡El video se edito con exito!",
                        type:"success",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                      });
                }, 2000);
            }
        }
    });
}

/*function FillVideoData(id){
    console.log("colocando datos en el modal");
    $(".idVideoToEdit").text(id);
}*/

/*function EditVideo(stringVideoID){
    var titleEdited = $("#editNameVideoInput"+stringVideoID).val();
    var descriptionEdited = $("#editDescriptionVideoInput"+stringVideoID).text();

    var validateData = new FormData();
    validateData.append("idEdited", stringVideoID);
    validateData.append("titleEdited", titleEdited);
    validateData.append("descriptionEdited", descriptionEdited);

    $.ajax({
        url:hiddenPath+"ajax/deleteVideo.ajax.php",
        method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
        success:function(response){
            console.log(response);
            if(response == "false"){
                swal({
                    title: "ERROR!",
                    text: "¡No se pudo editar el video!",
                    type:"error",
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                  });
            }else{
                swal({
                    title: "OK!",
                    text: "¡El video se edito con exito!",
                    type:"success",
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                  });
            }
        }
    });

}*/

/*$(".deleteUploadedVideo").click(function(){
    //var idVideo = $("#uploadedVideoID").text();

    var idVideo = $(".uploadedVideoIDD").attr('id');

    console.log("id del video a eliminar: " + idVideo);

    var validateData = new FormData();
    validateData.append("idVideoForDeleting", idVideo);

   $.ajax({
        url:hiddenPath+"ajax/deleteVideo.ajax.php",
        method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
        success:function(response){
            console.log(response);
            if(response == "false"){
                swal({
                    title: "ERROR!",
                    text: "¡No se pudo eliminar el video!",
                    type:"error",
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                  });
            } else {
                swal({
                    title: "OK!",
                    text: "¡El video se elimino con exito!",
                    type:"success",
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                  });
            }
        }
    });
});*/

$(".editUploadedVideo").click(function(){
    var videoID = $("#uploadedVideoID").text();
    var videoTitle = $(".uploadedVideoTitle").text();
    var videoDescription = $(".uploadedVideoDescription").text();

    $(".idVideoToEdit").text(videoID);
});

/*$(".submitEditedVideo").click(function(){
    console.log("click en el boton de subir cambios al editar");
    var idEdited = $(".idVideoToEdit").text();
    var titleEdited = $("#editNameVideoInput").val();
    var descriptionEdited = $("#editDescriptionVideoInput").text();

    var validateData = new FormData();
    validateData.append("idEdited", idEdited);
    validateData.append("titleEdited", titleEdited);
    validateData.append("descriptionEdited", descriptionEdited);

    console.log(idEdited);
    console.log(titleEdited);
    console.log(descriptionEdited);

    $.ajax({
        url:hiddenPath+"ajax/deleteVideo.ajax.php",
        method: "POST",
		data: validateData,
		cache: false,
		contentType: false,
		processData: false,
        success:function(response){
            console.log(response);
            if(response == "false"){
                swal({
                    title: "ERROR!",
                    text: "¡No se pudo editar el video!",
                    type:"error",
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                  });
            }else{
                swal({
                    title: "OK!",
                    text: "¡El video se edito con exito!",
                    type:"success",
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                  });
            }
        }
    });
});*/