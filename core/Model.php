<?php

namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATH = 'match';
    public function loadData($data)
    {
        foreach ($data as $key => $value){
            if(property_exists($this, $key)){
                $this->{$key} = $value;
            }
        }
    }


    abstract public function rules(): array;

    public array $errors = [];
    public function validate(): bool
    {
        foreach ($this->rules() as $attribute => $rules) {
            if (isset($this->{$attribute})) {
                $value = $this->{$attribute};
                foreach ($rules as $rule) {
                    $ruleName = $rule;

                    if (!is_string($ruleName)) {
                        $ruleName = $rule[0];
                    }

                    if ($ruleName === self::RULE_REQUIRED && !$value) {
                        $this->addError($attribute, self::RULE_REQUIRED);
                    }

                    if($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)){
                        $this->addError($attribute, self::RULE_EMAIL);
                    }
                    if($ruleName === self::RULE_MIN && strlen($value) < $rule['min']){
                        $this->addError($attribute, self::RULE_MIN, $rule);
                    }
                    if($ruleName === self::RULE_MAX && strlen($value) > $rule['max']){
                        $this->addError($attribute, self::RULE_MIN, $rule);
                    }

                    if($ruleName === self::RULE_MATH && $value !== $this->{$rule['match']}){
                        $this->addError($attribute, self::RULE_MATH, $rule);
                    }
                }
            }
        }
        return empty($this->errors);
    }

    private function addError(string $attribute, string $rule, $params = [])
    {
        $message = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $value){
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages()
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_MIN => 'This length of the field must be {min}',
            self::RULE_MAX=> 'This length of the field must be {max}',
            self::RULE_MATH => 'This field must be the same as {match}'
        ];
    }

    public function hasError(string $attribute): void
    {
    }

    public function getFirstError(string $attribute)
    {
    }

}