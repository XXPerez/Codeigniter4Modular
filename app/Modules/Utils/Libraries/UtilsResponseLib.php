<?php
namespace Utils\Libraries;

trait UtilsResponseLib {

    static $SUCCESS = 'success';
    static $ERROR = 'error';
    
    protected function setResponse($status, $data = null) {
        $response = new \stdClass();
        $response->status = $status;
        $response->data = $data;

        return $response;
    }

}
