<?php
  if (isset($_POST['submit'])) :
    include_once("Model/login.php");
  else :
    include_once("View/login.php");
  endif;
?>
