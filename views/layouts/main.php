<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href=<?php echo "/css/main.css"; ?>>
    <title><?php echo app\core\Application::$APP_NAME; ?></title>
</head>
<body>



<nav class='navbar'>
    <h2 class='navbar-title'> <?php echo app\core\Application::$APP_NAME; ?> </h2>
    <div class='navbar-links'>
        <a class='navbar-link' href="/">Home</a>
        <a class='navbar-link' href="/login">Login</a>
        <a class='navbar-link' href="/contact">Contact</a>
    </div>
</nav>

    <main>
        {{content}}
    </main>

</body>
</html>