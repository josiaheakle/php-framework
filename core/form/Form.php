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
        //<div class="row"> 
        echo sprintf(' 
        <form class="col s12 center-align" action="%s" method="%s">', $action, $method);
        return new Form();
    }

    /**
     * Echos form closing tag
     * ---
     */
    public static function endForm()
    {
        echo '</form>';
        // </div>

    }

    /**
     * Echos a styled submit buttton
     * ---
     */
    public static function submitButton()
    {
        echo    '<div class="row">
                    <button class="waves-effect waves-light btn " type="submit">submit</button>
                </div>';
    }

    public function field(Model $model, string $fieldName, string $labelText, string $inputType = 'text', string $class = '')
    {
            return new Field($model, $fieldName, $labelText, $inputType, $class);
    }

}