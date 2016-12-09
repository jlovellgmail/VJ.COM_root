<?php


$rootpath = $_SERVER['DOCUMENT_ROOT'];
include_once($rootpath . '/incs/conn.php');
include $rootpath . '/classes/Address.class.php';
include $rootpath . "/incs/check_login.php";

session_start();
if (isset($_SESSION["Cart"])) {
    $Cart = $_SESSION["Cart"];
    if (isset($_POST["email"]) && $_POST["email"]!=""){
        $Cart->setEmail($_POST["email"]);
    }
    $_SESSION["Cart"] = $Cart;
}

?>
