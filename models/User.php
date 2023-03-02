<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;
use app\core\Request;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\models
 **/
class User extends DbModel {

    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';

    public function fillables(): array {
        // Implement On Register
        return [];
    }

    public function rules(): array {
        return [
            'email' => [self::RULE_EMAIL, self::RULE_REQUIRED],
            'password' => [
                self::RULE_MIN,
                [ self::RULE_MIN, 8 ]
            ]
        ];
    }

    public function labels(): array {
        return [
            'email' => 'Email',
            'password' => 'Password'
        ];
    }

    public static function tableName(): string {
        return 'users';
    }

    public function login(Request $request) {
        $user = User::findOne(['email' => $this->email]);
        if (!$user) {
            $this->addError('email', 'User doesn\'t exist with this email');
            return false;
        }

        if (password_verify($this->password, $user->password)) {
            $this->addError('password', 'Password is incorrect');
            return false;
        }
        return Application::$app->login($user);
    }

    public static function primaryKey(): string {
        return 'id';
    }

    public function getDisplayName(): string {
        return $this->firstname." ".$this->lastname;
    }
}