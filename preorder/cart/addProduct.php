<?php

//ini_set('display_errors', 1);
//error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
$rootpath = $_SERVER['DOCUMENT_ROOT'];

//include $rootpath . "/classes/Cart.class.php";
//include $rootpath . "/classes/Product.class.php";
include $rootpath . '/incs/conn.php';
include $rootpath . "/incs/check_login.php";

if (!isset($_SESSION)) {
    session_start();
}

$PID = $_GET["pid"];
$Qty = $_GET["qty"];

if ($Qty == "") {
    $Qty = 1;
}

if (isset($_SESSION["Cart"])) {
    $Cart = $_SESSION["Cart"];
} else {
    $Cart = new Cart();
    if ($logedIn) {
        //$Cart->initializeFromDB($_SESSION["UsrID"]);
        $Cart->initialize($_SESSION["UsrID"], session_id());
    } else {
        $Cart->initialize(0, session_id());
    }
}


$Product = new Product();
$Product->initialize($PID);

$Cart->addItemToCart($Product, $Qty);
$Cart->setTaxFlag(FALSE);
$Cart->setTaxAmt(0);

/* if ($logedIn) {
  $Cart->addItemToDB($Product, $Qty);
  } */

$_SESSION["Cart"] = $Cart;
//header("Location: /cart/");
?>

