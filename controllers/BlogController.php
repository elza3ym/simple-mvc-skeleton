<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Blog;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\controllers
 **/
class BlogController extends Controller {
    public function create(Request $request, Response $response) {
        $blog = new Blog();
        $blog->loadData($request->getBody());
        $params = [
            'model' => $blog
        ];
        if ($request->isPost()) {
            $blogId = $blog->save();
            if ($blogId && $blog->validate()) {
                $response->redirect('/blog-post?id='.$blogId);
            }
        }
        return $this->render('blog.create', $params);
    }

    public function view(Request $request, Response $response) {
        $blogId = $request->getBody()['id'] ?? false;
        if (!$blogId) {
            $response->redirect('/');
        }

        $blog = Blog::findOne(['id' => $blogId]);
        if (!$blog) {
            $response->redirect('/');
        }

        $params = [
            'blog' => $blog
        ];
        return $this->render('blog.view', $params);
    }
}