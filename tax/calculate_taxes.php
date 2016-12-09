<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
$rootpath = $_SERVER['DOCUMENT_ROOT'];

include_once 'SpeedTaxApi.inc';
include_once 'SpeedTaxUtil.inc';

if ($logedIn) {
    $Usr_ID = $_SESSION["UsrID"];
    $Usr_Name = $_SESSION["Name"];
} else {
    $Usr_ID = 0;
    $Usr_Name = "";
}

try {
    $stxPring = new SpeedTax();
    $response = $stxPring->Ping();
    //echo $response->return;
    $PingResult = $response->return;
} catch (Exception $e) {
    // in case of an error, process the fault
    $PingResult = "FALSE";
    // if ($e instanceof WSFault) {
    //   printf("Soap Fault: %s\n", $e->Reason);
    //} else {
    //  printf("Message = %s\n", $e->getMessage());
    //}
}

if (isset($PingResult) && $PingResult != "pong") {

    $TmpState = $Addr->getVar("State");
    if (isset($TmpState) && ltrim(rtrim($TmpState)) == "CA") {
        $Cart = $_SESSION["Cart"];
        $TmpTotal = $Cart->getTotalWithOutTax();
        $TmpTax = $TmpTotal * 0.075;
        $Cart->setTaxFlag(TRUE);
        $Cart->setTaxAmt(number_format($TmpTax, 2));
        $Cart->setTaxInvoice('0000000');
        $_SESSION["Cart"] = $Cart;

        header("Location: billing.php");
    } else {
        $Cart = $_SESSION["Cart"];
        $Cart->setTaxFlag(FALSE);
        $Cart->setTaxAmt(0);
        $Cart->setTaxInvoice("");
        $_SESSION["Cart"] = $Cart;
         header("Location: billing.php");
    }
}

try {
    $Invoice = new invoice();
    $stx = new SpeedTax();
    $Invoice->customerIdentifier = $Usr_ID;
    $Invoice->customerName = $Usr_Name;
    $t = explode(' ', microtime());
    $InvoiceNr = "INV" . $t[1];
    $Invoice->invoiceNumber = $InvoiceNr;
    // Date in the form YYYY-MM-DD
    $currDate = date("Y-m-d");

    $Invoice->invoiceDate = $currDate;
    $Invoice->invoiceType = INVOICE_TYPES::INVOICE;

    //Set the Ship From Address 
    $ShipFromAddress = new addressTax();
    $ShipFromAddress->address1 = '214 N. Cedros Av.';
    $ShipFromAddress->address2 = 'Solana Beach, CA 92075';

    $ShipToAddress = new addressTax();
    $ShipToAddress->address1 = $Addr->getVar("Addr1") . " " . $Addr->getVar("Addr2");
    $ShipToAddress->address2 = $Addr->getVar("City") . ", " . $Addr->getVar("State") . " " . $Addr->getVar("Postal");
    $AddrRes = $stx->ResolveAddress($ShipToAddress);
    $AddrValResult = $AddrRes->ResolveAddressResult->resultType;

    //Set the price according to Shopping Cart. 
    $Price = new price();


    $lnItmCounter = 0;
    foreach ($Cart as $productArr) {
        $product = $productArr["item"];
        $prodQty = $productArr["qty"];
        ${"LineItem" . $lnItmCounter} = new lineItem();
        ${"LineItem" . $lnItmCounter}->lineItemNumber = $product->getPID();
        ${"LineItem" . $lnItmCounter}->productCode = "101";
        ${"LineItem" . $lnItmCounter}->customReference = $product->getProductName();
        ${"LineItem" . $lnItmCounter}->quantity = $prodQty;
        ${"Price" . $lnItmCounter} = new price();
        ${"Price" . $lnItmCounter}->decimalValue = $product->getVar("Price");
        ${"LineItem" . $lnItmCounter}->salesAmount = ${"Price" . $lnItmCounter};
        ${"LineItem" . $lnItmCounter}->shipFromAddress = $ShipFromAddress;
        if ($AddrValResult != "UNRESOLVED") {
            ${"LineItem" . $lnItmCounter}->shipToAddress = $ShipToAddress;
        } else {
            // Action for unresolved shipping address
            $Cart = $_SESSION["Cart"];
            $Cart->setTaxFlag(FALSE);
            $Cart->setTaxAmt(0);
            $Cart->setTaxInvoice("");
            $_SESSION["Cart"] = $Cart;
            header("Location: billing.php");
        }

        $Invoice->lineItems[$lnItmCounter] = ${"LineItem" . $lnItmCounter};
        $lnItmCounter = $lnItmCounter + 1;
    }
   /* ${"LineItem" . $lnItmCounter} = new lineItem();
    ${"LineItem" . $lnItmCounter}->lineItemNumber = 111111;
    ${"LineItem" . $lnItmCounter}->productCode = "103";
    ${"LineItem" . $lnItmCounter}->customReference = "Handling";
    ${"LineItem" . $lnItmCounter}->quantity = 1;
    ${"Price" . $lnItmCounter} = new price();
    ${"Price" . $lnItmCounter}->decimalValue = "50.00";
    ${"LineItem" . $lnItmCounter}->salesAmount = ${"Price" . $lnItmCounter};
    ${"LineItem" . $lnItmCounter}->shipFromAddress = $ShipFromAddress;
    ${"LineItem" . $lnItmCounter}->shipToAddress = $ShipToAddress;
    $Invoice->lineItems[$lnItmCounter] = ${"LineItem" . $lnItmCounter};*/


    $InvoiceResult = $stx->CalculateInvoice($Invoice);
    //print_r($InvoiceResult);
    //exit();
    switch ($InvoiceResult->CalculateInvoiceResult->resultType) {
        case 'SUCCESS':
            print "SUCCESS.<br>";
            HandleInvoiceCalcResults($InvoiceResult->CalculateInvoiceResult, $InvoiceNr);
            break;
        case 'FAILED_WITH_ERRORS':
            HandleErrors($SC_ID, "FAILED_WITH_ERRORS", "Invoice Number=" . $InvoiceNr);
            break;
        case 'FAILED_INVOICE_NUMBER':
            HandleErrors($SC_ID, "FAILED_INVOICE_NUMBER", "Error with Incoice NO = " . $InvoiceNr);
            break;
        default:
            HandleErrors($SC_ID, $InvoiceResult->CalculateInvoiceResult->resultType, "");
            break;
    }
    header("Location: billing.php");
} catch (Exception $ex) {
    if ($e instanceof WSFault) {
        //printf("Soap Fault: %s\n", $e->Reason);
        //HandleErrors($SC_ID,"Soap Fault",$e->Reason);
        //header("Location:https://" . $srv . "/shopcart/order_review.asp?sec=" .$_GET["sec"]."&from=".$_GET["from"]."&shipFlag=".$_GET["shipFlag"]."&processing=".$_GET["paym"]."&calcTax=true&Inv_No=0");
    } else {
        // printf("Exception Message = %s\n", $e->getMessage());
        //HandleErrors($SC_ID,"Exception Message",$e->getMessage());
        //header("Location:https://" . $srv . "/shopcart/order_review.asp?sec=" .$_GET["sec"]."&from=".$_GET["from"]."&shipFlag=".$_GET["shipFlag"]."&processing=".$_GET["paym"]."&calcTax=true&Inv_No=0");
    }
}

function HandleInvoiceCalcResults($result, $InvoiceNr) {

    foreach ($result as $name => $value) {
        switch ($name) {
            case 'totalTax':
                //print "Total Tax.........: $" . number_format($value->decimalValue, 2) . "\n";
                $Cart = $_SESSION["Cart"];
                $Cart->setTaxFlag(TRUE);
                $Cart->setTaxAmt(number_format($value->decimalValue, 2));
                $Cart->setTaxInvoice($InvoiceNr);
                $_SESSION["Cart"] = $Cart;
                break;
        }
    }
}

function HandleErrors($SC_ID, $ResultType, $Error) {
    $Cart = $_SESSION["Cart"];
    $Cart->setTaxFlag(FALSE);
    $Cart->setTaxAmt(0);
    $Cart->setTaxInvoice("");
    $_SESSION["Cart"] = $Cart;
    //$Error_Update = mssql_query("Insert Into _Tax_Errors (SC_ID,Result_Type,Error) values(" . $SC_ID . ",'" . $ResultType . "','" . $Error . "')");
    $mailTo = "spolycarpou@study.net";
    $mailSubj = "VirgilJames SpeedTax Calculate Error";
    $MailBody = "There was and error in retrieving tax for Shopping Cart=>\r\n" . print_r($Cart);
    $headers = 'From: erros@study.net' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
    mail($mailTo, $mailSubj, $MailBody, $headers);
}
