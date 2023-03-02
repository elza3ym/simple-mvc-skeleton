<?php

namespace app\core;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\core
 **/
interface Migration {
    public function up(): void;
    public function down(): void;
}