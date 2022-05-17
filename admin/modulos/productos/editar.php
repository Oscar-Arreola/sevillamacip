<?php
	$consulta = $CONEXION -> query("SELECT * FROM $modulo WHERE id = $id");
	$row_catalogo = $consulta -> fetch_assoc();
	$cat=$row_catalogo['categoria'];
	$marca=$row_catalogo['marca'];
	$claves_txt = $row_catalogo['claves'];

	$CATEGORY = $CONEXION -> query("SELECT * FROM $modulocat WHERE id = $cat");
	$row_CATEGORY = $CATEGORY -> fetch_assoc();
	$catNAME=$row_CATEGORY['txt'];
	$catParentID=$row_CATEGORY['parent'];

	$CATEGORY = $CONEXION -> query("SELECT * FROM $modulocat WHERE id = $catParentID");
	$row_CATEGORY = $CATEGORY -> fetch_assoc();
	$catParent=$row_CATEGORY['txt'];

// BREADCRUMB
	echo '
	<div class="uk-width-1-1 margin-v-20">
		<ul class="uk-breadcrumb uk-text-center">
			<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'">Productos</a></li>
			<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=categorias">Categorías</a></li>
			<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=catdetalle&cat='.$catParentID.'">'.$catParent.'</a></li>
			<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=items&cat='.$cat.'">'.$catNAME.'</a></li>
			<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=detalle&id='.$id.'">'.$row_catalogo['sku'].'</a></li>
			<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=editar&id='.$id.'" class="color-red">Editar</a></li>
		</ul>
	</div>';
	

// inicio
	echo '
	<div class="uk-width-1-1 margin-top-20 uk-form">
		<div class="uk-container">
			<form action="index.php" method="post" enctype="multipart/form-data" name="datos" onsubmit="return checkForm(this);">
				<input type="hidden" name="editar" value="1">
				<input type="hidden" name="modulo" value="'.$modulo.'">
				<input type="hidden" name="archivo" value="detalle">
				<input type="hidden" name="id" value="'.$id.'">
				<div>
						<label for="sku">SKU</label>
						<!--<input type="text" class="uk-input" name="sku" value="" autofocus required>-->
						<h3 class="uk-margin-remove">'.$row_catalogo['sku'].'</h3>
					</div>
				<div uk-grid class="uk-grid-small uk-child-width-1-3@s">
					
					<div>
						<label for="titulo">Titulo</label>
						<input type="text" class="uk-input" name="titulo" value="'.$row_catalogo['titulo'].'" required>
					</div>
					
					<div>
						<label for="categoria">Categoría y subCategoría</label>
						<div>
							<select name="categoria" data-placeholder="Seleccione una" class="chosen-select uk-select" required>
								<option value=""></option>';
									$CONSULTA = $CONEXION -> query("SELECT * FROM productoscat WHERE parent = 0 ORDER BY txt");
									while ($row_CONSULTA = $CONSULTA -> fetch_assoc()) {
										$parentId=$row_CONSULTA['id'];
										$parentTxt=$row_CONSULTA['txt'];
										echo '
											<optgroup label="'.$parentTxt.'">';
										$CONSULTA1 = $CONEXION -> query("SELECT * FROM productoscat WHERE parent = $parentId ORDER BY txt");
										while ($row_CONSULTA1 = $CONSULTA1 -> fetch_assoc()) {
											$estatus=(isset($cat) AND $cat==$row_CONSULTA1['id'])?'selected':'';
											echo '
											<option value="'.$row_CONSULTA1['id'].'" '.$estatus.'>'.$row_CONSULTA1['txt'].'</option>';
										}
										echo '
											</optgroup>';
									}
									echo '
							</select>
						</div>
					</div>
					<!--<div>
						<label for="marca">Marca</label>
						<div>
							<select name="marca" data-placeholder="Seleccione una" class="chosen-select uk-select" required>
								<option value=""></option>';
								$CONSULTA1 = $CONEXION -> query("SELECT * FROM productosmarcas ORDER BY txt");
								while ($row_CONSULTA1 = $CONSULTA1 -> fetch_assoc()) {
									if (isset($marca) AND $marca==$row_CONSULTA1['id']) {
										$estatus='selected';
									}else{
										$estatus='';
									}
									echo '
									<option value="'.$row_CONSULTA1['id'].'" '.$estatus.'>'.$row_CONSULTA1['txt'].'</option>';
								}
								echo '
							</select>
						</div>
					</div>-->
					<!--<div>
						<label for="tipotalla">Tipo de talla</label>
						<div>
							<select name="tipotalla" data-placeholder="Seleccione una" class="chosen-select uk-select" required>
								<option value=""></option>';
								$CONSULTA1 = $CONEXION -> query("SELECT * FROM productostallaclasif ORDER BY txt");
								while ($row_CONSULTA1 = $CONSULTA1 -> fetch_assoc()) {
									$estatus=($row_catalogo['tipotalla']==$row_CONSULTA1['id'])?'selected':'';
									echo '
									<option value="'.$row_CONSULTA1['id'].'" '.$estatus.'>'.$row_CONSULTA1['txt'].'</option>';
								}
								echo '
							</select>
						</div>
					</div>-->
					
					
				</div>

					<!--<div uk-grid class="uk-grid-small uk-child-width-1-3@s">
				
						<div>
							<label for="precio">Precio de lista</label>
							<input type="text" class="uk-input input-number" name="precio" value="'.$row_catalogo['precio'].'" required>
						</div>
						<div>
							<label for="preventa">preventa</label>
								<select name="preventa" data-placeholder="Seleccione uno" class="chosen-select uk-select" required>
								';
								if ($row_catalogo['preventa']== 0) {
											$estatus0='selected';
											$estatus1='';
										}else{
											$estatus0='';
											$estatus1='selected';
										}
								echo'
									<option value="0" '.$estatus0.'>no</option>
									<option value="1" '.$estatus1.'>si</option>
								</select>
							</div>
							<div>
								<label for="preventa">fecha preventa</label>
								<input type="date"  class="uk-input" name="fechapreve" value="'.$row_catalogo['fechapreve'].'">
							</div>
							<div>
								<label for="descuento">Descuento</label>
								<input type="text" class="uk-input input-number-deci descuento" name="descuento" value="'.$row_catalogo['descuento'].'" required>
							</div>
					</div>-->
					<div uk-grid class="uk-grid-small uk-child-width-1-1@s">
						<!--<label for="palabras_clave">Palabras clave: <span id="claves_txt"> </span></label>
						<input type="hidden" class="uk-input" name="claves" id="claves" value="">

							<div class="uk-card uk-card-default uk-padding">
								<div class="uk-child-width-1-6" uk-grid>
								';
								$CONSULTAF = $CONEXION -> query("SELECT * FROM productosclaves ORDER BY txt");
										while ($row_CONSULTAF = $CONSULTAF -> fetch_assoc()){
											
											$clave = $row_CONSULTAF['txt'];
											$CONSULTA_S=$CONEXION -> query("SELECT * FROM productos WHERE id = $id AND claves LIKE '%".$clave."%'");
											
											$row_consul = $CONSULTA_S->num_rows;
											if ($row_consul>0) {
												$check ="checked";
											}else{
												$check ="";
											}
								echo '<div>
										<input class="uk-checkbox check-clave" type="checkbox" value="'.$clave.'" '.$check.'> '.$row_CONSULTAF['txt'].'
									</div> ';
										}
								echo'
								</div>
							</div>-->

							<div class="uk-margin">
								<label for="txt">Descripción principal</label>
								<textarea class="editor" name="txt" id="txt">'.$row_catalogo['txt'].'</textarea>
							</div>
							<div class="uk-margin">
								<label for="txt1">Descripción Extendida <span class="uk-text-warning">(nota: si es una solucion no es necesario llenar este campo )</span></label>
								<textarea class="editor" name="txt1" id="txt1">'.$row_catalogo['txt1'].'</textarea>
							</div>
						</div>
			
					

				

					<div class="uk-margin">
						<label for="title">Título google</label>
						<input type="text" class="uk-input" name="title" value="'.$row_catalogo['title'].'">
					</div>
					<div class="uk-margin">
						<label for="metadescription">Descripción google</label>
						<textarea class="uk-textarea" name="metadescription">'.$row_catalogo['metadescription'].'</textarea>
					</div>
					<div class="uk-margin uk-text-center">
						<a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=detalle&id='.$id.'" class="uk-button uk-button-default uk-button-large" tabindex="10">Cancelar</a>					
						<button name="send" class="uk-button uk-button-primary uk-button-large">Guardar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	';

$scripts='
var clavesIni = "'.$claves_txt.'";
var claves =  clavesIni.split(",");


$(".check-clave").change( function(){
	
		if($(this).prop( "checked" )) {
				var cla = $(this).val()
				claves.push(cla)
	            $("#claves_txt").html(claves.toString())
	    }else{
	    		var cla = $(this).val()
	    		claves = claves.filter(function(item){
					  return item !== cla;
					});
	    		 $("#claves_txt").html(claves.toString())
	    }
	    console.log(claves);

	 $("#claves").val(claves);
})
';

