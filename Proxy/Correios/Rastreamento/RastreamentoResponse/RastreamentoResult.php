<?php

namespace PhpCorreios\Proxy\Correios\Rastreamento\RastreamentoResponse;

use PhpCorreios\Proxy\Correios\Rastreamento\RastreamentoResponse\RastreamentoDados;

final class RastreamentoResult {
    
    public $rastreamentoDados = array();
    
    public function addRastreamentoDados(RastreamentoDados $dados){
        array_push($this->rastreamentoDados, $dados);
    }
    
    
    
}
