<?php

namespace PhpCorreios\Proxy\Correios\Rastreamento\Util;

final class CorreiosTiposEvento {
    
    public $eventos = array();
    
    public function __construct() {
        $this->eventos['BDE'] = 'Baixa de distribuição externa';
        $this->eventos['BDI'] = 'Baixa de distribuição interna';
        $this->eventos['BDR'] = 'Baixa Corretiva';
        $this->eventos['CAR'] = 'Conferência de lista de registro';
        $this->eventos['CD'] = 'Conferência de nota de despacho';
        $this->eventos['CMR'] = 'Conferência de lista de registro';
        $this->eventos['CO'] = 'Coleta de objetos';
        $this->eventos['CUN'] = 'Conferência de lista de registro';
        $this->eventos['DO'] = 'Expedição de nota de despacho';
        $this->eventos['EST'] = 'Estorno';
        $this->eventos['FC'] = 'Função complementar';
        $this->eventos['IDC'] = 'Indenização de objetos';
        $this->eventos['IE'] = 'Comunicação de irregularidade de expedição';
        $this->eventos['IT'] = 'Passagem interna de objetosEmpresa Brasileira de Correios e Telégrafos';
        $this->eventos['SRO'] = 'Sistema de Rastreamento de Objetos';
        $this->eventos['LDI'] = 'Lista de distribuição interna';
        $this->eventos['OEC'] = 'Lista de objetos entregues ao carteiro';
        $this->eventos['PAR'] = 'Conferência Unidade Internacional';
        $this->eventos['PMT'] = 'Partida meio de transporte';
        $this->eventos['PO'] = 'Postagem (exceção)';
        $this->eventos['RO'] = 'Expedição de lista de registro';
        $this->eventos['TR'] = 'Trânsito';
    }
    
    /**
     * @param string $sigla
     * @return string
     */
    public function GetDescricaoDoEvento($sigla)    
    {
        $s = strtoupper($sigla);
        if(array_key_exists($s, $this->eventos))
                return $this->eventos[$s];
                
        return "";
    }
    
}