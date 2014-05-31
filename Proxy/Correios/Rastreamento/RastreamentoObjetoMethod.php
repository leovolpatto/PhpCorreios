<?php

namespace PhpCorreios\Proxy\Correios\Rastreamento;

final class RastreamentoObjetoMethod extends RastreamentoWsMethodBase {

    /**
     * @return RastreamentoResponse\RastreamentoResult
     */
    protected function AdaptResult($obj_xml) {
        if (!isset($obj_xml) || !is_object($obj_xml))
            return new RastreamentoResponse\RastreamentoErroResult("O XML de retorno está inválido ou os Correios alteraram o serviço.");

        if (count($obj_xml->error) > 0)
            return new RastreamentoResponse\RastreamentoErroResult("Erro no XML de retorno: '$obj_xml->error'");


        $result = new RastreamentoResponse\RastreamentoResult();

        foreach ($obj_xml->objeto as $o) {
            foreach ($o->evento as $e) {
                $rastreamentoDados = new \PhpCorreios\Proxy\Correios\Rastreamento\RastreamentoResponse\RastreamentoDados();
                $rastreamentoDados->numero = $o->numero->__toString();

                $rastreamentoDados->recebedor = (!isset($e->recebedor)) ? ' ' : $e->recebedor->__toString();
                $rastreamentoDados->documento = (!isset($e->documento)) ? ' ' : $e->documento->__toString();
                $rastreamentoDados->comentario = (!isset($e->comentario)) ? ' ' : $e->comentario->__toString();

                $rastreamentoDados->tipo = $e->tipo->__toString();
                $rastreamentoDados->sto = $e->sto->__toString();
                $rastreamentoDados->data = $e->data->__toString();
                $rastreamentoDados->hora = $e->hora->__toString();
                $rastreamentoDados->descricao = $e->descricao->__toString();
                $rastreamentoDados->local = $e->local->__toString();
                $rastreamentoDados->codigo = $e->codigo->__toString();
                $rastreamentoDados->cidade = $e->cidade->__toString();
                $rastreamentoDados->uf = $e->uf->__toString();
                $rastreamentoDados->status = $e->status->__toString();

                if (count($e->destino) > 0) {
                    $rastreamentoDados->localDestino = $e->destino->local->__toString();
                    $rastreamentoDados->codigoDestino = $e->destino->codigo->__toString();
                    $rastreamentoDados->bairroDestino = $e->destino->bairro->__toString();
                    $rastreamentoDados->cidadeDestino = $e->destino->cidade->__toString();
                    $rastreamentoDados->ufDestino = $e->destino->uf->__toString();
                }

                $result->addRastreamentoDados($rastreamentoDados);
            }
        }

        return $result;
    }

}
