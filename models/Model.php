<?php

namespace app\models;

use EmptyIterator;

abstract class Model {

    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL    = 'email';
    public const RULE_MATCH    = 'match';
    public const RULE_MIN      = 'min';
    public const RULE_MAX      = 'max';

    public array $errors = [];

    /**
     * Returns array of rules for each input of the modal.
     * ---
     * @return array : ['inputName' => [self::RULE_EXAMPLE]]
     */
    abstract public function rules(): array;
    
    /**
     * 
     */
    public function loadData(array $data) 
    {
        foreach($data as $k => $v) {
            if (property_exists($this, $k)) {
                $this->{$k} = $v;
            }
        }
    }


    /**
     * Goes through rules() 
     */
    public function validate()
    {
        foreach ($this->rules() as $inputName => $rules) {
            $value = $this->{$inputName};

            // echo '<pre>', var_dump(['value'=> $value]), '</pre>';
            // echo '<pre>',var_dump(['attribute'=>$inputName]),  '</pre>';

            foreach ($rules as $rule) {
                if(!is_string($rule)) {
                    $ruleName = $rule[0];
            } else $ruleName = $rule;
                if($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($inputName, self::RULE_REQUIRED);
                } else if ($ruleName === self::RULE_EMAIL ) {

                }
            }
        }
        echo '<pre>', var_dump($this->errors), '</pre>';

        return !empty($this->errors);
    }

    public function addError(string $ruleOrigin, string $ruleName) 
    {
        $message = $this->errorMessages()[$ruleName] ?? '';
        $this->errors[$ruleOrigin][] = $message;
    }

    /**
     * Returns array of rule error messages
     * ---
     * @return array [self::RULE_EXAPLE=>'message example']
     */
    public function errorMessages()
    {
        return [
            self::RULE_REQUIRED => 'Required.',
            self::RULE_EMAIL    => 'Must be a valid email address.',
            self::RULE_MIN      => 'Must be at least {min} characters.',
            self::RULE_EMAIL    => 'Must be less than {max} characters.',
            self::RULE_MATCH    => 'Must match {match}.'
        ];
    }

    /**
     * 
     */
    public static function validateString() 
    {

    }

    /**
     * 
     */
    public static function validateEmail() 
    {

    }

    /**
     * 
     */
    public static function createPassword()
    {

    }
}