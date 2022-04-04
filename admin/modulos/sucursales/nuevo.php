<?php 
echo '
<div class="uk-width-1-1 margin-v-20 uk-text-left">
	<ul class="uk-breadcrumb uk-text-capitalize">
		<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'">'.$modulo.'</a></li>
		<li><a href="index.php?rand='.rand(1,1000).'&modulo='.$modulo.'&archivo=nuevo" class="color-red">Nuevo</a></li>
	</ul>
</div>
';		
?>

<div class="uk-width-1-1">
	<div class="uk-container uk-container-small">
		<form action="index.php" method="post" name="editar">
			<input type="hidden" name="nuevo" value="1">
			<input type="hidden" name="modulo" value="<?=$modulo?>">
		<div class="uk-grid">
			<div class="uk-margin uk-width-1-1">
				<label class="uk-text-capitalize" for="titulo">Titulo</label>
				<input type="text" class="uk-input" name="titulo" id="titulo" autofocus>
			</div>	
			<div class="uk-margin uk-width-1-3">
				<label class="uk-text-capitalize" for="numero">numero</label>
				<input type="text" class="uk-input" name="numero" id="numero" autofocus>
			</div>	
			<div class="uk-margin uk-width-1-3">
				<label class="uk-text-capitalize" for="calle">calle</label>
				<input type="text" class="uk-input" name="calle" id="calle" autofocus>
			</div>	
			<div class="uk-margin uk-width-1-3">
				<label class="uk-text-capitalize" for="colonia">colonia</label>
				<input type="text" class="uk-input" name="colonia" id="colonia" autofocus>
			</div>	
			<div class="uk-margin uk-width-1-2">
				<label class="uk-text-capitalize" for="municipio">municipio</label>
				<input type="text" class="uk-input" name="municipio" id="municipio" autofocus>
			</div>	
			<div class="uk-margin uk-width-1-2">
				<label class="uk-text-capitalize" for="estado">estado</label>
				<input type="text" class="uk-input" name="estado" id="estado" autofocus>
			</div>	
			<div class="uk-margin uk-width-1-2">
				<label class="uk-text-capitalize" for="email1">email principal</label>
				<input type="text" class="uk-input" name="email1" id="email1" autofocus>
			</div>	
			<div class="uk-margin uk-width-1-2">
				<label class="uk-text-capitalize" for="email2">email secundario</label>
				<input type="text" class="uk-input" name="email2" id="email2" autofocus>
			</div>	
			<div class="uk-margin uk-width-1-3">
				<label class="uk-text-capitalize" for="tel1">telelfono 1</label>
				<input type="text" class="uk-input" name="tel1" id="tel1" autofocus>
			</div>	
			<div class="uk-margin uk-width-1-3">
				<label class="uk-text-capitalize" for="tel2">telelfono 2</label>
				<input type="text" class="uk-input" name="tel2" id="tel2" autofocus>
			</div>	
			<div class="uk-margin uk-width-1-3">
				<label class="uk-text-capitalize" for="whasapp">whasapp</label>
				<input type="text" class="uk-input" name="whasapp" id="whasapp" autofocus>
			</div>
			<div class="uk-margin uk-width-1-1">
				<label class="uk-text-capitalize" for="facebook">facebook</label>
				<input type="text" class="uk-input" name="facebook" id="facebook" autofocus>
			</div>
		</div>
			
			<div class="uk-margin uk-text-center">
				<a href="index.php?rand=<?=rand(1,1000)?>&modulo=<?=$modulo?>" class="uk-button uk-button-default uk-button-large" tabindex="10">Cancelar</a>					
				<button name="send" class="uk-button uk-button-primary uk-button-large">Guardar</button>
			</div>
		</form>
	</div>
</div>
