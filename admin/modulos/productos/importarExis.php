<?php
echo '
	<div class="uk-width-auto margen-v-20">
		<ul class="uk-breadcrumb uk-text-capitalize">
			<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'">Productos</a></li>
			<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=importarExis" class="color-red">Importar</a></li>
		</ul>
	</div>
	<div class="uk-width-expand@m margen-v-20">
		<div uk-grid class="uk-flex-right">
			<div>
				<button class="uk-button uk-button-default color-red" id="eliminatodo"><i uk-icon="trash"></i> &nbsp; Borrar todo</button>
			</div>
			<!--<div>
				<a href="modulos/productos/exportar.php" class="uk-button uk-button-primary" targer="_blank" download="productos.csv"><i uk-icon="download"></i> &nbsp; Exportar</a>
			</div>-->
		</div>
	</div>
';


?>
<style type="text/css">
 th, td {
	  border: 1px solid black;
	   border-collapse: collapse;
	}
	th, td {
	  padding: 5px;
	}
</style>

<div class="uk-width-1-1">
	<div uk-grid>
		<div class="uk-width-1-2@m">
			<div id="fileuploader">
				Cargar
			</div>
		</div>

		<div class="uk-width-1-2@m">
			El archivo debe ser formato CSV<br>
			CSV = Valores separados por comas<br>
			No se deben poner comas adicionles dentro de los campos<br>
			El SKU debe de estar formado por el sku orginal + el codigo del color + guion medio + el ID la talla<br>
			EL codigo del color se puede ver <a href="#modal-co" uk-toggle style="color: red">aqui</a><br>
			EL ID del la talla se puede ver <a href="#modal-ta" uk-toggle style="color: red">aqui</a><br>
		</div>
	</div>
</div>

<div class="uk-width-1-1">
	<p>Ejemplo:</p>
	<p>
		<table>
			<tr>

				<td>sku</td>
				<td>existencia</td>
			</tr>
			<tr>

				<td>0013MPANBCL-1</td>
				<td>10</td>

			</tr>
		</table>
	</p>
	<a href="../img/contenido/importar/ejemploExis.csv" download class="uk-button uk-button-white"><i class="fa fa-download"></i> Ejemplo</a>
</div>

<div id="errormessage" class="uk-width-1-1">
	<div class="uk-alert-danger" uk-alert>
		<a class="uk-alert-close" uk-close></a>
		<p>Ocurrió un error.<br>Revise la sintaxis de su archivo</p>
	</div>
</div>

<?php
	$consulta_co = $CONEXION->query("SELECT * FROM productoscolor");
	echo '
		<div id="modal-co" uk-modal>
		    <div class="uk-modal-dialog uk-modal-body">
		        <button class="uk-modal-close-default" type="button" uk-close></button>
		        <h2 class="uk-modal-title">Codigos de colores</h2>
		        <table>
		        <tr>
					<td>Color</td>
					<td>Codigo</td>
				</tr>';
		        while ($row_consultaco = $consulta_co->fetch_assoc()) {
		        	echo '
		        	<tr>
						<td>'.$row_consultaco['name'].'</td>
						<td>'.$row_consultaco['codigo'].'</td>
					</tr>';
		        }
		        echo '
		        </table>
		    </div>
		</div>';
	$consulta_ta = $CONEXION->query("SELECT * FROM productostallaclasif");

	echo '
		<div id="modal-ta" uk-modal>
		    <div class="uk-modal-dialog uk-modal-body">
		        <button class="uk-modal-close-default" type="button" uk-close></button>
		        <h2 class="uk-modal-title">Tipos de tallas</h2>
		        <table>
		        ';
		        while ($row_consultata = $consulta_ta->fetch_assoc()) {
		        	$tipo = $row_consultata['id'];
		        	echo '
		        	<tr>
						<td style="background-color: lightgray">Tipo de Talla</td>
					</tr>
		        	<tr>
						<td>'.$row_consultata['txt'].'</td>
					</tr>
					<tr style="border: 0px"><td style="border: 0px"></td></tr>
					<tr>
						<td>ID</td>
						<td>Nombre de talla</td>
					</tr>
					';

					$consulta_su = $CONEXION->query("SELECT * FROM productostalla WHERE tipo = $tipo");
					while ($row_consultasu = $consulta_su->fetch_assoc()) {
						echo'
						<tr>
							<td>'.$row_consultasu['id'].'</td>
							<td>'.$row_consultasu['txt'].'</td>
						</tr>
						';
						
					}

		        }
		        echo '
		        </table>
		    </div>
		</div>';
	$consulta_cla = $CONEXION->query("SELECT * FROM productosclaves");
	echo '
		<div id="modal-cla" uk-modal>
		    <div class="uk-modal-dialog uk-modal-body">
		        <button class="uk-modal-close-default" type="button" uk-close></button>
		        <h2 class="uk-modal-title">Palabras clave</h2>
		        <table>
		        <tr>
					<td>ID</td>
					<td>Clave</td>
				</tr>';
		        while ($row_consultacla = $consulta_cla->fetch_assoc()) {
		        	echo '
		        	<tr>
						<td>'.$row_consultacla['id'].'</td>
						<td>'.$row_consultacla['txt'].'</td>
					</tr>';
		        }
		        echo '
		        </table>
		    </div>
		</div>';

if (isset($showTable)) {
	echo '
	<div class="uk-width-1-1">
		<div class="uk-margin uk-text-center">
			<button class="continuebutton uk-button uk-button-primary uk-hidden">Continuar</button>
		</div>
		<div class="uk-overflow-auto">
			<table class="uk-table uk-table-striped uk-table-hover uk-table-small uk-table-middle">
				<thead>
					<tr>
						
						<td>sku</td>
						<td>existencia</td>
					</tr>
				</thead>
				<tbody>';
					$numReg=count($infoExistencias);
					/*$numRegUnico=count($array_unique);*/
					
					// Buscar repetidos
					$sku[0]=0;
					foreach ($infoExistencias as $key => $value) {
						$sku[$value[0]]=(isset($sku[$value[0]]))?1:0;
						if ($sku[$value[0]]==1) {
							$dontConinue=1;
							echo '<tr><td colspan="30" class="bg-red color-white text-xl uk-text-left">'.$value[2].'  <span class="text-sm">repetido en el archivo</span><div style="width:0;overflow:hidden;"><input type="text" autofocus></div></td></tr>';
						}
					}
					foreach ($infoExistencias as $key => $value) {
						$rowError = '';
						$catName = '';
						$marcaName = '';

						/*$sql="SELECT txt FROM $modulocat WHERE id = $value[0]";
						$CONSULTA = $CONEXION -> query($sql);
						$numCats=$CONSULTA->num_rows;
						if ($numCats==1) {
							$rowCONSULTA = $CONSULTA -> fetch_assoc();
							$catName = $rowCONSULTA['txt'];
						}*/
						/*
						$sql="SELECT genero FROM productos WHERE id = $value[1]";
						$CONSULTA = $CONEXION -> query($sql);
						$numMarcas=$CONSULTA->num_rows;
						if ($numMarcas==1) {
							$rowCONSULTA = $CONSULTA -> fetch_assoc();
							$marcaName = $rowCONSULTA['txt'];
						}*/

						// DESGLOSAR SKU

						$skuOrigen 	= strval($value[0]);
						$skuPro 	= substr($skuOrigen, 0, 8);
						$CodColor 	= substr($skuOrigen, 8, 3);
						 
						$i = strrpos($skuOrigen,'-');
						$l = strlen($skuOrigen) - $i;
						$idTalla = strtolower(substr($skuOrigen,$i+1,$l));

						$sql="SELECT id FROM $modulo WHERE sku = '$skuPro";
						// echo $sql;
						$CONSULTA = $CONEXION -> query($sql);
						$existe = $CONSULTA->num_rows;
						if ($existe<0) {
							$bg = 'bg-red color-white';
							$rowError .= '<br>'.$value[0].' no existe';
						}

						$bg = (!isset($value[1]))?'bg-red color-white':$bg;
						$bg = ( isset($value[2]))?'bg-red color-white':$bg;

						$rowError .= (!isset($value[1]))?'<br>Al producto '.$value[0].' le faltan celdas':'';
						$rowError .= ( isset($value[2]))?'<br>Al producto '.$value[0].' le sobran celdas':'';


						if (strlen($rowError)>0) {
							$dontConinue=1;
							echo '<tr><td colspan="30" class="bg-red color-white text-xl uk-text-left">'.$rowError.'<div style="width:0;overflow:hidden;"><input type="text" autofocus></div></td></tr>';
						}
						
						echo "
								<tr>
									<td class='$bg'>$value[0]</td>
									<td class='$bg'>$value[1]</td>
								</tr>";
					}
					echo '
				</tbody>
			</table>
		</div>
	</div>';

}


echo '
<div id="spinnermodal" class="uk-modal-full" uk-modal>
  <div class="uk-modal-dialog uk-flex uk-flex-middle uk-height-viewport">
    <div class="uk-width-1-1">
    	<div class="uk-flex uk-flex-center">
    		<div style="max-width:90%;width:600px;">
				<progress id="js-progressbar" class="uk-progress" value="0" max="100"></progress>
	    	</div>
    	</div>
		<div uk-slider="autoplay:true;autoplay-interval:4000;" class="uk-width-1-1 uk-margin">
			<ul class="uk-width-1-1 uk-slider-items uk-child-width-1-1 uk-grid-match ">
				<li>
					<div class="uk-text-center">
						Espera un momento
					</div>
				</li>
				<li>
					<div class="uk-text-center">
						Procesando tu archivo
					</div>
				</li>
				<li>
					<div class="uk-text-center">
						Codificando el documento
					</div>
				</li>
				<li>
					<div class="uk-text-center">
						Contactando a la NASA
					</div>
				</li>
				<li>
					<div class="uk-text-center">
						El FBI va por ti
					</div>
				</li>
				<li>
					<div class="uk-text-center">
						No te creas, pero es cierto
					</div>
				</li>
				<li>
					<div class="uk-text-center">
						Ya casi terminamos
					</div>
				</li>
				<li>
					<div class="uk-text-center">
						Un minutito más
					</div>
				</li>
				<li>
					<div class="uk-text-center">
						Otro minutito
					</div>
				</li>
				<li>
					<div class="uk-text-center">
						Sé paciente
					</div>
				</li>
				<li>
					<div class="uk-text-center">
						Estamos a punto de acabar
					</div>
				</li>
				<li>
					<div class="uk-text-center">
						¿Tienes un minuto?
					</div>
				</li>
				<li>
					<div class="uk-text-center">
						Ve por un café
					</div>
				</li>
				<li>
					<div class="uk-text-center">
						Me traes uno
					</div>
				</li>
			</ul>
		</div>      
    </div>
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
			allowedTypes: "csv",
			maxFileSize: 9999999,
			showFileCounter: false,
			showPreview:false,
			returnType:\'json\',
			onSuccess:function(data){ 
				window.location = (\'index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=importarExis&csvfileExis=\'+data);
			}
		});

		// Eliminar todo los productos
		$("#eliminatodo").click(function() {
			UIkit.modal.confirm("Desea borrar todos los productos?").then(function () {
				var statusConfirm2 = confirm("Perdona la insistencia, pero es muy importante. Estás a punto de borrar todos los productos. Estás seguro?"); 
				if (statusConfirm2 == true) {
					window.location = ("index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=importarExis&borrartodoslosproductos");
				}
			}, function () {
				console.log("Rejected.")
			});
		});

		$(".continuebutton").click(function(){
			UIkit.modal("#spinnermodal").show();
			procesararchivoimportado();
		});

	});

	';


	if (!isset($dontConinue)) {
		$scripts.= '
		$(".continuebutton").removeClass("uk-hidden");
		$("#errormessage").remove();
		';
	}

	if (isset($fileFinal)) {
		$scripts.= '
		function procesararchivoimportado() {
			$.ajax({
				method: "POST",
				url: "modulos/'.$modulo.'/acciones.php",
				data: { 
					file: "'.$fileFinal.'",
					infoExistencias: 1
				}
			})
			.done(function( response ) {
				console.log( response );
				datos = JSON.parse(response);
				UIkit.notification.closeAll();
				console.log(datos.estatus)
				if (datos.estatus == 1) {
					window.location = (\'index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=importarExis&showsuccess=1\');
				} else {
					var newvalue = datos.estatus * 100;
					$("#js-progressbar").val(newvalue);
					UIkit.notification(datos.msj,{pos:"bottom-right"});
					procesararchivoimportado();
				}
			});
		}
		';
	}



?>