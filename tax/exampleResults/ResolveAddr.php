<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
	<soap:Body>
		<ns1:ResolveAddressResponse xmlns:ns1="http://speedtax.com/transaction">
				<ns1:ResolveAddressResult>
					<ns1:ResultType>FULL</ns1:ResultType>
					<ns1:ResolvedAddress>
						<ns1:Address1>25201 ALICIA PKWY STE 120 ATTN: JOHN ADAMS</ns1:Address1>
						<ns1:Address2>Attn: John Adams</ns1:Address2>
						<ns1:City>LAGUNA HILLS</ns1:City>
						<ns1:State>CA</ns1:State>
						<ns1:Zip>92653</ns1:Zip>
						<ns1:Country>USA</ns1:Country>
						<ns1:FullFipsCode>0605939220</ns1:FullFipsCode>
						<ns1:Latitude>33.599635</ns1:Latitude>
						<ns1:Longitude>-117.692266</ns1:Longitude>
					</ns1:ResolvedAddress>
				
					<ns1:Jurisdictions>
						<ns1:Jurisdiction>
							<ns1:JurisdictionFips>06</ns1:JurisdictionFips>
							<ns1:JurisdictionName>California</ns1:JurisdictionName>
						</ns1:Jurisdiction>
						<ns1:Jurisdiction>
							<ns1:JurisdictionFips>059</ns1:JurisdictionFips>
							<ns1:JurisdictionName>ORANGE COUNTY</ns1:JurisdictionName>
						</ns1:Jurisdiction>
						<ns1:Jurisdiction>
							<ns1:JurisdictionFips>CCH8246-03</ns1:JurisdictionFips>
							<ns1:JurisdictionName>DISTRICT TAX (OCTA)</ns1:JurisdictionName>
						</ns1:Jurisdiction>
					</ns1:Jurisdictions>
				</ns1:ResolveAddressResult>
		</ns1:ResolveAddressResponse>
	</soap:Body>
</soap:Envelope>