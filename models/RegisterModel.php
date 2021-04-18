<?php

namespace app\models;

use app\core\Application;
use app\utils\Util;

class RegisterModel extends Model
{
    public static string $tableName = 'users';
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $password;
    public string $passwordConfirm;

    // public function __construct()
    // {
    //     parent::__construct();
    //     self::$tableName = 'users';
    // }

    /**
     * Validates
     * ---
     * @return int|false : int if user created, false if otherwise
     */
    public function register()
    {

        if($this->validate()) {

            $sql    = " INSERT INTO users (uniqueID, firstName, lastName, email, password, created) VALUES( "
                    . " ?, ?, ?, ?, ?, ?); ";
            $stmt   = self::$mysqli->prepare($sql);



            $uID        = Util::generateUniqueID();
            $hashedPass = password_hash($this->password, PASSWORD_BCRYPT);
            $dateNow    = Util::dateNow();

            $stmt->bind_param(  'ssssss', 
                                $uID, 
                                $this->firstName,
                                $this->lastName,
                                $this->email,
                                $hashedPass,
                                $dateNow
            );

            $stmt->execute();
            

            return true;

        } return false;
    }

    /**
     * Returns array of rules for each input of the model.
     * ---
     * @return array : ['inputName' => [self::RULE_EXAMPLE, ruleParam=>value]]
     */
    public function rules() : array
    {
        return [
            'firstName' =>          [self::RULE_REQUIRED],
            'lastName' =>           [self::RULE_REQUIRED],
            'email' =>              [self::RULE_REQUIRED,
                                     self::RULE_EMAIL,
                                    [self::RULE_UNIQUE, 'column'=>'email']],
            'password' =>           [self::RULE_REQUIRED,
                                    [self::RULE_MIN, 'min' =>  8],
                                    [self::RULE_MAX, 'max' => 24]],
            'passwordConfirm' =>    [self::RULE_REQUIRED, 
                                    [self::RULE_MATCH, 'match' => 'password']],
            
        ];
    }

}