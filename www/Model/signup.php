<?php
  function create_new_user($POST)
  {
    $error = "";
    if (User::exists($POST['username']))
      return ("Username already exists");
    else {
      unset($POST['submit']);
      $arr = html_array($POST);
      $error = (User::create($arr));
      return ($error);
    }
    return ("Error, please verify fields");
  }
 ?>
