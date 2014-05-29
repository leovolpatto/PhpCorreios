<?php

namespace PhpCorreios\Proxy;

final class CorreiosProxy {
    
    public $address;
    /**
     * @var Correios\CalcPrecoPrazoWS\CalcPrecoPrazoMethod
     */
    private $calcPrecoPrazoMethod;
    
    public function __construct($address = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.asmx') {
        $this->address = $address;
    }
    
    /**
     * @param \PhpCorreios\Proxy\Correios\CalcPrecoPrazoWS\RequestModel\CalcPrecoPrazoRequest $request
     * @return \PhpCorreios\Proxy\Correios\CalcPrecoPrazoWS\ResponseModel\CalcPrecoPrazoResponse
     */
    public function CalcPrecoPrazo(Correios\CalcPrecoPrazoWS\RequestModel\CalcPrecoPrazoRequest $request)
    {
        if($this->calcPrecoPrazoMethod == null)
            $this->calcPrecoPrazoMethod = new Correios\CalcPrecoPrazoWS\CalcPrecoPrazoMethod($this);
        
        return $this->calcPrecoPrazoMethod->Request($request);
    }
}
