<?php

namespace PhpCorreios\Util\Result;

final class CurlXmlResult extends \PhpCorreios\Util\CurlResult {

    public function __construct($rawData) {
        parent::__construct($rawData);
    }

    /**
     * @return array
     */
    public function GetResult() {
       
        //echo "<pre><code>";
        //echo $this->rawData;
        //echo "</code></pre>";
        if (!$this->rawData)
            return array();

        if (!function_exists('xml_parser_create')) {
            throw new Exception('xml_parser_create function could not be found.');
        }

        $parser = xml_parser_create();

        xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, 'utf-8');
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parse_into_struct($parser, $this->rawData, $xml_values);
        //$xml_values = xml_parse($parser, $this->rawData);
        
        
        /*
        echo '<pre>';
        
            $doc = new \DOMDocument();
            $doc->loadXML( $this->rawData );

            //$loginResults = $doc->getElementsByTagName("calcprecoprazoresponse");
            
            echo $doc->getElementsByTagName('valor')->item(0)->nodeValue;
            
            //$LoginResult = $LoginResults->item(0)->nodeValue;        
        
        
            //$movies = new \SimpleXMLElement($this->rawData);            
            //print_r($movies->attributes('http://tempuri.org/'));
            //print_r($movies->getDocNamespaces(true));
        
        die;
               
        
        //var_dump($xml_values);
        echo '</pre>';
        */
        xml_parser_free($parser);
        


        return $xml_values ? $xml_values : array();
    }

}