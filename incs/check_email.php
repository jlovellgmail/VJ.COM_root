<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
$rootpath = $_SERVER['DOCUMENT_ROOT'];
include_once($rootpath.'/incs/conn.php');
require_once $rootpath . "/classes/Cart.class.php";

$emailPost = $_POST["email"];
$emailValid = filter_var($emailPost, FILTER_VALIDATE_EMAIL);
if (!isset($_SESSION)) {
    session_start();
}


if (!$emailValid) {
    echo "Invalid Email";
    exit();
}

if (isset($_SESSION["Cart"])) {
    $Cart = $_SESSION["Cart"];
    if ($Cart->count() > 0) {
        $Cart->setEmail($emailPost);
    }
    $_SESSION["Cart"] = $Cart;
}

$sql = "SELECT UsrID, DelFlag from Users WHERE Email = :email";
$param = array(":email" => $emailPost);
$dbconn = database::getInstance();

$dbconn->doQueryParam($sql, $param);
$UsrInfo = $dbconn->loadObjectList();
$num_rows = $dbconn->getRows();

if ($num_rows >0 ){
	if ($UsrInfo[0]["DelFlag"] == "1")
	{
		echo "Account deleted";
	}
	else
	{
    	echo "Email Exist";
	}
    exit();
}else {
    
}
?>