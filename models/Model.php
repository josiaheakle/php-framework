<?php

namespace app\models;

abstract class Model {

    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL    = 'email';
    public const RULE_MATCH    = 'match';
    public const RULE_MIN      = 'min';
    public const RULE_MAX      = 'max';

    public array $errors = [];

    /**
     * Returns array of rules for each input of the model.
     * ---
     * @return array : ['inputName' => [self::RULE_EXAMPLE]]
     */
    abstract public function rules(): array;
    
    /**
     * Loads array of input following class attributes
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
     * Goes through custom set rules() to validate each input
     * ---
     * @return bool : True if no errors 
     */
    public function validate() : bool
    {
        foreach ($this->rules() as $inputName => $rules) {
            $value = $this->{$inputName} ?? '';
            foreach ($rules as $rule) {
                if(!is_string($rule)) {
                    $ruleName = $rule[0];
                } else $ruleName = $rule;
                if($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($inputName, self::RULE_REQUIRED);
                } else if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL) ) {
                    $this->addError($inputName, self::RULE_EMAIL);
                } else if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addError($inputName, self::RULE_MAX, $rule);
                } else if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addError($inputName, self::RULE_MIN, $rule);
                } else if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addError($inputName, self::RULE_MATCH, $rule);
                }
            }
        }
        return !empty($this->errors);
    }

    /**
     * Adds validation error to error array, 
     * ---
     * @param string $ruleOrigin : incorrect input field name
     * @param string $ruleName   : self::RULE_CONST
     * @param array $params      : ruleParam=>value
     * @return void
     */
    public function addError(string $ruleOrigin, string $ruleName, array $params =[]) 
    {
        $message = $this->errorMessages()[$ruleName] ?? '';
        foreach($params as $rule => $value) {
            $message = str_replace('{' . $rule . '}', $value, $message);
        }
        $this->errors[$ruleOrigin][] = $message;
    }

    /**
     * Returns array of rule error messages
     * ---
     * @return array [self::RULE_EXAPLE=>'message example']
     */
    public function errorMessages() : array
    {
        return [
            self::RULE_REQUIRED => 'Required.',
            self::RULE_EMAIL    => 'Must be a valid email address.',
            self::RULE_MIN      => 'Must be at least {min} characters.',
            self::RULE_MAX      => 'Must be less than {max} characters.',
            self::RULE_MATCH    => 'Must match {match}.'
        ];
    }

    /** 
     * Returns bool if specified input has error
     * ---
     * @param string @$inputName
     * @return bool  True if there is an error, false otherwise
     */
    public function hasError(string $inputName) : bool
    {
        if(!empty($this->errors[$inputName]) && !is_null($this->errors[$inputName])) {
            return true;
        } return false;
    }

    /**
     * Gets all errors for input field
     * ---
     * @return array : errors
     */
    public function getFieldErrors(string $inputName)  : array
    {
        if(!empty($this->errors[$inputName]) && !is_null($this->errors[$inputName])) {
            return $this->errors[$inputName];
        } return [];
    }
}