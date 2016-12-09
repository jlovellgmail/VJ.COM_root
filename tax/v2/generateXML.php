<?php

$pingRequestXml = '<?xml version="1.0" encoding="UTF-8"?> 
<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="http://speedtax.com/transaction" xmlns:ns2="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd" xmlns:ns3="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
       <SOAP-ENV:Header>
            <ns3:Security SOAP-ENV:mustUnderstand="1">
                <ns3:UsernameToken>
                    <ns3:Username>mitch@study.net</ns3:Username>
                    <ns3:Password>Ve&amp;@p57KW</ns3:Password>
                    <ns3:Nonce>wh66ztc4ZaCn2SFMpKDY/w==</ns3:Nonce>
                </ns3:UsernameToken>
            </ns3:Security>
        </SOAP-ENV:Header>
    <SOAP-ENV:Body>
        <ns1:Ping/>
    </SOAP-ENV:Body>
</SOAP-ENV:Envelope> ';

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


