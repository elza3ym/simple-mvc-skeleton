<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\User;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\controllers
 **/
class AuthController extends Controller {
    public string $layout = 'auth';
    public function login(Request $request) {
        $user = new User();
        $user->loadData($request->getBody());
        $params = [
            'model' => $user
        ];
        if ($request->isPost()) {
            $user->validate();
        }
        return $this->render('login', $params);
    }
}