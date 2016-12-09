<?php

$rootpath = $_SERVER['DOCUMENT_ROOT'];
include $rootpath . "/tax/STS_Tax.class.php";
include $rootpath . "/tax/generateXML.php";

$TaxObj = new STS_Tax();
if ($TaxObj->pingResult($TaxObj->sendSoapRequest($pingRequestXml))){
    echo "TRUE<br>";
}

//print_r($TaxObj->sendSoapRequest($resolveAddressRequestXml));

if ($TaxObj->addressResolved($TaxObj->sendSoapRequest($resolveAddressRequestXml))){
    echo "Addr TRUE";
}
