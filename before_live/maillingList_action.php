
<?php
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	
	$to = "jay@virgiljames.com";
	$subject = "Virgil James Mailing list - Request";

	$email = $_POST["email"];
	
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: <" . $email . ">\r\n";
    
	$message = "Email: " . $email;
	mail($to, $subject, $message, $headers);
	
	echo "<p class='lh-1-5' style='font-size:14px;'><em>Welcome to Virgil James. We'll be in touch soon.</em></p>";
?>