<?php
	$fallo=1;
	$cuerpo = '
	<html>
	<head>
		<meta charset="utf-8">
		<title>'.$asuntoCorreo.'</title>
	</head>
	<body>
		<div class="" style="max-width:700px;margin:auto;">
			<div class="" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);transition: 0.3s;border-radius: 5px;">
				<img src="'.$ruta.'img/design/email-header.jpg" alt="email-header.jpg" style="width:100%;border-radius: 5px 5px 0 0;">
				<div class="" style="padding:1em;">
					<div style="max-width: 700px; width: 100%; margin-top: 0; margin-bottom: 0; margin-right: auto; margin-left: auto; background-color: white; position: relative">
						'.$cuerpoCorreo.'
							<p class="">
								<a href="'.$ruta.'" style="color:white;">www.'.$dominio.'</a>
							</p>
							<p class="">
								Tel: '.$telefonoSeparado1.'
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	</html>

	';


	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	if(file_exists('library/phpmailer/src/Exception.php')){
		require 'library/phpmailer/src/Exception.php';
		require 'library/phpmailer/src/PHPMailer.php';
		require 'library/phpmailer/src/SMTP.php';
		$fallo=0;
	}elseif(file_exists('../library/phpmailer/src/Exception.php')){
		require '../library/phpmailer/src/Exception.php';
		require '../library/phpmailer/src/PHPMailer.php';
		require '../library/phpmailer/src/SMTP.php';
		$fallo=0;
	}else{
		$msjTxt.="<br>No se encontro PHPmailer";
	}

	// Envío
	if($fallo==0){
		$fallo=1;
		$mail = new PHPMailer(true);
		try {
			$mail->SMTPDebug  = 0;
			$mail->isSMTP();
			$mail->Host       = $Remitentehost;
			$mail->SMTPAuth   = true;
			$mail->Username   = $RemitenteMail;
			$mail->Password   = $Remitentepass;
			$mail->SMTPSecure = $Remitenteseguridad;
			$mail->Port       = $Remitenteport;

			$mail->setFrom($RemitenteMail, $Brand);

			$mail->isHTML(true);
			$mail->Subject = $asuntoCorreo;
			$mail->Body    = $cuerpo;
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			if ($debug==1) {
				//Set an alternative reply-to address
				// $mail->addAddress($efra, 'Efra');
				// $xtras=$efra;
				$fallo=0;
			}elseif (isset($send2user) AND $send2user==1) {
				//Set an alternative reply-to address
				$mail->addAddress($email, $nombre);
				$mail->AddBCC($destinatario1, $Brand);
				$xtras=$destinatario1.' y '.$email;
				if (strlen($destinatario2)>0) {
					$mail->AddBCC($destinatario2, $Brand);
					$xtras.=' y '.$destinatario2;
				}

				$fallo=0;
			}elseif (isset($send2user) AND $send2user==2) {
				//Set an alternative reply-to address
				$mail->addAddress($email, $nombre);
				$xtras=$email;
				$fallo=0;
			}else{
				//Set an alternative reply-to address
				$mail->addAddress($destinatario1, $Brand);
				$xtras=$destinatario1;
				if (strlen($destinatario2)>0) {
					$mail->AddBCC($destinatario2, $Brand);
					$xtras.='y '.$destinatario2;
				}

				$fallo=0;
			}
			if($mail->Send()){
					$fallo=0;
					$msjIcon  = 'check';
					$msjClase = 'success';
					$msjTxt   = 'Enviado';
			}else{
				$msjTxt.="<br>No se pudo enviar<br>Codigo: 12<br>Brand: $Brand <br>Dominio: $dominio <br>Remitente: $RemitenteMail";
			}


		} catch (Exception $e) {
			$msjTxt.= "<br>Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}