<!DOCTYPE html>
<?=$headGNRL?>
<body>

<?=$header?>
<?php
	$prodInicial=$pag*$prodspagina;
	$categoria = (!empty($cat)) ? " AND categoria = ".$cat : "" ;

 	$CONSULTA1 = $CONEXION -> query("SELECT * FROM productos WHERE estatus = 1 $categoria ORDER BY orden");
	$numItems=$CONSULTA1->num_rows;

	$CONSULTA2 = $CONEXION -> query("SELECT * FROM productos WHERE estatus = 1 $categoria LIMIT $prodInicial,$prodspagina");

	$CONSULTAsucur = $CONEXION -> query("SELECT * FROM sucursales ORDER BY orden LIMIT 1 ");
	$row_CONSULTAsucur= $CONSULTAsucur -> fetch_assoc();
	$lat=$row_CONSULTAsucur["lat"];
	$lon=$row_CONSULTAsucur["lon"];

	$CONSULTAsucur2 = $CONEXION -> query("SELECT * FROM sucursales ORDER BY orden");
	
	$CONSULTAcat = $CONEXION -> query("SELECT * FROM productoscat WHERE parent = 0 ORDER BY orden ");
?>
		

	<div class="uk-background-cover" style="background-image: url(img/design/carne_header.png); min-height: 290px; position: relative;">
		<div class="uk-position-top-left uk-position-small">
          <img class="img-slider-pri" src="img/design/logo.png" uk-img style="max-height: 10rem">
		</div>
		<div class="uk-position-bottom-right uk-position-small" style="max-width: 42em">
          <div class="uk-position-relative uk-visible-toggle uk-dark" tabindex="-1" uk-slider="autoplay: true: autoplay-interval: 2000">
				    <ul class="uk-slider-items uk-child-width-1-5@m uk-child-width-1-3 uk-grid">
				    	
				    	<?php while ($row_CONSULTAcat = $CONSULTAcat -> fetch_assoc()) { 
				    		$parent = $row_CONSULTAcat['id'];
				    		
				    		$CONSULTAsub = $CONEXION -> query("SELECT id FROM productoscat WHERE parent = $parent");
				    		$row_CONSULTAsub = $CONSULTAsub -> fetch_assoc();
				    		$pagCat = $row_CONSULTAsub['id'];
				    		$linkCat=$pag.'_'.$prodspagina.'_'.$pagCat.'_productos';
				    		if ($cat != $pagCat  ) {
				    		?>
				    		<li class="uk-flex-middle uk-flex uk-text-center">				           
					    		<a href="<?=$linkCat?>">
						          <div id="item'.$id.'" class="uk-card uk-card-default card-produ" style="width: 120px; height: 110px;">
						              <div class="uk-card-media-top uk-inline-clip uk-flex uk-flex-center uk-flex-middle " style="padding: 5px">
						                  <img src="img/contenido/productos/<?=$row_CONSULTAcat['imagen']?>" alt="" style="height: 50px" >
						             
						              </div>
						              <div class="card-produ-body uk-text-center" style="padding: 7px">
						                   <div class=""><?=$row_CONSULTAcat['txt'] ?></div>
						              </div>
						          </div>
						        </a>
							</li>
							

				    	<?php }
				    	} ?>
				    	<?php if (!empty($cat)) {?>
				    		<li class="uk-flex-middle uk-flex uk-text-center">				           
					    		<a href="productos">
						          <div id="" class="uk-card uk-card-default card-produ" style="width: 120px; height: 110px;">
						              <div class="uk-card-media-top uk-inline-clip uk-flex uk-flex-center uk-flex-middle " style="padding: 5px">
						                  <img src="img/design/ICONO_VACA.png" alt="" style="height: 50px" >
						             
						              </div>
						              <div class="card-produ-body uk-text-center" style="padding: 7px">
						                   <div class="">Todos</div>
						              </div>
						          </div>
						        </a>
							</li>
				    	<?php } ?>
				    	
				        
				        


				    </ul>
				
				</div>
		</div>
	</div>
	<div class="div-negro"></div>
	<div class="uk-container-expand padding-v-50">
		<div class="uk-grid">
			<div class="uk-width-1-6@m"></div>
			<div class="uk-width-expand@m">
				<div class="uk-child-width-1-3@m " uk-grid>
				<?php while ($row_CONSULTA2 = $CONSULTA2 -> fetch_assoc()) { ?>
					<div class="uk-flex uk-flex-center ">
			            
			            	 <?=item($row_CONSULTA2['id']);?>  
			          	
		            </div>
		        <?php } ?>
		        </div>
	        </div>
	        <div class="uk-width-1-6@m"></div>
		</div>
	</div>
		<div class="uk-flex uk-flex-center">
			<ul class="uk-pagination uk-flex-center uk-text-center">
				<?php
				if ($pag!=0) {
					$link=($pag-1).'_'.$prodspagina.'_'.$cat.'_productos';
					echo'
					<li><a href="'.$link.'"><i class="fa fa-lg fa-angle-left"></i> &nbsp;&nbsp; Anterior</a></li>';
				}
				
				$pagTotal=intval($numItems/$prodspagina);
				$resto=$numItems % $prodspagina;
				if (($resto) == 0){
					$pagTotal=($numItems/$prodspagina)-1;
				}
				for ($i=0; $i <= $pagTotal; $i++) { 
					$clase='';
					if ($pag==$i) {
						$clase='uk-active';
					}
					$link=$i.'_'.$prodspagina.'_'.$cat.'_productos';
					echo '<li><a href="'.$link.'" class="'.$clase.'">'.($i+1).'</a></li>';
				}
				if ($pag!=$pagTotal AND $numItems!=0) {
					$link=($pag+1).'_'.$prodspagina.'_'.$cat.'_productos';
					echo'
					<li><a href="'.$link.'">Siguiente &nbsp;&nbsp; <i class="fa fa-lg fa-angle-right"></i></a></li>';
				}
				?>
			</ul>
		</div>
	<div class="div-negro"></div>
		<div class="uk-container-expand">
			<div class="uk-grid">
				<div class="uk-width-1-3@m">
					<div id="sucur-produ" class="bg-black" style="height: 450px; overflow: auto;">
						<?php while ($row_CONSULTAsucur2= $CONSULTAsucur2 -> fetch_assoc()) { 
							echo cardSucurcal($row_CONSULTAsucur2['id'],'productos');
						 } ?>
					</div>
				</div>
				<div class="uk-width-expand@m uk-padding-remove">
					<section class="uk-padding-remove uk-margin-remove">

		<div class="uk-padding-remove uk-margin-remove bg-blanco sombra">
			<div id="map" style="height:450px;margin:0"></div>
			<div class="uk-position-top-center">
				
			</div>
		</div>
		
   
    
	
</section>      
				</div>			
			</div>			
		</div>



 <script>
//clase mapas viene del item
    	$(".mapas").click(function initMap() {
		    		var lat = $( this ).attr( "data-lat" );
		      		var lon = $( this ).attr( "data-lon" );

		      		lat =  parseFloat(lat);
		      		lon =  parseFloat(lon);

					console.log(lat); 
					console.log(<?= $lat ?>); 

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