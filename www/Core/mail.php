<?php
  function mailto($email, $subject, $message)
  {
    
    echo mailingg($email, "camagru@example.fr", $subject, $message) ? 'response' : 'no response';
  }
 ?>