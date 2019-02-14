<?php
  if(isset($_GET) && isset($_GET['ajax']) && $_GET['ajax'] = true && isset($_SESSION['user']))
  {
    if (isset($_POST) && isset($_POST['id']))
    {
      $db = $GLOBALS['db'];
      $id = $_POST['id'];
      $content = htmlspecialchars($_POST['content']);
      $user = unserialize($_SESSION['user']);
      $query = $db->prepare("INSERT INTO comment values(default, :id_pict, :id_user, :content, default)");
      $query->bindValue(":id_pict", intval($id), PDO::PARAM_INT);
      $query->bindValue(":id_user", $user->getId_user(), PDO::PARAM_INT);
      $query->bindValue(":content", htmlspecialchars($content), PDO::PARAM_STR);
      if ($result = $query->execute())
      {
        $objDateTime = (new DateTime('NOW'))->format(DateTime::ISO8601);
        echo '
        <div class="card bg-secondary">
          <div class="card-body">
            <h5 class="card-title">' . $user->getUsername() . ' <span class="text-muted">' . $objDateTime .'</span></h5>
            <p class="card-text">' . $content . '</p>
          </div>
        </div>';
      }
    }
  }
?>
