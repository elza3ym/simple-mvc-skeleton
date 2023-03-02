<?php

namespace app\core\form;

use app\core\Model;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\core\form
 **/
class Form {
    public static function begin(string $action, string $method) {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public static function end() {
        echo '</form>';
    }

    public function field(Model $model, string $attribute) {
        return new Field($model, $attribute);
    }
}