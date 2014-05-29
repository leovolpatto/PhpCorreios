<?php

namespace PhpCorreios\Util;

final class CurlHeader {

    public $postTo;
    public $host;
    public $usrAgent;
    public $contentType;

    /**
     * @var int
     */
    public $contentLength;
    public $acceptEncondingType;
    public $soapAction;

    public function __construct() {
        $this->postTo = "/calculador/CalcPrecoPrazo.asmx HTTP/1.1";
        $this->host = "ws.correios.com.br";
        $this->usrAgent = "Curl-PHP/";
        $this->contentType = "text/xml; charset=utf-8";
        $this->contentLength = 0;
        $this->acceptEncondingType = "GZIP";
        $this->soapAction = '"http://tempuri.org/CalcPrecoPrazo"';
    }

    public function GetHeaderArray() {
        $header = array(
            "POST $this->postTo",
            "Host: $this->host",
            "User-Agent: $this->usrAgent",
            "Content-Type: $this->contentType",
            "Content-Length: $this->contentLength",
            "Accept-Encoding: $this->acceptEncondingType",
            "SOAPAction: $this->soapAction");
        
        return $header;
    }
}
