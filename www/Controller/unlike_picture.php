<?php
  if(isset($_GET) && isset($_GET['ajax']) && $_GET['ajax'] = true && isset($_SESSION['user']))
  {
    if (isset($_POST) && isset($_POST['id']))
    {
      $db = $GLOBALS['db'];
      $id = $_POST['id'];
      $user = unserialize($_SESSION['user']);
      $query = $db->query("SELECT * FROM pictures p WHERE p.id_pict=" . $id);
      $count = $query->rowCount();
      if ($count == 1)
      {
        $picture = $query->fetch(PDO::FETCH_ASSOC);
        $pict = new Picture();
        $pict->hydrate($picture, false, false);
        if ($pict->unlike($user->getId_user()))
          echo "1";
        else
          echo "0";
      }
      echo "0";
    }
  }
?>
