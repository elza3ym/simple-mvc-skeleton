<?php

namespace app\controllers;

use app\core\Controller;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\controllers
 **/
class AuthController extends Controller {
    public string $layout = 'auth';
    public function login() {
        return $this->render('login');
    }
}