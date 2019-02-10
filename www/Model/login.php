<?php
if (isset($_POST['submit']))
{
  if (isset($_POST['password']) && isset($_POST['login'])) {
    if (User::verify($_POST['login'], $_POST['password'])) :
      $_SESSION['user'] = serialize(new User($_POST['login']));
      echo "Authentification successful !";
    else :
      echo "Invalid credentials";
    endif;
  }
  else {
    echo "Please enter your username and your password";
  }
}
?>
