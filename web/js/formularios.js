$(document).ready(function(){
    //oculta el campo congelado, al pulsar en tipo congelado
    //se muestra el input congelado y se pone requerido
    //al poner otro tipo se elimina el requerido y se quita el campo
    $("#fecha_hide").hide();
    $("#tipo").change(function(){
        if ($(this).val() == "4c901697-5aa0-11e8-a54d-e0d55e08b86f"){
            
            $("#fecha_hide").show();            
            $("#fecha_con").prop("required", true);
            
        }else{
            
            $("#fecha_hide").hide();            
            $("#fecha_con").removeProp("required");
        }
    });
    

});