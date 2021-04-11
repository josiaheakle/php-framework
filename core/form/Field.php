<?php

namespace app\core\form;
use app\models\Model;

class Field {

    public Model  $model;
    public string $fieldName;
    public string $labelText;
    public string $inputType;
    public string $classText;

    public function __construct(Model $model, string $fieldName, string $labelText, string $inputType = 'text', string $class = '')
    {

        
        $this->model        = $model;
        $this->fieldName    = $fieldName;
        $this->labelText    = $labelText;
        $this->inputType    = $inputType;
        $this->classText    = $class;
    }

    public function __toString()
    {

 
        return sprintf('<div class="input-field inline %s">
                            <input id="%s" name="%s" type="%s" class="validate"' . $this->getInputHtmlRules($this->fieldName) . ' value="%s">' .
                            '<label for="%s">%s</label>' . 
                            ($this->model->hasError($this->fieldName) ? 
                            implode("", array_map(function($error) {
                                return '<span class="helper-text" data-error="" data-success="">' . $error . '</span>';
                            }, $this->model->getFieldErrors($this->fieldName))) : '') .
                       '</div>',
                        $this->classText ?? '',
                        $this->fieldName ?? '',
                        $this->fieldName ?? '',
                        $this->inputType ?? '',
                        $this->model->{$this->fieldName} ?? '',
                        $this->fieldName ?? '',
                        $this->labelText ?? '',
                        ($this->model->hasError($this->fieldName) ? $this->model->errors[$this->fieldName][0] : ''));
        
    }

    /**
     * Gets rules from model, returns html string for input 
     * ---
     * @param string inputField
     * @return string : ex. max='8', required, ect
     */
    public function getInputHtmlRules(string $inputField) : string
    { 
        
        $ruleStr = '';
        $rules   = $this->model->rules()[$inputField];
        foreach($rules as $rule) {
            if(is_string($rule)) {
                if($rule === 'required') {
                    $ruleStr .= ' required';
                }
            } else if (is_array($rule) ) {
                if($rule[0] === 'min' || $rule[0] === 'max' ) {
                    $ruleStr .= ' ' . $rule[0] . 'length="' . $rule[$rule[0]] . '" ';
                }
            }
        }
        return $ruleStr;
    }

}