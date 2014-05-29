<?php

namespace PhpCorreios\Util\Result;

final class CurlTextResult extends \PhpCorreios\Util\CurlResult{
    
    public function __construct($rawData) {
        parent::__construct($rawData);
    }

    /**
     * @return string
     */
    public function GetResult() {
        return $this->rawData;
    }

}
