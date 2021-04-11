<!-- <form method="post" action=''>
    <label for='email-input'>Email</label>
    <input id='email-input' type='text' name='email' required>
    <br>
    <label for='password-input'>Password</label>
    <input id='password-input' type='password' name='password'> 
    <br>
    <button type='submit'>submit</button>
</form>
<br> -->


<div class="card ">
    <div class="card-content black-text center-align">
        <span class="card-title">Login</span>
        <div class='container center-align column'>
            <?php 
                // echo '<pre>';
                // var_dump($model);
                // echo '</pre>';
                $form = app\core\form\Form::beginForm('post', '');
                    echo $form->field($model, 'email', 'Email', 'email', 'col s8') . '<br>';
                    echo $form->field($model, 'password', 'Password', 'password', 'col s6');
                    app\core\form\Form::submitButton();
                app\core\form\Form::endForm();
            ?>
            <a class='' href='/register'>Create New Account</a>
        </div>
    </div>
</div>