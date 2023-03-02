<?php

namespace app\core\form;

use app\core\Model;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\core\form
 **/
class Field {
    private string $inputType = 'text';

    /**
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute) {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString(): string {
        return sprintf('
            <div class="form-group">
                <label class="form-label">%s</label>
                <input type="%s" name="%s" value="%s" class="form-control %s" >
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
        ',
            $this->model->getLabel($this->attribute),
            $this->inputType,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->model->getFirstError($this->attribute)
        );
    }

    public function passwordField() {
        $this->inputType = 'password';
        return $this;
    }

    public function emailField() {
        $this->inputType = 'email';
        return $this;
    }
}