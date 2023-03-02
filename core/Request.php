<?php

namespace app\core;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\core
 **/
class Request {
    public function getMethod() {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet() {
        return $this->getMethod() === 'get';
    }

    public function isPost() {
        return $this->getMethod() === 'post';
    }

    public function getPath() {
        $path = $_SERVER['REQUEST_URI'];
        $position = strpos('?', $path);
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }

    public function getBody() {
        // TODO: implement getBody()
    }
}