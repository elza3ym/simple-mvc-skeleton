<?php

namespace app\core;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\core
 **/
class Response {
    public function setStatusCode(int $code) {
        http_response_code($code);
    }
}