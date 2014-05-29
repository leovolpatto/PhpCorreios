<?php

namespace PhpCorreios\Util;

final class CurlRequest {
    /**
     * @var CurlHeader
     */
    private $header;
    /**
     * @var CurlBody
     */
    private $body;
    /**
     * @var string
     */
    private $resultString;
    /**
     * @var string
     */
    public $expectResultAs;
    
    public $requestResultInfo;

    public function __construct(CurlHeader $header, CurlBody $body, $expectResultAs = 'text/xml') {
        $this->header = $header;
        $this->body = $body;
        $this->expectResultAs = $expectResultAs;
    }
    
    /**
     * @return CurlHeader
     */
    public function GetHeader()
    {
        return $this->header;
    }
    
    /**
     * @return CurlBody
     */
    public function GetBody()
    {
        return $this->body;
    }
    
    /**
     * @param string $result
     */
    public function SetResultString($result)
    {
        $this->resultString = $result;
    }
    
    public function SetResultInfo($info)
    {
        $this->requestResultInfo = $info;
    }
    
    /**
     * @param string $result
     */
    public function GetResultString()
    {
        return $this->resultString;
    }
    
}
