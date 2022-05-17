<!DOCTYPE html>
<?=$headGNRL?>
<body>

<?=$header?>
<?php
 
 $consulta = $CONEXION -> query("SELECT * FROM configuracion WHERE id = 1 LIMIT 1");
 $row_consulta = $consulta->fetch_assoc();

 $CONSULTA5 = $CONEXION -> query("SELECT * FROM galeriaspic WHERE producto = 4 LIMIT 1");

 $query2 = "SELECT * FROM productos WHERE inicio = 1 and  categoria != 39 ORDER BY orden LIMIT 5";
 $query3 = "SELECT * FROM galeriaspic WHERE producto = 2 ORDER BY orden LIMIT 1";
 $query4 = "SELECT * FROM empresas WHERE estatus = 1 ORDER BY orden";
 $query5 = "SELECT * FROM productos WHERE categoria = 39 ORDER BY orden";
?>

<!-- Productos de muestra -->

<?=carousel("carousel")?>
<!-- seccion seguro y finanzas -->

<div class="uk-width-1-1">
	<section>
	<div class="padding-40 ">
		<div class="uk-grid uk-margin-remove  padding-40 p-remove">
			<div class="uk-width-1-1 uk-width-2-3@m">
				<h2 class="uk-text-uppercase color-primary uk-text-bold text-xxl padding-left-30">Seguros y fianzas</h2>
				<div class="uk-grid uk-child-width-1-1  uk-child-width-1-3@m uk-margin-remove">

				<?php
					$Consulta2 =  $CONEXION -> query($query2);
					$conta = 0;
					while($row_consulta2 = $Consulta2->fetch_assoc()){
					$conta++;
					
					switch ($conta) {
						case 1:
								$color = "#805179";
								$colortex = "color-white";
							break;
						case 2:
								$color = "#e3c7a3";
								$colortex = "color-white";
							break;
						case 3:
								$color = "#edf7fd";
								$colortex = "color-negro";
							break;
						case 4:
								$color = "#002349";
								$colortex = "color-white";
							break;
						case 5:
								$color = "#ac931f";
								$colortex = "color-white";
							break;
						
						default:
							# code...
							break;
					}
					?>
					<div class="padding-5">
						<div class="uk-inline">
							<div class="uk-text-center padding-10 <?=$colortex?>" style="min-height: 14em;background-color:<?=$color?>">
								<h3 class="<?=$colortex?> text-xxxl" style="line-height: 90%"><?=$row_consulta2['titulo']?></h3>
								<div class="text-7"><?=$row_consulta2['txt']?></div>
							</div>
							<a href="<?=$row_consulta2['id']?>_servicio-detalle"><div class="uk-position-bottom-right bg-white uk-text-center padding-h-10"> <i class="fas fa-chevron-right"></i></div></a>
						</div>
					</div>
				<?php } ?>
					
				</div>
			</div>
			<div class="uk-width-1-1 uk-width-1-3 uk-inline uk-visible@l">
				<?php 
					$Consulta3 =  $CONEXION -> query($query3);
					$row_consulta3 = $Consulta3->fetch_assoc();
				?>
				<img src="img/contenido/galerias/<?=$row_consulta3['imagen']?>" alt="" style="margin-top: -50%;position: relative;z-index: 3;">
				<img style="position: absolute;right: -2em;height: 19em;z-index: -1;" src="img/design/Elipse-2.png" alt="">

				<div class="uk-position-bottom uk-position-large" style="margin-bottom: 50px">
					<div  class="uk-margin-auto-vertical" style="position: relative;width: 35em;margin-left: -12em;">
					<div>
						<h1 class="uk-text-uppercase color-primary uk-text-bold text-xxl">Agenda tu consultoria</h1>
						<div>¡Estamos para apoyaste y darle la mejor solucion!</div>
					</div>
						<form class=" form-contacto" uk-grid>
							<input class="uk-input input-contacto uk-width-1-4 margin-h-5" type="text" id="nombre" placeholder="Nombre">
							<input class="uk-input input-contacto uk-width-1-4 margin-h-5" type="text" id="telefono" placeholder="Telefono">
							<input class="uk-input input-contacto uk-width-1-4 margin-h-5" type="text" id="email" placeholder="Correo">
							<buttom class="uk-button uk-button-personal  margin-h-5" id="footersend" >Enviar</buttom>
						</form>
					</div>
				</div>
			</div>
			<div class="uk-width-1-1 uk-inline uk-hidden@l">
						<div>
							<h1 class="uk-text-uppercase color-primary uk-text-bold text-xxl">Agenda tu consultoria</h1>
							<div>¡Estamos para apoyaste y darle la mejor solucion!</div>
						</div>
						<form class=" form-contacto" uk-grid>
							<input class="uk-input input-contacto uk-width-1-1 margin-h-5" type="text" id="nombre" placeholder="Nombre">
							<input class="uk-input input-contacto uk-width-1-1 margin-h-5" type="text" id="telefono" placeholder="Telefono">
							<input class="uk-input input-contacto uk-width-1-1 margin-h-5" type="text" id="email" placeholder="Correo">
							<div class="uk-text-center uk-width-1-1">
								<buttom class="uk-button uk-button-personal  margin-h-5" id="footersend" >Enviar</buttom>
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
			<div id="servicios" class="padding-h-40">
				<div class="uk-margin-remove border-u padding-40 p-remove-small">
					<div class="uk-text-center margin-top-30 uk-width-1-1">
						<h1 class="uk-text-uppercase color-primary uk-text-bold text-xxl">Servicios</h1>
						<p style="max-width: 36em;margin-left: auto;margin-right: auto;"><?= $row_consulta['txt_s1']?></p>
					</div>
					<div class="uk-container" style="margin-top: 3em;">
						<div id="slider-cat" class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider>
							<ul class="uk-slider-items uk-child-width-1-1 uk-child-width-1-3@m">
							<?php
									$Consulta5 =  $CONEXION -> query($query5);
									while($row_consulta5 = $Consulta5->fetch_assoc()){?>
								<li>
									<div class="uk-flex uk-flex-center uk-padding-remove">
										<div class="circulo-servi uk-border-circle uk-flex uk-flex-middle uk-flex-center  uk-inline">
											<div>
												<div class="text-lg uk-text-center"><?=strtok($row_consulta5['titulo'], " ")?></div>
												<div class="text-lg uk-text-center uk-text-bold"><?=strstr($row_consulta5['titulo'], " ")?></div>
											</div>
											<div class="uk-position-bottom-right uk-text-center "><img class="link-servicios" data-id="<?=$row_consulta5['id']?>" src="img/design/fecha-link.png" alt="" style="width: 4em; cursor: pointer"></div>
										</div>
									</div>
								</li>
							<?php }?>
							</ul>

							<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
							<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

						</div>
						<?php
							$Consulta6 =  $CONEXION -> query($query5);
							while($row_consulta6 = $Consulta6->fetch_assoc()){
								$proid = $row_consulta6['id'];
								?>
							<div id="<?=$proid?>" class="slider-servicios" style="display: none">
								<div class=" margin-v-30 uk-position-relative" >
				
											<div class="uk-card uk-card-default bg-secondary uk-height-1-1">
													<div class="uk-grid uk-margin-remove  uk-child-width-1-1 uk-child-width-1-2@m uk-height-1-1">
														<div class="uk-padding-large">
															<div class="uk-text-uppercase color-primary uk-text-bold text-lg"><?=$row_consulta6['titulo']?></div>
															<?=$row_consulta6['txt']?>
														</div>
														<div class="uk-cover-container" style="min-height: 400px">
															<?php $ConsultaPic =  $CONEXION -> query("SELECT * FROM productospic WHERE producto = $proid LIMIT 1");
															$row_ConsultaPic = $ConsultaPic->fetch_assoc()?>
															<img src="img/contenido/productos/<?=$row_ConsultaPic['imagen']?>" alt="" uk-cover >
															
														</div>
													</div>
												</div>
										
									
									<div class="slider-close uk-position-top-right" style="top: -60px;cursor: pointer;" ><i class="far fa-times-circle" style="font-size: 2em; color: black;"></i></div>
								</div>
							</div>
						<?php }?>
					</div>

					<div class="padding-v-40">
						<div class="uk-text-center margin-top-30 uk-width-1-1">
							<h1 class="uk-text-uppercase color-primary uk-text-bold text-xxl">¡Trabajamos con los mejores!</h1>
							<p style="max-width: 36em;margin-left: auto;margin-right: auto;"><?= $row_consulta['txt_s2']?></p>
						</div>
							<div class="uk-container">
								<div uk-slider>
									<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" >
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
									<ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>
								</div>
						</div>
					</div>
					<div class="uk-visible@m" style="margin-top: 7em">
						<?=$footer_fal?>
					</div>
				</div>
				<?=$footer?>
			</div>
		</div>
	</div>
</section>
</div>


<script>

		$(".link-servicios").click(function() {
			let idser = $(this).attr("data-id");
			console.log(idser);
			$(".slider-servicios").hide();
			$("#"+idser).show();
			$("#slider-cat").hide()

		})

		$(".slider-close").click(function() {
			console.log("hola");
			$(".slider-servicios").hide();
			$("#slider-cat").show()
		})


</script>



</body>
</html>