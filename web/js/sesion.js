$(document).ready(function(){

	$(".wrap_form_registro").hide();

	$(".tabs li:last-of-type").click(function (){
		$(".wrap_form_sesion").hide();
		$(".wrap_form_registro").show();
		$("ul li:first-of-type").removeClass("current");
		$("ul li:last-of-type").addClass("current");
	});

	$(".tabs li:first-of-type").click(function (){
		$(".wrap_form_registro").hide();
		$(".wrap_form_sesion").show();
		$("ul li:last-of-type").removeClass("current");
		$("ul li:first-of-type").addClass("current");
	});





	var formulario = document.forms, 
		elementos1 = formulario[0].elements,
		elementos2 = formulario[1].elements;


	function validarInputsSesion() {
		for (var i = 0; i < elementos1.length; i++) {
			if (elementos1[i].type == "text" || elementos1[i].type == "email" ||elementos1[i].type == "password") {
				if (elementos1[i].value == 0) {
					console.log("El campo " + elementos1[i].name + " está incompleto");
					elementos1[i].className = elementos1[i].className + " error";
					return false;
				}else{
					elementos1[i].className = elementos1[i].className.replace("");
				}

				return true;
			}
		}
	}

	function enviarSesion(e){
		if (!validarInputsSesion()){
			console.log('inputs no validados');
			e.preventDefault();
		}else{
			console.log('enviado correctamente');
		}
	}


	function validarInputsRegistro() {
		for (var i = 0; i < elementos1.length; i++) {
			if (elementos1[i].type == "text" || elementos1[i].type == "email" ||elementos1[i].type == "password") {
				if (elementos1[i].value == 0) {
					console.log("El campo " + elementos1[i].name + " está incompleto");
					elementos1[i].className = elementos1[i].className + " error";
					return false;
				}else{
					elementos1[i].className = elementos1[i].className.replace("");
				}
			}

			if (elementos1.pass.value !== elementos1.passr.value) {
				elementos1.pass.value = "";
				elementos1.passr.value = "";
				elementos1.pass.value = elementos1.pass.className + "error";
				elementos1.passr.value = elementos1.pass.className + "error";
			}else{
				elementos1.pass.value = elementos1.pass.className.replace("error", "");
				elementos1.passr.value = elementos1.pass.className.replace("error", "");
			}

			return true;
		}
	}


	function enviarRegistro(e){
		if (!validarInputsRegistro()){
			console.log('inputs no validados');
			e.preventDefault();
		}else{
			console.log('enviado correctamente');
		}
	}

	function focusInput(){
		this.parentElement.children[1].className = "label active";
		this.parentElement.children[0].className = this.parentElement.children[0].className.replace("error", "");
	}

	function blurInput(){
		if (this.value <= 0){
			this.parentElement.children[1].className = "label";
			this.parentElement.children[0].className = this.parentElement.children[0].className + " error";
		}
	}

	formulario[0].addEventListener("submit", enviarSesion);
	formulario[1].addEventListener("submit", enviarRegistro);

	for (var i = 0; i < elementos1.length; i++) {
		if (elementos1[i].type == "text" || elementos1[i].type == "email" ||elementos1[i].type == "password"){
			elementos1[i].addEventListener("focus", focusInput);
			elementos1[i].addEventListener("blur", blurInput);
		}
	}

	for (var i = 0; i < elementos2.length; i++) {
		if (elementos2[i].type == "text" || elementos2[i].type == "email" ||elementos2[i].type == "password"){
			elementos2[i].addEventListener("focus", focusInput);
			elementos2[i].addEventListener("blur", blurInput);
		}
	}





});