<?php

namespace PhpCorreios\Util;

final class CurlException extends \Exception{
    /**
     * @var CurlHeader
     */
    public $header;
    /**
     * @var CurlBody
     */
    public $body;
    /**
     * @var int
     */
    public $errorNr;

    public function __construct($message, $errorNr, \PhpCorreios\Util\CurlHeader $header, PhpCorreios\Util\CurlBody $body) {
        $this->errorNr = $errorNr;
        $this->header = $header;
        $this->body = $body;
        parent::__construct($message);        
    }
    
}
