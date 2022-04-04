<?php 
$CONSULTA = $CONEXION -> query("SELECT * FROM $modulo WHERE id = $id");
$rowCONSULTA = $CONSULTA -> fetch_assoc();

$titulo = (!empty($rowCONSULTA['titulo'])) ? $rowCONSULTA['titulo'] : null ;
$numero = (!empty($rowCONSULTA['numero'])) ? $rowCONSULTA['numero'] : null ;
$calle = (!empty($rowCONSULTA['calle'])) ? $rowCONSULTA['calle'] : null ;
$colonia = (!empty($rowCONSULTA['colonia'])) ? $rowCONSULTA['colonia'] : null ;
$municipio = (!empty($rowCONSULTA['municipio'])) ? $rowCONSULTA['municipio'] : null ;
$estado = (!empty($rowCONSULTA['estado'])) ? $rowCONSULTA['estado'] : null ;
$email1 = (!empty($rowCONSULTA['email1'])) ? $rowCONSULTA['email1'] : null ;
$email2 = (!empty($rowCONSULTA['email2'])) ? $rowCONSULTA['email2'] : null ;
$tel1 = (!empty($rowCONSULTA['tel1'])) ? $rowCONSULTA['tel1'] : null ;
$tel2 = (!empty($rowCONSULTA['tel2'])) ? $rowCONSULTA['tel2'] : null ;
$whatsapp = (!empty($rowCONSULTA['whatsapp'])) ? $rowCONSULTA['whatsapp'] : null ;
$facebook = (!empty($rowCONSULTA['facebook'])) ? $rowCONSULTA['facebook'] : null ;

echo '
<div class="uk-width-1-1 margin-v-20">
	<ul class="uk-breadcrumb uk-text-capitalize">
		<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'">Planteles</a></li>
		<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=detalle&id='.$id.'">'.$rowCONSULTA['titulo'].'</a></li>
		<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=editar&id='.$id.'" class="color-red">Editar</a></li>
	</ul>
</div>

<div class="uk-width-1-1 margin-top-20">
	<div class="uk-container uk-container-small">
		<form action="index.php" method="post" enctype="multipart/form-data" name="datos" onsubmit="return checkForm(this);">
			<input type="hidden" name="editar" value="1">
			<input type="hidden" name="modulo" value="'.$modulo.'">
			<input type="hidden" name="archivo" value="detalle">
			<input type="hidden" name="id" value="'.$id.'">

			<div class="uk-grid">
			<div class="uk-margin uk-width-1-1>
				<label class="uk-text-capitalize" for="titulo">Título:</label>
				<input type="text" class="uk-input" name="titulo" value="'.$titulo.'" autofocus required>
			</div>
			<div class="uk-margin uk-width-1-3">
				<label class="uk-text-capitalize" for="numero">numero</label>
				<input type="text" class="uk-input" name="numero" id="numero" autofocus value="'.$numero.'">
			</div>	
			<div class="uk-margin uk-width-1-3">
				<label class="uk-text-capitalize" for="calle">calle</label>
				<input type="text" class="uk-input" name="calle" id="calle" autofocus value="'.$calle.'">
			</div>	
			<div class="uk-margin uk-width-1-3">
				<label class="uk-text-capitalize" for="colonia">colonia</label>
				<input type="text" class="uk-input" name="colonia" id="colonia" autofocus value="'.$colonia.'">
			</div>	
			<div class="uk-margin uk-width-1-2">
				<label class="uk-text-capitalize" for="municipio">municipio</label>
				<input type="text" class="uk-input" name="municipio" id="municipio" autofocus value="'.$municipio.'">
			</div>	
			<div class="uk-margin uk-width-1-2">
				<label class="uk-text-capitalize" for="estado">estado</label>
				<input type="text" class="uk-input" name="estado" id="estado" autofocus value="'.$estado.'">
			</div>	
			<div class="uk-margin uk-width-1-2">
				<label class="uk-text-capitalize" for="email1">email principal</label>
				<input type="text" class="uk-input" name="email1" id="email1" autofocus value="'.$email1.'">
			</div>	
			<div class="uk-margin uk-width-1-2">
				<label class="uk-text-capitalize" for="email2">email secundario</label>
				<input type="text" class="uk-input" name="email2" id="email2" autofocus value="'.$email2.'">
			</div>	
			<div class="uk-margin uk-width-1-3">
				<label class="uk-text-capitalize" for="tel1">telelfono 1</label>
				<input type="text" class="uk-input" name="tel1" id="tel1" autofocus value="'.$tel1.'">
			</div>	
			<div class="uk-margin uk-width-1-3">
				<label class="uk-text-capitalize" for="tel2">telelfono 2</label>
				<input type="text" class="uk-input" name="tel2" id="tel2" autofocus value="'.$tel2.'">
			</div>	
			<div class="uk-margin uk-width-1-3">
				<label class="uk-text-capitalize" for="whatsapp">whatsapp</label>
				<input type="text" class="uk-input" name="whatsapp" id="whatsapp" autofocus value="'.$whatsapp.'">
			</div>
			<div class="uk-margin uk-width-1-1">
				<label class="uk-text-capitalize" for="facebook">facebook</label>
				<input type="text" class="uk-input" name="facebook" id="facebook" autofocus value="'.$facebook.'">
			</div>
		</div>
			<div class="uk-margin uk-text-center">
				<a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=detalle&id='.$id.'" class="uk-button uk-button-default uk-button-large" tabindex="10">Cancelar</a>					
				<button name="send" class="uk-button uk-button-primary uk-button-large">Guardar</button>
			</div>
		</form>
	</div>
</div>


';