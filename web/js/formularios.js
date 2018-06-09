$(document).ready(function(){
    //oculta el campo congelado, al pulsar en tipo congelado
    //se muestra el input congelado y se pone requerido
    //al poner otro tipo se elimina el requerido y se quita el campo
    $(".fcongediv").hide();
    $("#tipo").change(function(){
        
           //para obtener fecha actual
            let hoy = new Date();
            let agno = hoy.getFullYear();
            let mes = hoy.getMonth() + 1;
            let dia = hoy.getDate();
            //añade 0 delante
            if(mes < 10){
                mes = '0'+mes; 
            }
            if(dia < 10){
                dia = '0'+dia; 
            }
            let fechaActualString = agno + "-" + mes + "-" + dia;
        
        
        //si es tipo congelado
        if ($(this).val() == "4c901697-5aa0-11e8-a54d-e0d55e08b86f"){
            
            //muestra campo congelado y oculta fecha caducidad
            $(".fcongediv").show();            
            $("#fecha_con").prop("required", true);
            $("#fecha_con").val(fechaActualString);
            $(".fcaddiv").hide();
            $("#fecha_cad").prop("required", false);
            //$("#fecha_cad").val("2037-01-01");
            
            
        }else{
               
            //sino oculta congelado y muetra fecha caducidad    
            $(".fcongediv").hide();            
            $("#fecha_con").removeProp("required");
            $(".fcaddiv").show();
            $("#fecha_cad").prop("required", true);                   
            $("#fecha_cad").val(fechaActualString);
        }
    });
    

});