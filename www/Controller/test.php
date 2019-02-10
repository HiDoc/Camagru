<?php
if (isset($_SESSION['user']) && isset($_POST['test'])) :
  $picture = new Picture();
  $picture->create($_POST);
  $picture->insert(unserialize($_SESSION['user']));
endif;
?>
