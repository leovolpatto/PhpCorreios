<?php

namespace PhpCorreios\Util;

/**
 * Description of Curl
 *
 * @author Leo
 */
final class Curl {
    
    private $wsdlAddress;
    public $requestTimeout = 30;
    
    public function __construct($wsdlAddress) {
        $this->wsdlAddress = $wsdlAddress;
    }
    
    /**
     * @param \PhpCorreios\Util\CurlBody $body
     * @param \PhpCorreios\Util\CurlHeader $header
     * @return CurlResult
     * @throws CurlException
     */
    public function Request(CurlBody $body, CurlHeader $header)
    {
        $ch = curl_init();
        $header->contentLength = strlen($body->GetBodyString());
        curl_setopt($ch, CURLOPT_URL, $this->wsdlAddress);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE , false);
        curl_setopt($ch, CURLOPT_HEADER , false );
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->requestTimeout);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header->GetHeaderArray());
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body->GetBodyString());
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, 'GZIP');
        
        try
        {
            $result = curl_exec($ch);  
        } catch (Exception $ex) {
               echo 'fezes';
        }

        if(curl_errno($ch)) 
            throw new CurlException(curl_error($ch), curl_errno($ch), $header, $body);
        
        $request = new CurlRequest($header, $body);
        $request->SetResultString($result);
        $request->SetResultInfo(curl_getinfo($ch));
        
        return CurlResultFactory::GetConcreteResult($request);
    }
    
}
