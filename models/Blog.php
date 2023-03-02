<?php

use app\core\DbModel;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 **/
class Blog extends DbModel {
    private string $title;
    private string $description;
    private string $image;

    private int $userId;
    public function fillables(): array {
        return [
            'title', 'description', 'image', 'userId'
        ];
    }

    public function rules(): array {
        return [
            'title' => [
                self::RULE_REQUIRED,
                self::RULE_MIN => [
                    self::RULE_MIN => 8
                ]
            ],
            'description' => [
                self::RULE_REQUIRED,
                self::RULE_MIN => [
                    self::RULE_MIN => 8
                ]
            ],
        ];
    }

    public function labels(): array {
        return [
            'title' => 'Title',
            'description' => 'Blog Description',
            'image' => 'Image URL',
        ];
    }
}