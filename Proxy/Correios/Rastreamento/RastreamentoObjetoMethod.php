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
        
        echo $obj_xml->qtd . "\n";
        echo $obj_xml->TipoPesquisa . "\n";
        echo $obj_xml->TipoResultado . "\n";

        // se for uma lista de objetos percorre a lista
        foreach ($obj_xml->objeto as $o) {
            echo $o->numero . "\n";
            // percore todos os eventos registrados deste objeto
            foreach ($o->evento as $e) {
                // 3 campos que raramente sao preenchidos
                $recebedor = (!isset($e->recebedor)) ? ' ' : $e->recebedor;
                $documento = (!isset($e->documento)) ? ' ' : $e->documento;
                $comentario = (!isset($e->comentario)) ? ' ' : $e->comentario;
                echo "
							$e->tipo \n
							$e->sto  \n
							$e->data \n
							$e->hora \n
							$e->descricao \n
							$recebedor \n
							$documento \n
							$comentario \n
							$e->local \n
							$e->codigo \n
							$e->cidade \n
							$e->uf \n
							$e->status \n
						";
                // se existe node destino entao ...
                if (count($e->destino) > 0){
                    echo "
							$e->destino->local \n
							$e->destino->codigo \n
							$e->destino->bairro / $e->destino->cidade \n
							$e->destino->uf \n";
                }
            }
        }
    }
}
