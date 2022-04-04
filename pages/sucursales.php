<!DOCTYPE html>
<?=$headGNRL?>
<body>

<?=$header?>
<?php
	$rutapic ="img/contenido/sucursales/";
	$nopic	 ="img/design/img_sucursal.png";


	$CONSULTAsucur = $CONEXION -> query("SELECT * FROM sucursales ORDER BY orden LIMIT 1 ");
	$row_CONSULTAsucur= $CONSULTAsucur -> fetch_assoc();
	$lat=$row_CONSULTAsucur["lat"];
	$lon=$row_CONSULTAsucur["lon"];
	$id=$row_CONSULTAsucur['id'];

	$CONSULTAsucur2 = $CONEXION -> query("SELECT * FROM sucursales ORDER BY orden");
	
	
?>
		

	<div class="uk-background-cover" style="background-image: url(img/design/carne_header.png); min-height: 300px">
		<div class="uk-position-top-left uk-position-small">
          <img class="img-slider-pri" src="img/design/logo.png" uk-img style=" z-index: 2; position: relative;">
		</div>
	</div>
	<div class="div-negro"></div>
	<div class="uk-container-expand">
		<div id="sucur-dot" class="uk-position-relative uk-visible-toggle uk-dark" tabindex="-1" uk-slider>
			<div class="bg-slider padding-v-50 padding-h-30">
			    <ul class="uk-slider-items uk-child-width-1-1 uk-child-width-1-3@m uk-grid">
			    	<?php while ($row_CONSULTAsucur2= $CONSULTAsucur2 -> fetch_assoc()) { 
			    		$pic = (isset($row_CONSULTAsucur2['imagen'])) ? $rutapic.$row_CONSULTAsucur2['imagen']  : $nopic ;?>
					<li >
			            <?=cardSucurcal($row_CONSULTAsucur2['id'],'sucursales');?>
			        </li>
			    	<?php	 } ?>
		    	</ul>
	    	</div>
	    	<div class="uk-grid padding-v-30">
	    		 <div class="uk-width-1-3@m"></div>
			    <div class="uk-width-expand@m uk-flex uk-flex-center uk-flex-middle slider-navs" >
		 			<a class="margin-h-20" href="#"  uk-slider-item="previous">
				    	<i class="fas fa-chevron-left"></i>
				    </a>
				    <div style="font-size: 0.7em">M&aacute;s Sucursales</div>
				    <a class="margin-h-20" href="#"  uk-slider-item="next">
				    	<i class="fas fa-chevron-right"></i>
				    </a>
				    
				 </div>
				 <div class="uk-width-1-3@m uk-flex uk-flex-right uk-flex-middle">
				      <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin" style="margin-right: 30px;"></ul>
				 </div>
			 </div>
		</div>
		 
	</div>


	<div class="div-negro"></div>
		<div class="uk-container uk-container-expand bg-semiblack" style="padding-right: 0px">
			<div class="uk-grid">
				<div class="uk-width-1-2@m masinfo" >
					<div class="uk-grid uk-flex-center uk-text-center" uk-grid>
					    <div class="uk-width-1-1 padding-h-30" style="margin-top: 10px">
					    	<div class="uk-cover-container uk-height-medium border-rad-black">
					        	<img src="<?=$pic?>" uk-cover>
						        <div class="uk-position-top-center uk-position-small">                        
	 								<h1 class="uk-text-capitalize borde-negro"><?=$row_CONSULTAsucur["titulo"]?></h1>
	                            </div>
					        </div>
					    </div>
					    <div class="uk-width-1-1 padding-h-30" style="margin-top: 10px">
					       <div class="uk-card border-rad-black">
							    <div class="uk-card-header bg-black">
							        <div class="uk-card-title color-blanco" style="font-size: 1em; font-weight: bold;">En esta sucursal puedes encontrar:</div>
							    </div>
							    <div class="padding-v-30 padding-h-10 bg-white">
							    	<div class="uk-position-relative uk-visible-toggle uk-dark" tabindex="-1" uk-slider="autoplay: true: autoplay-interval: 2000">
									    <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-4@m uk-grid">

									    	<?php
											$CONSULTAcatsuc = $CONEXION->query("SELECT * FROM sucursalescat WHERE sucursal = $id AND estatus = 1");
									    	 while ($row_CONSULTAcatsuc = $CONSULTAcatsuc-> fetch_assoc() ) {
									    	?>
									    		<li>
										           <div class="uk-flex-center uk-text-center">
										    			<img src="img/contenido/productos/<?=$row_CONSULTAcatsuc['imagen']?>" uk-img style="height: 60px">
										    			<div class="uk-text-uppercase text-card-pro"><?=$row_CONSULTAcatsuc['nombre'] ?></div>
										    		</div>
										        </li>
									    	<?php
									    	} ?>
									        
									        


									    </ul>
									     <a class="uk-position-center-left " href="#" uk-slidenav-previous uk-slider-item="previous"></a>
    									<a class="uk-position-center-right " href="#" uk-slidenav-next uk-slider-item="next"></a>

									</div>

							    	
							    </div>
							    
							</div>
					    </div>
					    <div class="uk-width-1-2@m padding-left-30 padding-right-30" style="margin-top: 10px">
					       <div class="uk-card border-rad-black">
							    <div class="uk-card-header bg-black">
							        <h3 class="uk-card-title color-blanco"><img src="img/design/icono_email.png" uk-img style="max-height: 30px"> Email</h3>
							    </div>
							    <div class="padding-v-30 padding-h-10 bg-white color-negro">
							    	<div><?=$row_CONSULTAsucur["email1"]?></div>
							    	<div><?=$row_CONSULTAsucur["email2"]?></div>
							    </div>
							    
							</div>
					    </div>					    
					    <div class="uk-width-1-2@m padding-right-30" style="margin-top: 10px">
					       <div class="uk-card border-rad-black">
							    <div class="uk-card-header  bg-black">
							        <h3 class="uk-card-title color-blanco"><img src="img/design/icono_telefono.png" uk-img style="max-height: 30px"> Telefonos</h3>
							    </div>
							    <div class="padding-v-30 padding-h-10 bg-white color-negro">
							    	<div><?=$row_CONSULTAsucur["tel1"]?></div>
							    	<div><?=$row_CONSULTAsucur["tel2"]?></div>
							    </div>
							    
							</div>
							<div class="ubi-suc uk-visible@m" >
								<div class="uk-card border-rad-black">
								    <div class="uk-card-header  bg-black">
								        <h3 class="uk-card-title color-blanco"><img src="img/design/icono_ubicacion.png" uk-img style="max-height: 30px"> Direcci&oacute;n</h3>
								    </div>
								    <div class="padding-v-30 padding-h-10 bg-white color-negro">
								    	<div><?=$row_CONSULTAsucur["calle"]?> <?=$row_CONSULTAsucur["numero"]?></div>
								    	<div><?=$row_CONSULTAsucur["colonia"]?> en <?=$row_CONSULTAsucur["municipio"]?>, <?=$row_CONSULTAsucur["estado"]?></div>
								    </div>
								    
								</div>
							</div>
					    </div>
					     <div class="uk-width-1-1 padding-h-30 uk-hidden@s" style="margin-top: 10px">
						    <div class="uk-card border-rad-black">
							    <div class="uk-card-header  bg-black">
							        <h3 class="uk-card-title color-blanco"><img src="img/design/icono_ubicacion.png" uk-img style="max-height: 30px"> Direcci&oacute;n</h3>
							    </div>
							    <div class="padding-v-30 padding-h-10 bg-white color-negro">
							    	<div><?=$row_CONSULTAsucur["calle"]?> <?=$row_CONSULTAsucur["numero"]?></div>
							    	<div><?=$row_CONSULTAsucur["colonia"]?> en <?=$row_CONSULTAsucur["municipio"]?>, <?=$row_CONSULTAsucur["estado"]?></div>
							    </div>
							</div>
						</div>
					    <div class="uk-width-1-2 uk-flex uk-flex-middle uk-flex-center " style="margin-top: 10px; font-size: 1.2em">
							   <div class="color-blanco uk-text-capitalize">contact&aacute;nos directamente:</div>
							
					    </div>
					    <div class="uk-width-1-2 " style="margin-top: 10px">
							    <a href="https://wa.me/521<?=$row_CONSULTAsucur["whatsapp"]?>?text=Me%20gustaría%20saber%20..."><i class="icono-redes fab fa-whatsapp-square"></i></a>
								<a href="<?=$row_CONSULTAsucur["facebook"]?>"><i class="icono-redes fab fa-facebook-square"></i></a>
					    </div>
					    
					</div>
				</div>
				<?php 
				$CONSULTAsucur2 = $CONEXION -> query("SELECT * FROM sucursales ORDER BY orden");
				while ($row_CONSULTAsucur2= $CONSULTAsucur2 -> fetch_assoc()) { 
					$pic = (isset($row_CONSULTAsucur2['imagen'])) ? $rutapic.$row_CONSULTAsucur2['imagen']  : $nopic ;
					$id  = $row_CONSULTAsucur2['id'];
					?>
				<div id="div<?=$row_CONSULTAsucur2["id"]?>" class="uk-width-1-2@m masinfo" style="display: none;">
					<div class="uk-grid uk-flex-center uk-text-center" uk-grid>
					    <div class="uk-width-1-1 padding-h-30" style="margin-top: 10px">
					    	<div class="uk-cover-container uk-height-medium border-rad-black">
					        	<img src="<?=$pic?>" uk-cover>
						        <div class="uk-position-top-center uk-position-small">                        
	 								<h1 class="uk-text-capitalize borde-negro"><?=$row_CONSULTAsucur2["titulo"]?></h1>
	                            </div>
					        </div>
					    </div>
					    <div class="uk-width-1-1 padding-h-30" style="margin-top: 10px">
					       <div class="uk-card border-rad-black">
							    <div class="uk-card-header bg-black">
							        <div class="uk-card-title color-blanco" style="font-size: 1em; font-weight: bold;">En esta sucursal puedes encontrar:</div>
							    </div>
							    <div class="padding-v-30 padding-h-10 bg-white">
							    	<div class="uk-position-relative uk-visible-toggle uk-dark" tabindex="-1" uk-slider="autoplay: true: autoplay-interval: 2000">
									    <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-4@m uk-grid">
									    	<?php
											$CONSULTAcatsuc = $CONEXION->query("SELECT * FROM sucursalescat WHERE sucursal = $id AND estatus = 1");
									    	 while ($row_CONSULTAcatsuc = $CONSULTAcatsuc-> fetch_assoc() ) {
									    	?>
									    		<li>
										           <div class="uk-flex-center uk-text-center">
										    			<img src="img/contenido/productos/<?=$row_CONSULTAcatsuc['imagen']?>" uk-img style="height: 60px">
										    			<div class="uk-text-uppercase text-card-pro"><?=$row_CONSULTAcatsuc['nombre'] ?></div>
										    		</div>
										        </li>
									    	<?php
									    	} ?>

									    </ul>
									     <a class="uk-position-center-left " href="#" uk-slidenav-previous uk-slider-item="previous"></a>
    									<a class="uk-position-center-right " href="#" uk-slidenav-next uk-slider-item="next"></a>

									</div>

							    	
							    </div>
							    
							</div>
					    </div>
					    <div class="uk-width-1-2 padding-left-30" style="margin-top: 10px">
					       <div class="uk-card border-rad-black">
							    <div class="uk-card-header bg-black">
							        <h3 class="uk-card-title color-blanco"><img src="img/design/icono_email.png" uk-img style="max-height: 30px"> Email</h3>
							    </div>
							    <div class="padding-v-30 padding-h-10 bg-white color-negro">
							    	<div><?=$row_CONSULTAsucur2["email1"]?></div>
							    	<div><?=$row_CONSULTAsucur2["email2"]?></div>
							    </div>
							    
							</div>
					    </div>					    
					    <div class="uk-width-1-2 padding-right-30" style="margin-top: 10px">
					       <div class="uk-card border-rad-black">
							    <div class="uk-card-header  bg-black">
							        <h3 class="uk-card-title color-blanco"><img src="img/design/icono_telefono.png" uk-img style="max-height: 30px"> Telefonos</h3>
							    </div>
							    <div class="padding-v-30 padding-h-10 bg-white color-negro">
							    	<div><?=$row_CONSULTAsucur2["tel1"]?></div>
							    	<div><?=$row_CONSULTAsucur2["tel2"]?></div>
							    </div>
							    
							</div>
							<div class="ubi-suc uk-visible@m" >
								<div class="uk-card border-rad-black">
								    <div class="uk-card-header  bg-black">
								        <h3 class="uk-card-title color-blanco"><img src="img/design/icono_ubicacion.png" uk-img style="max-height: 30px"> Direcci&oacute;n</h3>
								    </div>
								    <div class="padding-v-30 padding-h-10 bg-white color-negro">
								    	<div><?=$row_CONSULTAsucur2["calle"]?> <?=$row_CONSULTAsucur2["numero"]?></div>
								    	<div><?=$row_CONSULTAsucur2["colonia"]?> en <?=$row_CONSULTAsucur2["municipio"]?>, <?=$row_CONSULTAsucur2["estado"]?></div>
								    </div>
								    
								</div>
							</div>
					    </div>
					    <div class="uk-width-1-1 padding-h-30 uk-hidden@s" style="margin-top: 10px">
						    <div class="uk-card border-rad-black">
							    <div class="uk-card-header  bg-black">
							        <h3 class="uk-card-title color-blanco"><img src="img/design/icono_ubicacion.png" uk-img style="max-height: 30px"> Direcci&oacute;n</h3>
							    </div>
							    <div class="padding-v-30 padding-h-10 bg-white color-negro">
							    	<div><?=$row_CONSULTAsucur2["calle"]?> <?=$row_CONSULTAsucur2["numero"]?></div>
							    	<div><?=$row_CONSULTAsucur2["colonia"]?> en <?=$row_CONSULTAsucur2["municipio"]?>, <?=$row_CONSULTAsucur2["estado"]?></div>
							    </div>
							</div>
						</div>

					    
					    <div class="uk-width-1-2 uk-flex uk-flex-middle uk-flex-center " style="margin-top: 10px; font-size: 1.2em">
							   <div class="color-blanco uk-text-capitalize">contact&aacute;nos directamente:</div>
							
					    </div>
					    <div class="uk-width-1-2 " style="margin-top: 10px">
							    <a href="https://wa.me/521<?=$row_CONSULTAsucur2["whatsapp"]?>?text=Me%20gustaría%20saber%20..."><i class="icono-redes fab fa-whatsapp-square"></i></a>
								<a href="<?=$row_CONSULTAsucur2["facebook"]?>"><i class="icono-redes fab fa-facebook-square"></i></a>
					    </div>
					    
					</div>
				</div>
				<?php	 } ?>
				<div class="uk-width-1-2@m uk-padding-remove border-vertical">

					<section class="uk-padding-remove uk-margin-remove in line">
							<div class="uk-padding-remove uk-margin-remove bg-blanco sombra">
								<div id="map" class="h-map" style="margin:0"></div>
								<div class="uk-position-top-center">
									
								</div>
							</div>	
					</section>   
				</div>			
			</div>	

			<div class="uk-grid" style="margin-top: 0px">
				<div class="uk-width-1-2@m uk-padding-remove uk-height-large uk-cover-container">
					
					    	<img src="img/design/entrega_domicilio.png" uk-cover>
					
				</div>
				<div class="uk-width-1-2@m uk-padding-remove border-vertical">
						<div class="uk-width-1-1">
							<div class="bg-white uk-height-medium uk-flex uk-flex-center uk-flex-middle uk-text-capitalize" style="font-size: 0.7em">
								<div>
									<div class="borde-negro">visita nuestras Sucursales </div>
									<div class="borde-negro">o pide servicio a domicilio </div>
								</div>
								<div>
									<img src="img/design/pin.png">
								</div>
							</div>
						</div>
						<div class="uk-width-1-1 uk-height-small uk-cover-container">
							<div>
								<img src="img/design/carne_domicilio.png" uk-cover>
							</div>
						</div>
				</div>
			</div>		
		</div>
		<div class="div-negro"></div>


 <script>
 	//clase mapas viene del item
    	$(".mapas").click(function initMap() {

    				var id 	= $( this ).attr( "data-id");
    				$(".masinfo").hide();
    				$("#div"+id).show();

		    		var lat = $( this ).attr( "data-lat" );
		      		var lon = $( this ).attr( "data-lon" );

		      		lat =  parseFloat(lat);
		      		lon =  parseFloat(lon);

			        var myLatLng = {lat: lat, lng: lon};;
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
			          icon: icon,
			          map: map,
			          title: 'MOOI'
			        });
			      });  		

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
          icon: icon,
          map: map,
          title: 'MOOI'
        });
      }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?=$googleMaps?>&callback=initMap"></script>

<?=$footer?>



</body>
</html>