<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include_once($rootpath . '/incs/conn.php');
include $rootpath . '/classes/Address.class.php';
include $rootpath . "/incs/check_login.php";

$Addr = new Address();
$Type = "";

if (isset($_GET['AddrID'])) {
    if (isset($_GET["action"]) && $_GET["action"] == "update") {
        $Type = $_POST["addrType"];
        $Addr->initialize($_GET['AddrID']);
        $Addr->setVar('AddrID', $_GET['AddrID']);
        $Addr->setVar('FName', $_POST['FName']);
        $Addr->setVar('LName', $_POST['LName']);
        $Addr->setVar('Addr1', $_POST['Addr1']);
        //if ($_POST["Addr2"] == "") {
        //  $Addr->setVar('Addr2', "NULL");
        //} else {
        $Addr->setVar('Addr2', $_POST['Addr2']);
        //}
        $Addr->setVar('City', $_POST['City']);
        $Addr->setVar('State', $_POST['State']);
        $Addr->setVar('Postal', $_POST['Postal']);
        $Addr->setVar('Country', $_POST['Country']);
        $Addr->setVar('DateUpdated', date('m/d/Y H:i:s'));
        if (isset($_POST["Phone"])) {
            if ($_POST["Phone"] == "") {
                $Addr->setVar('Phone', "NULL");
            } else {
                $Addr->setVar('Phone', $_POST['Phone']);
            }
        }

        $Addr->store();
        if ($Type == "Shp") {
            $redirect = "shipping.php";
        } else {
            $redirect = "billing.php";
        }
    } else {
        $Type = $_GET["AddrType"];
        $Addr->initialize($_GET['AddrID']);
        $Addr->setVar("AddrID", $_GET['AddrID']);
        $sql = "Update Address set DateUpdated=getDate() where AddrID=" . $_GET["AddrID"];
        $dbconn = database::getInstance();
        $dbconn->doQuery($sql);
        if (isset($_GET["action"]) && $_GET["action"] == "selAddr" && $Type == "Shp") {
            $redirect = "shipping.php";
        } else {
            $redirect = "billing.php";
        }
    }
} else {
    $Type = $_POST["addrType"];
    $Addr->initialize($_POST);
    $Addr->setVar("Type", $Type);
    if (isset($_POST["saveNewAddress"]) && $_POST["saveNewAddress"] == "on") {
        $Addr->setSaveAddrFlag(TRUE);
        if ($logedIn) {
            $Addr->setVar("UsrID", $_SESSION["UsrID"]);
            $Addr->store();
        }
    } else {
        $Addr->setSaveAddrFlag(FALSE);
    }
    if ($Type == "Shp") {
        $redirect = "billing.php";
    } else if ($Type == "Bil") {
        //redirection is set as a hidden field on the form that we submit.
        //We need to redirect to billing is AddressBook is loaded and summary if AddressFrom 
        $redirect = $_POST["post_redirection"];
    }
}

session_start();

if (isset($_SESSION["Cart"])) {
    $Cart = $_SESSION["Cart"];
    if ($Type == 'Shp') {
        $Cart->addShipAddr($Addr);
        if ($Addr->getVar("Country") == "US") {
            include $rootpath . '/tax/calculate_taxes.php';
        } else {
            $Cart->setTaxFlag(FALSE);
            $Cart->setTaxAmt(0);
            $Cart->setTaxInvoice("");
        }
    } else if ($Type == 'Bil') {
        $Cart->addBillAddr($Addr);
        $Cart->setPaymMethod("cc");
    }

    $_SESSION["Cart"] = $Cart;
}
header("Location: " . $redirect);
