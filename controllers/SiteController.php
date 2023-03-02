<?php

namespace app\controllers;

use app\core\Controller;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\controllers
 **/
class SiteController extends Controller {
    protected string $layout = 'main';

    public function home() {
        return 'Hello World';
    }
}