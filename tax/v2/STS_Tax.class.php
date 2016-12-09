<?php

class STS_Tax {

    //Base URL for all methods. Replace this with the Demo/Production URL.
    private $soapUrl = "https://service.myspeedtax.com/tx2/services/STxTransactionService?wsdl";
    private $headers = array(
        "Content-type: text/xml;charset=\"utf-8\"",
        "Accept: text/xml",
        "Cache-Control: no-cache",
        "Pragma: no-cache"
    );

    public function sendSoapRequest($RequestXml) {
        $this->headers['Content-length'] = strlen($RequestXml);
        $ch = curl_init($this->soapUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $RequestXml);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function pingResult($xmlAns) {
        $xml = simplexml_load_string($xmlAns);
        $result = $xml->children('soap', true)->Body->children('ns1', true)->PingResponse->PingResult->PingResponse;
        $serverUp = FALSE;
        foreach ($result as $res) {
            if (ltrim(rtrim($res)) == "pong") {
                $serverUp = TRUE;
            }
           
        }
        return $serverUp;
        
    }
    
    public function addressResolved($xmlAns){
        $xml = simplexml_load_string($xmlAns);
        $result = $xml->children('soap', true)->Body->children('ns1', true)->ResolveAddressResponse->ResolveAddressResult->ResultType;
        $AddrResolved = FALSE;
        foreach ($result as $res) {
            if (ltrim(rtrim($res)) == "FULL" || ltrim(rtrim($res)) == "FALLBACK" || ltrim(rtrim($res)) == "STATE" ) {
                $AddrResolved = TRUE;
            }
           
        }
        return $AddrResolved;
        
    }

}
?>

