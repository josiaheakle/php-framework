<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href="/css/materialize.min.css">
    <title><?php echo app\core\Application::$APP_NAME; ?></title>
</head>
<body>



    <nav>
        <div class="nav-wrapper container">
            <a href="/" class="brand-logo">Logo</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="/login">Login</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </div>
    </nav>

    <main>
        {{content}}
    </main>


    <script src='/js/materialize.min.js' ></script>
</body>
</html>