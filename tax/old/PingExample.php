<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);
include_once 'SpeedTaxApi.inc';

try {
	
    // call the operation
	$stx = new SpeedTax();
	//echo $stx; 
	$response = $stx->Ping();
    //echo  "Response: " . $response->return . "\n";
	echo $response->return;

} catch (Exception $e) {
    // in case of an error, process the fault
    if ($e instanceof WSFault) {
        printf("Soap Fault: %s\n", $e->Reason);
    } else {
        printf("Message = %s\n", $e->getMessage());
    }
}

?>

