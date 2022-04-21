<!DOCTYPE html>
<?=$headGNRL?>
<body>

<?=$header?>
<?php
 

 $CONSULTA5 = $CONEXION -> query("SELECT * FROM galeriaspic WHERE producto = 4 LIMIT 1");
   
 $query3 = "SELECT * FROM galeriaspic WHERE producto = 2 ORDER BY orden LIMIT 1";
 $query4 = "SELECT * FROM empresas WHERE estatus = 1 ORDER BY orden";
?>

<!-- Productos de muestra -->
<div class="uk-container-expand bg-secondary">
	<div class="padding-h-40 padding-top-40">
		<div class="uk-margin-remove border-u-inver padding-40" style="padding-bottom: 11em">
			<div class="uk-flex uk-flex-center">
				<div style="max-width: 60%">
					<div class="uk-flex uk-flex-center">
						<img src="img/design/corazon.png" alt="">
					</div>
					<h1 class="uk-text-center color-white text-xxl">Tu seguro de gasto medicos mayores</h1>
					<p class="uk-text-center color-white text-8">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores, inventore, laboriosam ad molestiae eius nihil repellat accusantium possimus reiciendis a quod modi eos in. Eaque nobis ex mollitia magni minus?</p>
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
		<div class="uk-grid uk-margin-remove  padding-40">
			<div class="uk-width-1-2">
				<img src="img/design/producto1.png" alt="" style="margin-top: -20%;position: relative;z-index: 3;" >
			</div>
			<div class="uk-width-1-2">
				<div>
					Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam, temporibus. Pariatur deserunt assumenda quasi quod? Sit ad, magnam pariatur enim at perferendis quibusdam officiis id error maiores vitae, eos rerum.
				</div>
			</div>
		</div>
		<div class="padding-40">
			<div class="uk-width-1-1">
				<div class="uk-grid uk-margin-remove">
					<div class="uk-width-5-6 uk-margin-auto-vertical">
						<hr style="border-top:4px solid #002349; width: 100%">
					</div>
					<div class="uk-width-auto">
						<a href=""><img src="img/design/pdfdescarga.png" alt=""></a>
					</div>
					
				</div>
			</div>
			<div class="uk-width-1-1 padding-left-40">
				<div  class="uk-margin-auto-vertical" >
					<div>
						<h1 class="uk-text-uppercase color-primary uk-text-bold text-xxl">Agenda tu consultoria</h1>
						<div>¡Estamos para apoyaste y darle la mejor solucion!</div>
					</div>
					<form class=" form-contacto">
						<input class="uk-input input-contacto uk-margin-remove" type="text" id="nombre" placeholder="Nombre">
						<input class="uk-input input-contacto uk-margin-remove" type="text" id="telefono" placeholder="Telefono">
						<input class="uk-input input-contacto uk-margin-remove" type="text" id="email" placeholder="Correo">
						<buttom class="uk-button uk-button-personal  uk-margin-remove" id="footersend" >Enviar</buttom>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<section>
	<div>
		<div class="uk-container-expand bg-secondary">
			<div class="padding-h-40">
				<div class="uk-margin-remove border-u padding-40">
					
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
					<div style="margin-top: 7em">
						<?=$footer_fal?>
					</div>
				</div>
				<?=$footer?>
			</div>
		</div>
	</div>
</section>




</body>
</html>