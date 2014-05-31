<?php

namespace PhpCorreios\Proxy\Correios\Rastreamento;

/**
 * Baseado em http://sooho.com.br/rastrear/
 */
abstract class RastreamentoWsMethodBase {

    /**
     * @var \PhpCorreios\Proxy\CorreiosProxy
     */
    protected $proxy;
    
    
    public function __construct(\PhpCorreios\Proxy\CorreiosProxy $proxy) {
       $this->proxy = $proxy; 
    }
     
    /**
     * @return RastreamentoResponse\RastreamentoResult
     */
    protected abstract function AdaptResult($result);

    /**
     * @return RastreamentoResponse\RastreamentoResult
     */
    public function Request($codigo)
    {
        $r = new Util\RastrearPedido();        
	$xml = $r->rastrear( $codigo );
	$obj_xml = simplexml_load_string($xml); 
                
        return $this->AdaptResult($obj_xml);
    }
}
    