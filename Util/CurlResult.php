<?php

namespace PhpCorreios\Util;

abstract class CurlResult {
    
    /**
     * @var string
     */
    protected $rawData;
    
    public function __construct($rawData) {
       $this->rawData = $rawData; 
    }
    
    public abstract function GetResult();    
}
