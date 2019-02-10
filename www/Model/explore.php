<?php
  function hydratePictures(){
    $db = $GLOBALS['db'];
    $user = false;
    if (isset($_SESSION['user'])) $user = unserialize($_SESSION['user']);
    $query = $db->query("SELECT p.id_pict, p.user_id,
      u.username, p.path, p.title, p.description,
      (SELECT count(*) FROM likes l where p.id_pict = l.pict_id) AS likes,
      (SELECT count(*) FROM comment c where p.id_pict = c.pict_id) AS comment
      FROM pictures p, users u WHERE u.id_user = p.user_id "
      . ($user !== false ? 'AND u.id_user <> ' . $user->getId_user() : '')
      . " ORDER BY likes LIMIT 12 ");
    if ($query !== false)
    {
      while ($result = $query->fetch(PDO::FETCH_ASSOC))
      {
        $picture = new Picture();
        $picture->hydrate($result, false, isset($_SESSION['user']));
        echo $picture->__toString();
      }
    }
  }
?>
