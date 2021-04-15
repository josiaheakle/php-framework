<div class="card ">
    <div class="card-content black-text center-align">
        <span class="card-title">Register</span>
        <div class='container center-align column'>
            <?php 
                $form = app\core\form\Form::beginForm('post', '');

                    echo $form->field($model, 'firstName', 'First Name', 'text', 'col s6');
                    echo $form->field($model, 'lastName', 'Last Name', 'text', 'col s6') . '<br>';
                    echo $form->field($model, 'email', 'Email', 'email', 'col s8') . '<br>';
                    echo $form->field($model, 'password', 'Password', 'password', 'col s6');
                    echo $form->field($model, 'passwordConfirm', 'Confirm Password', 'password', 'col s6');
                    ?>

                    <?php
                app\core\form\Form::submitButton();
                app\core\form\Form::endForm();

            ?>
            <a class='' href='/login'>Use existing account</a>
        </div>






    </div>
        <!-- <div class="card-action">
            <a href="#">This is a link</a>
            <a href="#">This is a link</a>
        </div> -->
</div>

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