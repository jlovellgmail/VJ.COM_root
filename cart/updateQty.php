<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . '/incs/conn.php';
include $rootpath . "/incs/check_login.php";

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["Cart"])) {
    $Cart = $_SESSION["Cart"];
    $InputArr = explode("&", $inputElement);
    foreach ($InputArr as $InpBox) {
        $PID = $_GET["pid"];
        $PQty = $_GET["qty"];
        $SCPID = $_GET["scpid"];
        $Product = new Product();
        $Product->initialize($PID);
        $Product->setSCProdID($SCPID);
        $Cart->updateItemToCart($Product, $PQty);
        $Cart->setTaxFlag(FALSE);
        $Cart->setTaxAmt(0);
    }


    $_SESSION["Cart"] = $Cart;
}
?>

