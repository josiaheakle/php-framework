<?php

namespace app\models;

class LoginModel extends Model
{
    public string $email;
    public string $password;

    public function login()
    {
        echo 'login';
    }

    /**
     * Returns array of rules for each input of the model.
     * ---
     * @return array : ['inputName' => [self::RULE_EXAMPLE, ruleParam=>value]]
     */
    public function rules() : array
    {
        return [
            'email' =>              [self::RULE_REQUIRED,
                                     self::RULE_EMAIL],
            'password' =>           [self::RULE_REQUIRED,
                                    [self::RULE_MIN, 'min' =>  8],
                                    [self::RULE_MAX, 'max' => 24]]
        ];
    }

}