<?php

namespace app\models;

use app\core\Model;

class RegisterModel extends Model
{
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $password;
    public string $confirmPassword;

    /**
     * @param string $firstName
     */


    public function register()
    {
        echo "Create new User";

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

}