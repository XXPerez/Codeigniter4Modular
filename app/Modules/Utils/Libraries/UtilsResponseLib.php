<?php
namespace Utils\Libraries;
use \CodeIgniter\API\ResponseTrait;

trait UtilsResponseLib {

    use ResponseTrait;
    static $SUCCESS = 200;
    static $NOTAUTH = 401;
    static $FORBIDDEN = 403;
    static $NOTFOUND = 404;
    static $NOTALLOWED = 405;
    static $SERVERERROR = 500;
    
    protected function sendResponse($status, $data = null) {
        $myresponse = $this->setResponse($status, $data);
        $this->respond((object) $myresponse)->send();
        die();
    }
            
    protected function setResponse($status, $data = null) {
        
        $myresponse = new \stdClass();
        if (is_array($data)) {
            $data = (object) $data;
        }
        if ($status == self::$SUCCESS) {
            $myresponse->status = $status;
            $myresponse->data = $data;
        } else {
            $myresponse->status = $status;
            $myresponse->error = $data;
        }

        return $myresponse;
    }

}
