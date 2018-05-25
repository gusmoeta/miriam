$(document).ready(function(){
    $("#fecha_hide").hide();
    $("#tipo").change(function(){
        if ($(this).val() == "4c901697-5aa0-11e8-a54d-e0d55e08b86f"){
            $("#fecha_hide").show();
        }else{
            $("#fecha_hide").hide();
        }
    });
    

});