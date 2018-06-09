$(document).ready(function(){
	
	//porq doble la igualacion si en js no hay problema con ambito creo
	var ventana_ancho = $(window).width();
	var ventana_alto = $(window).height();

	$(window).on("resize", function(){
		ventana_ancho = $(window).width();
		ventana_alto = $(window).height();
		$("nav").show();
	
		if (ventana_ancho >= 950) {
			$("nav").show();
		
			$(".tit2").show();
		} else {
			$(".tit2").hide();
		}
	});

	if (ventana_ancho <= 1159) {
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

	/*buscar*/
	var cont2 = 1;
	$(".buscar").hide();
	$(".search_btn").click(function(){
		$(".buscar").show();
		if (cont2 == 1) {
			$(".buscar").show();
			$(".tit1").hide();
			cont2 = 0;
		} else {
			$(".buscar").hide();
			$(".tit1").show();
			cont2 = 1;
		}		
	});



	// $("li").click(function(){
	// 	$(this).css("background-color", "#8BC34A");
	// });

});