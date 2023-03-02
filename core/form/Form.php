<?php

namespace app\core\form;

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


}