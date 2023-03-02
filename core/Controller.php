<?php

namespace app\core;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\core
 **/
abstract class Controller {
    protected string $layout = 'main';

    /**
     * @return string
     */
    public function getLayout(): string {
        return $this->layout;
    }

    /**
     * @param string $layout
     */
    public function setLayout(string $layout): void {
        $this->layout = $layout;
    }
}