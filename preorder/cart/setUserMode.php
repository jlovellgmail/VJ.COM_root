<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/incs/conn.php';
include $rootpath . "/incs/check_login.php";

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_GET["mode"]) && $_GET["mode"]!=""){
    $mode = $_GET["mode"];
}else {
    $mode="";
}


if (isset($_SESSION["Cart"])) {
    $Cart = $_SESSION["Cart"];
    $Cart->setUsrMode($mode);
    $_SESSION["Cart"] = $Cart;
}
header("Location: shipping.php");