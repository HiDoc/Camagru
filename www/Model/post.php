<?php
$count = 0;
function hydratePictures(){
  $db = $GLOBALS['db'];
  $user = unserialize($_SESSION['user']);
  $query = $db->query("SELECT p.id_pict, p.user_id,
    u.username, p.path, p.title, p.description,
    (SELECT count(*) FROM likes l where p.id_pict = l.pict_id) AS likes,
    (SELECT count(*) FROM comment c where p.id_pict = c.pict_id) AS comment
    FROM pictures p, users u WHERE u.id_user = p.user_id AND p.id_pict =". $_GET['posts']);
  while ($result = $query->fetch(PDO::FETCH_ASSOC))
  {
    $picture = new Picture();
    $picture->hydrate($result, false, true);
    echo $picture->__toString();
    $count++;
  }
  if ($count == 0)
    echo "No picture found";
}
function hydrateComments() {
  $db = $GLOBALS['db'];
  $user = unserialize($_SESSION['user']);
  $query = $db->query("SELECT u.username, c.content, c.created
                      FROM pictures p, users u, comment c 
                      WHERE u.id_user = c.user_id
                      AND p.id_pict = ". $_GET['posts']);
  while ($result = $query->fetch(PDO::FETCH_ASSOC))
  {
    echo '<div class="row">';
    echo '
    <div class="card bg-secondary">
      <div class="card-body">
        <h5 class="card-title">' . htmlspecialchars($result['username']) . ' <span class="text-muted">' . $result['created'] .'</span></h5>
        <p class="card-text">' . htmlspecialchars($result['content']) . '</p>
      </div>
    </div>';
    echo '</div>';
  }
}
 ?>
