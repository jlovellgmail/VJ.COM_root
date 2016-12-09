<?php

//The sample code uses curl library and is tested on php-5.5.3-nts-Win32-VC11-x86.  This is for  sample purpose only.
//Please change $URL, $headers below as required.
//Also change username, password and companyid in each xml request as required.

class STS_SOAP {

    //Base URL for all methods. Replace this with the Demo/Production URL.
    private $soapUrl = "https://service.myspeedtax.com/tx/services/STxTransactionService?wsdl";
    private $headers = array(
        "Content-type: text/xml;charset=\"utf-8\"",
        "Accept: text/xml",
        "Cache-Control: no-cache",
        "Pragma: no-cache"
    );

    public function sendSoapRequest(&$xml) {
        $this->headers['Content-length'] = strlen($xml);

        $ch = curl_init($this->soapUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

}

//Call the methods one by one
$soapapi = new STS_SOAP();

$pingRequestXml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
		xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
		xmlns:tran="http://speedtax.com/transaction">
		<soapenv:Header>
			<wsse:Security soapenv:mustUnderstand="1">
				<wsse:UsernameToken>
					<wsse:Username>testuser</wsse:Username>
					<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">password</wsse:Password>
				</wsse:UsernameToken>
			</wsse:Security>
		</soapenv:Header>
		<soapenv:Body>
			<tran:Ping/>
		</soapenv:Body>
	</soapenv:Envelope>';

print "\n\nPING::\n" . $soapapi->sendSoapRequest($pingRequestXml);

print "\n\n--------------------------------------------------------------------------------------";

$getVersionRequestXml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
		xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
		xmlns:tran="http://speedtax.com/transaction">
		<soapenv:Header>
			<wsse:Security soapenv:mustUnderstand="1">
				<wsse:UsernameToken>
					<wsse:Username>testuser</wsse:Username>
					<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">password</wsse:Password>
				</wsse:UsernameToken>
			</wsse:Security>
		</soapenv:Header>
		<soapenv:Body>
			<tran:GetVersion/>
		</soapenv:Body>
	</soapenv:Envelope>';

print "\n\nVERSION::\n" . $soapapi->sendSoapRequest($getVersionRequestXml);

print "\n\n--------------------------------------------------------------------------------------";

$resolveAddressRequestXml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"  xmlns:tran="http://speedtax.com/transaction">
		<soapenv:Header>
			  <wsse:Security soapenv:mustUnderstand="1">
					 <wsse:UsernameToken>
						<wsse:Username>STX-02199</wsse:Username>
						<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">password</wsse:Password>
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

print "\n\nResolve Address Response::\n" . $soapapi->sendSoapRequest($resolveAddressRequestXml);

print "\n\n--------------------------------------------------------------------------------------";

$calculateInvoiceRequestXml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"  xmlns:tran="http://speedtax.com/transaction">
		<soapenv:Header>
			  <wsse:Security soapenv:mustUnderstand="1">
					 <wsse:UsernameToken>
						<wsse:Username>STX-02199</wsse:Username>
						<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">password</wsse:Password>
					 </wsse:UsernameToken>
			  </wsse:Security>
		</soapenv:Header>
		<soapenv:Body>
			<tran:CalculateInvoice>
				<tran:CalculateInvoiceRequest>
					<tran:EntityID>STX-02199-00</tran:EntityID>
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

print "\n\n--------------------------------------------------------------------------------------";

$queryInvoiceRequestXml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"  xmlns:tran="http://speedtax.com/transaction">
		<soapenv:Header>
			  <wsse:Security soapenv:mustUnderstand="1">
					 <wsse:UsernameToken>
						<wsse:Username>STX-02199</wsse:Username>
						<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">password</wsse:Password>
					 </wsse:UsernameToken>
			  </wsse:Security>
		</soapenv:Header>
		<soapenv:Body>
			<tran:QueryInvoice>
				<tran:QueryInvoiceRequest>
					<tran:EntityID>STX-02199-00</tran:EntityID>
					<tran:InvoiceNumber>Sample Invoice 30</tran:InvoiceNumber>
				</tran:QueryInvoiceRequest>
			</tran:QueryInvoice>
		</soapenv:Body>
	</soapenv:Envelope>';

print "\n\nQuery Invoice Response::\n" . $soapapi->sendSoapRequest($queryInvoiceRequestXml);

print "\n\n--------------------------------------------------------------------------------------";

$postInvoiceRequestXml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"  xmlns:tran="http://speedtax.com/transaction">
		<soapenv:Header>
			  <wsse:Security soapenv:mustUnderstand="1">
					 <wsse:UsernameToken>
						<wsse:Username>STX-02199</wsse:Username>
						<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">password</wsse:Password>
					 </wsse:UsernameToken>
			  </wsse:Security>
		</soapenv:Header>
		<soapenv:Body>
		  <tran:PostInvoice>
				<tran:PostInvoiceRequest>
					<tran:EntityID>STX-02199-00</tran:EntityID>
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
				</tran:PostInvoiceRequest>
			</tran:PostInvoice>
		</soapenv:Body>
	</soapenv:Envelope>';

print "\n\nPost Invoice Response::\n" . $soapapi->sendSoapRequest($postInvoiceRequestXml);

print "\n\n--------------------------------------------------------------------------------------";

$postInvoicesRequestXml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"  xmlns:tran="http://speedtax.com/transaction">
		<soapenv:Header>
			  <wsse:Security soapenv:mustUnderstand="1">
					 <wsse:UsernameToken>
						<wsse:Username>STX-02199</wsse:Username>
						<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">password</wsse:Password>
					 </wsse:UsernameToken>
			  </wsse:Security>
		</soapenv:Header>
		<soapenv:Body>
			<tran:PostInvoices>
				<tran:PostInvoicesRequest>
					<tran:EntityID>STX-02199-00</tran:EntityID>
					<tran:InvoiceNumbers>
						<tran:InvoiceNumber>Sample Invoice 31</tran:InvoiceNumber>
						<tran:InvoiceNumber>Sample Invoice 32</tran:InvoiceNumber>
					</tran:InvoiceNumbers>
				</tran:PostInvoicesRequest>
			</tran:PostInvoices>
		</soapenv:Body>
	</soapenv:Envelope>';

print "\n\nPost Invoices Response::\n" . $soapapi->sendSoapRequest($postInvoicesRequestXml);

print "\n\n--------------------------------------------------------------------------------------";

$voidInvoiceRequestXml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"  xmlns:tran="http://speedtax.com/transaction">
		<soapenv:Header>
			  <wsse:Security soapenv:mustUnderstand="1">
					 <wsse:UsernameToken>
						<wsse:Username>STX-02199</wsse:Username>
						<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">password</wsse:Password>
					 </wsse:UsernameToken>
			  </wsse:Security>
		</soapenv:Header>
		<soapenv:Body>
			<tran:VoidInvoice>
				<tran:VoidInvoiceRequest>
					<tran:EntityID>STX-02199-00</tran:EntityID>
					<tran:InvoiceNumber>Sample Invoice 30</tran:InvoiceNumber>
				</tran:VoidInvoiceRequest>
      </tran:VoidInvoice>
		</soapenv:Body>
	</soapenv:Envelope>';

print "\n\nVoid Invoice Response::\n" . $soapapi->sendSoapRequest($voidInvoiceRequestXml);

print "\n\n--------------------------------------------------------------------------------------";

$createLocationFromAddressRequestXml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"  xmlns:tran="http://speedtax.com/transaction">
		<soapenv:Header>
			  <wsse:Security soapenv:mustUnderstand="1">
					 <wsse:UsernameToken>
						<wsse:Username>STX-02199</wsse:Username>
						<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">password</wsse:Password>
					 </wsse:UsernameToken>
			  </wsse:Security>
		</soapenv:Header>
		<soapenv:Body>
			<tran:CreateLocationFromAddress>
				<tran:CreateLocationFromAddressRequest>
					<tran:EntityID>STX-02199-00</tran:EntityID>
					<tran:Address>
					   <tran:Address1>25201 Alicia Pkwy Ste 120</tran:Address1>
					   <tran:Address2>C/O John Adams</tran:Address2>
					   <tran:City>Laguna Hills</tran:City>
					   <tran:State>CA</tran:State>
					   <tran:Zip>92653</tran:Zip>
					   <tran:Country>US</tran:Country>
					</tran:Address>
					<tran:MinimumConfidence>STATE</tran:MinimumConfidence>
				</tran:CreateLocationFromAddressRequest>
			</tran:CreateLocationFromAddress>
		</soapenv:Body>
	</soapenv:Envelope>';

print "\n\nCreate Location From Address Response::\n" . $soapapi->sendSoapRequest($createLocationFromAddressRequestXml);

print "\n\n--------------------------------------------------------------------------------------";

$getAddressFromLocationRequestXml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"  xmlns:tran="http://speedtax.com/transaction">
		<soapenv:Header>
			  <wsse:Security soapenv:mustUnderstand="1">
					 <wsse:UsernameToken>
						<wsse:Username>STX-02199</wsse:Username>
						<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">password</wsse:Password>
					 </wsse:UsernameToken>
			  </wsse:Security>
		</soapenv:Header>
		<soapenv:Body>
			<tran:GetAddressFromLocation>
				<tran:GetAddressFromLocationRequest>
					<tran:EntityID>STX-02199-00</tran:EntityID>
					<tran:LocationReference>069265354894084</tran:LocationReference>
				</tran:GetAddressFromLocationRequest>
			</tran:GetAddressFromLocation>
		</soapenv:Body>
	</soapenv:Envelope>';

print "\n\nGet Address From Location Response::\n" . $soapapi->sendSoapRequest($getAddressFromLocationRequestXml);

print "\n\n--------------------------------------------------------------------------------------";

$createCustomerRequestXml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"  xmlns:tran="http://speedtax.com/transaction">
		<soapenv:Header>
			  <wsse:Security soapenv:mustUnderstand="1">
					 <wsse:UsernameToken>
						<wsse:Username>STX-02199</wsse:Username>
						<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">password</wsse:Password>
					 </wsse:UsernameToken>
			  </wsse:Security>
		</soapenv:Header>
		<soapenv:Body>
			<tran:CreateCustomer>
				<tran:CreateCustomerRequest>
					 <tran:EntityID>STX-02199-00</tran:EntityID>
					 <tran:Customer>
						<tran:CustomerReference>Sample Customer 30</tran:CustomerReference>
						<tran:Name>Test Test</tran:Name>
						<tran:TaxNumber>1234567</tran:TaxNumber>
					 </tran:Customer>
				 </tran:CreateCustomerRequest>
			 </tran:CreateCustomer>
		</soapenv:Body>
	</soapenv:Envelope>';

print "\n\nCreate Customer Response::\n" . $soapapi->sendSoapRequest($createCustomerRequestXml);

print "\n\n--------------------------------------------------------------------------------------";

$editCustomerRequestXml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"  xmlns:tran="http://speedtax.com/transaction">
		<soapenv:Header>
			  <wsse:Security soapenv:mustUnderstand="1">
					 <wsse:UsernameToken>
						<wsse:Username>STX-02199</wsse:Username>
						<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">password</wsse:Password>
					 </wsse:UsernameToken>
			  </wsse:Security>
		</soapenv:Header>
		<soapenv:Body>
			<tran:EditCustomer>
				<tran:EditCustomerRequest>
					 <tran:EntityID>STX-02199-00</tran:EntityID>
					 <tran:Customer>
						<tran:CustomerReference>Sample Customer 30</tran:CustomerReference>
						<tran:Name>Test Test</tran:Name>
						<tran:TaxNumber>1234567</tran:TaxNumber>
					 </tran:Customer>
				 </tran:EditCustomerRequest>
			 </tran:EditCustomer>
		</soapenv:Body>
	</soapenv:Envelope>';

print "\n\nEdit Customer Response::\n" . $soapapi->sendSoapRequest($editCustomerRequestXml);

print "\n\n--------------------------------------------------------------------------------------";

$createExemptionRequestXml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"  xmlns:tran="http://speedtax.com/transaction">
		<soapenv:Header>
			  <wsse:Security soapenv:mustUnderstand="1">
					 <wsse:UsernameToken>
						<wsse:Username>STX-02199</wsse:Username>
						<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">password</wsse:Password>
					 </wsse:UsernameToken>
			  </wsse:Security>
		</soapenv:Header>
		<soapenv:Body>
			<tran:CreateExemption>
				<tran:CreateExemptionRequest>
					<tran:EntityID>STX-02199-00</tran:EntityID>
					<tran:Exemption>
					   <tran:CustomerReference>Sample Customer 30</tran:CustomerReference>
					   <tran:ExemptionReference>Sample Exemption 30</tran:ExemptionReference>
					   <tran:StartDate>2014-01-13T00:00:00</tran:StartDate>
					   <tran:EndDate>2015-01-13T00:00:00</tran:EndDate>
					   <tran:ExemptedStateCodes>
						  <tran:StateCode>CA</tran:StateCode>
						  <tran:StateCode>CO</tran:StateCode>
					   </tran:ExemptedStateCodes>
					   <tran:ExemptionRate>0.5</tran:ExemptionRate>
					   <tran:SKUCode>genMerch</tran:SKUCode>
					   <tran:BusinessType>Construction</tran:BusinessType>
					   <tran:ExemptionReason>other</tran:ExemptionReason>
					</tran:Exemption>
				</tran:CreateExemptionRequest>
			</tran:CreateExemption>
		</soapenv:Body>
	</soapenv:Envelope>';

print "\n\nCreate Exemption Response::\n" . $soapapi->sendSoapRequest($createExemptionRequestXml);

print "\n\n--------------------------------------------------------------------------------------";

$editExemptionRequestXml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"  xmlns:tran="http://speedtax.com/transaction">
		<soapenv:Header>
			  <wsse:Security soapenv:mustUnderstand="1">
					 <wsse:UsernameToken>
						<wsse:Username>STX-02199</wsse:Username>
						<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">password</wsse:Password>
					 </wsse:UsernameToken>
			  </wsse:Security>
		</soapenv:Header>
		<soapenv:Body>
			<tran:EditExemption>
				<tran:EditExemptionRequest>
					<tran:EntityID>STX-02199-00</tran:EntityID>
					<tran:Exemption>
					   <tran:CustomerReference>Sample Customer 30</tran:CustomerReference>
					   <tran:ExemptionReference>Sample Exemption 30</tran:ExemptionReference>
					   <tran:StartDate>2014-01-13T00:00:00</tran:StartDate>
					   <tran:EndDate>2015-01-13T00:00:00</tran:EndDate>
					   <tran:ExemptedStateCodes>
						  <tran:StateCode>CA</tran:StateCode>
						  <tran:StateCode>WI</tran:StateCode>
					   </tran:ExemptedStateCodes>
					   <tran:ExemptionRate>0.5</tran:ExemptionRate>
					   <tran:SKUCode>genMerch</tran:SKUCode>
					   <tran:BusinessType>Construction</tran:BusinessType>
					   <tran:ExemptionReason>other</tran:ExemptionReason>
					</tran:Exemption>
				</tran:EditExemptionRequest>
			</tran:EditExemption>
		</soapenv:Body>
	</soapenv:Envelope>';

print "\n\nEdit Exemption Response::\n" . $soapapi->sendSoapRequest($editExemptionRequestXml);

print "\n\n--------------------------------------------------------------------------------------";

$queryExemptionRequestXml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"  xmlns:tran="http://speedtax.com/transaction">
		<soapenv:Header>
			  <wsse:Security soapenv:mustUnderstand="1">
					 <wsse:UsernameToken>
						<wsse:Username>STX-02199</wsse:Username>
						<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">password</wsse:Password>
					 </wsse:UsernameToken>
			  </wsse:Security>
		</soapenv:Header>
		<soapenv:Body>
			<tran:QueryExemption>
				<tran:QueryExemptionRequest>
					 <tran:EntityID>STX-02199-00</tran:EntityID>
					 <tran:CustomerReference>Sample Customer 30</tran:CustomerReference>
					 <tran:ExemptionReference>Sample Exemption 30</tran:ExemptionReference>
				</tran:QueryExemptionRequest>
			</tran:QueryExemption>
		</soapenv:Body>
	</soapenv:Envelope>';

print "\n\nQuery Exemption Response::\n" . $soapapi->sendSoapRequest($queryExemptionRequestXml);

print "\n\n--------------------------------------------------------------------------------------";

$getCCHProductCodesRequestXml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"  xmlns:tran="http://speedtax.com/transaction">
		<soapenv:Header>
			  <wsse:Security soapenv:mustUnderstand="1">
					 <wsse:UsernameToken>
						<wsse:Username>STX-02199</wsse:Username>
						<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">password</wsse:Password>
					 </wsse:UsernameToken>
			  </wsse:Security>
		</soapenv:Header>
		<soapenv:Body>
			<tran:GetCCHProductCodes/>
		</soapenv:Body>
	</soapenv:Envelope>';

print "\n\nGet CCH Product Codes Response::\n" . $soapapi->sendSoapRequest($getCCHProductCodesRequestXml);

print "\n\n--------------------------------------------------------------------------------------";

$getCustomProductCodesRequestXml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"  xmlns:tran="http://speedtax.com/transaction">
		<soapenv:Header>
			  <wsse:Security soapenv:mustUnderstand="1">
					 <wsse:UsernameToken>
						<wsse:Username>STX-02199</wsse:Username>
						<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">password</wsse:Password>
					 </wsse:UsernameToken>
			  </wsse:Security>
		</soapenv:Header>
		<soapenv:Body>
			<tran:GetCustomProductCodes>
				<tran:GetCustomProductsRequest>
					<tran:EntityID>STX-02199-00</tran:EntityID>
				</tran:GetCustomProductsRequest>
			</tran:GetCustomProductCodes>
		</soapenv:Body>
	</soapenv:Envelope>';

print "\n\nGet Custom Product Codes Response::\n" . $soapapi->sendSoapRequest($getCustomProductCodesRequestXml);

print "\n\n--------------------------------------------------------------------------------------";

$mapSKURequestXml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"  xmlns:tran="http://speedtax.com/transaction">
		<soapenv:Header>
			  <wsse:Security soapenv:mustUnderstand="1">
					 <wsse:UsernameToken>
						<wsse:Username>STX-02199</wsse:Username>
						<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">password</wsse:Password>
					 </wsse:UsernameToken>
			  </wsse:Security>
		</soapenv:Header>
		<soapenv:Body>
			<tran:MapSKU>
				<tran:MapSKURequest>
					<tran:EntityID>STX-02199-00</tran:EntityID>
					<tran:SKUMapping>
					   <tran:ClientSKU>Sample Client SKU</tran:ClientSKU>
					   <tran:CCHProductCode>90002199000000000019</tran:CCHProductCode>
					   <tran:Description>Sample Mapping</tran:Description>
					   <tran:StartDate>2014-08-29T00:00:00</tran:StartDate>
					   <tran:EndDate>2015-08-30T00:00:00</tran:EndDate>
					</tran:SKUMapping>
				</tran:MapSKURequest>
			</tran:MapSKU>
		</soapenv:Body>
	</soapenv:Envelope>';

print "\n\nMap SKU Response::\n" . $soapapi->sendSoapRequest($mapSKURequestXml);

print "\n\n--------------------------------------------------------------------------------------";

$editSKURequestXml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"  xmlns:tran="http://speedtax.com/transaction">
		<soapenv:Header>
			  <wsse:Security soapenv:mustUnderstand="1">
					 <wsse:UsernameToken>
						<wsse:Username>STX-02199</wsse:Username>
						<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">password</wsse:Password>
					 </wsse:UsernameToken>
			  </wsse:Security>
		</soapenv:Header>
		<soapenv:Body>
			<tran:EditSKU>
				<tran:EditSKURequest>
					<tran:EntityID>STX-02199-00</tran:EntityID>
					<tran:SKUMapping>
					   <tran:ClientSKU>Sample Client SKU</tran:ClientSKU>
					   <tran:CCHProductCode>90002199000000000019</tran:CCHProductCode>
					   <tran:Description>Sample Mapping</tran:Description>
					   <tran:StartDate>2014-09-29T00:00:00</tran:StartDate>
					   <tran:EndDate>2015-09-30T00:00:00</tran:EndDate>
					</tran:SKUMapping>
				</tran:EditSKURequest>
			</tran:EditSKU>
		</soapenv:Body>
	</soapenv:Envelope>';

print "\n\Edit SKU Response::\n" . $soapapi->sendSoapRequest($editSKURequestXml);
?>