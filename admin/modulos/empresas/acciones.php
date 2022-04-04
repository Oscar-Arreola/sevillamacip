<?php
$modulo='empresas';
$modulopic=$modulo.'pic';

//%%%%%%%%%%%%%%%%%%%%%%%%%%    Borrar Foto     %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	if(isset($_REQUEST['borrarPic'])){
		if($borrar = $CONEXION->query("DELETE FROM $modulo WHERE id = $id")){
			// Borramos el archivo de imagen
			$rutaIMG="../img/contenido/".$modulo."/";
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
					if($imagenID==$id){
						$pic=$rutaIMG.$file;
						$exito=1;
						unlink($pic);
					}
				}
			}
		}
	}
	
//%%%%%%%%%%%%%%%%%%%%%%%%%%    Subir Imágen     %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

	if(isset($_GET["uploadedfile"])){
		$rutaInicial = '../library/upload-file/php/uploads/';
		$rutaFinal = '../img/contenido/'.$modulo.'/';

		$imagenName=$_GET['uploadedfile'];
		$position=$_GET['position'];


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
				$sql = "INSERT INTO $modulo (nombre) VALUES ('$imgFinal')";
				
				if ($insertar = $CONEXION->query($sql)) {
					// Copiar el archivo a su nueva ubicación
					copy($rutaInicial.$imagenName, $rutaFinal.$imgFinal);
					unlink($rutaInicial.$imagenName);
				}
				

				

				// $sql="UPDATE $modulopic SET (imagen) = ($imgFinal) WHERE id = $id";
				// $actualizar = $CONEXION->query($sql);
				
			}			
		
	}






