<?php

namespace PhpCorreios\Util\Result;

final class CurlErrorResult extends \PhpCorreios\Util\CurlResult {
    
    public $details;
    /**
     * @var \PhpCorreios\Util\CurlRequest
     */
    public $request;
    
    public function __construct($rawData, \PhpCorreios\Util\CurlRequest $request) {
        $this->request = $request;
        parent::__construct($rawData);
    }  
    
    public function GetResult() {
        return $this->rawData;
    }

}
