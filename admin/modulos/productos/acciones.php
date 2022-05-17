<?php
	$modulo='productos';
	$modulocat=$modulo.'cat';
	$modulopic=$modulo.'pic';
	$modulomain=$modulo.'main';
	$rutaFinal='../img/contenido/'.$modulo.'/';

//    Artículo Nuevo                    
	if(isset($_POST['nuevo'])){ 
		// Verificamos que el sku no este la base de datos
		if(!isset($fallo)){
			$sql = "INSERT INTO $modulo (fecha) VALUES ('$hoy')";
			if($insertar = $CONEXION->query($sql)){
				$exito=1;
				$legendSuccess .= "<br>Producto nuevo";
				$editarNuevo=1;
				$id=$CONEXION->insert_id;
				$archivo='detalle';

			}else{
				$fallo=1;  
				$legendFail .= "<br>No se pudo agregar a la base de datos - $cat";
			}
		}else{
			$legendFail .= "<br>La categoría o marca están vacíos.";
		}
	}

//    Artículo Editar                   
	if(isset($_REQUEST['editar']) OR isset($editarNuevo)) {

		
		// Obtenemos los valores enviados

		$fallo=1;  
		$legendFail .= "<br>No se pudo modificar la base de datos";
		foreach ($_POST as $key => $value) {
			if ($key=='txt' || $key=='txt1' || $key=='claves') {
				$dato = trim(str_replace("'", "&#039;", $value));
			}else{
				$dato = trim(htmlentities($value, ENT_QUOTES));
			}
			if ($actualizar = $CONEXION->query("UPDATE $modulo SET $key = '$dato' WHERE id = $id")) {
				$exito=1;
				if (isset($fallo)) {
					unset($fallo);
				}
			}
		}
			if (isset($editarNuevo)) {
				$exito =0;
				$consultaNEW = $CONEXION->query("SELECT * FROM $modulo WHERE id = $id");
				$rowConsultaNEW = $consultaNEW->fetch_assoc();
				// contruimos el sku
				$sku = str_pad($id, 4, "0", STR_PAD_LEFT);
				$generoSku = substr($rowConsultaNEW['genero'], 0, 1);
				$modeloSku = substr($rowConsultaNEW['titulo'], 0, 3);

				$sku = strtoupper($sku.$generoSku.$modeloSku);

				if ($actualizar = $CONEXION->query("UPDATE $modulo SET sku = '$sku' WHERE id = $id")) {
				$exito=1;
				}
			}
			

		if (isset($exito)) {
			header('location: index.php?rand='.rand(1,9999).'&modulo='.$modulo.'&archivo='.$archivo.'&id='.$id);
		}
	}

//    Artículo Borrar                   
	if(isset($_REQUEST['borrarPod'])){
		include '../../../includes/connection.php';
		$id=$_POST['id'];

		$consulta= $CONEXION -> query("SELECT * FROM $modulopic WHERE producto = $id");
		while ($rowConsulta = $consulta-> fetch_assoc()) {
			$picID=$rowConsulta['id'];
			// Borramos el archivo de imagen
			$rutaIMG='../../'.$rutaFinal;
			$filehandle = opendir($rutaIMG); // Abrir archivos
			while ($file = readdir($filehandle)) {
				if ($file != "." && $file != "..") {
					// Id de la imagen
					if (strpos($file,'-')===false) {
						$imagenID = strstr($file,'.',TRUE);
					}else{
						$imagenID = strstr($file,'-',TRUE);
					}
					// Comprobamos que sean iguales
					if($imagenID==$picID){
						$pic=$rutaIMG.$file;
						$exito=1;
						unlink($pic);
					}
				}
			}
		}

		if($borrar = $CONEXION->query("DELETE FROM $modulo WHERE id = $id")){
			$borrar = $CONEXION->query("DELETE FROM $modulopic WHERE producto = $id");
			echo "<div class='bg-success color-blanco'><i uk-icon='icon: trash;ratio:2;'></i> &nbsp; Borrado</div>";
		}else{
			echo "<div class='bg-danger color-blanco'><i uk-icon='icon: warning;ratio:2;'></i> &nbsp; No se pudo borrar</div>";
		}
	}

//    Categoria Nueva                   
	if(isset($_POST['nuevacategoria'])){ 
		// Obtenemos los valores enviados
		if (isset($_POST['categoria'])) { $categoria=$_POST['categoria'];   }else{	$categoria=false; $fallo=1; }
		if (isset($_POST['cat'])) { $cat=$_POST['cat']; }else{ $cat=false; $fallo=1; }

		// Sustituimos los caracteres inválidos
		$categoria=(htmlentities($categoria, ENT_QUOTES));

		// Actualizamos la base de datos
		if($categoria!=""){
			$sql = "INSERT INTO $modulocat (txt,parent) VALUES ('$categoria',$cat)";
			if($insertar = $CONEXION->query($sql)){
				$cat = $CONEXION->insert_id;
				$exito=1;
				$legendSuccess .= "<br>Nueva categoria";
			}
		}else{
			$fallo=1;  
			$legendFail .= "<br>El campo está vacío";
		}
	}

//    Sub Categoria Nueva               
	if(isset($_POST['nuevasubcategoria'])){ 
		// Obtenemos los valores enviados
		if (isset($_POST['categoria'])) { $categoria=$_POST['categoria'];   }else{	$categoria=false; $fallo=1; }

		// Sustituimos los caracteres inválidos
		$categoria=htmlentities($categoria, ENT_QUOTES);

		// Actualizamos la base de datos
		if($categoria!=""){
			$sql = "INSERT INTO $modulocat (txt,parent) VALUES ('$categoria',$cat)";
			if($insertar = $CONEXION->query($sql)){
				$id = $CONEXION->insert_id;
				$exito=1;
				$legendSuccess .= "<br>Nueva subcategoria";
			}else{
				$fallo=1;  
				$legendFail .= "<br>No pudo agregarse a la base de datos ".$modulocat.'-'.$cat.'-'.$categoria;
			}
		}else{
			$fallo=1;  
			$legendFail .= "<br>El campo está vacío";
		}
	}

//    Categoría Borrar                  
	if(isset($_REQUEST['eliminarCat'])){
		if($borrar = $CONEXION->query("DELETE FROM $modulocat WHERE id = $id")){
			$exito=1;
			$legendSuccess .= "<br>Categoría eliminada";
		}else{
			$legendFail .= "<br>No se pudo borrar de la base de datos";
			$fallo=1;  
		}
	}
//    Subir foto galería                
	if(isset($_GET["uploadedfile"])){
		$rutaInicial = '../library/upload-file/php/uploads/';
		$rutaFinal = '../img/contenido/'.$modulo.'/';

		$imagenName=$_GET['uploadedfile'];

		$id=$_GET['id'];
		
			

			// Guardar en la base de datos
			// Verificar que la imagen existe
			if(!file_exists($rutaInicial.$imagenName)){
				$fallo=1;
				$legendFail='<br>No se permite refrescar la página.';
			} 
			if (!isset($fallo)) {
				// Extensión de la imagen
				$i = strrpos($imagenName,'.');
				$l = strlen($imagenName) - $i;
				$ext = strtolower(substr($imagenName,$i+1,$l));

				// Nombre del nuevo archivo
				$rand=rand(111111111,999999999);
				$imgFinal=$rand.'.'.$ext;
				// Si el nombre ya está en usado, definir otro
				if(file_exists($rutaFinal.$imgFinal)){
					$imgFinal=$rand.'.'.$ext;
				}
				$sql = "INSERT INTO $modulopic (producto,imagen) VALUES ($id,'$imgFinal')";
				
				if ($insertar = $CONEXION->query($sql)) {
					// Copiar el archivo a su nueva ubicación
					copy($rutaInicial.$imagenName, $rutaFinal.$imgFinal);
					unlink($rutaInicial.$imagenName);
				}
				

				

				// $sql="UPDATE $modulopic SET (imagen) = ($imgFinal) WHERE id = $id";
				// $actualizar = $CONEXION->query($sql);
				
			}			
		
	}
//    Subir foto galería                
if(isset($_GET["fileuploadermain"])){
	$rutaInicial = '../library/upload-file/php/uploads/';
	$rutaFinal = '../img/contenido/'.$modulo.'/';

	$imagenName=$_GET['fileuploadermain'];

	$id=$_GET['id'];
	
		

		// Guardar en la base de datos
		// Verificar que la imagen existe
		if(!file_exists($rutaInicial.$imagenName)){
			$fallo=1;
			$legendFail='<br>No se permite refrescar la página.';
		} 
		if (!isset($fallo)) {
			// Extensión de la imagen
			$i = strrpos($imagenName,'.');
			$l = strlen($imagenName) - $i;
			$ext = strtolower(substr($imagenName,$i+1,$l));

			// Nombre del nuevo archivo
			$rand=rand(111111111,999999999);
			$imgFinal=$rand.'.'.$ext;
			// Si el nombre ya está en usado, definir otro
			if(file_exists($rutaFinal.$imgFinal)){
				$imgFinal=$rand.'.'.$ext;
			}

			if ($actualizar = $CONEXION->query("UPDATE $modulo SET imagen = '$imgFinal' WHERE id = $id")) {
				$exito=1;
				// Copiar el archivo a su nueva ubicación
				copy($rutaInicial.$imagenName, $rutaFinal.$imgFinal);
				unlink($rutaInicial.$imagenName);
				}
				
		}

			// $sql="UPDATE $modulopic SET (imagen) = ($imgFinal) WHERE id = $id";
			// $actualizar = $CONEXION->query($sql);
			
	
}

	
//    Borrar foto galería               
	if(isset($_POST['borrarpdf'])){
		include '../../../includes/connection.php';
		$rutaFinal='../../../img/contenido/'.$modulo.'/';
		$id=$_POST['id'];
			$CONSULTA = $CONEXION -> query("SELECT * FROM $modulo WHERE id = $id");
			
			if ($row_CONSULTA = $CONSULTA -> fetch_assoc()) {
				unlink($rutaFinal.$row_CONSULTA['imagen']);
					if(file_exists($rutaFinal.$row_CONSULTA['imagen'])){
						$exito=0;	
					}else{
						$exito=1;
						$borrar = $CONEXION->query("UPDATE $modulo SET imagen = null WHERE id = $id");
					}
					
				}
		
		
		if(isset($exito)){
			echo "<div class='bg-success color-blanco'><i uk-icon='icon: trash;ratio:2;'></i> &nbsp; Borrado</div>";
		}else{
			echo "<div class='bg-danger color-blanco'><i uk-icon='icon: warning;ratio:2;'></i> &nbsp; no se pudo borrar</div>";
		}
	}

//    Borrar foto galería               
	if(isset($_POST['borrarfoto'])){
		include '../../../includes/connection.php';
		$rutaFinal='../../../img/contenido/'.$modulo.'/';
		$id=$_POST['id'];
		// Borramos el archivo de imagen
		$filehandle = opendir($rutaFinal); // Abrir archivos
		while ($file = readdir($filehandle)) {
			if ($file != "." && $file != "..") {
				// Id de la imagen
				if (strpos($file,'-')===false) {
					$imagenID = strstr($file,'.',TRUE);
				}else{
					$imagenID = strstr($file,'-',TRUE);
				}
				// Comprobamos que sean iguales
				if($imagenID==$id){
					$pic=$rutaFinal.$file;
					$exito=1;
					unlink($pic);
				}
			}
		}

		$borrar = $CONEXION->query("DELETE FROM $modulopic WHERE id = $id");
		if(isset($exito)){
			echo "<div class='bg-success color-blanco'><i uk-icon='icon: trash;ratio:2;'></i> &nbsp; Borrado</div>";
		}else{
			echo "<div class='bg-danger color-blanco'><i uk-icon='icon: warning;ratio:2;'></i> &nbsp; No se pudo borrar</div>";
		}
	}

//    Borrar Foto Redes                 
	if(isset($_REQUEST['borrarpicredes'])){
		$CONSULTA = $CONEXION -> query("SELECT * FROM $modulo WHERE id = $id");
		$row_CONSULTA = $CONSULTA -> fetch_assoc();
		if (strlen($row_CONSULTA['imagen'])>0) {
			unlink($rutaFinal.$row_CONSULTA['imagen']);
			$actualizar = $CONEXION->query("UPDATE $modulo SET imagen = '' WHERE id = $id");
			$exito=1;
			$legendSuccess.='<br>Foto eliminada';
		}else{
			$legendFail .= "<br>No se encontró la imagen en la base de datos";
			$fallo=1;
		}
	}

//    Subir varios tipos de imagen      
	if(isset($_GET['filename'])){
		$imagenName  = $_REQUEST['filename'];
		$position    = $_GET['position'];
		$rutaInicial = '../library/upload-file/php/uploads/';
		$fallo       = 1;

		//Obtenemos la extensión de la imagen
		$i = strrpos($imagenName,'.');
		$l = strlen($imagenName) - $i;
		$ext = strtolower(substr($imagenName,$i+1,$l));


		if(file_exists($rutaInicial.$imagenName)){
			if ($position=='gallery') { // Imágenes de la galería
				$sql = "INSERT INTO $modulopic (producto) VALUES ($id)";
				$insertar = $CONEXION->query($sql);
				$pic=$CONEXION->insert_id;
				$imgAux=$rutaFinal.$pic.'.jpg';
				copy($rutaInicial.$imagenName, $imgAux);

				$original = imagecreatefromjpeg($imgAux);
				$ancho  = imagesx($original);
				$alto   = imagesy($original);

				$newName=$pic."-sm.jpg";
				$anchoNuevo = 300;
				$altoNuevo  = $anchoNuevo*$alto/$ancho;

				// Creamos la imagen
				$imagenAux = imagecreatetruecolor($anchoNuevo,$altoNuevo); 
				// Copiamos el inicio de la original para pegarlo en el archivo nuevo
				imagecopyresampled($imagenAux,$original,0,0,0,0,$anchoNuevo,$altoNuevo,$ancho,$alto);
				// Pegamos el inicio de la imagen
				if(imagejpeg($imagenAux,$rutaFinal.$newName,90)){ // 90 es la calidad de compresión
					$exito=1;
					unset($fallo);
				}
				
			}elseif($position=='main'){ // Imagen para compartir
				$imgFinal=$hoy.rand(111111111,999999999).'.'.$ext;
				if(file_exists($rutaFinal.$imgFinal)){
					$imgFinal=$hoy.rand(111111111,999999999).'.'.$ext;
				}
				$CONSULTA = $CONEXION -> query("SELECT * FROM $modulo WHERE id = $id");
				$row_CONSULTA = $CONSULTA -> fetch_assoc();
				if ($row_CONSULTA['imagen']!='' AND file_exists($rutaFinal.$row_CONSULTA['imagen'])) {
					unlink($rutaFinal.$row_CONSULTA['imagen']);
				}
				$legendFail.='<br>Fail - '.$position;

				if (copy($rutaInicial.$imagenName, $rutaFinal.$imgFinal)) {
					$sigue=1;
				}
		
				if (isset($sigue)) {
					if ($actualizar = $CONEXION->query("UPDATE $modulo SET imagen = '$imgFinal' WHERE id = $id")) {
						unset($fallo);
						$exito=1;
					}
				}

			}elseif($position=='cat'){
				$imgFinal=$hoy.rand(111111111,999999999).'.'.$ext;
				if(file_exists($rutaFinal.$imgFinal)){
					$imgFinal=$hoy.rand(111111111,999999999).'.'.$ext;
				}
				$CONSULTA = $CONEXION -> query("SELECT * FROM productoscat WHERE id = $cat");
				$row_CONSULTA = $CONSULTA -> fetch_assoc();
				if ($row_CONSULTA['imagen']!='' AND file_exists($rutaFinal.$row_CONSULTA['imagen'])) {
					unlink($rutaFinal.$row_CONSULTA['imagen']);
				}
				copy($rutaInicial.$imagenName, $rutaFinal.$imgFinal);
				$actualizar = $CONEXION->query("UPDATE productoscat SET imagen = '$imgFinal' WHERE id = $cat");
				unset($fallo);

			}elseif($position=='cathover'){
				$imgFinal=$hoy.rand(111111111,999999999).'.'.$ext;
				if(file_exists($rutaFinal.$imgFinal)){
					$imgFinal=$hoy.rand(111111111,999999999).'.'.$ext;
				}
				$CONSULTA = $CONEXION -> query("SELECT * FROM productoscat WHERE id = $cat");
				$row_CONSULTA = $CONSULTA -> fetch_assoc();
				if ($row_CONSULTA['imagenhover']!='' AND file_exists($rutaFinal.$row_CONSULTA['imagenhover'])) {
					unlink($rutaFinal.$row_CONSULTA['imagenhover']);
				}
				copy($rutaInicial.$imagenName, $rutaFinal.$imgFinal);
				$actualizar = $CONEXION->query("UPDATE productoscat SET imagenhover = '$imgFinal' WHERE id = $cat");
				unset($fallo);

			}elseif($position=='iconomarcas'){
				$imgFinal=$hoy.rand(111111111,999999999).'.'.$ext;
				if(file_exists($rutaFinal.$imgFinal)){
					$imgFinal=$hoy.rand(111111111,999999999).'.'.$ext;
				}
				$CONSULTA = $CONEXION -> query("SELECT * FROM productosmarcas WHERE id = $id");
				$row_CONSULTA = $CONSULTA -> fetch_assoc();
				if ($row_CONSULTA['imagen']!='' AND file_exists($rutaFinal.$row_CONSULTA['imagen'])) {
					unlink($rutaFinal.$row_CONSULTA['imagen']);
				}
				copy($rutaInicial.$imagenName, $rutaFinal.$imgFinal);
				$actualizar = $CONEXION->query("UPDATE productosmarcas SET imagen = '$imgFinal' WHERE id = $id");
				unset($fallo);

			}elseif($position=='iconoclasif'){
				$imgFinal=$hoy.rand(111111111,999999999).'.'.$ext;
				if(file_exists($rutaFinal.$imgFinal)){
					$imgFinal=$hoy.rand(111111111,999999999).'.'.$ext;
				}
				$CONSULTA = $CONEXION -> query("SELECT * FROM productosclasif WHERE id = $id");
				$row_CONSULTA = $CONSULTA -> fetch_assoc();
				if ($row_CONSULTA['imagen']!='' AND file_exists($rutaFinal.$row_CONSULTA['imagen'])) {
					unlink($rutaFinal.$row_CONSULTA['imagen']);
				}
				copy($rutaInicial.$imagenName, $rutaFinal.$imgFinal);
				$actualizar = $CONEXION->query("UPDATE productosclasif SET imagen = '$imgFinal' WHERE id = $id");
				unset($fallo);

			}elseif($position=='iconoclasiftxt'){
				$imgFinal=$hoy.rand(111111111,999999999).'.'.$ext;
				if(file_exists($rutaFinal.$imgFinal)){
					$imgFinal=$hoy.rand(111111111,999999999).'.'.$ext;
				}
				$CONSULTA = $CONEXION -> query("SELECT * FROM productosclasif WHERE id = $id");
				$row_CONSULTA = $CONSULTA -> fetch_assoc();
				if ($row_CONSULTA['imagen2']!='' AND file_exists($rutaFinal.$row_CONSULTA['imagen2'])) {
					unlink($rutaFinal.$row_CONSULTA['imagen2']);
				}
				copy($rutaInicial.$imagenName, $rutaFinal.$imgFinal);
				$actualizar = $CONEXION->query("UPDATE productosclasif SET imagen2 = '$imgFinal' WHERE id = $id");
				unset($fallo);

			}elseif($position=='color'){
				$imgFinal=$hoy.rand(111111111,999999999).'.'.$ext;
				if(file_exists($rutaFinal.$imgFinal)){
					$imgFinal=$hoy.rand(111111111,999999999).'.'.$ext;
				}
				copy($rutaInicial.$imagenName, $rutaFinal.$imgFinal);
				$insertar = $CONEXION->query("INSERT INTO productoscolor (imagen) VALUES ('$imgFinal')");
				unset($fallo);

			}
		}else{
			$fallo=1;
			$legendFail='<br>No se permite refrescar la página.';
		}


		// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
		// Borramos las imágenes que estén remanentes en el directorio files
		// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
		$filehandle = opendir($rutaInicial); // Abrir archivos
		while ($file = readdir($filehandle)) {
			if ($file != "." && $file != ".." && $file != ".gitignore" && $file != ".htaccess" && $file != "thumbnail") {
				if(file_exists($rutaInicial.$file)){
					//echo $ruta.$file.'<br>';
					unlink($rutaInicial.$file);
				}
			}
		} 
		closedir($filehandle); 
	}

//    Subir CSV                         
	if(isset($_GET['csvfile'])){

		$rutaInicial="../library/upload-file/php/uploads/";
		$rutaFinal='../img/contenido/importar/';

		$filehandle = opendir($rutaFinal); // Abrir archivos
		while ($file = readdir($filehandle)) {
			if ($file != "." && $file != ".." && $file != "ejemplo.csv") {
				if(file_exists($rutaFinal.$file)){
					//echo $ruta.$file.'<br>';
					unlink($rutaFinal.$file);
				}
			}
		}
		closedir($filehandle);


		$fileName=$_GET['csvfile'];
		$i = strrpos($fileName,'.');
		$l = strlen($fileName) - $i;
		$ext = strtolower(substr($fileName,$i+1,$l));

		// Si no es CSV cancelamos
		if ($ext!='csv') {
			$fallo=1;
			$legendFail='<br>El archivo debe ser CSV';
		}

		if (!isset($fallo)) {
			$fileFinal=rand(111111111,999999999).'.csv';
			$rutaFinal=$rutaFinal.$fileFinal;
			if(copy($rutaInicial.$fileName, $rutaFinal)){
				$legendSuccess.= '<br>Archivo cargado con éxito';
				unlink($rutaInicial.$fileName);
				$gestor = @fopen($rutaFinal, "r");
				while (($bufer = fgets($gestor, 4096)) !== false) {
					$bufer=str_replace('"', '', $bufer);
					if (!isset($showTable)){
						$showTable = 1;
					}else{
						$infoImportar[]=explode(',',trim($bufer));
					}
				}
			    fclose($gestor);
			}else{
				//$fallo=1;
				//$legendFail='<br>No se permite refrescar la página.';
			}
		}
	}
//    Subir CSV Existencias                        
	if(isset($_GET['csvfileExis'])){

		$rutaInicial="../library/upload-file/php/uploads/";
		$rutaFinal='../img/contenido/importar/';

		$filehandle = opendir($rutaFinal); // Abrir archivos
		while ($file = readdir($filehandle)) {
			if ($file != "." && $file != ".." && $file != "ejemplo.csv") {
				if(file_exists($rutaFinal.$file)){
					//echo $ruta.$file.'<br>';
					unlink($rutaFinal.$file);
				}
			}
		}
		closedir($filehandle);


		$fileName=$_GET['csvfileExis'];
		$i = strrpos($fileName,'.');
		$l = strlen($fileName) - $i;
		$ext = strtolower(substr($fileName,$i+1,$l));

		// Si no es CSV cancelamos
		if ($ext!='csv') {
			$fallo=1;
			$legendFail='<br>El archivo debe ser CSV';
		}

		if (!isset($fallo)) {
			$fileFinal=rand(111111111,999999999).'.csv';
			$rutaFinal=$rutaFinal.$fileFinal;
			if(copy($rutaInicial.$fileName, $rutaFinal)){
				$legendSuccess.= '<br>Archivo cargado con éxito';
				unlink($rutaInicial.$fileName);
				$gestor = @fopen($rutaFinal, "r");
				while (($bufer = fgets($gestor, 4096)) !== false) {
					$bufer=str_replace('"', '', $bufer);
					if (!isset($showTable)){
						$showTable = 1;
					}else{
						$infoExistencias[]=explode(',',trim($bufer));
					}
				}
			    fclose($gestor);
			}else{
				//$fallo=1;
				//$legendFail='<br>No se permite refrescar la página.';
			}
		}
	}
//%%%%%%%%%%%%%%%%%%%%%%%%%%    Importar existencias       %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	if(isset($_POST['infoExistencias'])){
		include '../../../includes/connection.php';
		$msjClase  = 'danger';
		$msjIcon   = 'warning';
		$msjTxt    = '<br>Error';
		$xtras     = '';
		$fallo     = 0;

		$fileFinal = $_POST['file'];
		$rutaFinal = '../../../img/contenido/importar/';
		$rutaFinal = $rutaFinal.$fileFinal;

		$gestor = @fopen($rutaFinal, "r");
		while (($bufer = fgets($gestor, 4096)) !== false) {
			$bufer=str_replace('"', '', $bufer);
			if (!isset($first)){
				$first='';
			}else{
				$infoExistencias[]=explode(',',trim($bufer));
			}
		}
	    fclose($gestor);

	    $num=0;
	    $numTotal=count($infoExistencias);
		foreach ($infoExistencias as $key => $value) {
			$existencias = trim($value[1]);

			$skuOrigen 	= strval(trim($value[0]));
			$skuPro 	= substr($skuOrigen, 0, 8);
			$CodColor 	= substr($skuOrigen, 8, 3);
			 
			$i = strrpos($skuOrigen,'-');
			$l = strlen($skuOrigen) - $i;
			$idTalla = strtolower(substr($skuOrigen,$i+1,$l));


			$sql0="SELECT * FROM productos WHERE sku = '$skuPro'";
			$CONSULTA = $CONEXION->query($sql0);
			$existe = $CONSULTA->num_rows;
			$rowCONSULTA = $CONSULTA->fetch_assoc();
			$idPro =$rowCONSULTA['id'];

			$sqlCol ="SELECT * FROM productoscolor WHERE codigo = '$CodColor'";
			$CONSULTACOL = $CONEXION->query($sqlCol);
			$rowCONSULTACOL = $CONSULTACOL->fetch_assoc();
			$idCol =$rowCONSULTACOL['id'];


			if ($existe>0 AND !isset($bandera)) {
				
	
				$sql = "UPDATE productosexistencias SET existencias = $existencias WHERE producto = $idPro AND talla = $idTalla AND color = $idCol";
				if ($actualizar = $CONEXION->query($sql)) {
				
					$msjClase = 'success';
					$msjIcon  = 'check';
					$msjTxt   = $skuOrigen;
					$num++;
				}
			}
			
				

		}
		$estatus  = $num/$numTotal;
			echo '{ "msj":"<div class=\'uk-text-center color-blanco bg-success padding-10 text-lg\'><i uk-icon=\'icon:'.$msjIcon.';ratio:3;\'></i> &nbsp; '.$msjTxt.'</div>", "estatus":"'.$estatus.'"}';
		
	}

//%%%%%%%%%%%%%%%%%%%%%%%%%%    Importar datos       %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	if(isset($_POST['importardatos'])){
		include '../../../includes/connection.php';
		$msjClase  = 'danger';
		$msjIcon   = 'warning';
		$msjTxt    = '<br>Error';
		$xtras     = '';
		$fallo     = 0;

		$fileFinal = $_POST['file'];
		$rutaFinal = '../../../img/contenido/importar/';
		$rutaFinal = $rutaFinal.$fileFinal;

		$gestor = @fopen($rutaFinal, "r");
		while (($bufer = fgets($gestor, 4096)) !== false) {
			$bufer=str_replace('"', '', $bufer);
			if (!isset($first)){
				$first='';
			}else{
				$infoImportar[]=explode(',',trim($bufer));
			}
		}
	    fclose($gestor);

	    $num=0;
	    $numTotal=count($infoImportar);

		foreach ($infoImportar as $key => $value) {
			if (!isset($bandera)) {
				$bandera=1;
				$sql = 'INSERT INTO productos (categoria,genero,titulo,tipotalla,ajuste,precio,txt,claves)
				VALUES ( 
				 "'.trim($value[0]).'" , 
				 "'.trim($value[1]).'" , 
				 "'.trim($value[2]).'" , 
				 "'.trim($value[3]).'" , 
				 "'.trim($value[4]).'" , 
				 "'.trim($value[5]).'" , 
				 "'.trim($value[6]).'" , 
				 "'.trim($value[7]).'" 
				);';
				if ($insertar = $CONEXION->query($sql)) {
					$id=$CONEXION->insert_id;

					$sku = str_pad($id, 4, "0", STR_PAD_LEFT);
					$generoSku = substr($value[1], 0, 1);
					$modeloSku = substr($value[2], 0, 3);

					$sku = strtoupper($sku.$generoSku.$modeloSku);

					if ($actualizar = $CONEXION->query("UPDATE productos SET sku = '$sku' WHERE id = $id")) {
					$exito=1;
					}

					$sql1="SELECT * FROM productos";
					$CONSULTA = $CONEXION->query($sql1);
					while($rowCONSULTA = $CONSULTA -> fetch_assoc()){
						$id=$rowCONSULTA['id'];
						foreach ($rowCONSULTA as $key => $value) {
							$comaValue = str_replace('#', ',', $value);
							$sql2 = "UPDATE productos SET $key = '$comaValue' WHERE id = $id";
							$quitarComas = $CONEXION->query($sql2);
						}
						$sku=$rowCONSULTA['sku'];
					}
					$msjClase = 'success';
					$msjIcon  = 'check';
					$msjTxt   = $sku;

				}
			}

				
			$num++;
		}
		$estatus  = $num/$numTotal;
		echo '{ "msj":"<div class=\'uk-text-center color-blanco bg-'.$msjClase.' padding-10 text-lg\'><i uk-icon=\'icon:'.$msjIcon.';ratio:3;\'></i> &nbsp; '.$msjTxt.'</div>", "estatus":"'.$estatus.'"}';
	}


