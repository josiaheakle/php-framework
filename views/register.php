<?php 

    $form = app\core\form\Form::beginForm('post', '');

        echo '<pre>';
        var_dump($model->errors);
        echo '</pre>';


        echo $form->field($model, 'firstName', 'First Name') . '<br>';
        echo $form->field($model, 'lastName', 'Last Name'). '<br>';
        echo $form->field($model, 'email', 'Email'). '<br>';
        echo $form->field($model, 'password', 'Password', 'password'). '<br>';
        echo $form->field($model, 'passwordConfirm', 'Confirm Password', 'password'). '<br>';
        ?><button type='submit'>submit</button><?php

    app\core\form\Form::endForm();

?>


<!-- <form method="post" action=''>
    <label for='email-input'>Email</label>
    <input id='email-input' type='email' name='email' >
    <br>
    <label for='first-name-input'>First Name</label>
    <input id='first-name-input' type='text' name='firstName' >
    <br>
    <label for='last-name-input'>Last Name</label>
    <input id='last-name-input' type='text' name='lastName' >
    <br>
    <label for='password-input'>Password</label>
    <input id='password-input' type='password' name='password'> 
    <br>
    <label for='password-repeat-input'>Confirm Password</label>
    <input id='password-repeat-input' type='password' name='passwordConfirm'> 
    <br>
    <button type='submit'>submit</button>
</form> -->
<br>
<a href='/login'>Use existing account</a>