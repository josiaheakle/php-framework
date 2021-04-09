<?php

namespace app\core\form;
use app\models\Model;

class Form {

    /**
     * Echos form opening tag using method and action provided, returns new form instance
     * ---
     * @param string $method : form method
     * @param string $action : form action
     * @return form          : form opening tag
     */
    public static function beginForm(string $method, string $action='') : Form
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    /**
     * Echos form closing tag
     * ---
     * @return string form closeing tag
     */
    public static function endForm()
    {
        echo '</form>';

    }

    public function field(Model $model, string $fieldName, string $labelText, string $inputType = 'text')
    {
            return new Field($model, $fieldName, $labelText, $inputType);
    }

}