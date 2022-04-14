<?php
	$modulo     = 'configuracion';
	$rutaInicial= '../library/upload-file/php/uploads/';
	$rutaFinal  = '../img/contenido/varios/';
	$rutaSlider = '../img/contenido/carousel/';

// *****************************
// Textos del editor    
// *****************************
	if (isset($_POST['editartextosconformato'])) {
		foreach ($_POST as $key => $value) {
			$dato = trim(str_replace("'", "&#039;", $value));
			$actualizar = $CONEXION->query("UPDATE $modulo SET $key = '$dato' WHERE id = 1");
			$exito=1;
			unset($fallo);
		}
	}
	if (isset($_POST['editartextos'])) {
		foreach ($_POST as $key => $value) {
			$dato = trim(htmlentities($value, ENT_QUOTES));
			$actualizar = $CONEXION->query("UPDATE $modulo SET $key = '$dato' WHERE id = 1");
			$exito=1;
			unset($fallo);
		}
	}


	//  Borrar varios tipos de dato 
		if(isset($_POST['eliminargeneral'])){
			include '../../../includes/connection.php';

			$estatus=0;
			$mensajeClase='danger';
			$mensajeIcon='exclamation-triangle';
			$mensaje='No se pudo borrar';
			
			$id=$_POST['id'];
			$tabla=$_POST['tabla'];
			if($borrar = $CONEXION->query("DELETE FROM $tabla WHERE id = $id")){
				$mensajeClase='success';
				$mensajeIcon='trash';
				$mensaje='Borrado';
				$estatus=1;
			}

			$msj=str_replace('"', "'", '<div class="uk-text-center color-white bg-'.$mensajeClase.' padding-10 text-lg"><i class="fa fa-'.$mensajeIcon.'"></i> &nbsp; '.$mensaje.'</div>');
			echo '{ "msj":"'.$msj.'" , "estatus":"'.$estatus.'" }';
		}

	//  Borrar existencias
		if(isset($_POST['eliminarexistencias'])){
			include '../../../includes/connection.php';

			$tabla=$_POST['tabla'];
			$campo=$_POST['campo'];
			$id   =$_POST['id'];

			$estatus=0;
			$mensajeClase='danger';
			$mensajeIcon='exclamation-triangle';
			$mensaje='Error';

			$id=$_POST['id'];
			$tabla=$_POST['tabla'];

			$sql="DELETE FROM productosexistencias WHERE $campo = $id";
			if($borrar = $CONEXION->query($sql)){
				$sql1="DELETE FROM $tabla WHERE id = $id";
				if($borrar = $CONEXION->query($sql1)){
					$mensajeClase='success';
					$mensajeIcon='trash';
					$mensaje='Borrado';
					$estatus=1;
				}else{
					$mensaje.='<br>No se pudo borrar<br>'.$sql1;
				}
			}else{
				$mensaje.='<br>No se pudieron borrar las existencias<br>'.$sql;
			}

			$msj=str_replace('"', "'", '<div class="uk-text-center color-white bg-'.$mensajeClase.' padding-10 text-lg"><i class="fa fa-'.$mensajeIcon.'"></i> &nbsp; '.$mensaje.'</div>');
			echo '{ "msj":"'.$msj.'" , "estatus":"'.$estatus.'" }';
		}


// *****************************
//	Archivos
// *****************************
	// Borrar archivos      
		if(isset($_REQUEST['borrarpic'])){
			$campo=$_GET['campo'];

			$CONSULTA = $CONEXION -> query("SELECT $campo FROM $modulo WHERE id = 1");
			$row_CONSULTA = $CONSULTA -> fetch_assoc();

			if (strlen($row_CONSULTA[$campo])>0) {
				$pic=$rutaFinal.$row_CONSULTA[$campo];
				if(file_exists($pic)){
					unlink($pic);
					$legendSuccess.='<br>Archivo eliminado: '.$row_CONSULTA[$campo];
				}else{
					$legendSuccess.='<br>Archivo no encontrado';
				}
				$actualizar = $CONEXION->query("UPDATE $modulo SET $campo = NULL WHERE id = 1");
				$exito=1;
			}else{
				$legendFail .= "<br>No se encontró el archivo en la base de datos: ".$row_CONSULTA[$campo];
				$fallo=1;
			}
		}

	// Subir archivos       
		if(isset($_GET['fileuploaded'])){
			$imagenName=$_GET['fileuploaded'];

			$id=(isset($_GET['id']))?$_GET['id']:$id;
			$tabla=(isset($_GET['tabla']))?$_GET['tabla']:$modulo;
			$campo=$_GET['campo'];

			// Verificar que la imagen existe
			if(!file_exists($rutaInicial.$imagenName)){
				$fallo=1;
				$legendFail='<br>No se permite refrescar la página.';
			}

			// Guardar en la base de datos
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

				// Obtenemos el nombre del archivo anterior
				$sql="SELECT $campo FROM $tabla WHERE id = $id";
				//echo $sql;
				$CONSULTA = $CONEXION -> query($sql);
				$row_CONSULTA = $CONSULTA -> fetch_assoc();
				// Si existe, lo borramos
				if ($row_CONSULTA[$campo]!='' AND file_exists($rutaFinal.$row_CONSULTA[$campo])) {
					unlink($rutaFinal.$row_CONSULTA[$campo]);
				}

				// Copiar el archivo a su nueva ubicación
				copy($rutaInicial.$imagenName, $rutaFinal.$imgFinal);
				$sql="UPDATE $tabla SET $campo = '$imgFinal' WHERE id = $id";
				$actualizar = $CONEXION->query($sql);
				
			}

			// Borramos las imágenes que estén remanentes en el directorio de subida
			$filehandle = opendir($rutaInicial); // Abrir archivos
			while ($file = readdir($filehandle)) {
				if ($file != "." && $file != "..") {
					if(file_exists($rutaInicial.$file)){
						unlink($rutaInicial.$file);
					}
				}
			} 
			// Fin lectura archivos
			closedir($filehandle); 

		}


// *****************************
//	FAQ
// *****************************
	//	Nuevo Artículo      
		if(isset($_POST['nuevo']) && isset($_POST['pregunta'])){ 
			// Obtenemos los valores enviados
			if (isset($_POST['pregunta']))	{ $pregunta=htmlentities($_POST['pregunta'], ENT_QUOTES);	}else{	$pregunta=''; }
			if (isset($_POST['respuesta']))	{ $respuesta=str_replace("'", "&#039;", $_POST['respuesta']);	}else{	$respuesta=''; }

			// Actualizamos la base de datos
			if($pregunta!=""){

				$legendFail.='<br>'.$pregunta;

				$sql = "INSERT INTO faq (pregunta,respuesta,orden)".
					"VALUES ('$pregunta','$respuesta','99')";
				if($insertar = $CONEXION->query($sql)){
					$exito=1;
					$id=$CONEXION->insert_id;
					$legendSuccess .= '<br>Pregunta nueva';
				}else{
					$fallo=1;  
					$legendFail .= "<br>No se pudo agregar a la base de datos";
				}
			}else{
				$fallo=1;  
				$legendFail .= "<br>Está vacío";
			}
		}

	//	Editar FAQ     
		if(isset($_POST['faqeditar']) && isset($_POST['pregunta'])){

		    // Obtenemos los valores enviados
			if (isset($_POST['pregunta']))	{ $pregunta=htmlentities($_POST['pregunta'], ENT_QUOTES);	}else{	$pregunta=''; }
			if (isset($_POST['respuesta']))	{ $respuesta=str_replace("'", "&#039;", $_POST['respuesta']);	}else{	$respuesta=''; }


			if(
					$actualizar = $CONEXION->query("UPDATE faq SET 
						pregunta = '$pregunta',
						respuesta  = '$respuesta' 
						WHERE id = $id")
				){
				$exito=1;
				$legendSuccess.='<br>Guardado';
			}else{
				$fallo=1;  
				$legendFail .= "<br>No se pudo modificar la base de datos";
			}
		}

	//	Borrar Artículo     
		if(isset($_REQUEST['borrarFaq'])){
			if($borrar = $CONEXION->query("DELETE FROM faq WHERE id = $id")){
				$exito=1;
				$legendSuccess .= "<br>Pregunta eliminada";
			}else{
				$legendFail .= "<br>No se pudo borrar de la base de datos";
				$fallo=1;  
			}
		}


// *****************************
//	USUARIOS
// *****************************

	//	Nuevo Administrador 
		if(isset($_REQUEST['new-user'])){
			if(isset($_REQUEST['user'])){ $user=strtolower($_REQUEST['user']); }else{ $user=false; $legendFail.="<br><br>Proporcione nombre de usuario";}
			if(isset($_REQUEST['pass'])){ $pass=$_REQUEST['pass']; }else{ $pass=false; $legendFail.="<br><br>Proporcione contraseña";}
			if(isset($_REQUEST['pass1'])){ $pass1=$_REQUEST['pass1']; }else{ $pass1=false; $legendFail.="<br><br>Confirme su contraseña";}
			if(strlen($pass)>5){
				if($pass==$pass1 and $user!=false){
					$pass_encripted = md5($pass);

					$USER = $CONEXION -> query("SELECT * FROM user WHERE user = '$user'");
					$numRows = $USER ->num_rows;
					if ($numRows==0) {

						$sql = "INSERT INTO user (pass,user,nivel)".
							"VALUES ('$pass_encripted','$user',1)";
						if($insertar = $CONEXION->query($sql))
						{
							$exito='success';
							$legendSuccess.="<br>Administrador agregado";
						}else{
							$fallo='danger';  
							$legendFail.="<br>No se pudo agregar el Administrador";
						}
					}else{
						$fallo='danger';  
						$legendFail.="<br>El usuario ya existe";
					}
				}else{
					$fallo='danger';  
					$legendFail.="<br>Las contraseñas no coinciden ";
				}
			}else{
				$fallo='danger';  
				$legendFail.="<br>La contraseña es demasiado débil ";
			}
		}

	//	Editar Administrador
		if(isset($_REQUEST['edit-user'])){
			if(isset($_REQUEST['user'])){ $user=strtolower($_REQUEST['user']); }else{ $user=false; $legendFail.="<br><br>Proporcione nombre de usuario";}
			if(isset($_REQUEST['pass'])){ $pass=$_REQUEST['pass']; }else{ $pass=false; $legendFail.="<br><br>Proporcione contraseña";}
			if(isset($_REQUEST['pass1'])){ $pass1=$_REQUEST['pass1']; }else{ $pass1=false; $legendFail.="<br><br>Confirme su contraseña";}
			if(strlen($pass)>5){
				if($pass==$pass1){
					$pass_encripted = md5($pass);

					if(
						$actualizar = $CONEXION->query("UPDATE user SET user = '$user' WHERE id = $id")
					and	$actualizar = $CONEXION->query("UPDATE user SET pass = '$pass_encripted' WHERE id = $id")
						)
					{
						$exito='success';
						$legendSuccess.="<br>Administrador editado";
					}else{
						$fallo='danger';  
						$legendFail.="<br>No se pudo modificar el Administrador";
					}
				}else{
					$fallo='danger';  
					$legendFail.="<br>Contraseñas no coinciden";
				}
			}else{
				$fallo='danger';  
				$legendFail.="<br>Contraseña demasiado débil";
			}
		}

	//	Borrar Administrador
		if(isset($_REQUEST['borrarUser'])){
			if($borrar = $CONEXION->query("DELETE FROM user WHERE id = $id"))
			{
				$exito='success';
				$legendSuccess.="<br>Administrador eliminado";
			}else{
				$fallo='danger';  
				$legendFail.="<br>No se pudo eliminar el Administrador";
			}
		} 

	//	Editar nivel        
		if (isset($_POST['editanivel'])) {
			include '../../../includes/connection.php';
			
			$id = $_POST['id'];
			$nivel = $_POST['nivel'];

			$actualizar = $CONEXION->query("UPDATE user SET nivel = $nivel WHERE id = $id");
		}


// *****************************
//	SLIDER INICIO
// *****************************
	//	Nuevo video      
		if(isset($_POST['agregavideo']) AND isset($_POST['video'])){ 
			$video=$_POST['video'];

			$sql = "INSERT INTO carousel (video,orden)".
				"VALUES ('$video','99')";
			if($insertar = $CONEXION->query($sql)){
				header('location: index.php?rand='.rand(1,9999).'&modulo='.$modulo.'&archivo='.$archivo);
			}
		}
	//%%%%%%%%%%%%%%%%%%%%%%%%%%    insertar o cambiar texto Imagen      	 %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
		if(isset($_POST['idImg'])){
			
			$idImg=$_POST['idImg'];
			$tituloImg=$_POST['titulo'];
			$txtImg=$_POST['texto'];
			$urlImg=$_POST['url'];

			// actualizamos la base de datos
			$sqlImg = 'UPDATE carousel SET titulo = "'.$tituloImg.'", txt= "'.$txtImg.'", url= "'.$urlImg.'"  WHERE id = '.$idImg.'';
			if($actualizar = $CONEXION->query($sqlImg)){
				$legendSuccess.= "<br> texto actualizado";
				$exito='success';
			}else{
				$legendFail .= "<br>No se pudo actualizar de la base de datos";
				$fallo='danger';  
			}
		}

	//%%%%%%%%%%%%%%%%%%%%%%%%%%    Borrar Imagen      	 %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
		if(isset($_POST['borrarslider'])){
			include '../../../includes/connection.php';
			$id=$_POST['id'];
			// Borramos de la base de datos
			if($borrar = $CONEXION->query("DELETE FROM carousel WHERE id = $id")){
				$legendSuccess.= "<br> Imagen eliminada";
				$exito='success';
			}else{
				$legendFail .= "<br>No se pudo borrar de la base de datos";
				$fallo='danger';  
			}
			// Borramos el archivo de imagen
			$rutaSlider="../../../img/contenido/carousel/";
			$filehandle = opendir($rutaSlider); // Abrir archivos
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
						$pic=$rutaSlider.$file;
						$exito=1;
						unlink($pic);
					}
				}
			}
			if (isset($exito)) {
				$mensajeClase='success';
				$mensajeIcon='check';
				$mensaje='Eliminado';
			}else{
				$mensajeClase='danger';
				$mensajeIcon='ban';
				$mensaje='No se pudo guardar';
			}

			echo '<div class="uk-text-center color-white bg-'.$mensajeClase.' padding-10 text-lg"><i class="fa fa-'.$mensajeIcon.'"></i> &nbsp; '.$mensaje.'</div>';		
		}

	//%%%%%%%%%%%%%%%%%%%%%%%%%%    Subir Imagen     	 %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
		if(isset($_GET['imagenslider'])){
			//Obtenemos la extensión de la imagen
			$exito = 0;
			$imagenName=$_GET['imagenslider'];
			$i = strrpos($imagenName,'.');
			$l = strlen($imagenName) - $i;
			$ext = strtolower(substr($imagenName,$i+1,$l));

			

			if(!file_exists($rutaInicial.$imagenName)){
				$fallo=1;
				$legendFail='<br>No se permite refrescar la página.';
			}

			$imagen = rand(1111,9999).'.'.$ext;
			if (file_exists($rutaSlider.$imagen)){
				$imagen = rand(1111,9999).'.'.$ext;
			}


			if (!isset($fallo)) {
				$sql = "INSERT INTO carousel (imagen, orden) VALUES ('$imagen', '99')";
				if($insertar = $CONEXION->query($sql)){

					copy($rutaInicial.$imagenName, $rutaSlider.$imagen);
					unlink($rutaInicial.$imagenName);
					$exito=1;
					$legendSuccess = "<br>Guardado";

					$mensajeClase = 'success';
					$mensajeIcon  = 'check';
					$mensaje      = 'guardado'.$imagenName;
				}

				if($exito==1){
					header('location: index.php?rand='.rand(1,9999).'&modulo='.$modulo.'&archivo='.$archivo);
				}else{
					$fallo=1;  
					$legendFail .= $sql;
				}
			}

				
			
		}


// *****************************
//	COLORES Y TALLAS
// *****************************
	// 	COLORES Y TALLAS 
		//  COLOR NUEVO 
			if(isset($_POST['nuevocolor'])){ 
				// Obtenemos los valores enviados
				if (isset($_POST['txt'])) { $txt=$_POST['txt'];   }else{	$txt=false; $fallo=1; }

				// Sustituimos los caracteres inválidos
				$txt=htmlentities($txt, ENT_QUOTES);

				// Actualizamos la base de datos
				if($txt!=""){
					$sql = "INSERT INTO productoscolor (txt) VALUES ('$txt')";
					if($insertar = $CONEXION->query($sql)){
						$cat = $CONEXION->insert_id;
						header( 'Location: index.php?rand='.rand(1,9999).'&modulo='.$modulo.'&archivo='.$archivo);
					}else{
						$fallo=1;  
						$legendFail .= "<br>No pudo agregarse a la base de datos $txt";
					}
				}else{
					$fallo=1;  
					$legendFail .= "<br>El campo está vacío";
				}
			}

		//  NUEVA TEXTURA
			if (isset($_GET['filenametextura'])) {
				$imagenName=$_GET['filenametextura'];

				// Verificar que la imagen existe
				if(!file_exists($rutaInicial.$imagenName)){
					$fallo=1;
					$legendFail='<br>No se permite refrescar la página.';
				}

				// Guardar en la base de datos
				if (!isset($fallo)) {
					// Extensión de la imagen
					$i = strrpos($imagenName,'.');
					$l = strlen($imagenName) - $i;
					$ext = strtolower(substr($imagenName,$i+1,$l));

					$imgFinal=$hoy.rand(111111111,999999999).'.'.$ext;
					if(file_exists($rutaFinal.$imgFinal)){
						$imgFinal=$hoy.rand(111111111,999999999).'.'.$ext;
					}
					copy($rutaInicial.$imagenName, $rutaFinal.$imgFinal);
					$insertar = $CONEXION->query("INSERT INTO productoscolor (imagen) VALUES ('$imgFinal')");
					unset($fallo);
				}

				// Borramos las imágenes que estén remanentes en el directorio de subida
				$filehandle = opendir($rutaInicial); // Abrir archivos
				while ($file = readdir($filehandle)) {
					if ($file != "." && $file != "..") {
						if(file_exists($rutaInicial.$file)){
							unlink($rutaInicial.$file);
						}
					}
				} 
				// Fin lectura archivos
				closedir($filehandle); 
			}

		//  TIPOS DE TALLA
			if(isset($_POST['nuevtipodetalla'])){ 
				// Obtenemos los valores enviados
				if (isset($_POST['txt'])) { $txt=$_POST['txt'];   }else{	$txt=false; $fallo=1; }

				// Sustituimos los caracteres inválidos
				$txt=htmlentities($txt, ENT_QUOTES);

				// Actualizamos la base de datos
				if($txt!=""){
					$sql = "INSERT INTO productostallaclasif (txt) VALUES ('$txt')";
					if($insertar = $CONEXION->query($sql)){
						header( 'Location: index.php?rand='.rand(1,9999).'&modulo='.$modulo.'&archivo='.$archivo);
					}else{
						$fallo=1;  
						$legendFail .= "<br>No pudo agregarse a la base de datos<br> $sql";
					}
				}else{
					$fallo=1;  
					$legendFail .= "<br>El campo está vacío";
				}
			}

		//  TALLA NUEVA 
			if(isset($_GET['nuevatalla'])){ 
				// Obtenemos los valores enviados
				if (isset($_GET['txt'])) { $txt=htmlentities($_GET['txt'], ENT_QUOTES);   }else{	$txt=false; $fallo=1; }
				if (isset($_GET['tipo'])) { $tipo=htmlentities($_GET['tipo'], ENT_QUOTES);   }else{	$tipo=false; $fallo=1; }

				// Actualizamos la base de datos
				if($txt!=""){
					$sql = "INSERT INTO productostalla (tipo,txt) VALUES ('$tipo','$txt')";
					if($insertar = $CONEXION->query($sql)){
						$cat = $CONEXION->insert_id;
						header( 'Location: index.php?rand='.rand(1,9999).'&modulo='.$modulo.'&archivo='.$archivo.'&id='.$id);
					}else{
						$fallo=1;  
						$legendFail .= "<br>No pudo agregarse a la base de datos $txt";
					}
				}else{
					$fallo=1;  
					$legendFail .= "<br>El campo está vacío";
				}
			}
// INSERT GENERAL 
	if(isset($_POST['nuevoinsert'])){
		GLOBAL $CONEXION;
			$campo="";
			$valores="";
			$primero= FALSE;
			$modulo=$_POST['modulo'];
			$archivo=$_POST['archivo'];
			$tabla=$_POST['tabla'];
			foreach ($_POST as $key => $value) {
				if ($key !='nuevoinsert' && $key !='modulo' && $key !='tabla' && $key !='archivo') {
					if ($key=='txt') {
						$dato = trim(str_replace("'", "&#039;", $value));
					}else{
						$dato = trim(htmlentities($value, ENT_QUOTES));
					}
					if ($primero == TRUE) {
						$campo= $campo.','.$key;
						$valores= $valores.$value.',';
					}else{
						$campo= $campo.$key;
						$valores= $valores.$value;	
					}
					$primero= TRUE;
					;
				}	
			}

			$sql = "INSERT INTO $tabla ($campo) VALUES ('$valores')";
				if($insertar = $CONEXION->query($sql)){
					$cat = $CONEXION->insert_id;
					$msjClase = 'success';
					$msjIcon  = 'check';
					header( 'Location: index.php?rand='.rand(1,9999).'&modulo='.$modulo.'&archivo='.$archivo);
				}else{
					$fallo=1;  
					$msjClase = 'danger';
					$msjIcon  = 'warning';
					$msjTxt = $sql;
					echo '{ "msj":"<div class=\'uk-text-center color-blanco bg-'.$msjClase.' padding-10 text-lg\'><i uk-icon=\'icon:'.$msjIcon.';ratio:2;\'></i> &nbsp; '.$msjTxt.'</div>"}';
				}
		}
	//  MARCA NUEVA 
		if(isset($_POST['nuevamarca'])){ 
			// Obtenemos los valores enviados
			if (isset($_POST['txt'])) { $txt=$_POST['txt'];   }else{	$txt=false; $fallo=1; }

			// Sustituimos los caracteres inválidos
			$txt=htmlentities($txt, ENT_QUOTES);

			// Actualizamos la base de datos
			if($txt!=""){
				$sql = "INSERT INTO productosmarcas (txt) VALUES ('$txt')";
				if($insertar = $CONEXION->query($sql)){
					$cat = $CONEXION->insert_id;
					header( 'Location: index.php?rand='.rand(1,9999).'&modulo='.$modulo.'&archivo='.$archivo);
				}else{
					$fallo=1;  
					$legendFail .= "<br>No pudo agregarse a la base de datos $txt";
				}
			}else{
				$fallo=1;  
				$legendFail .= "<br>El campo está vacío";
			}
		}

	//  CLASIFICACIÓN NUEVA 
		if(isset($_POST['nuevaclasif'])){ 
			// Obtenemos los valores enviados
			if (isset($_POST['txt'])) { $txt=$_POST['txt'];   }else{	$txt=false; $fallo=1; }

			// Sustituimos los caracteres inválidos
			$txt=htmlentities($txt, ENT_QUOTES);

			// Actualizamos la base de datos
			if($txt!=""){
				$sql = "INSERT INTO productosclasif (txt) VALUES ('$txt')";
				if($insertar = $CONEXION->query($sql)){
					$cat = $CONEXION->insert_id;
					header( 'Location: index.php?rand='.rand(1,9999).'&modulo='.$modulo.'&archivo='.$archivo);
				}else{
					$fallo=1;  
					$legendFail .= "<br>No pudo agregarse a la base de datos $txt";
				}
			}else{
				$fallo=1;  
				$legendFail .= "<br>El campo está vacío";
			}
		}


// *****************************
//	CUPONES
// *****************************
	// Nuevo cupón
		if (isset($_POST['nuevocupon'])) {
			$codigo = (isset($_POST['codigo'])) ? trim(htmlentities($_POST['codigo'])):'';
			$txt = (isset($_POST['txt'])) ? trim(htmlentities($_POST['txt'])):'';
			$descuento = (isset($_POST['descuento'])) ? trim(htmlentities($_POST['descuento'])):'';
			$vigencia = (isset($_POST['vigencia'])) ? trim(htmlentities($_POST['vigencia'])):'';
			
			$sql = "INSERT INTO cupones (codigo,txt,descuento,vigencia,alta)".
				"VALUES ('$codigo','$txt','$descuento','$vigencia','$hoy')";
			if($insertar = $CONEXION->query($sql)){
				$exito=1;
				$id=$CONEXION->insert_id;
				header('location: index.php?rand='.rand(1,9999).'&modulo='.$modulo.'&archivo='.$archivo.'&id='.$id.'&showsuccess=1');
			}else{
				$fallo=1;
				$legendFail='<br>'.$sql;
			}
		}


// *****************************
//	RESPALDOS
// *****************************
	//    Borrar archivo de respaldo  
		if(isset($_POST['borrarrespaldo'])){
			include '../../../includes/connection.php';
			$file     = $_POST['file'];
			$rutaFinal='../../../backup/';

			$msjClase = 'danger';
			$msjIcon  = 'warning';
			$msjTxt   = '<br>Error';
			$estatus  = '';
			$horario  = '';
			$xtras    = $rutaFinal.$file;
			$fallo    = 1;
		
			if (strlen($file)>0 AND file_exists($rutaFinal.$file)) {
				unlink($rutaFinal.$file);

				$fallo    = 0;
				$msjIcon  = 'trash';
				$msjClase = 'success';
				$msjTxt   = 'Borrado';
			}

			// Mostrar mensaje
				echo '{ "msj":"<div class=\'uk-text-center color-blanco bg-'.$msjClase.' padding-10 text-lg\'><i uk-icon=\'icon:'.$msjIcon.';ratio:2;\'></i> &nbsp; '.$msjTxt.'</div>", "estatus":"'.$fallo.'", "xtras":"'.$xtras.'" '.$estatus.''.$horario.'}';
		}

	//    Respaldar base de datos     
		if (isset($_POST['respaldarbasededatos'])) {
			include '../../../includes/connection.php';
		
			$msjClase = 'danger';
			$msjIcon  = 'warning';
			$msjTxt   = '<br>Error';
			$estatus  = '';
			$horario  = '';
			$xtras    = '';
			$fallo    = 1;
		
			$rutaBackup='../../../backup/';

		    $contents = "-- Database: `".$database."` --\n";
			
			$CONSULTA = $CONEXION->query("SHOW TABLES");
			while($rowCONSULTA = $CONSULTA->fetch_array()){
		        $tablasRespaldar[] = $rowCONSULTA[0];
			}
		    
		    foreach($tablasRespaldar as $table){
		        $contents .= "-- Table `".$table."` --\n";
		        
		        $consulta = $CONEXION->query("SHOW CREATE TABLE ".$table);
		        while($rowConsulta = $consulta->fetch_array()){
		            $contents .= $rowConsulta[1].";\n\n";
		        }

		        $consulta = $CONEXION->query("SELECT * FROM ".$table);
		        $numItems = $consulta->num_rows;
		        $fields = $consulta->fetch_fields();
		        $fields_count = count($fields);
		        
		        $insert_head = "INSERT INTO `".$table."` (";
		        for($i=0; $i < $fields_count; $i++){
		            $insert_head  .= "`".$fields[$i]->name."`";
		                if($i < $fields_count-1){
		                        $insert_head  .= ', ';
		                    }
		        }
		        $insert_head .= ")";
		        $insert_head .= "VALUES\n";        
		        
		        if($numItems>0){
		            $r = 0;
		            while($rowConsulta = $consulta->fetch_array()){
		                if(($r % 400)  == 0){
		                    $contents .= $insert_head;
		                }
		                $contents .= "(";
		                for($i=0; $i < $fields_count; $i++){
		                    $rowConsulta_content =  str_replace("\n","\\n",$CONEXION->real_escape_string($rowConsulta[$i]));
		                    
		                    switch($fields[$i]->type){
		                        case 8: case 3:
		                        	if (strlen($rowConsulta_content)>0) {
		                            	$contents .=  $rowConsulta_content;
		                        	}else{
		                            	$contents .=  'NULL';
		                        	}
		                            break;
		                        default:
		                        	if (strlen($rowConsulta_content)) {
			                            $contents .= "'". $rowConsulta_content ."'";
		                        	}else{
		                            	$contents .=  'NULL';
		                        	}
		                    }
		                    if($i < $fields_count-1){
		                            $contents  .= ', ';
		                        }
		                }
		                if(($r+1) == $numItems || ($r % 400) == 399){
		                    $contents .= ");\n\n";
		                }else{
		                    $contents .= "),\n";
		                }
		                $r++;
		            }
		        }
		    }

			// Si no existe la carpeta, se crea
			if (!is_dir ( $rutaBackup )) {
			    mkdir ( $rutaBackup, 0777, true );
			}

			// Nombre del archivo final
			$backup_file_name = "sql-backup-".date( "Y-m-d").".sql";

			// Crea el recurso para crear el archivo
			$fp = fopen($backup_file_name ,'w+');
			if (($result = fwrite($fp, $contents))) {
			    $msjTxt.="<br>Archivo creado";
			}else{
			    $msjTxt.='<br>No se pudo crear el respaldo';
			}
			fclose($fp);

			if(copy($backup_file_name, $rutaBackup.$backup_file_name)){
			    
			    if (file_exists($rutaBackup.$backup_file_name)) {
			        unlink($backup_file_name);
			    }

				$fallo    = 0;
				$msjIcon  = 'check';
				$msjClase = 'success';
				$msjTxt   = 'Éxito';

			}else{
			    $msjTxt.='<br>No se pudo guardar el archivo';
			}

			// Mostrar mensaje
				echo '{ "msj":"<div class=\'uk-text-center color-blanco bg-'.$msjClase.' padding-10 text-lg\'><i uk-icon=\'icon:'.$msjIcon.';ratio:2;\'></i> &nbsp; '.$msjTxt.'</div>", "estatus":"'.$fallo.'", "xtras":"'.$xtras.'" '.$estatus.''.$horario.'}';

			//    Cerrar conexión y Borrar Error_log         
				mysqli_close($CONEXION);
				if (file_exists('error_log')) {
					unlink('error_log');
				}

		}







