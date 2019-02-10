<?php
  if (isset($_GET) && isset($_GET['ajax']) && $_GET['ajax'] = true && isset($_SESSION['user']) && isset($_POST))
  {
    if (isset($_POST['submit']))
    {
      $user = unserialize($_SESSION['user']);
      if (isset($_POST['bio']) && $_POST['bio'] !== '') htmlspecialchars($user->setBio($_POST['bio']));
      if (isset($_POST['location']) && $_POST['location'] !== '') htmlspecialchars($user->setLocation($_POST['location']));
      if (isset($_POST['name']) && $_POST['name'] !== '') htmlspecialchars($user->setName($_POST['name']));
      $user->update();
      $_SESSION['user'] = serialize($user);
      echo '
      <div class="col-md-12 mb-0">
        <div class="alert alert-success mb-0" role="alert"> Updated </div>
      </div>
      ';
    }
  }
?>
