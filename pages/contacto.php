<!DOCTYPE html>
<?=$headGNRL?>
<body>

<?=$header?>
<?php

$consulta = $CONEXION -> query("SELECT * FROM configuracion WHERE id = 1 LIMIT 1");
$row_consulta = $consulta->fetch_assoc();

	$CONSULTAsucur = $CONEXION -> query("SELECT * FROM sucursales ORDER BY orden LIMIT 1 ");
	$row_CONSULTAsucur= $CONSULTAsucur -> fetch_assoc();
	$lat=$row_CONSULTAsucur["lat"];
	$lon=$row_CONSULTAsucur["lon"];
	$id=$row_CONSULTAsucur['id'];
	$imagen= $row_CONSULTAsucur['imagen'];

	
?>

<div class="uk-container-expand bg-secondary">
	<div class="padding-h-40 padding-top-20">
		<div class="uk-margin-remove border-u-inver padding-40 p-remove-small" style="padding-bottom: 5em">
				<div class="uk-flex uk-flex-center padding-v-40">
					<img src="img/design/sobre.png" alt="">
				</div>
				<div class="uk-flex uk-flex-center">
					<h1 style="max-width: 80%" class="uk-text-uppercase color-primary uk-text-bold text-xxl uk-text-center"><?= $row_consulta['txt_t2']?></h1>
				</div>
				<div class="uk-flex uk-flex-center">
					<p style="max-width: 60%" class="uk-text-center color-white text-8"><?= $row_consulta['txt_s3']?></p>
				</div>
				<div class="uk-flex uk-flex-center">
					<hr width="30%" style="border-top:4px solid #002349;">
				</div>
			<div class="padding-h-40">
				<form class="uk-grid-small form-contacto padding-top-20" uk-grid>
					<div class="uk-width-1-1 uk-width-1-3@s">
						<input class="uk-input input-contacto2" type="text" id="nombre" placeholder="TU NOMBRE">
					</div>
					<div class="uk-width-1-1 uk-width-1-3@s">
						<input class="uk-input input-contacto2" type="text" id="telefono" placeholder="WHATSAPP">
					</div>
					<div class="uk-width-1-1 uk-width-1-3@s">
						<input class="uk-input input-contacto2" type="text" id="email" placeholder="CORREO">
					</div>
					<div class="uk-width-1-1@s">
						<textarea class="uk-textarea input-contacto2"  id="comentarios" placeholder="MENSAJE"></textarea>
					</div>
					<div class="uk-width-1-1@s uk-text-center">
						<buttom class="uk-button uk-button-personal margin-v-10" id="footersend" >Enviar</buttom>
					</div>
				</form>
			</div>
			<div class="margin-top-30 padding-bottom-40">
				<div class="text-lg color-negro uk-text-center uk-text-right@m">Calle: <?=$row_CONSULTAsucur['calle']?> # <?=$row_CONSULTAsucur['numero']?></div>
				<div class="text-lg color-negro uk-text-center uk-text-right@m">Localizacion:  <?=$row_CONSULTAsucur['colonia']?>,  <?=$row_CONSULTAsucur['municipio']?>,  <?=$row_CONSULTAsucur['estado']?></div>
				<div class="text-lg color-negro uk-text-center uk-text-right@m">Email Principal:  <?=$row_CONSULTAsucur['email1']?></div>
				<div class="text-lg color-negro uk-text-center uk-text-right@m">Email Secundario:  <?=$row_CONSULTAsucur['email1']?></div>
				<div class="text-lg color-negro uk-text-center uk-text-right@m">Telefono1:  <?=$row_CONSULTAsucur['tel1']?></div>
				<div class="text-lg color-negro uk-text-center uk-text-right@m">Telefono2:  <?=$row_CONSULTAsucur['tel2']?></div>

			</div>
		</div>
	</div>	
</div>
<div class="border-top-azul border-bottom-azul">
			<div id="map" class="" style="margin:0"></div>
</div>
	<div>
		<div class="uk-container-expand bg-secondary">
			<div class="padding-h-40">
				<div class="uk-margin-remove border-u padding-40">
					<div class="uk-visible@m" style="margin-top: 7em">
						<?=$footer_fal?>
					</div>
				</div>
				<?=$footer?>
			</div>
		</div>
	</div>



					
						
					
					
						<div class="uk-width-1-1 uk-hidden@m">
							<div class="margin-top-30">
								<div class="text-xl color-negro uk-text-right">Robert Delgadillo Jewelry</div>
								<div class="text-xl color-negro uk-text-right">Whatsapp: <?=$telefonoSeparado1?></div>
								<div class="text-xl color-negro uk-text-right">Oficinas: <?=$telefonoSeparado?></div>
								<div class="text-xl color-negro uk-text-right"><?=$destinatario1?></div>
							</div>
						</div>
				
			


  </div>
	<?=$scriptGNRL?>
	<script>
 	//clase mapas viene del item

      function initMap() {

      	
        var myLatLng = {lat:<?= $lat ?>, lng:<?= $lon ?>};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom:18,
          center: myLatLng
        });
        var icon = {
		    url: './img/design/pin.png', // url
		    scaledSize: new google.maps.Size(40, 40), // scaled size
		    origin: new google.maps.Point(0,0), // origin
		    anchor: new google.maps.Point(0, 0) // anchor
		};

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'MOOI'
        });
      }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?=$googleMaps?>&callback=initMap"></script


</body>
</html>