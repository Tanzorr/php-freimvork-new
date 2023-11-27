<?php

namespace app\models;

use app\core\DbModel;
use app\core\Model;

class User extends DbModel
{
    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';//$confirmPassword

    /**
     * @param string $firstName
     */

    public function tableName(): string
    {
       return 'users';
    }

    public function register()
    {
        return $this->save();
    }

    public function rules(): array
    {
        return [
            'firstName'=>[self::RULE_REQUIRED],
            'lastName'=>[self::RULE_REQUIRED],
            'email'=>[self::RULE_REQUIRED, self::RULE_EMAIL],
            'password'=>[self::RULE_REQUIRED, [self::RULE_MIN, 'min'=>4], [self::RULE_MAX, 'max'=>20]],
            'confirmPassword'=>[self::RULE_REQUIRED, [self::RULE_MATH, 'match'=>'password']],
        ];
    }

    public function attributes(): array
    {
       return ['firstName', 'lastName', 'email', 'password'];
    }

}