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
 $query4 = "SELECT * FROM empresas WHERE estatus = 1 ORDER BY orden";

?>


<section>
	<div class="padding-h-40 padding-v-40 bg-secondary uk-position-relative">
		<img src="img/design/fondo_mancha.png" alt="" class="uk-position-top-right" style="z-index: 1; width: 85%; height: 85%">
		<div class="border-white" style="position: relative; z-index: 2">
			<div class="padding-h-30">
				<div class="uk-grid" style="padding-top: 4em">
					<div class="uk-width-1-1 uk-width-1-3@m uk-flex uk-flex-bottom">
						<div>
							<h1 class="color-primary uk-text-bold text-xxl">Nuestra razon de ser, es tu bienestar</h1>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque dicta, commodi consequuntur vitae architecto libero, repellat pariatur quia, sed atque quo nemo voluptatibus illo error incidunt autem sequi fuga delectus!</p>
						</div>
					</div>
					<div class="uk-width-1-1 uk-width-1-4@m uk-flex uk-flex-middle">
						<img src="img/design/manos.png" alt="" style="width: 14em">
					</div>
					<div class="uk-width-1-1 uk-width-expand@m uk-padding-remove" >
									<div>
										<div class="circulo-servi uk-border-circle uk-flex uk-flex-middle uk-flex-center uk-inline" style="color:#805179" >
											<div class="color-white">
												<div class="text-lg uk-text-center uk-text-bold">VISION</div>
											</div>
											<div class="uk-position-bottom-left uk-text-center "><img src="img/design/fecha-link.png" alt="" style="width: 4em; cursor: pointer"></div>
										</div>
									</div>
									<div class="uk-flex uk-flex-around">
										<div class="uk-flex uk-flex-middle">
											<img src="img/design/logo_azul.png" alt="">
										</div>
										<div class="circulo-servi uk-border-circle uk-flex uk-flex-middle uk-flex-center uk-inline" style="color:#ac931f" >
											<div class="color-white">
												<div class="text-lg uk-text-center uk-text-bold">VALORES</div>
											</div>
											<div class="uk-position-top-left uk-text-center "><img src="img/design/fecha-link.png" alt="" style="width: 4em; cursor: pointer"></div>
										</div>
									</div>
									<div>
										<div class="circulo-servi uk-border-circle uk-flex uk-flex-middle uk-flex-center uk-inline" style="color:#e3c7a3" >
											<div class="color-white">
												<div class="text-lg uk-text-center uk-text-bold">MISIÓN</div>
											</div>
											<div class="uk-position-bottom-right uk-text-center "><img src="img/design/fecha-link.png" alt="" style="width: 4em; cursor: pointer"></div>
										</div>
									</div>
					</div>

				</div>
				<div class="padding-v-40 margin-top-30">
						<div class="uk-text-center margin-top-30 uk-width-1-1">
							<h1 class="uk-text-uppercase color-primary uk-text-bold text-xxl">¡Trabajamos con los mejores!</h1>
							<p style="max-width: 36em;margin-left: auto;margin-right: auto;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
						<div class="uk-container">
							<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider>
								<ul class="uk-slider-items uk-child-width-1-1 uk-child-width-1-5@m uk-grid">
									<?php
										$Consulta4 =  $CONEXION -> query($query4);
										while ($row_consulta4 = $Consulta4->fetch_assoc()) {
									?>
									<li class=" uk-flex uk-flex-center uk-flex-middle">
										<div class="uk-panel">
											<img src="img/contenido/empresas/<?=$row_consulta4['nombre']?>" style="max-width: 200px" alt="">
										</div>
									</li>
									<?php } ?>
								</ul>

							<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
							<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

						</div>
						</div>
					</div>
				</div>
				<div class="padding-40" style="margin-top: 5em">
					<?=$footer_fal?>
				</div>
		
		</div>
	</div>
</section>


<?=$footer?>



</body>
</html>