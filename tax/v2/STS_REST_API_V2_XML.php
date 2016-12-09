<?php

//The sample code uses curl library and is tested on php-5.5.3-nts-Win32-VC11-x86.  This is for  sample purpose only.
//Please change $URL and  AccountId:Password below as required.
//Also change the ENTITY_ID placeholder in 'curl_init' in the individual methods below.

        class STS_REST_XML {
            //Base URL for all methods. Replace this with the Demo/Production URL.
            private $URL = 'https://service.myspeedtax.com/tx2/services/rest/'; 
			private $multiHeaders;

			function __construct() {
				//STS API uses base64 conversion of AccountID:Password.
				//Replace the AccountID and Password below.
				$base64EncodedString = base64_encode("STX-02244:Ve&@p57KW");

				//Authorization Headers for the API calls. 
				$this->multiHeaders = array(
					'Authorization: Basic ' . $base64EncodedString,
					'Content-Type: application/xml',
					'Accept:application/xml'
                );  
			}
            
			//This function calls ping method.
            public function ping() { 
                //Attach ping to the base url.
				
                $curl = curl_init($this->URL.'ping');
                
				//Attach the header.
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                
				//Make the call and then close the connection.
                $response = curl_exec($curl);
				
                curl_close($curl);
				echo $response;
				exit;
				
            } 
        
            //This function calls version method.
            public function version() { 
                //Attach version to the base url.
                $curl = curl_init($this->URL.'version');
                
				//Attach the header.               
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                
				//Make the call and then close the connection.
                $response = curl_exec($curl);
                curl_close($curl);
            }
            
			//This function calls resolveAddress.
            public function resolveAddress() {
                //Resolve the address '25201 Alicia Pkwy  Laguna Hills, CA 92653'. 
				//Use %20 for spaces in the query string.
                $address = 'address?State=CA&Zip=92653&Address1=25201%20Alicia%20Pkwy&City=Laguna%20Hills';
                $curl = curl_init($this->URL.$address);
                
				//Attach the header
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                
				//Make the call and then close the connection
                $response = curl_exec($curl);
                curl_close($curl);
            }
			
			//This function calls calculateInvoice.
            public function calculateInvoice() {
				//Build calcuate invoice xml.
                $xml = '<Invoice xmlns="http://speedtax.com/transaction">
						<InvoiceNumber>Sample Invoice 41</InvoiceNumber>
						<InvoiceDate>2013-11-13T00:00:00</InvoiceDate>
						<InvoiceType>INVOICE</InvoiceType>
						<ShipFromAddress>
							<Address1>3069 Hoffman Hill Blvd Ste 110</Address1>
							<City>Dupont</City>
							<State>WA</State>
							<Zip>98327</Zip>
							<Country>US</Country>
						</ShipFromAddress>
						<ShipToAddress>
							<Address1>5145 Centennial Blvd Ste 102</Address1>
							<City>Colorado Springs</City>
							<State>CO</State>
							<Zip>80919</Zip>
							<Country>US</Country>
						</ShipToAddress>
						<LineItems>
							<LineItem>
								<LineItemNumber>0</LineItemNumber>
								<ProductCode>TestCode1</ProductCode>
								<Quantity>1</Quantity>
								<UnitPrice>
									<DecimalValue>20.99</DecimalValue>
								</UnitPrice>
								<SalesAmount>
								  <Cents>99</Cents>
								  <Dollars>20</Dollars>
								  <Negative>false</Negative>
								</SalesAmount>
							</LineItem>
							<LineItem>
								<LineItemNumber>1</LineItemNumber>
								<ProductCode>TestCode2</ProductCode>
								<Quantity>5</Quantity>
								<UnitPrice>
									  <DecimalValue>1.99</DecimalValue>
								</UnitPrice>
								<SalesAmount>
									  <Cents>20</Cents>
									  <Dollars>80</Dollars>
									  <Negative>false</Negative>
								</SalesAmount>
							</LineItem>
						</LineItems>
					</Invoice>';
             
				//Replace ENTITY_ID placeholder with your actual entity id below. 
                $curl = curl_init($this->URL.'entity/STX-02199-00/invoice/calculate');
                
				//Set other options for the call.
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

				//Make the call and then close the connection.
                $response = curl_exec($curl);
                print "\n\nCalculate Invoice Response::\n".$response;
                curl_close($curl);
            }

			//This function calls queryInvoice.
			public function queryInvoice() {
				//Query the invoice number 'Sample Invoice 40'. 
				//Use %20 for spaces in the query string.
				//Replace ENTITY_ID placeholder with your actual entity id below. 
                $curl = curl_init($this->URL.'entity/STX-02199-00/invoice/query?InvoiceNumber=Sample%20Invoice%2041');
                
				//Attach the header
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                
				//Make the call and then close the connection
                $response = curl_exec($curl);
                curl_close($curl);
            }


			//This function calls postInvoice.
			public function postInvoice() {
				//Build post invoice xml.
                $xml = '<Invoice xmlns="http://speedtax.com/transaction">
						<InvoiceNumber>Sample Invoice 41</InvoiceNumber>
						<InvoiceDate>2013-11-13T00:00:00</InvoiceDate>
						<InvoiceType>INVOICE</InvoiceType>
						<ShipFromAddress>
							<Address1>3069 Hoffman Hill Blvd Ste 110</Address1>
							<City>Dupont</City>
							<State>WA</State>
							<Zip>98327</Zip>
							<Country>US</Country>
						</ShipFromAddress>
						<ShipToAddress>
							<Address1>5145 Centennial Blvd Ste 102</Address1>
							<City>Colorado Springs</City>
							<State>CO</State>
							<Zip>80919</Zip>
							<Country>US</Country>
						</ShipToAddress>
						<LineItems>
							<LineItem>
								<LineItemNumber>0</LineItemNumber>
								<ProductCode>TestCode1</ProductCode>
								<Quantity>1</Quantity>
								<UnitPrice>
									<DecimalValue>20.99</DecimalValue>
								</UnitPrice>
								<SalesAmount>
								  <Cents>99</Cents>
								  <Dollars>20</Dollars>
								  <Negative>false</Negative>
								</SalesAmount>
							</LineItem>
							<LineItem>
								<LineItemNumber>1</LineItemNumber>
								<ProductCode>TestCode2</ProductCode>
								<Quantity>5</Quantity>
								<UnitPrice>
									  <DecimalValue>1.99</DecimalValue>
								</UnitPrice>
								<SalesAmount>
									  <Cents>20</Cents>
									  <Dollars>80</Dollars>
									  <Negative>false</Negative>
								</SalesAmount>
							</LineItem>
						</LineItems>
					</Invoice>';
             
				//Replace ENTITY_ID placeholder with your actual entity id below.  
                $curl = curl_init($this->URL.'entity/STX-02199-00/invoice/post');
                
				//Set other options for the call.
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                
				//Make the call and then close the connection.
				$response = curl_exec($curl);
                print "\n\nPost Invoice Response::\n".$response;
                curl_close($curl);
            }

			//This function calls postInvoices.
			public function postInvoices() {
				//Post invoice numbers 'Sample Invoice 41' and 'Sample Invoice 42'
				//Build post invoices xml.
                $xml = '<PostInvoices xmlns="http://speedtax.com/transaction">
						 <InvoiceNumbers>
						  <InvoiceNumber>Sample Invoice 41</InvoiceNumber>
						  <InvoiceNumber>Sample Invoice 42</InvoiceNumber>
						 </InvoiceNumbers>
						</PostInvoices>';
             
				//Replace ENTITY_ID placeholder with your actual entity id below.  
                $curl = curl_init($this->URL.'entity/STX-02199-00/invoice/postInvoices');
                
				//Set other options for the call.
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                
				//Make the call and then close the connection.
				$response = curl_exec($curl);
                print "\n\nPost Invoices Response::\n".$response;
                curl_close($curl);
            }

			//This function calls voidInvoice.
			public function voidInvoice() {
				//Void the invoice number 'Sample Invoice 40'. 
				//Use %20 for spaces.
				//Replace ENTITY_ID placeholder with your actual entity id below. 
                $curl = curl_init($this->URL.'entity/STX-02199-00/invoice/void?InvoiceNumber=Sample%20Invoice%2041');
				$params='';
                
				//Set other options for the call.
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                
				//Make the call and then close the connection
                $response = curl_exec($curl);
				print "\n\nVoid Invoice Response::\n".$response;
                curl_close($curl);
            }

			//This function calls createLocationFromAddress.
			public function createLocationFromAddress() {
				//Create location from the address '25201 Alicia Pkwy  Laguna Hills, CA 92653, USA'. 
				//Use %20 for spaces.
				//Replace ENTITY_ID placeholder with your actual entity id below. 
				$curl = curl_init($this->URL.'entity/STX-02199-00/createLocationFromAddress?State=CA&Zip=92653&Country=US&Address1=25201%20Alicia%20Pkwy&City=Laguna%20Hills');
				$xml='<MinimumConfidence xmlns="http://speedtax.com/transaction">STATE</MinimumConfidence>';
                
				//Set other options for the call.
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                
				//Make the call and then close the connection
                $response = curl_exec($curl);
				print "\n\nCreate Location From Address Response::\n".$response;
                curl_close($curl);
            }


			//This function calls getAddressFromLocation.
			public function getAddressFromLocation() {
				//Get the address for lcoation reference '012345678912345'. 
				//Use %20 for spaces.
				//Replace ENTITY_ID placeholder with your actual entity id below. 
                $curl = curl_init($this->URL.'entity/STX-02199-00/getAddressFromLocation?LocationReference=012345678912345');
                
				//Attach the header
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                
				//Make the call and then close the connection
                $response = curl_exec($curl);
                curl_close($curl);
            }

			//This function calls createcustomer.
			public function createCustomer() {
				//Build create customer xml.
                $xml = '<Customer xmlns="http://speedtax.com/transaction">
							<CustomerReference>Sample Customer 41</CustomerReference>
							<Name>Test Test</Name>
							<TaxNumber>1234567</TaxNumber>
						</Customer>';
             
				//Replace ENTITY_ID placeholder with your actual entity id below. 
                $curl = curl_init($this->URL.'entity/STX-02199-00/customer/create');
                
				//Set other options for the call.
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                
				//Make the call and then close the connection
                $response = curl_exec($curl);
				print "\n\nCreate Customer Response::\n".$response;
                curl_close($curl);
            }

			//This function calls editcustomer.
			public function editCustomer() {
				//Build edit customer xml.
                $xml = '<Customer xmlns="http://speedtax.com/transaction">
							<CustomerReference>Sample Customer 41</CustomerReference>
							<Name>Test Test Test</Name>
							<TaxNumber>1234567</TaxNumber>
						</Customer>';
             
				//Replace ENTITY_ID placeholder with your actual entity id below. 
                $curl = curl_init($this->URL.'entity/STX-02199-00/customer/edit');
                
				//Set other options for the call.
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                
				//Make the call and then close the connection
                $response = curl_exec($curl);
				print "\n\nEdit Customer Response::\n".$response;
                curl_close($curl);
            }

			//This function calls createExemption.
			public function createExemption() {
				//Build create exemption xml.
                $xml = '<Exemption xmlns="http://speedtax.com/transaction">
						   <CustomerReference>Sample Customer 41</CustomerReference>
						   <ExemptionReference>Sample Exemption 41</ExemptionReference>
						   <StartDate>2014-01-13T00:00:00</StartDate>
						   <EndDate>2015-01-13T00:00:00</EndDate>
						   <ExemptedStateCodes>
							  <StateCode>CA</StateCode>
							  <StateCode>CO</StateCode>
						   </ExemptedStateCodes>
						   <ExemptionRate>0.5</ExemptionRate>
						   <SKUCode>genMerch</SKUCode>
						   <BusinessType>Construction</BusinessType>
						   <ExemptionReason>other</ExemptionReason>
						</Exemption>';
             
				//Replace ENTITY_ID placeholder with your actual entity id below. 
                $curl = curl_init($this->URL.'entity/STX-02199-00/exemption/create');
                
				//Set other options for the call.
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                
				//Make the call and then close the connection
                $response = curl_exec($curl);
				print "\n\nCreate Exemption Response::\n".$response;
                curl_close($curl);
            }

			//This function calls editExemption.
			public function editExemption() {
				//Build edit exemption xml.
                $xml = '<Exemption xmlns="http://speedtax.com/transaction">
						   <CustomerReference>Sample Customer 41</CustomerReference>
						   <ExemptionReference>Sample Exemption 41</ExemptionReference>
						   <StartDate>2016-01-13T00:00:00</StartDate>
						   <EndDate>2017-01-13T00:00:00</EndDate>
						   <ExemptedStateCodes>
							  <StateCode>CA</StateCode>
							  <StateCode>CO</StateCode>
						   </ExemptedStateCodes>
						   <ExemptionRate>0.5</ExemptionRate>
						   <SKUCode>genMerch</SKUCode>
						   <BusinessType>Construction</BusinessType>
						   <ExemptionReason>other</ExemptionReason>
						</Exemption>';
             
				//Replace ENTITY_ID placeholder with your actual entity id below. 
                $curl = curl_init($this->URL.'entity/STX-02199-00/exemption/edit');
                
				//Set other options for the call.
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                
				//Make the call and then close the connection
                $response = curl_exec($curl);
				print "\n\nEdit Exemption Response::\n".$response;
                curl_close($curl);
            }

			//This function calls queryExemption.
			public function queryExemption() {
				//Query the exemption number 'Sample Exemption 40' and customer 'Sample Customer 40'. 
				//Replace ENTITY_ID placeholder with your actual entity id below. 
                $curl = curl_init($this->URL.'entity/STX-02199-00/exemption/query?ExemptionReference=Sample%20Exemption%2041&CustomerReference=Sample%20Customer%2041');
                
				//Attach the header
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                
				//Make the call and then close the connection
                $response = curl_exec($curl);
                curl_close($curl);
            }

			//This function calls getCCHProductCodes.
			public function getCCHProductCodes() {
                $curl = curl_init($this->URL.'entity/productMapping/getCCHProductCodes');
                
				//Attach the header
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                
				//Make the call and then close the connection
                $response = curl_exec($curl);
                curl_close($curl);
            }

			//This function calls getCustomProductCodes.
			public function getCustomProductCodes() {
				//Replace ENTITY_ID placeholder with your actual entity id below. 
                $curl = curl_init($this->URL.'entity/STX-02199-00/productMapping/getCustomProductCodes');
                
				//Attach the header
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);

				//Make the call and then close the connection
                $response = curl_exec($curl);
                curl_close($curl);
            }

			//This function calls mapSKU.
			public function mapSKU() {
				//Build map SKU xml.
                $xml = '<SKUMapping xmlns="http://speedtax.com/transaction">
						   <ClientSKU>Sample Client SKU</ClientSKU>
						   <CCHProductCode>90002199000000000019</CCHProductCode>
						   <Description>Sample Mapping 41</Description>
						   <StartDate>2014-08-29T00:00:00</StartDate>
						   <EndDate>2015-08-30T00:00:00</EndDate>
						</SKUMapping>';

				//Replace ENTITY_ID placeholder with your actual entity id below. 
                $curl = curl_init($this->URL.'entity/STX-02199-00/productMapping/create');
                
				//Set other options for the call.
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                
				//Make the call and then close the connection
                $response = curl_exec($curl);
				print "\n\nMap SKU Response::\n".$response;
                curl_close($curl);
            }

			//This function calls editSKU.
			public function editSKU() {
				//Build edit SKU xml.
                $xml = '<SKUMapping xmlns="http://speedtax.com/transaction">
						   <ClientSKU>Sample Client SKU</ClientSKU>
						   <CCHProductCode>90002199000000000019</CCHProductCode>
						   <Description>Sample Mapping 42</Description>
						   <StartDate>2014-08-29T00:00:00</StartDate>
						   <EndDate>2015-08-30T00:00:00</EndDate>
						</SKUMapping>';

				//Replace ENTITY_ID placeholder with your actual entity id below. 
                $curl = curl_init($this->URL.'entity/STX-02199-00/productMapping/edit');
                
				//Set other options for the call.
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                
				//Make the call and then close the connection
                $response = curl_exec($curl);
				print "\n\nEdit SKU Response::\n".$response;
                curl_close($curl);
            }
        }
        
		//Call the methods one by one
        $restapi = new STS_REST_XML();
               
        print "\n\nPING:: ";
        $restapi->ping();

		//print "\n\n--------------------------------------------------------------------------------------";
        /*
        print "\n\nVERSION:: ";
        $restapi->version();

		print "\n\n--------------------------------------------------------------------------------------";
        
        print "\n\nResolve Address Response::\n" ;
        $restapi->resolveAddress();

		print "\n\n--------------------------------------------------------------------------------------";
		
		$restapi->calculateInvoice();

		print "\n\n--------------------------------------------------------------------------------------";

		print "\n\nQuery Invoice Response::\n" ;
        $restapi->queryInvoice();

		print "\n\n--------------------------------------------------------------------------------------";

        $restapi->postInvoice();

		print "\n\n--------------------------------------------------------------------------------------";

        $restapi->postInvoices();

		print "\n\n--------------------------------------------------------------------------------------";

        $restapi->voidInvoice();

		print "\n\n--------------------------------------------------------------------------------------";

        $restapi->createLocationFromAddress();

		print "\n\n--------------------------------------------------------------------------------------";

		print "\n\nGet Address From Location Response::\n" ;
        $restapi->getAddressFromLocation();

		print "\n\n--------------------------------------------------------------------------------------";

		$restapi->createCustomer();

		print "\n\n--------------------------------------------------------------------------------------";

        $restapi->editCustomer();

		print "\n\n--------------------------------------------------------------------------------------";

        $restapi->createExemption();

		print "\n\n--------------------------------------------------------------------------------------";

        $restapi->editExemption();

		print "\n\n--------------------------------------------------------------------------------------";

		print "\n\nQuery Exemption Response::\n" ;
        $restapi->queryExemption();

		print "\n\n--------------------------------------------------------------------------------------";

		print "\n\nGet CCH Product Codes Response::\n" ;
        $restapi->getCCHProductCodes();

		print "\n\n--------------------------------------------------------------------------------------";

		print "\n\nGet Custom Product Codes Response::\n" ;
        $restapi->getCustomProductCodes();

		print "\n\n--------------------------------------------------------------------------------------";

        $restapi->mapSKU();

		print "\n\n--------------------------------------------------------------------------------------";

        $restapi->editSKU();*/
?>