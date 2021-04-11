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



<?php

    
    // $path = ucwords(substr(\app\core\Application::$app->request->getPath(), 1));

?>

    <main class='container'>
        {{content}}
    </main>

    <script src='/js/materialize.min.js' ></script>
    <script>
    M.AutoInit();
    </script>
</body>
</html>