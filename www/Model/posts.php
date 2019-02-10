<?php
function hydratePictures(){
  $db = $GLOBALS['db'];
  $user = unserialize($_SESSION['user']);
  $query = $db->query("SELECT p.id_pict, p.user_id,
    u.username, p.path, p.title, p.description,
    (SELECT count(*) FROM likes l where p.id_pict = l.pict_id) AS likes,
    (SELECT count(*) FROM comment c where p.id_pict = c.pict_id) AS comment
    FROM pictures p, users u WHERE u.id_user = p.user_id AND u.id_user =". $user->getId_user());
  while ($result = $query->fetch(PDO::FETCH_ASSOC))
  {
    $picture = new Picture();
    $picture->hydrate($result, true, false);
    echo $picture->__toString();
  }
}
 ?>
