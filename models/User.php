<?php

namespace app\models;

use app\core\DbModel;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\models
 **/
class User extends DbModel {

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

    public function tableName(): string {
        return 'users';
    }
}