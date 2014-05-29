<?php

namespace PhpCorreios\Proxy\Correios\CalcPrecoPrazoWS;

final class CalcPrecoPrazoMethod extends CalcPrecoPrazoWsMethodBase {
    
    
    protected function AdaptResult(\PhpCorreios\Util\CurlResult $result) {
        //var_dump($result->GetResult());
        return $result->GetResult();
    }

    /**
     * @param \PhpCorreios\Proxy\Correios\CalcPrecoPrazoWS\RequestModel\CalcPrecoPrazoRequest $request
     */
    protected function CreateRequestBody(RequestModel\RequestBase $request) {
        $env = 
        '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tem="http://tempuri.org/">
           <soapenv:Header/>
           <soapenv:Body>
                <tem:CalcPrecoPrazo>
                      <tem:nCdEmpresa></tem:nCdEmpresa>
                      <tem:sDsSenha></tem:sDsSenha>
                      <tem:nCdServico>'. $request->codigoDoServico .'</tem:nCdServico>
                      <tem:sCepOrigem>'. $request->cepOrigem .'</tem:sCepOrigem>
                      <tem:sCepDestino>'. $request->cepDestino .'</tem:sCepDestino>
                      <tem:nVlPeso>'. $request->pesoKg .'</tem:nVlPeso>
                      <tem:nCdFormato>'. $request->formato .'</tem:nCdFormato>
                      <tem:nVlComprimento>'. $request->comprimentoCm .'</tem:nVlComprimento>
                      <tem:nVlAltura>'. $request->alturaCm .'</tem:nVlAltura>
                      <tem:nVlLargura>'. $request->larguraCm .'</tem:nVlLargura>
                      <tem:nVlDiametro>'. $request->diametroCm .'</tem:nVlDiametro>
                      <tem:sCdMaoPropria>'. ($request->maoPropria ? 'S' : 'N') .'</tem:sCdMaoPropria>
                      <tem:nVlValorDeclarado>'. $request->valorDeclarado .'</tem:nVlValorDeclarado>
                      <tem:sCdAvisoRecebimento>'. ($request->avisoDeRecebimento ? 'S' : 'N') .'</tem:sCdAvisoRecebimento>
                </tem:CalcPrecoPrazo>
           </soapenv:Body>
        </soapenv:Envelope>';
        
        $cb = new \PhpCorreios\Util\CurlBody($env);
        return $cb;
    }

    protected function SetSoapActionMethod(&$soapActionMethod) {
        $soapActionMethod = '"http://tempuri.org/CalcPrecoPrazo"';
    }

}
