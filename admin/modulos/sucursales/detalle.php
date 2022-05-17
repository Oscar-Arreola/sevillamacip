<?php 
$CONSULTA = $CONEXION -> query("SELECT * FROM $modulo WHERE id = $id");
$rowCONSULTA = $CONSULTA -> fetch_assoc();

$fechaSQL=$rowCONSULTA['fecha'];
$segundos=strtotime($fechaSQL);
$fechaUI=date('m/d/Y',$segundos);



echo '
<div class="uk-width-1-2@s margin-v-20">
	<ul class="uk-breadcrumb uk-text-capitalize">
		<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'">'.$modulo.'</a></li>
		<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=detalle&id='.$id.'" class="color-red">'.$rowCONSULTA['titulo'].'</a></li>
	</ul>
</div>
<div class="uk-width-1-2@s uk-text-right margin-v-20">
<!--	<a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=nuevo&" class="uk-button uk-button-default"><i class="fa fa-lg fa-plus"></i> &nbsp; Nuevo</a>-->
	<a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=editar&id='.$id.'" class="uk-button uk-button-primary"><i class="fas fa-pencil-alt"></i> &nbsp; Editar</a>
</div>

<div class="uk-width-1-1 margin-v-20">
	<div uk-grid class="uk-grid-match" >
		<div class="uk-width-1-2@s">
			<div class="uk-card uk-card-body uk-card-default">
				<div>
					<span class="uk-text-capitalize uk-text-muted">Titulo</span>
					'.$rowCONSULTA['titulo'].'
				</div>	
							
				<div id="map" class="uk-height-large">
				</div>
				<div class="uk-margin uk-text-center">
					<input type="hidden" id="mapahidden" class="uk-input" value="('.($rowCONSULTA['lat']*1).', '.($rowCONSULTA['lon']*1).')">
					<button class="uk-button uk-button-primary" id="mapasave">Guardar mapa</button>
				</div>
				<div class="uk-width-1-1 uk-text-right">
					<span class="uk-text-muted">Fecha de captura:</span>
					'.$fechaUI.'
				</div>
			</div>
		</div>
		
	</div>
</div>

';

echo'


<script async defer src="https://maps.googleapis.com/maps/api/js?key='.$googleMaps.'&callback=initMap"></script>
';


$mapzoom='13';
if (isset($rowCONSULTA['lat'])==0) {
	$maplat='20.606857';
	$maplng='-103.4018826';
}else{
	$maplat=$rowCONSULTA['lat']*1;
	$maplng=$rowCONSULTA['lon']*1;
}


$scripts='
	$(".editarcat").change(function(e) {
		var id = $(this).attr("id");
		var idsuc 	= $(this).attr("data-suc");
		
		var checkbok =  document.getElementById(id)
		 if(checkbok.checked){
			activo = 1;
		 }else{
		 	activo = 0;
		 }
	
		$.ajax({
				method: "POST",
				url: "modulos/'.$modulo.'/acciones.php",
				data: { 
					editarcat: 1,
					id: id,
					activo: activo,
					idsuc: idsuc

				}
			})
			.done(function( msg ) {
				UIkit.notification.closeAll();
				UIkit.notification(msg,{pos:"bottom-right"});
				console.log(msg);
			});
		

	});

	var map;
	var markers = [];

	function initMap() {
	  var haightAshbury = {lat: '.$maplat.', lng: '.$maplng.'};

	  map = new google.maps.Map(document.getElementById("map"), {
	    zoom: '.$mapzoom.',
	    center: haightAshbury
	  });

      addMarker(haightAshbury);

	  // This event listener will call addMarker() when the map is clicked.
	  map.addListener("click", function(event) {
	    addMarker(event.latLng);
	    var mapa=event.latLng;
	    $("#mapahidden").attr("value",mapa);
	  });
	}

	// Adds a marker to the map and push to the array.
	function addMarker(location) {
	  var marker = new google.maps.Marker({
	    position: location,
	    map: map
	  });
	  setMapOnAll(null);
	  markers = [];
	  markers.push(marker);
	}

	// Sets the map on all markers in the array.
	function setMapOnAll(map) {
	  for (var i = 0; i < markers.length; i++) {
	    markers[i].setMap(map);
	  }
	}

	// Guardar mapa
	$("#mapasave").click(function(){
		var valor = $("#mapahidden").val();
		$.ajax({
			method: "POST",
			url: "modulos/'.$modulo.'/acciones.php",
			data: { 
				editarmapa : 1,
				id : '.$id.',
				valor : valor
			}
		})
		.done(function( msg ) {
			UIkit.notification.closeAll();
			UIkit.notification(msg);
		});
	})

	$(document).ready(function() {
		$("#fileuploadermain").uploadFile({
			url:"../library/upload-file/php/upload.php",
			fileName:"myfile",
			maxFileCount:1,
			showDelete: \'false\',
			allowedTypes: "jpeg,jpg",
			maxFileSize: 6291456,
			showFileCounter: false,
			showPreview:false,
			returnType:\'json\',
			onSuccess:function(data){ 
				window.location = (\'index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo='.$archivo.'&id='.$id.'&imagen=\'+data);
			}
		});
	});

	// Borrar foto redes
	$(".borrarpic").click(function() {
		var statusConfirm = confirm("Realmente desea borrar esto?"); 
		if (statusConfirm == true) { 
			window.location = ("index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo='.$archivo.'&id='.$id.'&borrarpic");
		} 
	});


	';
