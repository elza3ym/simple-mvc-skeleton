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
        $params = [
            'name' => 'Check24',
            'posts' => [
                'title' => 'Big scary news',
                'description' => 'Don\'t be afraid',
                'image' => 'image_url_scary'
            ]
        ];
        return $this->render('home');
    }
}