<?php

namespace app\models;

class RegisterModel extends Model
{
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $password;
    public string $passwordConfirm;

    public function register()
    {
        echo '<br> creating new user <br>';
    }

    /**
     * Returns array of rules for each input of the model.
     * ---
     * @return array : ['inputName' => [self::RULE_EXAMPLE]]
     */
    public function rules() : array
    {
        return [
            'firstName' =>          [self::RULE_REQUIRED],
            'lastName' =>           [self::RULE_REQUIRED],
            'email' =>              [self::RULE_REQUIRED,
                                     self::RULE_EMAIL],
            'password' =>           [self::RULE_REQUIRED,
                                    [self::RULE_MIN, 'min' =>  8],
                                    [self::RULE_MAX, 'max' => 24]],
            'passwordConfirm' =>    [self::RULE_REQUIRED, 
                                    [self::RULE_MATCH, 'match' => 'password']]
        ];
    }

}