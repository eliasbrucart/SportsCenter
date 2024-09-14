$("#uploadVideoInput").change(function(){
    var video = this.files[0];
    console.log(video);

    if(video["type"] != "video/mp4"){
        $("#uploadVideoInput").val("");

        swal({
            title: "Error al subir el video!",
            text: "¡El video debe ser del formate mp4 o m4v",
            type: "error",
            confirmButtonText: "¡Cerrar!",
            closeOnConfirm: false
          })

        console.log("Error al subir el video!!");
    }else{
        console.log("Cargando video!");
        var dataVideo = new FileReader;
        dataVideo.readAsDataURL(video);

        $(dataVideo).on("load", function(event){
            var routeVideo = event.target.result;
            console.log(routeVideo);
            $(".preview").attr("src",  routeVideo);
        });
    }
});