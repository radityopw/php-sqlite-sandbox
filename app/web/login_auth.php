<?php

$is_auth = false;
$error_message = "Authentikasi Gagal";
 
if(isset($_POST)){
	$email = $_POST['email'];
	$passkey = $_POST['passkey'];
	
	$du = new DaftarUser();
	$session = $du->login($email,$passkey);
	if($session){
		setcookie("session", $session, time()+3600);
		setcookie("username", $email, time()+3600);
		$is_auth = true;
	}

}