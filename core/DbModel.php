<?php

namespace app\core;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\core
 **/
abstract class DbModel extends Model {

    abstract public function fillables(): array;
    public function save() {
        // TODO: Implement this to store to DB
    }
}