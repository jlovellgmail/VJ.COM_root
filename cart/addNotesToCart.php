<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include_once($rootpath . '/incs/conn.php');


session_start();
if (isset($_SESSION["Cart"])) {
    $Cart = $_SESSION["Cart"];
    if (isset($_POST["shipNote"]) && shipNote != "") {
        $Cart->addShipNotes($_POST["shipNote"]);
    }
    $_SESSION["Cart"] = $Cart;
}

