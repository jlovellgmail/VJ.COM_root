<?php

ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
$rootpath = $_SERVER['DOCUMENT_ROOT'];
include_once($rootpath . '/incs/conn.php');
include $rootpath . '/classes/CreditCard.class.php';

$CreditCard = new CreditCard();

$CreditCard->initialize($_POST);


//print_r($_POST);
session_start();
if (isset($_SESSION["Cart"])) {
    $Cart = $_SESSION["Cart"];
    $Cart->addCreditCard($CreditCard);
    $Cart->setPaymMethod("cc");
    $_SESSION["Cart"] = $Cart;
}

//header("Location: payment.php");
