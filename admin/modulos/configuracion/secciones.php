<?php
$id=1;
$CONSULTA = $CONEXION -> query("SELECT * FROM configuracion WHERE id = $id");
$rowCONSULTA = $CONSULTA -> fetch_assoc();

echo '
<div class="uk-width-auto@m margin-top-20">
	<ul class="uk-breadcrumb uk-text-capitalize">
		<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'">Configuración</a></li>
		<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo='.$archivo.'" class="color-red">Secciones</a></li>
	</ul>
</div>




<div class="uk-width-1-1">
	<div class="uk-container">
		<div uk-grid class="uk-grid-large">

			<div class="uk-width-1-3@l margin-v-50 uk-text-left"></div>
			<div class="uk-width-1-3@l margin-v-50 uk-text-left">
				<div class="uk-margin">
					<div>
						Titulo seccion 2
					</div>
					<div class="uk-width-expand">
						<input type="text" class="input-text editarajax uk-input" data-tabla="'.$modulo.'" data-campo="txt_t1" data-id="1" value="'.$rowCONSULTA['txt_t1'].'">
					</div>
				</div>
			</div>
			<div class="uk-width-1-3@l margin-v-50 uk-text-left">
				<div class="uk-margin">
					<div>
						Titulo contacto
					</div>
					<div class="uk-width-expand">
						<input type="text" class="input-text editarajax uk-input" data-tabla="'.$modulo.'" data-campo="txt_t2" data-id="1" value="'.$rowCONSULTA['txt_t2'].'">
					</div>
				</div>
			</div>
			<div class="uk-width-1-3@l margin-v-50 uk-text-left">
				Inicio seccion 1
				<form action="index.php" method="post">
					<input type="hidden" name="modulo" value="'.$modulo.'">
					<input type="hidden" name="editartextosconformato" value="1">
					<input type="hidden" name="archivo" value="secciones">
					<textarea class="editor min-height-150" name="txt_s1">'.$rowCONSULTA['txt_s1'].'</textarea>
					<br>
					<div class="uk-text-center">
						<button class="uk-button uk-button-primary">Guardar</button>
					</div>
				</form>
			</div>

			<div class="uk-width-1-3@l margin-v-50 uk-text-left">
				Inicio seccion 2
				<form action="index.php" method="post">
					<input type="hidden" name="modulo" value="'.$modulo.'">
					<input type="hidden" name="editartextosconformato" value="1">
					<input type="hidden" name="archivo" value="secciones">
					<textarea class="editor min-height-150" name="txt_s2">'.$rowCONSULTA['txt_s2'].'</textarea>
					<br>
					<div class="uk-text-center">
						<button class="uk-button uk-button-primary">Guardar</button>
					</div>
				</form>
			</div>

			<div class="uk-width-1-3@l margin-v-50 uk-text-left">
				Contacto
				<form action="index.php" method="post">
					<input type="hidden" name="modulo" value="'.$modulo.'">
					<input type="hidden" name="editartextosconformato" value="1">
					<input type="hidden" name="archivo" value="secciones">
					<textarea class="editor min-height-150" name="txt_s3">'.$rowCONSULTA['txt_s3'].'</textarea>
					<br>
					<div class="uk-text-center">
						<button class="uk-button uk-button-primary">Guardar</button>
					</div>
				</form>
			</div>

		</div>';


		$pic=$rutaFinal.$rowCONSULTA['imagen2'];
		if(strlen($rowCONSULTA['imagen2'])>0 AND file_exists($pic)){
			$file='
			<div class="uk-panel uk-text-center">
				<a href="'.$pic.'" target="_blank">
					<img src="'.$pic.'">
				</a><br><br>
				<button class="uk-button uk-button-danger uk-button-large borrarpic"><i uk-icon="icon:trash"></i> Eliminar</button>
			</div>';
		}else{
			$file='
			<div class="uk-panel uk-text-center">
				<p class="uk-scrollable-box"><i uk-icon="icon:warning;ratio:5;"></i><br><br>
					Falta imagen<br><br>
				</p>
			</div>';
		}

		/*echo '
		<div class="uk-width-1-1">
			<div class="margin-top-50 uk-text-center uk-container uk-container-xsmall">
				Dimensiones recomendadas: 420 x 630 px<br><br>
				<div uk-grid>
					<div class="uk-width-1-2@s">
						<div id="fileuploader">
							Cargar
						</div>
					</div>
					<div class="uk-width-1-2@s uk-text-center margin-v-20">
						'.$file.'
					</div>
				</div>
			</div>
		</div>';*/

echo '
	</div>
</div>
';



$scripts.='
	$(document).ready(function() {
		$("#fileuploader").uploadFile({
			url:"../library/upload-file/php/upload.php",
			fileName:"myfile",
			maxFileCount:1,
			showDelete: \'false\',
			allowedTypes: "jpg,jpeg,png,gif",
			maxFileSize: 6291456,
			showFileCounter: false,
			showPreview:false,
			returnType:\'json\',
			onSuccess:function(data){ 
				window.location = (\'index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo='.$archivo.'&campo=imagen2&id='.$id.'&fileuploaded=\'+data);
			}
		});
	});	




	// Borrar imagen
	$(".borrarpic").click(function() {
		var statusConfirm = confirm("Realmente desea borrar esto?"); 
		if (statusConfirm == true) { 
			window.location = ("index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo='.$archivo.'&campo=imagen2&id='.$id.'&borrarpic=1");
		} 
	});

';