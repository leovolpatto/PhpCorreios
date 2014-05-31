<?php

namespace PhpCorreios\Proxy\Correios\Rastreamento\Util;

/**
 * Classe utilizada para rastrear pedidos dos correiors via API e XML
 * @autor : wandeco [sans.pds@gmail.com]
 * @data : 2013-07-10 12:37
 * @fonte : http://blog.correios.com.br/comercioeletronico/wp-content/uploads/2011/10/Guia-Tecnico-Rastreamento-XML-Cliente-Vers%C3%A3o-e-commerce-v-1-5.pdf
 */
final class RastrearPedido
{
    /**
     * URL para onde devemos requerir os eventos do produto rastreado
     * @var string
     */
    private $url = "http://websro.correios.com.br/sro_bin/sroii_xml.eventos";
    
    /**
     * Array que guarda infos que serao enviadas ao correio para rastreamento
     * array( Usuario, Senha, Tipo, Resultado, Objetos )
     * @var Array() 
     */
    private $data = array(); 
   
    private $xml = null;
   
    function __construct( $arr_dados = array() )
    {
       // @todo - validar dados recebidos
       if( !empty( $dados ) ) $this->data = $arr_dados;
       else{
          $this->data = array(
             'Usuario' => 'ECT', /* Informado pela área comercial dos Correios na ativação do serviço. */
             'Senha' => 'SRO',   /* Informado pela área comercial dos Correios na ativação do serviço. */
             'Tipo' => 'L',      /* L - Lista de Objetos, F - Intervalo de Objetos */
             'Resultado' => 'T', /* T : Retorna todos os eventos do objeto, U : Retorna apenas ultimo evento do objeto */
             'Objetos' => 'XX000000000YY' /*IDs listadas sem espacos um apos o outro*/  
		);
        }
    }
    /**
	* metodo usado para passar codigo de rastreamento
	* @todo - alterar a funcao para receber varios codigos ao inves de um so
	* @param string[13] $objetos - codigo do objeto a ser rastreado
	* @return XML
	*/
    function rastrear( $objetos = null )
    {
        if( $objetos ) $this->data['Objetos'] = $objetos;
		$this->xml = $this->curl_connection( $this->url, 'POST', $this->data );
 
        // converte para objeto ? se quiser ja retornar objeto ...
        // retire comentario da linha abaixo!
        // return simplexml_load_string( $this->xml );
        return $this->xml;
    }
    /**
    * Método para conexão via cRUL.
    * @param type $url
    * @param string $method GET com padrão
    * @param array $data
    * @param type $timeout 30
    * @param type $charset ISO
    * @return array
    */
    private function curl_connection(
		$url, 
		$method = 'GET', 
		Array $data = null, 
		$timeout = 30, 
		$charset = 'ISO-8859-1'
	){	
        if (strtoupper($method) === 'POST') {
            $postFields = ($data ? http_build_query($data, '', '&') : "");
            $contentLength = "Content-length: ".strlen($postFields);
            $methodOptions = Array(
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $postFields,
                    );			
        } else {
            $contentLength = null;
            $methodOptions = Array(
                    CURLOPT_HTTPGET => true
                    );				
        }
 
        $options = Array(
            CURLOPT_HTTPHEADER => Array(
                "Content-Type: application/x-www-form-urlencoded; charset=".$charset,
                $contentLength
            ),	
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CONNECTTIMEOUT => $timeout,
            //CURLOPT_TIMEOUT => $timeout
        ); 
        $options = ($options + $methodOptions);
 
        $curl = curl_init();
        curl_setopt_array($curl, $options);			
        $resp  = curl_exec($curl);
        $info  = curl_getinfo($curl);// para debug
        $error = curl_errno($curl);
        $errorMessage = curl_error($curl);
        curl_close($curl);
        
        if ($error) {
            //log_message('error', $errorMessage);
                //throw new Exception("Erro ao conectar: $errorMessage");
                return false;
        } else {
                return $resp;
        }
    }
}