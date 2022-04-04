<?php
echo '
	<div class="uk-width-auto margin-top-20 uk-text-left">
		<ul class="uk-breadcrumb uk-text-capitalize">
			<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'">Configuración</a></li>
			<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=cfgmarcas" class="color-red">Claves</a></li>
		</ul>
	</div>

	<div class="uk-width-1-1">
		<div class="uk-container uk-container-small">
			<div class="uk-card uk-card-default uk-card-body uk-border-rounded">

				<div class="uk-text-right uk-margin">
					<a href="#add" uk-toggle class="uk-button uk-button-success"><i uk-icon="plus"></i> &nbsp; Nueva clave</a>
				</div>

				<div class="margin-bottom-50">
					<table class="uk-table uk-table-striped uk-table-hover uk-table-small uk-table-middle uk-table-responsive">
						<thead>
							<tr>
								<th class="uk-text-left">Claves</th>
								<th width="50px"></th>
							</tr>
						</thead>
						<tbody class="sortable" data-tabla="productosclaves">';
		// Obtener tipos
		$CONSULTA = $CONEXION -> query("SELECT * FROM productosclaves ORDER BY orden");
		while ($rowCONSULTA = $CONSULTA -> fetch_assoc()) {
			$thisID=$rowCONSULTA['id'];

			$pic=$rutaFinal.$rowCONSULTA['imagen'];
			$fichaIcon='<i class="fa-lg far fa-square uk-text-muted pointer"></i>';
			if(file_exists($pic) AND strlen($rowCONSULTA['imagen'])>0){
				$fichaIcon='
					<div class="uk-inline">
						<i class="fa-lg fas fa-check-square uk-text-primary pointer"></i>
						<div uk-drop="pos: right-justify">
							<img uk-img data-src="'.$pic.'" class="uk-border-rounded">
						</div>
					</div>';
			}

			echo '
							<tr id="row'.$thisID.'">
								<td class="uk-text-left">
									<input class="editarajax uk-input uk-form-small uk-form-blank" type="text" data-tabla="productostalla" data-campo="txt" data-id="'.$rowCONSULTA['id'].'" value="'.$rowCONSULTA['txt'].'">
								</td>
								
								<td>
									<a href="javascript:eliminargeneral('.$thisID.',\'productosclaves\')" class="borrar color-red" uk-icon="trash"></a>
								</td>
							</tr>';
		}


		echo '
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>';

// Auxiliar para leer el id que se desea editar
echo '
	<input type="hidden" id="fichaid">';

// Ventanas modales
echo '
	<div id="ficha" uk-modal>
		<div class="uk-modal-dialog uk-modal-body">
			<button class="uk-modal-close-default" type="button" uk-close></button>
			<p>JPG 160 x 110 px</p>
			<div id="fileupload">
				Cargar
			</div>
		</div>
	</div>

';


// MODAL MARCAS
	echo '
		<div id="add" uk-modal class="modal">
			<div class="uk-modal-dialog uk-modal-body">
				<button class="uk-modal-close-default" type="button" uk-close></button>
				<h4>Nueva clave</h4>
				<form action="index.php" method="post">
					<input type="hidden" name="nuevoinsert" value="1">
					<input type="hidden" name="modulo" value="'.$modulo.'">
					<input type="hidden" name="archivo" value="'.$archivo.'">
					<input type="hidden" name="tabla" value="productosclaves">

					<div uk-grid class="uk-grid-collapse">
						<div class="uk-width-1-1">
							<input type="text" name="txt" class="uk-input" placeholder="Nueva clave" required><br><br>
						</div>
						<div class="uk-width-1-1 uk-text-center">
							<a href="#" class="uk-button uk-button-white uk-button-large uk-modal-close">Cancelar</a>
							<button class="uk-button uk-button-primary uk-button-large" type="submit" tabindex="10">Agregar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		';

$scripts='
	// Elimina general
	function eliminargeneral (id,tabla) { 
		UIkit.modal.confirm("Realmente desea borrar esto?").then(function() {
			$.ajax({
				method: "POST",
				url: "modulos/'.$modulo.'/acciones.php",
				data: { 
					eliminargeneral: 1,
					id: id,
					tabla: tabla
				}
			})
			.done(function( response ) {
				console.log( response );
				UIkit.notification.closeAll();
				datos = JSON.parse( response );
				UIkit.notification(datos.msj,{pos:"bottom-right"});
				if(datos.estatus==1){
					$("#row"+id).fadeOut();
				}
			});
		}, function () {
			console.log("Rechazado")
		});
	}

	
	$(".fichalink").click(function(){
		var id = $(this).attr("data-id");
		$("#fichaid").val(id);
	})

	$("#fileupload").uploadFile({
		url: "../library/upload-file/php/upload.php",
		fileName: "myfile",
		maxFileCount: 1,
		showDelete: \'false\',
		allowedTypes: "jpg,jpeg,png,gif",
		maxFileSize: 10000000,
		showFileCounter: false,
		showPreview: false,
		returnType: \'json\',
		onSuccess:function(data){
			var id = $("#fichaid").val();
			window.location = (\'index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo='.$archivo.'&tabla=productosclaves&campo=imagen&id=\'+id+\'&fileuploaded=\'+data);
		}
	});
	
	';









