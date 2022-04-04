<!DOCTYPE html>
<?=$headGNRL?>
<body>

<?=$header?>
<?php

	$CONSULTA = $CONEXION -> query("SELECT * FROM productoscat WHERE parent = 0 ORDER BY orden ");
	
?>
<div class="bg-gris-blanco ">
  <div class="uk-container uk-container-xlarge">
    <div>
      <div class="uk-flex uk-flex-center top-pa-media">
        <img class="padding-10" src="img/design/logo.png">
      </div>
      <section id="seccion-con-1">
			
				
					<div uk-grid>
					
						<div class="uk-width-1-1 uk-width-1-3@m ">
							<div>
								<div>
						          <div class="mini-linea"></div>
						        </div>
						        <div class="uk-text-uppercase text-xxl"><?=$txt_t2?></div>
						        	<?=$txt_s3?>

								<div style="    margin-right: -9em;">
						          <div class="uk-flex uk-flex-right" style="padding-right: 2em;">
						            <div class="mini-linea"></div>
						          </div>
						          <div class="uk-flex uk-flex-right">
						            <img src="img/design/tiendalogo.png">
						          </div>
						        </div>
						    </div>
							
							<form class="uk-grid-small form-contacto" uk-grid>
							    <div class="uk-width-1-1">
							        <input class="uk-input input-contacto" type="text" id="nombre" placeholder="Nombre">
							    </div>
							    <div class="uk-width-1-1@s">
							        <input class="uk-input input-contacto" type="text" id="telefono" placeholder="Telefono">
							    </div>
							    <div class="uk-width-1-1@s">
							        <input class="uk-input input-contacto" type="text" id="email" placeholder="Correo">
							    </div>
							    <div class="uk-width-1-1@s">
							        <textarea class="uk-textarea input-contacto" rows="5" id="comentarios" placeholder="Mensaje"></textarea>
							    </div>
							    <div class="uk-width-1-1@s uk-text-center">
							        <buttom class="uk-button uk-button-personal margin-v-10" id="footersend" >Enviar</buttom>
							    </div>
							</form>

						</div>
						
						<div class="uk-width-2-3@m uk-visible@m">
							<div class="uk-position-bottom-right uk-position-large">
								<div class="text-xxl color-negro uk-text-right">Robert Delgadillo Jewelry</div>
								<div class="text-xxl color-negro uk-text-right">Whatsapp: <?=$telefonoSeparado1?></div>
								<div class="text-xxl color-negro uk-text-right">Oficinas: <?=$telefonoSeparado?></div>
								<div class="text-xxl color-negro uk-text-right"><?=$destinatario1?></div>
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
				
			

      </section>
     </div>
   </div>
   <?=$footer?>
  </div>
		
	
		
	



	


<?=$scriptGNRL?>


</body>
</html>