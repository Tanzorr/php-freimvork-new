<?php
use app\core\Application;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap 5 Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">WebSiteName</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="/">Home</a></li>
            <li><a href="/contacts">Contacts</a></li>
            <li><a href="/#">Page 2</a></li>
            <li><a href="/#">Page 3</a></li>
        </ul>
        <ul class="nav navbar-nav mr-right">
            <li><a href="/login">Login</a></li>
            <li><a href="/register">Register</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <?php if(Application::$app->session->getFlash('success')):?>
    <div class="alert alert-success">
         <?php echo Application::$app->session->getFlash('success')?>
    </div>
    <?php endif; ?>
    {{ content }}
</div>


</body>
</html>
