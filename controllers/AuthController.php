<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\User;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\controllers
 **/
class AuthController extends Controller {
    public string $layout = 'auth';
    public function login(Request $request, Response $response) {
        $user = new User();
        $user->loadData($request->getBody());
        $params = [
            'model' => $user
        ];
        if ($request->isPost()) {
            if ($user->validate() && $user->login($request)) {
                $response->redirect('/');
            }
        }
        return $this->render('login', $params);
    }

    public function logout(Request $request, Response $response) {
        Application::$app->logout();
        $response->redirect('/');
    }
}