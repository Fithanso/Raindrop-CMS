<?php

namespace Raindrop\Helper;

use PHPMailer\PHPMailer;
use Raindrop\Load;

class Common {

	/**
	 * @return bool
	 */
	public static function isPost() {
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			return true;
		}

		return false;
	}

	/**
	 * @return mixed
	 */
	public static function getMethod() {
		return $_SERVER['REQUEST_METHOD'];
	}

	/**
	 * @return bool|string
	 */
	public static function getPathUrl() {
		$pathUrl = $_SERVER['REQUEST_URI'];

		if($position = strpos($pathUrl,'?')) {//search for GET parameters in the query
			$pathUrl = substr($pathUrl, 0, $position);//cut GET parameters from url
		}
		return $pathUrl;
	}

	static function isLinkActive($key) {

		if(self::searchMatchString($_SERVER['REQUEST_URI'], $key)){
			return true;
		}
		return false;
	}

	static function searchMatchString($string, $find){
		if(strripos($string, $find) !== false) {
			return true;
		}
	}

	public static function sendMail($addresses, $body, $subject = 'Raindrop'){

		$mail = new PHPMailer\PHPMailer(true);

		try {

			$mail->SMTPDebug = 0;
			$mail->isSMTP();
			$mail->Host       = 'smtp.gmail.com';
			$mail->SMTPAuth   = true;
			$mail->Username   = 'raindropmail1@gmail.com';
			$mail->Password   = 'scubastar123';
			$mail->SMTPSecure = 'tls';
			$mail->Port       = 587;
			$mail->CharSet    = 'UTF-8';

			$mail->setFrom('raindropmail1@gmail.com', 'Raindrop');

			foreach($addresses as $i => $email){
				$mail->addAddress($email);
			}


			$mail->isHTML(true);
			$mail->Subject = $subject;
			$mail->Body    = $body;


			$mail->send();

		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
}