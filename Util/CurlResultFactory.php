<?php

namespace PhpCorreios\Util;

final class CurlResultFactory {
    
    /**
     * @param \PhpCorreios\Util\CurlRequest $request
     * @return CurlRequest 
     */
    public static function GetConcreteResult(CurlRequest $request)
    {
        if(is_array($request->requestResultInfo))
        {
            if($request->requestResultInfo['http_code'] == 500)
                return new Result\CurlErrorResult($request->GetResultString(), $request);
        }
            
        switch ($request->expectResultAs)
        {
            case 'text/xml':
                return new Result\CurlXmlResult($request->GetResultString());
            case 'text/plain':
                return new Result\CurlTextResult($request->GetResultString());
            default:
                throw new Exception("Unexpected result type $request->expectResultAs. You need to implement a CurlResult for it.");
            //return new Result\CurlTextResult($request->GetResultString());
        }
    }
    
}
