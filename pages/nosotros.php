<!DOCTYPE html>
<?=$headGNRL?>
<body>

<?=$header?>
<?php
 $CONSULTA1 = $CONEXION -> query("SELECT * FROM clientes WHERE estatus = 1");
 $CONSULTA2 = $CONEXION -> query("SELECT * FROM empresas WHERE estatus = 1");
 $CONSULTA3	= $CONEXION -> query("SELECT * FROM configuracion LIMIT 1");
 $row_CONSULTA3 = $CONSULTA3 -> fetch_assoc();
 $mision = $row_CONSULTA3['about2'];
 $vision = $row_CONSULTA3['about3'];
   

?>


	<div class="uk-background-cover bg-h-mediun-plus" style="background-image: url(img/design/fondo_ladrillos.png);">
		<div class="uk-position-top-left uk-position-small">
            <img class="img-slider-pri" src="img/design/logo.png" uk-img>
        </div>
	</div>
	<div style="    height: 0px; text-align: center;">
		 <img class="" src="img/design/logo_grande.png" uk-img style="margin-top: -8em; max-height: 300px">
	</div>
	<div class="uk-background-cover bg-h-mediun-plus" style="background-image: url(img/design/fondo_cuchillos.png);"></div>
		<div class="" style="margin-top: -11rem;">		    
		    <div class="uk-grid">
		    	<div class="uk-width-1-6"></div>
					<div class="uk-width-expand ">
						<h1 class="uk-text-capitalize borde-negro"><img data-src="img\design\CORTES_DESTACADOS.png" uk-img style="max-height: 60px"> nuestra misi&oacute;n</h1>
					</div>
				<div class="uk-width-1-6"></div>
			</div>
				
			
		    <div class="uk-grid">
		    	<div class="uk-width-1-6"></div>
				<div class="uk-width-expand bg-gris-claro padding-40 text-vm borde-vm"><?=$mision?></div>
				<div class="uk-width-1-6"></div>
			</div>
				
		</div>
	<div class="div-negro altura-flotante"></div>

	<div class="uk-background-cover altura-vm" style="background-image: url(img/design/imagen_mision.png);"></div>
	<div class="uk-background-cover bg-semiblack" style="height: 300px"></div>
		<div class="" style="margin-top: -11rem;">		    
		    <div class="uk-grid">
		    	<div class="uk-width-1-6"></div>
					<div class="uk-width-expand ">
						<h1 class="uk-text-capitalize borde-negro"><img data-src="img\design\CORTES_DESTACADOS.png" uk-img style="max-height: 60px"> nuestra visi&oacute;n</h1>
					</div>
				<div class="uk-width-1-6"></div>
			</div>

		    <div class="uk-grid">
		    	<div class="uk-width-1-6"></div>
				<div class="uk-width-expand bg-gris-claro padding-40 text-vm borde-vm"><?=$vision?></div>
				<div class="uk-width-1-6"></div>
			</div>		
		</div>
		<div class="div-negro altura-flotante"></div>
	<div class="uk-background-cover altura-vm" style="background-image: url(img/design/imagen_vision.png);">
		
	</div>
	<div class="div-negro"></div>
	<div class="padding-30 bg-semiblack uk-text-center padding-40">
		<h1 class="uk-text-capitalize borde-negro"><img data-src="img\design\CORTES_DESTACADOS.png" uk-img style="max-height: 60px"> Algunos clientes</h1>
		
	</div>
	<div class="uk-container-expand padding-v-100 uk-flex uk-flex-middle">
		 <div class="uk-grid">
			<div class="uk-width-1-6@m"></div>
				<div class="uk-width-expand uk-slider-container padding-h-39 " uk-slider="<?=$sliderAutoplay?>">
					<div class="uk-position-relative uk-dark" tabindex="-1">
					    <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@m uk-grid">
					    	<?php while ($row_CONSULTA1 = $CONSULTA1 -> fetch_assoc()) { ?>
					        <li class="uk-flex uk-flex-middle uk-flex-center">
					            <div class="uk-panel">
					                <img src="img/contenido/clientes/<?=$row_CONSULTA1['nombre']?>" alt="">
					            </div>
					        </li>
					         <?php } ?>	
					    </ul>

					    <a class="uk-position-center-left-out uk-position-small uk-visible@s " href="#" uk-slidenav-previous uk-slider-item="previous"></a>
					    <a class="uk-position-center-right-out uk-position-small uk-visible@s" href="#" uk-slidenav-next uk-slider-item="next"></a>
					</div>
				</div>
			<div class="uk-width-1-6@m"></div>	
		</div>			
	</div>
	<div class="div-negro"></div>
	<div class="uk-background-cover" style="background-image: url(img/design/fondo_empleado.png);">
		<div uk-grid class="">
			<div class="uk-width-expand@m uk-flex uk-flex-right uk-flex-middle uk-text-center" >
				<div style="max-width: 700px">
					<div class="borde-blanco" style="font-size: 2em">No importa el tama&ntilde;o de tu negocio podemos trabajar contigo.</div>
					<a class="uk-button uk-button-black margin-v-10" href="<?=$ruta?>#negocios" >Saber m&aacute;s</a>
				</div>
			</div>
			<div class="uk-width-1-3@m">
				<img class="" src="img/design/EMPLEADO_CEDIS.png" alt="" uk-img style="max-height: 400px">
			</div>
		</div>
	</div>
	<div class="div-negro"></div>
	<div class=" padding-30 bg-semiblack uk-text-center padding-40">
		<h1 class="uk-text-capitalize borde-negro"><img data-src="img\design\CORTES_DESTACADOS.png" uk-img style="max-height: 60px"> nuestros excelentes proveedores</h1>
		
	</div>
	<div class="uk-container-expand padding-v-100 uk-flex uk-flex-middle">
		 <div class="uk-grid">
			<div class="uk-width-1-6@m"></div>
				<div class="uk-width-expand uk-slider-container padding-h-39 " uk-slider="<?=$sliderAutoplay?>">
					<div class="uk-position-relative uk-dark" tabindex="-1">
					    <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@m uk-grid">
					    	<?php while ($row_CONSULTA2 = $CONSULTA2 -> fetch_assoc()) { ?>
					        <li class="uk-flex uk-flex-middle uk-flex-center">
					            <div class="uk-panel">
					                <img src="img/contenido/empresas/<?=$row_CONSULTA2['nombre']?>" alt="">
					            </div>
					        </li>
					         <?php } ?>	
					    </ul>

					    <a class="uk-position-center-left-out uk-position-small uk-visible@s " href="#" uk-slidenav-previous uk-slider-item="previous"></a>
					    <a class="uk-position-center-right-out uk-position-small uk-visible@s" href="#" uk-slidenav-next uk-slider-item="next"></a>
					</div>
				</div>
			<div class="uk-width-1-6@m"></div>	
		</div>			
	</div>



<?=$footer?>



</body>
</html>