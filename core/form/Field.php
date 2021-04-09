<?php

namespace app\core\form;
use app\models\Model;

class Field {

    public Model  $model;
    public string $fieldName;
    public string $labelText;
    public string $inputType;

    public function __construct(Model $model, string $fieldName, string $labelText, string $inputType = 'text')
    {

        
        $this->model        = $model;
        $this->fieldName    = $fieldName;
        $this->labelText    = $labelText;
        $this->inputType    = $inputType;
    }

    public function __toString()
    {

        $hasError = $this->model->hasError($this->fieldName);

        return sprintf('<label for="%s">%s</label>
                        <input type="%s" id="%s" name="%s" value="%s" class="%s" >' .
                        ($hasError ? '<span class="error-text">%s</span>' : ''),
                        $this->fieldName,
                        $this->labelText,
                        $this->inputType,
                        $this->fieldName,
                        $this->fieldName,
                        $this->model->{$this->fieldName},
                        $hasError ? 'error' : '',
                        ($hasError ? $this->model->errors[$this->fieldName][0] : ''));
        
    }

}