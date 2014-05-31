<?php

namespace PhpCorreios\Proxy\Correios\Rastreamento\RastreamentoResponse;

use PhpCorreios\Proxy\Correios\Rastreamento\RastreamentoResponse\RastreamentoDados;

final class RastreamentoResult extends RastreamentoResultBase {
    
    public $rastreamentoDados = array();
    
    public function addRastreamentoDados(RastreamentoDados $dados){
        $dados->_id = count($this->rastreamentoDados);
        array_push($this->rastreamentoDados, $dados);
    }
    
    
    
}
