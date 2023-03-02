<?php

namespace app\controllers;

use app\core\Controller;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\controllers
 **/
class SiteController extends Controller {
    public string $layout = 'main';

    public function home() {
        return $this->render('home');
    }
}