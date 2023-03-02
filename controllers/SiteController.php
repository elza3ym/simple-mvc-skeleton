<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Blog;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\controllers
 **/
class SiteController extends Controller {
    public string $layout = 'main';

    public function home() {
        $blogs = Blog::findAll();
        $params = [
            'blogs' => $blogs
        ];
        return $this->render('home', $params);
    }
}