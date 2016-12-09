<?php

//The sample code uses curl library and is tested on php-5.5.3-nts-Win32-VC11-x86.  This is for  sample purpose only.
//Please change $URL and  AccountId:Password below as required.
//Also change the ENTITY_ID placeholder in 'curl_init' in the individual methods below.

        class STS_REST_JSON {
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
					'Content-Type: application/json',
					'Accept:application/json'
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
				//Use %20 for spaces.
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
				//Build calcuate invoice json.
                $jsonString = '{
				  "Invoice": {
					"InvoiceNumber": "Sample Invoice 45",
					"InvoiceDate": "2013-11-13T00:00:00",
					"InvoiceType": "INVOICE",
					"ShipFromAddress": {
					  "Address1": "3069 Hoffman Hill Blvd Ste 110",
					  "City": "Dupont",
					  "State": "WA",
					  "Zip": "98327",
					  "Country": "US"
					},
					"ShipToAddress": {
					  "Address1": "5145 Centennial Blvd Ste 102",
					  "City": "Colorado Springs",
					  "State": "CO",
					  "Zip": "80919",
					  "Country": "US"
					},
					"LineItems": {
					  "LineItem": [
						{
						  "LineItemNumber": "0",
						  "ProductCode": "TestCode1",
						  "Quantity": "1",
						  "UnitPrice": { "DecimalValue": "20.99" },
						  "SalesAmount": {
							"Cents": "99",
							"Dollars": "20",
							"Negative": "false"
						  }
						},
						{
						  "LineItemNumber": "1",
						  "ProductCode": "TestCode2",
						  "Quantity": "5",
						  "UnitPrice": { "DecimalValue": "1.99" },
						  "SalesAmount": {
							"Cents": "20",
							"Dollars": "80",
							"Negative": "false"
						  }
						}
					  ]
					}
				  }
				}';
             
				//Replace ENTITY_ID placeholder with your actual entity id below.
                $curl = curl_init($this->URL.'entity/STX-02199-00/invoice/calculate');
                
				//Set other options for the call.
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonString);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

				//Make the call and then close the connection.
                $response = curl_exec($curl);
                print "\n\nCalculate Invoice Response::\n".$response;
                curl_close($curl);
            }

			//This function calls queryInvoice.
			public function queryInvoice() {
				//Query the invoice number 'Sample Invoice 1'. 
				//Use %20 for spaces.
				//Replace ENTITY_ID placeholder with your actual entity id below. 
                $curl = curl_init($this->URL.'entity/STX-02199-00/invoice/query?InvoiceNumber=Sample%20Invoice%2045');
                
				//Attach the header
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                
				//Make the call and then close the connection
                $response = curl_exec($curl);
                curl_close($curl);
            }
			
			//This function calls postInvoice.
			public function postInvoice() {
				//Build post invoice json.
                $jsonString = '{
				  "Invoice": {
					"InvoiceNumber": "Sample Invoice 45",
					"InvoiceDate": "2013-11-13T00:00:00",
					"InvoiceType": "INVOICE",
					"ShipFromAddress": {
					  "Address1": "3069 Hoffman Hill Blvd Ste 110",
					  "City": "Dupont",
					  "State": "WA",
					  "Zip": "98327",
					  "Country": "US"
					},
					"ShipToAddress": {
					  "Address1": "5145 Centennial Blvd Ste 102",
					  "City": "Colorado Springs",
					  "State": "CO",
					  "Zip": "80919",
					  "Country": "US"
					},
					"LineItems": {
					  "LineItem": [
						{
						  "LineItemNumber": "0",
						  "ProductCode": "TestCode1",
						  "Quantity": "1",
						  "UnitPrice": { "DecimalValue": "20.99" },
						  "SalesAmount": {
							"Cents": "99",
							"Dollars": "20",
							"Negative": "false"
						  }
						},
						{
						  "LineItemNumber": "1",
						  "ProductCode": "TestCode2",
						  "Quantity": "5",
						  "UnitPrice": { "DecimalValue": "1.99" },
						  "SalesAmount": {
							"Cents": "20",
							"Dollars": "80",
							"Negative": "false"
						  }
						}
					  ]
					}
				  }
				}';
				 
				//Replace ENTITY_ID placeholder with your actual entity id below.   
                $curl = curl_init($this->URL.'entity/STX-02199-00/invoice/post');
                
				//Set other options for the call.
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonString);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                
				//Make the call and then close the connection.
				$response = curl_exec($curl);
                print "\n\nPost Invoice Response::\n".$response;
                curl_close($curl);
            }

			//This function calls postInvoices.
			public function postInvoices() {
				//Post invoice numbers 'Sample Invoice 1' and 'Sample Invoice 1'
				//Build post invoices json.
				$jsonString = '{
				  "PostInvoices": {
					"InvoiceNumbers": {
					  "InvoiceNumber": [
						"Sample Invoice 46",
						"Sample Invoice 47"
					  ]
					}
				  }
				}';
					 
				//Replace ENTITY_ID placeholder with your actual entity id below.  
                $curl = curl_init($this->URL.'entity/STX-02199-00/invoice/postInvoices');
                
				//Set other options for the call.
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonString);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                
				//Make the call and then close the connection.
				$response = curl_exec($curl);
                print "\n\nPost Invoices Response::\n".$response;
                curl_close($curl);
            }

			//This function calls voidInvoice.
			public function voidInvoice() {
				//Void the invoice number 'Sample Invoice 1'. 
				//Use %20 for spaces.
				//Replace ENTITY_ID placeholder with your actual entity id below. 
                $curl = curl_init($this->URL.'entity/STX-02199-00/invoice/void?InvoiceNumber=Sample%20Invoice%2045');
				$params = '';
                
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
                $curl = curl_init($this->URL.'entity/STX-02199-00/createLocationFromAddress?State=CA&Zip=92653&Country=USA&Address1=25201%20Alicia%20Pkwy&City=Laguna%20Hills');
				$jsonString = '{ "MinimumConfidence": "STATE" }';
                
				//Set other options for the call.
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonString);
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
                $curl = curl_init($this->URL.'entity/STX-02199-00/getAddressFromLocation?LocationReference=069265312635943');
                
				//Attach the header
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                
				//Make the call and then close the connection
                $response = curl_exec($curl);
                curl_close($curl);
            }

			//This function calls createcustomer.
			public function createCustomer() {
				//Build create customer json.
                $jsonString = '{
				  "Customer": {
					"CustomerReference": "Sample Customer 45",
					"Name": "Test Test",
					"TaxNumber": "1234567"
				  }
				}';
             
				//Replace ENTITY_ID placeholder with your actual entity id below. 
                $curl = curl_init($this->URL.'entity/STX-02199-00/customer/create');
                
				//Set other options for the call.
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonString);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                
				//Make the call and then close the connection
                $response = curl_exec($curl);
				print "\n\nCreate Customer Response::\n".$response;
                curl_close($curl);
            }

			//This function calls editcustomer.
			public function editCustomer() {
				//Build edit customer json.
                $jsonString = '{
				  "Customer": {
					"CustomerReference": "Sample Customer 45",
					"Name": "Test T. Test",
					"TaxNumber": "1234567"
				  }
				}';
             
				//Replace ENTITY_ID placeholder with your actual entity id below. 
                $curl = curl_init($this->URL.'entity/STX-02199-00/customer/edit');
                
				//Set other options for the call.
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonString);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                
				//Make the call and then close the connection
                $response = curl_exec($curl);
				print "\n\nEdit Customer Response::\n".$response;
                curl_close($curl);
            }

			//This function calls createExemption.
			public function createExemption() {
				//Build create exemption json.
                $jsonString = '{
				  "Exemption": {
					"CustomerReference": "Sample Customer 45",
					"ExemptionReference": "Sample Exemption 45",
					"StartDate": "2014-01-13T00:00:00",
					"EndDate": "2015-01-13T00:00:00",
					"ExemptedStateCodes": {
					  "StateCode": [
						"CA",
						"CO"
					  ]
					},
					"ExemptionRate": "0.5",
					"SKUCode": "genMerch",
					"BusinessType": "Construction",
					"ExemptionReason": "other"
				  }
				}';
             
				//Replace ENTITY_ID placeholder with your actual entity id below. 
                $curl = curl_init($this->URL.'entity/STX-02199-00/exemption/create');
                
				//Set other options for the call.
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonString);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                
				//Make the call and then close the connection
                $response = curl_exec($curl);
				print "\n\nCreate Exemption Response::\n".$response;
                curl_close($curl);
            }

			//This function calls editExemption.
			public function editExemption() {
				//Build edit exemption json.
                $jsonString = '{
				  "Exemption": {
					"CustomerReference": "Sample Customer 45",
					"ExemptionReference": "Sample Exemption 45",
					"StartDate": "2016-01-13T00:00:00",
					"EndDate": "2017-01-13T00:00:00",
					"ExemptedStateCodes": {
					  "StateCode": [
						"CA",
						"CO"
					  ]
					},
					"ExemptionRate": "0.5",
					"SKUCode": "genMerch",
					"BusinessType": "Construction",
					"ExemptionReason": "other"
				  }
				}';
             
				//Replace ENTITY_ID placeholder with your actual entity id below. 
                $curl = curl_init($this->URL.'entity/STX-02199-00/exemption/edit');
                
				//Set other options for the call.
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonString);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                
				//Make the call and then close the connection
                $response = curl_exec($curl);
				print "\n\nEdit Exemption Response::\n".$response;
                curl_close($curl);
            }

			//This function calls queryExemption.
			public function queryExemption() {
				//Query the exemption number 'Test 123456' and customer 'Test Customer1'. 
				//Replace ENTITY_ID placeholder with your actual entity id below. 
                $curl = curl_init($this->URL.'entity/STX-02199-00/exemption/query?ExemptionReference=Sample%20Exemption%2045&CustomerReference=Sample%20Customer%2045');
                
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
				//Build map SKU json.
                $jsonString = '{
				  "SKUMapping": {
					"ClientSKU": "Sample Client SKU",
					"CCHProductCode": "90002199000000000019",
					"Description": "Sample Mapping 45",
					"StartDate": "2014-08-29T00:00:00",
					"EndDate": "2015-08-30T00:00:00"
				  }
				}';

				//Replace ENTITY_ID placeholder with your actual entity id below. 
                $curl = curl_init($this->URL.'entity/STX-02199-00/productMapping/create');
                
				//Set other options for the call.
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonString);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                
				//Make the call and then close the connection
                $response = curl_exec($curl);
				print "\n\nMap SKU Response::\n".$response;
                curl_close($curl);
            }

			//This function calls editSKU.
			public function editSKU() {
				//Build edit SKU json.
                $jsonString = '{
				  "SKUMapping": {
					"ClientSKU": "Sample Client SKU",
					"CCHProductCode": "90002199000000000019",
					"Description": "Sample Mapping 45 New",
					"StartDate": "2014-08-29T00:00:00",
					"EndDate": "2015-08-30T00:00:00"
				  }
				}';

				//Replace ENTITY_ID placeholder with your actual entity id below. 
                $curl = curl_init($this->URL.'entity/STX-02199-00/productMapping/edit');
                
				//Set other options for the call.
                curl_setopt($curl, CURLOPT_HTTPHEADER, $this->multiHeaders);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonString);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                
				//Make the call and then close the connection
                $response = curl_exec($curl);
				print "\n\nEdit SKU Response::\n".$response;
                curl_close($curl);
            }
        }
        
		//Call the methods one by one
        $restapi = new STS_REST_JSON();
               
        print "\n\nPING:: ";
        $restapi->ping();

		print "\n\n--------------------------------------------------------------------------------------";
        
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

        $restapi->editSKU();

		
?>