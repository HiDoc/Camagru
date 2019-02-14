<?php
  function mailto($email, $subject, $message)
  {
    echo mail($email, "camagru@example.fr", $subject, $message) ? 'response' : 'no response';
  }
 ?>