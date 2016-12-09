<?php

class STS_SOAP {

//Base URL for all methods. Replace this with the Demo/Production URL.
    private $soapUrl = "https://service.myspeedtax.com/tx2/services/STxTransactionService?wsdl";
    private $headers = array(
        "Content-type: text/xml;charset=\"utf-8\"",
        "Accept: text/xml",
        "Cache-Control: no-cache",
        "Pragma: no-cache"
    );

    public function sendSoapRequest($pingRequestXml) {
        $this->headers['Content-length'] = strlen($pingRequestXml);
        $ch = curl_init($this->soapUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $pingRequestXml);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

}

//Call the methods one by one
$soapapi = new STS_SOAP();
$pingRequestXml = '<?xml version="1.0" encoding="UTF-8"?> 
<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="http://speedtax.com/transaction" xmlns:ns2="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd" xmlns:ns3="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
<SOAP-ENV:Header><ns3:Security SOAP-ENV:mustUnderstand="1"><ns3:UsernameToken><ns3:Username>mitch@study.net</ns3:Username><ns3:Password>Ve&amp;@p57KW</ns3:Password><ns3:Nonce>wh66ztc4ZaCn2SFMpKDY/w==</ns3:Nonce></ns3:UsernameToken></ns3:Security>
</SOAP-ENV:Header>
<SOAP-ENV:Body>
<ns1:Ping/>
</SOAP-ENV:Body>
</SOAP-ENV:Envelope> ';
//print'ping : ' . $soapapi->sendSoapRequest($pingRequestXml);
$result = $soapapi->sendSoapRequest($pingRequestXml);
$xml =  simplexml_load_string($result);
$result = $xml->children('soap', true)->Body->children('ns1', true)->PingResponse->PingResult->PingResponse;
$finalRes = "";
foreach  ($result as $res){
    echo $res;
    $finalRes = $res;
}
if (ltrim(rtrim($finalRes))== "pong"){
    echo "YESSSSSSSSSSSSSSSSSSSSSS";
}

print "\n\n------------------------------------------------------------------------------";

$resolveAddressRequestXml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"  xmlns:tran="http://speedtax.com/transaction">
		<soapenv:Header>
			  <wsse:Security soapenv:mustUnderstand="1">
					 <wsse:UsernameToken>
						<wsse:Username>mitch@study.net</wsse:Username>
						<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">Ve&amp;@p57KW</wsse:Password>
					 </wsse:UsernameToken>
			  </wsse:Security>
		</soapenv:Header>
		<soapenv:Body>
			<tran:ResolveAddress>
				<tran:ResolveAddressRequest>
					<tran:Address1>25201 Alicia Pkwy, Suite 120</tran:Address1>
					<tran:Address2>Attn: John Adams</tran:Address2>
					<tran:City>Laguna Hills</tran:City>
					<tran:State>CA</tran:State>
					<tran:Zip>92653</tran:Zip>
					<tran:Country>US</tran:Country>
				</tran:ResolveAddressRequest>
			</tran:ResolveAddress>
		</soapenv:Body>
	</soapenv:Envelope>';

//print "\n\nResolve Address Response::\n" . $soapapi->sendSoapRequest($resolveAddressRequestXml);

$xml = simplexml_load_string($soapapi->sendSoapRequest($resolveAddressRequestXml));
$result = $xml->children('soap', true)->Body->children('ns1', true)->ResolveAddressResponse->ResolveAddressResult->ResultType;
foreach ($result as $res) {
    echo $res ;
}


//$soap     = simplexml_load_string($soapapi->sendSoapRequest($resolveAddressRequestXml));
//$response = $soap->children('http://schemas.xmlsoap.org/soap/envelope/')->Body->children()->ResolveAddressResponse;
//print_r((string)$response);
//exit();
//$customerId = (string) $response->ResolveAddressResult->ResultType;
//print "\n\nResolve Address Response::\n" . $customerId;
print "\n\n--------------------------------------------------------------------------------------";


$calculateInvoiceRequestXml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"  xmlns:tran="http://speedtax.com/transaction">
		<soapenv:Header>
			  <wsse:Security soapenv:mustUnderstand="1">
					 <wsse:UsernameToken>
						<wsse:Username>mitch@study.net</wsse:Username>
						<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">Ve&amp;@p57KW</wsse:Password>
					 </wsse:UsernameToken>
			  </wsse:Security>
		</soapenv:Header>
		<soapenv:Body>
			<tran:CalculateInvoice>
				<tran:CalculateInvoiceRequest>
					<tran:EntityID>STX-02244-01</tran:EntityID>
					<tran:Invoice>
						<tran:InvoiceNumber>Sample Invoice 30</tran:InvoiceNumber>
						<tran:InvoiceDate>2013-11-13T00:00:00</tran:InvoiceDate>
						<tran:InvoiceType>INVOICE</tran:InvoiceType>
						<tran:ShipFromAddress>
							<tran:Address1>3069 Hoffman Hill Blvd Ste 110</tran:Address1>
							<tran:City>Dupont</tran:City>
							<tran:State>WA</tran:State>
							<tran:Zip>98327</tran:Zip>
							<tran:Country>US</tran:Country>
						</tran:ShipFromAddress>
						<tran:ShipToAddress>
							<tran:Address1>5145 Centennial Blvd Ste 102</tran:Address1>
							<tran:City>Colorado Springs</tran:City>
							<tran:State>CO</tran:State>
							<tran:Zip>80919</tran:Zip>
							<tran:Country>US</tran:Country>
						</tran:ShipToAddress>
						<tran:LineItems>
							<tran:LineItem>
								<tran:LineItemNumber>0</tran:LineItemNumber>
								<tran:ProductCode>TestCode1</tran:ProductCode>
								<tran:Quantity>1</tran:Quantity>
								<tran:UnitPrice>
									<tran:DecimalValue>20.99</tran:DecimalValue>
								</tran:UnitPrice>
								<tran:SalesAmount>
								  <tran:Cents>99</tran:Cents>
								  <tran:Dollars>20</tran:Dollars>
								  <tran:Negative>false</tran:Negative>
								</tran:SalesAmount>
							</tran:LineItem>
							<tran:LineItem>
								<tran:LineItemNumber>1</tran:LineItemNumber>
								<tran:ProductCode>TestCode2</tran:ProductCode>
								<tran:Quantity>5</tran:Quantity>
								<tran:UnitPrice>
									  <tran:DecimalValue>1.99</tran:DecimalValue>
								</tran:UnitPrice>
								<tran:SalesAmount>
									  <tran:Cents>20</tran:Cents>
									  <tran:Dollars>80</tran:Dollars>
									  <tran:Negative>false</tran:Negative>
								</tran:SalesAmount>
							</tran:LineItem>
						</tran:LineItems>
					</tran:Invoice>
				</tran:CalculateInvoiceRequest>
			</tran:CalculateInvoice>
		</soapenv:Body>
	</soapenv:Envelope>';

print "\n\nCalculate Invoice Response::\n" . $soapapi->sendSoapRequest($calculateInvoiceRequestXml);

?>