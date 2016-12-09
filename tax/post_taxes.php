<?php

include_once 'SpeedTaxApi.inc';
include_once 'SpeedTaxUtil.inc';

try {
    $InvoiceNr = $TaxInvoiceNo;
    $OD_ID = $OrdID;

    $invoiceNumbers[0] = $InvoiceNr;
    $stx = new SpeedTax();
    $result = $stx->PostInvoices($invoiceNumbers);

    switch ($result->PostBatchInvoicesResult->resultType) {
        case 'SUCCESS':
            //header("Location:https://" . $srv . "/shopcart/order_confirmation.asp?OID=" . $OD_ID . "&sec=" . $_GET["sec"] . "&from=" . $_GET["from"]);
            
            break;
        case 'FAILED_WITH_ERRORS':
            HandleErrors($OD_ID, "POSTING FAILED_WITH_ERRORS", $result->PostBatchInvoicesResult->errors);
            break;
        case 'FAILED_INVOICE_NUMBER':
            HandleErrors($OD_ID, "POSTING_FAILED_INVOICE_NUMBER", "The invoice number is incorrectly formatted = " . $InvoiceNr);
            break;
    }
} catch (Exception $e) {
    // in case of an error, process the fault
    if ($e instanceof WSFault) {
        //printf("Soap Fault: %s\n", $e->Reason);
        HandleErrors($OD_ID, "Post Soap Fault", $e->Reason);
    } else {
        // printf("Exception Message = %s\n", $e->getMessage());
        HandleErrors($OD_ID, "Post Exception Message", $e->getMessage());
    }
}

function HandleErrors($OD_ID, $ResultType, $Err) {
    //$Error_Update = mssql_query("Insert Into _Tax_Errors (OD_ID,Result_Type,Error) values(" . $OD_ID . ",'" . $ResultType . "','" . $Err . "')");
    $mailTo = "spolycarpou@study.net";
    $mailSubj = "SpeedTax Posting Error";
    $MailBody = "There was and error in posting the invoice to SpeedTax for Order ID=" . $OD_ID . "\n\n" . $Err;
    $headers = 'From: erros@study.net' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

    mail($mailTo, $mailSubj, $MailBody, $headers);
}
