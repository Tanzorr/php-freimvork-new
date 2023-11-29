<?php

namespace app\models;

use app\core\DbModel;
use app\core\Model;

class User extends DbModel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public int  $status = self::STATUS_INACTIVE;
    public string $password = '';
    public string $confirmPassword = '';//$confirmPassword

    /**
     * @param string $firstName
     */

    public function tableName(): string
    {
       return 'users';
    }

    public function save()
    {
        $this->status = self::STATUS_INACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'firstName'=>[self::RULE_REQUIRED],
            'lastName'=>[self::RULE_REQUIRED],
            'email'=>[self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE, 'class'=>self::class
            ]],
            'password'=>[self::RULE_REQUIRED, [self::RULE_MIN, 'min'=>4], [self::RULE_MAX, 'max'=>20]],
            'confirmPassword'=>[self::RULE_REQUIRED, [self::RULE_MATH, 'match'=>'password']],
        ];
    }

    public function attributes(): array
    {
       return ['firstName', 'lastName', 'email','status','password'];
    }

    public function labels(): array
    {
      return [
          'firstName' => 'First Name',
          'lastName' =>'Last Name',
          'email'=>'Email',
          'password' => 'Password',
          'confirmPassword' =>'Confirm Password'

      ];
    }

}