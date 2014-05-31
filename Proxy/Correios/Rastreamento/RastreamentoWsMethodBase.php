<?php

namespace PhpCorreios\Proxy\Correios\Rastreamento;

//http://sooho.com.br/rastrear/


abstract class RastreamentoWsMethodBase {
    
    /**
     * @var \PhpCorreios\Util\CurlHeader
     */
    protected $curlHeader;
    /**
     * @var \PhpCorreios\Proxy\CorreiosProxy
     */
    protected $proxy;
    
    
    public function __construct(\PhpCorreios\Proxy\CorreiosProxy $proxy) {
       $this->proxy = $proxy; 
    }
    
    protected abstract function SetSoapActionMethod(&$soapActionMethod);

    /**
     * @return \PhpCorreios\Util\CurlBody
     */
    protected abstract function CreateRequestBody(RequestModel\RequestBase $request);

    /**
     * @return ResponseModel\CalcPrecoPrazoResponseBase
     */    
    protected abstract function AdaptResult(\PhpCorreios\Util\CurlResult $result);

    protected function CreateCurlHeader()
    {
        $this->curlHeader = new \PhpCorreios\Util\CurlHeader();
        $this->curlHeader->soapAction = $this->soapActionMethod;
        $this->curlHeader->host = $this->soapHost;
        $this->curlHeader->postTo = $this->soapPostTo;
    }    
    
    public function Request(RequestModel\RequestBase $request)
    {
        if($this->curlHeader == null)
            $this->CreateCurlHeader();
        
        $curl = new \PhpCorreios\Util\Curl($this->proxy->address);
        $result = $curl->Request($this->CreateRequestBody($request), $this->curlHeader);
        
        if($result instanceof \PhpCorreios\Util\Result\CurlErrorResult)
            return new ResponseModel\Error ($result);
        
        return $this->AdaptResult($result);
    }
}
    