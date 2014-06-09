<?php

namespace PhpCorreios\Proxy\Correios\Rastreamento\Util;

class CorreiosStatusEventos {

    public $listStatusEventos = array();

    public function __construct() {
        $this->montarEventosCorreios();
    }

    /**
     * 
     * @param type $status
     * @param type $tipo
     * @return \PhpCorreios\Proxy\Correios\Rastreamento\Util\CorreiosStatusEvento
     */
    public function getEventoPorStatusTipo($status, $tipo) {
        foreach ($this->listStatusEventos as $evento) {
            if (strcasecmp($evento->status, $status) == 0) {
                foreach ($evento->tipo as $evSigla => $evTipo) {
                    if (strcasecmp($evSigla, $tipo) == 0) {
                        return $evento;
                    }
                }
                return new CorreiosStatusEvento(array('error' => 'Tipo de evento não encontrado'));
            }
        }
        return new CorreiosStatusEvento(array('error' => 'Status do evento não encontrado'));
    }

    private function montarEventosCorreios() {
        $listaEventos = new ListaDeEventos();
        foreach ($listaEventos->listaEventos as $evento) {
            $statusEvento = new CorreiosStatusEvento($evento);
            $this->addStatusEvento($statusEvento);
        }
    }

    private function addStatusEvento(CorreiosStatusEvento $evento) {
        array_push($this->listStatusEventos, $evento);
    }

}

final class CorreiosStatusEvento {

    public $tipo = array();
    public $status;
    public $descricao;
    public $detalhe;
    public $procedimento;
    public $_cod_ref;
    public $_error;

    public function __construct(array $evento) {
        if (!empty($evento['tipo'])) {
            $tpEvento = new CorreiosTiposEventos();
            foreach ($evento['tipo'] as $tipo) {
                $this->tipo[$tipo] = $tpEvento->GetDescricaoDoEvento($tipo);
            }
            $this->status = $evento['status'];
            $this->descricao = $evento['descricao'];
            $this->detalhe = $evento['detalhe'];
            $this->procedimento = $evento['procedimento'];
            $this->_cod_ref = $evento['_cod_ref'];
        } else {
            $this->_error = $evento['error'];
        }
    }

}
