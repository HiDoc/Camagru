<?php
if (isset($_POST['submit']))
{
  if (isset($_POST['password']) && isset($_POST['login'])) {
    if (User::verify($_POST['login'], $_POST['password'])) :
      $user = new User($_POST['login']);
      if ($user->getActive() == 1) :
        $_SESSION['user'] = serialize(new User($_POST['login']));
        echo "Authentification successful !";
      else :
          echo "You must activate your account !";
      endif;
    else :
      echo "Invalid credentials";
    endif;
  }
  else {
    echo "Please enter your username and your password";
  }
}
?>
