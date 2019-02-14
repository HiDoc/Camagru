<?php
  include_once("Model/signup.php");
  $error = "";
  function echoError($err) {
    echo '<div class="container">';
    echo '<div class="row">';
    echo '<div class="alert alert-danger" role="alert">';
    echo $err;
    echo '</div>';
    echo '</div>';
    echo '</div>';
  }
  if (isset($_POST['submit']))
  {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      echoError("invalid email adress");
    }
    else if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $_POST['password']))
      echoError("Invalid Password");
    else if (!preg_match('/^\w{5,20}$/', $_POST['username']))
      echoError("Username must be alpha and contains between 5 and 20 characters");
    else
      if (($error = create_new_user($_POST)) === true) :
        include_once("View/signup-success.php");
      else :
        echoError($error);
      endif;
  }
  if ($error !== true)
    include_once("View/signup.php");
?>
