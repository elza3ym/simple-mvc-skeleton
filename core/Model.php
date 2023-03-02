<?php

namespace app\core;

/**
 * @author Mohamed A. Shehata <elza3ym@icloud.com>
 * @package app\core
 **/
abstract class Model {
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    private array $errors = [];

    abstract public function rules(): array;
    abstract public function labels(): array;

    public function loadData($data) {
        foreach ($data as $attribute => $value) {
            if (property_exists($this, $attribute)) {
                $this->{$attribute} = $value;
            }
        }
    }

    public function validate() {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($rule)) {
                    $ruleName = $rule[0];
                }

                if ($ruleName == self::RULE_REQUIRED && !$value) {
                    $this->addErrorForRule($attribute, self::RULE_REQUIRED);
                }

                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addErrorForRule($attribute, self::RULE_EMAIL);
                }

                if ($ruleName === self::RULE_MIN) {
                    var_dump(strlen($value) < $rule[self::RULE_MIN]);
                    die();
                    $this->addErrorForRule($attribute, self::RULE_MIN, $rule);
                }

            }
        }
        return empty($this->errors);
    }

    protected function addErrorForRule(string $attribute, string $rule, array $params = []) {
        $message = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function addError(string $attribute, string $message) {
        $this->errors[$attribute][] = $message;
    }

    private function errorMessages(): array {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MAX => 'max length of this field must be {max}',
        ];
    }

    public function hasError(string $attribute) {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError(string $attribute) {
        return $this->errors[$attribute][0] ?? false;
    }

    public function getLabel(string $attribute) {
        return $this->labels()[$attribute] ?? $attribute;
    }
}