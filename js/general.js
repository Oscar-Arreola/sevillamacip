// Precarga Entrada
	$(document).ready(function() {
		$("#preloader").fadeOut();
	});

// Precarga Salida
	$(".spinnershot").click(function(){
		UIkit.modal("#spinnermodal").show();
	});

// Remover autocompletar
	$("input").attr("autocomplete","off");

// Campos numéricos
	$(".input-number").keypress("keypress", function (e) {
		var keyCode = e.which ? e.which : e.keyCode
		if (!(keyCode >= 48 && keyCode <= 57)) {
			if (keyCode!=46) {
				e.preventDefault();
			}
		}
	});	

// Posicion de los botones flotantes
	var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0)-100;
	$( "#totop" ).css( "top", h);
	$( window ).scroll(function() {
		var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0)-100;
		$( "#totop" ).css( "top", h);
	});
	$( window ).resize(function() {
		var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0)-100;
		$( "#totop" ).css( "top", h);
	});

	$pantalla = $(window);
	$('#arrow-button').addClass("claro");
	$pantalla.scroll(function() {
		if ($pantalla.scrollTop()>300) {
			$('#arrow-button').removeClass("oscuro");
			$('#arrow-button').addClass("claro");
		}else{
			$('#arrow-button').removeClass("claro");
			$('#arrow-button').addClass("oscuro");
		}
	});

// Regresar a la página anterior
	$(".goback").click(function() {
		window.history.go(-1);
	});

// Reductor de tamaño de fuente
	$("#fontsmaller").click(function(){
		var size = $("body").css("font-size");
		var sizeNew = (size.substring(0, 2)*1)-2;
		if (sizeNew<10) {sizeNew=10};
		$("body").css("font-size",sizeNew);
	});
	$("#fontbigger").click(function(){
		var size = $("body").css("font-size");
		var sizeNew = (size.substring(0, 2)*1)+2;
		$("body").css("font-size",sizeNew);
		console.log(sizeNew);
	});

// Enfocar el campo de la ventana modal
	$('.modal').on('shown', function () {
		$('.modal  input:text:visible:first').focus();
	});

// Enfocar el campo de la ventana modal
	$('.modal-login').on('shown', function () {
		$('#login-email').focus();
	});

// Alto de fotos cuadradas
	$(document).ready(function() {
		$(document).ready(function() {
		var alto=$(".pic-sq").width();
		$(".pic-sq").height(alto);
	});
	$( window ).resize(function() {
		var alto=$(".pic-sq").width();
		$(".pic-sq").height(alto);
		});
	})

// Envío de correo
			$("#footersend").click(function(){

			var nombre = $("#nombre").val();
			var email = $("#email").val();
			var telefono = $("#telefono").val();
			// var asunto = $("#asunto").val();
			var comentarios = $("#comentarios").val();
			var fallo = 0;
			var alerta = "";

			$("input").removeClass("uk-form-danger");
			if (nombre=="") { fallo=1; alerta="Falta nombre"; id="nombre"; }
			if (comentarios=="") { fallo=1; alerta="Falta comentarios"; id="comentarios"; }
			if (telefono=="") { fallo=1; alerta="Falta telefono"; id="telefono"; }
			// if (asunto=="") { fallo=1; alerta="Falta asunto"; id="asunto"; }

			if (email=="") {
				fallo=1; alerta="Falta email"; id="email";
			}else{
				var n = email.indexOf("@");
				var l = email.indexOf(".");
				if ((n*l)<2) {
					fallo=1; alerta="Proporcione un email válido"; id="email";
				}
			}

			


			var parametros = {
				"contacto" : 1,
				"nombre" : nombre,
				"email" : email,
				"telefono" : telefono,
				// "asunto" : asunto,
				"comentarios" : comentarios,
			};
			if (fallo == 0) {
				$.ajax({
					data:  parametros,
					url:   "includes/acciones.php",
					type:  "post",
					beforeSend: function () {
						$("#footersend").html("<div uk-spinner></div>");
						$("#footersend").prop("disabled",true);
						$("#footersend").disabled = true;
						UIkit.notification.closeAll();
						UIkit.notification('<div class="uk-text-center color-blanco bg-blue padding-10 text-lg"><i  uk-spinner></i> Espere...</div>');
					},
					success:  function (msj) {
						$("#footersend").html("Enviar");
						$("#footersend").disabled = false;
						$("#footersend").prop("disabled",false);
						$("#nombre").val("");
						$("#email").val("");
						$("#telefono").val("");
						$("#comentarios").val("");
						// $("#asunto").val("");
						$(".labelhidden").addClass("alpha0");
						console.log(msj);
						datos = JSON.parse(msj);
						UIkit.notification.closeAll();
						UIkit.notification(datos.msj);
					}
				})
			}else{

				UIkit.notification.closeAll();
				UIkit.notification('<div class="uk-text-center color-blanco bg-danger padding-10 text-lg"><i uk-icon="icon:warning;ratio:2;"></i> &nbsp; '+alerta+'</div>');
				$("#"+id).focus();
				$("#"+id).addClass("uk-form-danger");
			}
		});

	

	// equalheight
		equalheight = function(container){
			var altoMax = 0,
			    alto;
				$(container).each(function() {
				  alto=$(this).height();
				  if (alto>altoMax) { altoMax=alto; };
				});
				$(container).height(altoMax);
			}

			setTimeout(function(){
				equalheight('.equal');
			},1000);
			setTimeout(function(){
				equalheight('.equal');
			},5000);

// Animación del botón fijo
	function cotizacionfixedanimate(){
		setTimeout(function(){
			$("#cotizacion-fixed-img").removeClass("uk-animation-shake");
		},2000);
		setTimeout(function(){
			$("#cotizacion-fixed-img").addClass("uk-animation-shake");
		},3000);
		setTimeout(function(){
			cotizacionfixedanimate();
		},5000);
	}
	cotizacionfixedanimate();
