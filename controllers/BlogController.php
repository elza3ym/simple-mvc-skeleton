<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\Blog;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\controllers
 **/
class BlogController extends Controller {
    public function create(Request $request) {
        $blog = new Blog();
        $blog->loadData($request->getBody());
        $params = [
            'model' => $blog
        ];
        if ($request->isPost()) {
            var_dump($blog);
        }
        return $this->render('blog.create', $params);
    }

    public function view(Request $request) {
        //TODO: When init migrations
//        $blog = Blog::findOne['id' => $id];
        $blog = ['title' => 'New', 'description' => 'This is good news', 'image' => 'google.com'];
        $params = [
            'blog' => $blog
        ];
        return $this->render('blog.view', $params);
    }
}