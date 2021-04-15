<?php

namespace app\models;

use app\core\Application;
use app\utils\Util;

class LoginModel extends Model
{
    public string $email;
    public string $password;

    /**
     * Validates, returns 
     */
    public function login()
    {
        if($this->validate()) {
            $sql  = "SELECT * FROM users WHERE email=? AND deleted IS NULL LIMIT 1 ";
            $stmt = self::$mysqli->prepare($sql);
            $stmt->bind_param('s', $this->email);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            Util::logDebug(DEBUG_PATH, ['LOGIN STMT'=>$stmt->get_result()]);
            Util::logDebug(DEBUG_PATH, ['LOGIN VALIDATION RESULT'=>$result]);
            Util::logDebug(DEBUG_PATH, ['MYSQL ERROR'=>self::$mysqli->error]);
            if(!is_null($result)) {
                $pass_verify = password_verify($this->password, $result['password']);
                if($pass_verify) {
                    return $result;
                }
            } return false;
        }
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