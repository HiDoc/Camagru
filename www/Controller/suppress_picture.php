<?php
  if(isset($_GET) && isset($_GET['ajax']) && $_GET['ajax'] = true && isset($_SESSION['user']))
  {
    if (isset($_POST) && isset($_POST['id']))
    {
      $db = $GLOBALS['db'];
      $id = $_POST['id'];
      $user = unserialize($_SESSION['user']);
      $query = $db->query("SELECT * FROM pictures p WHERE p.id_pict=" . $id . ' AND p.user_id =' . $user->getId_user());
      $count = $query->rowCount();
      if ($count == 1)
      {
        $picture = $query->fetch(PDO::FETCH_ASSOC);
        $pict = new Picture();
        $pict->hydrate($picture, false, false);
        if ($pict->suppress())
        {
          echo '
          <div class="row mb-2">
            <div class="col-md-12 mb-0">
              <div class="alert alert-warning" role="alert"> Picture removed </div>
            </div>
          </div>
          ';
        }
      }
    }
  }
?>
