<?php

namespace PhpCorreios\Proxy\Correios\Rastreamento\RastreamentoResponse;

final class RastreamentoErroResult extends RastreamentoResultBase{
    
    public $erroMsg;
    
    /**
     * @param string $msg
     */
    public function __construct($msg) {
        $this->erroMsg = $msg;
    }
    
}
