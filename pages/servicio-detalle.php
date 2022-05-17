<!DOCTYPE html>
<?=$headGNRL?>
<body>

<?=$header?>
<?php
 

 $Consulta1 = $CONEXION -> query("SELECT * FROM productos WHERE id = $id LIMIT 1");
 $row_consulta1 = $Consulta1->fetch_assoc();
 $Consulta2 = $CONEXION -> query("SELECT * FROM productospic WHERE producto = $id ORDER BY orden LIMIT 1");
 $row_consulta2 = $Consulta2->fetch_assoc();
 $Consulta3 = $CONEXION -> query("SELECT * FROM productospic WHERE producto = $id ORDER BY orden LIMIT 99 OFFSET 1 ");
 $query4 = "SELECT * FROM empresas WHERE estatus = 1 ORDER BY orden";


?>

<!-- Productos de muestra -->
<div class="uk-container-expand bg-secondary">
	<div class="padding-h-40 padding-top-40">
		<div class="uk-margin-remove border-u-inver padding-40 p-remove-small" style="padding-bottom: 11em">
			<div class="uk-flex uk-flex-center">
				<div style="max-width: 60%">
					<div class="uk-flex uk-flex-center">
						<img src="img/contenido/productos/<?=$row_consulta2['imagen']?>" alt="" style="height: 9em">
					</div>
					<h1 class="uk-text-center color-white text-xxl"><?=$row_consulta1['titulo']?></h1>
					<p class="uk-text-center color-white text-8"><?=$row_consulta1['txt']?></p>
					<div class="uk-flex uk-flex-center">
						<hr width="50%">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- seccion seguro y finanzas -->
<section>
	<div class="padding-h-40 padding-v-40">
		<div class="uk-grid uk-margin-remove  padding-40 p-remove-small">
			<div class="uk-width-1-1 uk-width-1-2@m">

				<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow="min-height: 600; max-height: 700">

					<ul class="uk-slideshow-items">
					<?php
						while ( $row_consulta3 = $Consulta3->fetch_assoc()) {
					?>
						<li>
							<img src="img/contenido/productos/<?=$row_consulta3['imagen']?>" alt="" uk-cover>
						</li>
					<?php } ?>
					</ul>

					<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
					<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

				</div>
			
				
				
			</div>
			<div class="uk-width-1-1 uk-width-1-2@m p-remove-small">
				<div>
					<?=$row_consulta1['txt1']?>
				</div>
			</div>
		</div>
		<div class="padding-40 p-remove-small">
			<div class="uk-width-1-1 uk-visible@l">
				<div class="uk-grid uk-margin-remove">
					<div class="uk-width-5-6 uk-margin-auto-vertical">
						<hr style="border-top:4px solid #002349; width: 100%">
					</div>
					<div class="uk-width-auto">
						<?php if ($row_consulta1['imagen'] != null) { ?>
							<a href="img/contenido/productos/<?=$row_consulta1['imagen']?>" target="_blank"><img src="img/design/pdfdescarga.png" alt=""></a>
						<?php } ?>
					</div>
					
				</div>
			</div>
			<div class="uk-width-1-1 uk-hidden@l">
				<div class="uk-width-1-1 uk-flex uk-flex-center p-remove-small">
						<?php if ($row_consulta1['imagen'] != null) { ?>
							<a href="img/contenido/productos/<?=$row_consulta1['imagen']?>" target="_blank"><img src="img/design/pdfdescarga.png" alt=""></a>
						<?php } ?>
					</div>

			</div>
			<div class="uk-width-1-1 padding-left-40 uk-visible@l">
				<div  class="uk-margin-auto-vertical" >
					<div>
						<h1 class="uk-text-uppercase color-primary uk-text-bold text-xxl">Agenda tu consultoria</h1>
						<div>¡Estamos para apoyaste y darle la mejor solucion!</div>
					</div>
					<form class=" form-contacto" uk-grid>
							<input class="uk-input input-contacto uk-width-1-4 uk-margin-remove" type="text" id="nombre" placeholder="Nombre">
							<input class="uk-input input-contacto uk-width-1-4 uk-margin-remove" type="text" id="telefono" placeholder="Telefono">
							<input class="uk-input input-contacto uk-width-1-4 uk-margin-remove" type="text" id="email" placeholder="Correo">
							<buttom class="uk-button uk-button-personal  uk-margin-remove" id="footersend" >Enviar</buttom>
						</form>
				</div>
			</div>

			<div class="uk-width-1-1 uk-inline uk-hidden@l">
						<div>
							<h1 class="uk-text-uppercase color-primary uk-text-bold text-xxl">Agenda tu consultoria</h1>
							<div>¡Estamos para apoyaste y darle la mejor solucion!</div>
						</div>
						<form class=" form-contacto uk-margin-remove uk-padding-remove" uk-grid>
							<input class="uk-input input-contacto uk-width-1-1 uk-margin-remove" type="text" id="nombre" placeholder="Nombre">
							<input class="uk-input input-contacto uk-width-1-1 uk-margin-remove" type="text" id="telefono" placeholder="Telefono">
							<input class="uk-input input-contacto uk-width-1-1 uk-margin-remove" type="text" id="email" placeholder="Correo">
							<div class="uk-text-center uk-width-1-1 uk-padding-remove">
								<buttom class="uk-button uk-button-personal  uk-margin-remove" id="footersend" >Enviar</buttom>
							</div>
						</form>
					</div>
			</div>

		</div>
	</div>
</section>

<section>
	<div>
		<div class="uk-container-expand bg-secondary">
			<div class="padding-h-40 ">
				<div class="uk-margin-remove border-u padding-40  p-remove-small">
					
					<div class="padding-v-40">
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
				<?=$footer?>
			</div>
		</div>
	</div>
</section>




</body>
</html>