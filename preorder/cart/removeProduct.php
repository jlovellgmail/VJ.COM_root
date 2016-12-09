<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/incs/conn.php';


$PID = $_GET["pid"];
$SCPID = $_GET["scpid"];
session_start();
if (isset($_SESSION["Cart"])) {
    $Cart = $_SESSION["Cart"];
    $Product = new Product();
    $Product->initialize($PID);
    $Product->setSCProdID($SCPID);
    $Cart->deleteItemFromCart($Product);
    $Cart->setTaxFlag(FALSE);
    $Cart->setTaxAmt(0);
    $_SESSION["Cart"] = $Cart;
}


header("Location: /cart/");
?>

