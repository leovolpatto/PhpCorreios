<?php

namespace PhpCorreios\Util;

final class CurlBody {
    
    private $bodyString;
    
    public function __construct($bodyString) {
        $this->bodyString = $bodyString;
    }
    
    /**
     * @return string
     */
    public function GetBodyString()
    {
        return $this->bodyString;
    }
}
