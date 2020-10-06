<?php
namespace Utils\Libraries;

trait UtilsResponseLib {

    protected function setResponse($status, $data = null) {
        $response = new \stdClass();
        $response->status = $status;
        $response->data = $data;

        return $response;
    }

}
