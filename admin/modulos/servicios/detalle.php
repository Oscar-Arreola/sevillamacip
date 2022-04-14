<?php
$sql="SELECT * FROM $modulo WHERE id = $id";
$CONSULTA0 = $CONEXION -> query($sql);
while ($rowCONSULTA0 = $CONSULTA0 -> fetch_assoc()) {

	echo '
		<div class="uk-width-1-2@s margin-v-20">
			<ul class="uk-breadcrumb uk-text-capitalize">
				<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'">'.$modulo.'</a></li>
				<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo='.$archivo.'&id='.$id.'" class="color-red">'.$rowCONSULTA0['titulo'].'</a></li>
			</ul>
		</div>';

	echo '
		<div class="uk-width-1-2@s margin-v-20">
			<div>
				<div id="fileuploader">
					Cargar
				</div>
			</div>
		</div>';


	echo '
		<div class="uk-width-1-1 uk-text-center">
			<div uk-grid class="uk-grid-small uk-child-width-1-6@xl uk-child-width-1-4@m uk-child-width-1-2 uk-text-center uk-grid-match sortable" id="app" data-tabla="'.$modulopic.'">';

				$sql="SELECT * FROM $modulopic WHERE producto = $id ORDER BY orden";
				//echo $sql;
				$CONSULTA = $CONEXION -> query($sql);
				while ($rowCONSULTA = $CONSULTA -> fetch_assoc()) {
					$idpic=$rowCONSULTA['id'];
					$imagen=$rowCONSULTA['imagen'];
					$pic=$rutaFinal.$imagen;
					$picHtml=(file_exists($pic))?$pic:'../'.$noPic;
					echo '
						<div id="'.$idpic.'">
							<div class="uk-card uk-card-default uk-card-body">
								<div class="uk-margin" uk-lightbox>
									<a href="'.$picHtml.'">
										<img data-src="'.$picHtml.'" uk-img>
									</a>
								</div>
								
								<div class="uk-margin">
									<a href="javascript:borrarfoto(\''.$imagen.'\',\''.$idpic.'\')" class="uk-icon-button uk-button-danger" uk-icon="trash"></a>
								</div>
							</div>
						</div>';
				}

				echo '
			</div>
		</div>';





$scripts.='
function borrarfoto (file, id) { 
			var statusConfirm = confirm("Realmente desea eliminar esto?"); 
			if (statusConfirm == true) { 
				$.ajax({
					method: "POST",
					url: "modulos/'.$modulo.'/acciones.php",
					data: { 
						borrarfoto: 1,
						id: id,
						file: file
					}
				})
				.done(function( msg ) {
					UIkit.notification.closeAll();
					UIkit.notification(msg);
					$("#"+id).addClass( "uk-invisible" );
				});
			}
		}


// Subir imagen de galería
	$("#fileuploader").uploadFile({
		url:"../library/upload-file/php/upload.php",
		fileName:"myfile",
		maxFileCount:1,
		showDelete: "false",
		allowedTypes: "jpeg,jpg,png",
		maxFileSize: 6291456,
		showFileCounter: false,
		showPreview:false,
		returnType:"json",
		onSuccess:function(data){ 
			window.location = ("index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo='.$archivo.'&id='.$id.'&imagen="+data);
		}
	});





	';




}
