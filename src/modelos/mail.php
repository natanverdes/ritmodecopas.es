<?php

	class Mail{

		public static function newValidationMail($to){

			$email_to = $to;
			$email_from = 'noreply@ritmodecopas.es';
			$token = self::generateToken();
			$email_subject = "Valida tu cuenta ritmodecopas.es";
			$email_message = "Para validar su cuenta debe acceder a este link: http://www.ritmodecopas.es/validate_user.php?token=".$token;

			$headers = 'From: '.$email_from."\r\n".
			'Reply-To: '.$email_from."\r\n" .
			'X-Mailer: PHP/' . phpversion();

			mail($email_to, $email_subject, $email_message, $headers);
			
			return $token;
		}

		private static function generateToken($length = 20) {
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
		    return $randomString;
		}

	}



?>