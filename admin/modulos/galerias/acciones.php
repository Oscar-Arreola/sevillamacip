<?php
$modulo='galerias';
$modulopic=$modulo.'pic';
$rutaFinal='../img/contenido/'.$modulo.'/';

//%%%%%%%%%%%%%%%%%%%%%%%%%%    Nuevo galería    %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	if(isset($_POST['nuevocatalogo']) AND isset($_POST['titulo'])){
		$titulo	= trim(htmlentities($_POST['titulo']));

		$sql = "INSERT INTO $modulo (titulo) VALUES ('$titulo')";
		if($insertar = $CONEXION->query($sql)){
			$id = $CONEXION->insert_id;
			header( 'Location: index.php?rand='.rand(1,9999).'&modulo='.$modulo.'&archivo='.$archivo.'&id='.$id.'&showsuccess=1');
		}else{
			$legendFail .= "<br>No se pudo borrar de la base de datos";
			$fallo='danger';  
		}
	}

//%%%%%%%%%%%%%%%%%%%%%%%%%%    Borrar galería     %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	if(isset($_POST['borrararticulo'])){
		include '../../../includes/connection.php';
		$rutaFinal='../../'.$rutaFinal;
		$id=$_POST['id'];

		if($borrar = $CONEXION->query("DELETE FROM $modulo WHERE id = $id")){
			$exito=1;
		}

		$CONSULTA = $CONEXION -> query("SELECT * FROM $modulopic WHERE producto = $id");
		while($row_CONSULTA = $CONSULTA -> fetch_assoc()){
			$id=$row_CONSULTA['id'];

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
		}

		if(isset($exito)){
			echo "<div class='bg-success color-blanco'><i uk-icon='icon: trash;ratio:2;'></i> &nbsp; Borrado</div>";
		}else{
			echo "<div class='bg-danger color-blanco'><i uk-icon='icon: warning;ratio:2;'></i> &nbsp; No se pudo borrar</div>";
		}
	}

//%%%%%%%%%%%%%%%%%%%%%%%%%%    Borrar Imagen     %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
		if(isset($_POST['borrarfoto'])){
		include '../../../includes/connection.php';
		$rutaFinal='../../../img/contenido/'.$modulo.'/';
		$id=$_POST['id'];
		$file=$_POST['file'];
		// Borramos el archivo de imagen
		$pic=$rutaFinal.$file;
		unlink($pic);

		if (!file_exists($pic)) {
			$exito=1;
		}

		
		if(isset($exito)){
			$borrar = $CONEXION->query("DELETE FROM $modulopic WHERE id = $id");
			echo "<div class='bg-success color-blanco'><i uk-icon='icon: trash;ratio:2;'></i> &nbsp; Borrado</div>";
		}else{
			echo "<div class='bg-danger color-blanco'><i uk-icon='icon: warning;ratio:2;'></i> &nbsp; No se pudo borrar</div>";
		}
	}

//%%%%%%%%%%%%%%%%%%%%%%%%%%    Subir foto     %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	if(isset($_REQUEST['imagen'])){
		$rutaFinal='../img/contenido/'.$modulo.'/';
		$id=$_GET['id'];

		$imagenName=$_GET['imagen'];

		$rutaInicial="../library/upload-file/php/uploads/";

		if(file_exists($rutaInicial.$imagenName)){
			$i = strrpos($imagenName,'.');
			$l = strlen($imagenName) - $i;
			$ext = strtolower(substr($imagenName,$i+1,$l));


		$imagen = rand(1111,9999).'.'.$ext;
			if (file_exists($rutaFinal.$imagen)){
				$imagen = rand(1111,9999).'.'.$ext;
			}
			$sql = "INSERT INTO $modulopic (producto,imagen) VALUES ('$id','$imagen')";
			if($insertar = $CONEXION->query($sql)){
		 	 	copy($rutaInicial.$imagenName, $rutaFinal.$imagen);
				unlink($rutaInicial.$imagenName);
				$exito=1;
				$legendSuccess = "<br>Guardado";

				$mensajeClase = 'success';
				$mensajeIcon  = 'check';
				$mensaje      = 'guardado'.$imagenName;
		    }
	}	
				
}










