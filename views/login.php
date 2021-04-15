<div class="card ">
    <div class="card-content black-text center-align">
        <span class="card-title">Login</span>
        <div class='container center-align column'>
            <?php 
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