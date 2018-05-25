$(document).ready(function(){
	
	var ventana_ancho = $(window).width();
	var ventana_alto = $(window).height();
	//alert(ventana_ancho);
	$(window).on("resize", function(){
		ventana_ancho = $(window).width();
		ventana_alto = $(window).height();
		//$("nav").show();
		//alert(ventana_ancho);
		if (ventana_ancho >= 950) {
			$("nav").show();
			//alert(ventana_ancho);
			$(".tit2").show();
		} else {
			$(".tit2").hide();
		}
	});

	if (ventana_ancho <= 950) {
		$("nav").hide();
		$(".tit2").hide();
	}

	if (ventana_ancho >= 950) {
		$("nav").show();
		$(".tit2").show();
	}

	var cont = 1;
	$(".menu-icono").click(function(){
		//$(".menu_bar").hide();

		if (cont == 1) {
			$("nav").show("slide", { direction: "left" }, "slow");
			cont = 0;
		} else {
			$("nav").hide("slide", { direction: "left" }, "slow");
			cont = 1;
		}				
	});

	//cerrar menu si se hace clic fuera de el
	/*if (ventana_ancho <= 950) {
		$("html").click(function() {
	    	$("nav").hide("slide", { direction: "left" });
		});

		$("nav").click(function (e) {
		    e.stopPropagation();
		});
		$(".menu_bar").click(function (e) {
		    e.stopPropagation();
		});
	}*/

	/**/
});