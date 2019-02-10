<?php
  if(isset($_GET) && isset($_GET['ajax']) && $_GET['ajax'] = true && isset($_SESSION['user']))
  {
    $user = unserialize($_SESSION['user']);
    include_once("View/profile_edit.php");
  }
?>
