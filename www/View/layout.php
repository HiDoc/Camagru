<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Focal .42</title>

    <link rel="icon" href="http://localhost:8888/Core/img/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="/Core/css/bootstrap.min.css" >
    <link rel="stylesheet" href="/Core/css/master.css">
    <link rel="stylesheet" href="/Core/css/minor.css">
  </head>
  <body class="body-<?= $class ?>">
    <div class="container">
      <nav class="navbar navbar-light">
        <img src="http://localhost:8888/Core/img/logo.png" class="navbar-brand logo" alt="logo">
        <span class="navbar-brand d-inline-block align-top" height="30px" alt="">Focal .42</span>
        <?= $header ?>
      </nav>
    </div>
    <?= $content ?>
  </body>
</html>
