<?php
    if (isset($_SESSION['user']))
      $user = unserialize($_SESSION['user']);
    include_once("View/profile.php");
?>
