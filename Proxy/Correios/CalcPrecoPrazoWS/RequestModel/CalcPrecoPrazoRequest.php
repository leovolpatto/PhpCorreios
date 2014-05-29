<?php

namespace PhpCorreios\Proxy\Correios\CalcPrecoPrazoWS\RequestModel;

final class CalcPrecoPrazoRequest extends RequestBase{

    public $codigoDoServico;
    public $cepOrigem;
    public $cepDestino;
    public $pesoKg;
    public $formato;
    public $comprimentoCm;
    public $alturaCm;
    public $larguraCm;
    public $diametroCm;
    public $valorDeclarado;
    /**
     * @var boolean
     */
    public $maoPropria = false;    
    /**
     * @var boolean
     */
    public $avisoDeRecebimento = false;
    
}
