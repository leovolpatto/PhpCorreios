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
        xml_parser_free($parser);

        return $xml_values ? $xml_values : array();
    }

}