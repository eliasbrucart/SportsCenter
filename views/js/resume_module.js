$('#selectActivityResume').on("change", function(){

    var activitySelected = $('#selectActivityResume').val();

    var validateData = new FormData();
    validateData.append("activitySelected", activitySelected);

    $.ajax({
        url:hiddenPath+"ajax/resume_module_ajax.php",
        method: "POST",
        data: validateData,
        cache: false,
        contentType: false,
        processData: false,
        success:(response) => {
            console.log("Activity Selected", response);
            $('.resumeText').text("$" + response);
        }
    });
});