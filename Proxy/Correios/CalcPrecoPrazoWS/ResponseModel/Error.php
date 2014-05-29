<?php

namespace PhpCorreios\Proxy\Correios\CalcPrecoPrazoWS\ResponseModel;

final class Error extends CalcPrecoPrazoResponseBase{
    
    public $error;
    
    public function __construct($error) {
        $this->error = $error;
    }
    
}
