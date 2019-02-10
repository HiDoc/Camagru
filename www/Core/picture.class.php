<?php

class Picture
{
  private $_id_pict;
  private $_user_id;
  private $_username;
  private $_path;
  private $_title;
  private $_description;
  private $_likes;
  private $_comment;
  private $_userLog;
  private $_explore;

  function __construct()
  {
    foreach (get_object_vars($this) as $key => $value) {
      $this->$key = "";
    }
    $this->_explore = false;
  }

  public function hydrate($data = [], $userLog, $explore) {
    foreach ($data as $key => $value)
    {
      $method = 'set'.ucfirst($key);
      if (method_exists($this, $method))
        $this->$method($value);
    }
    $this->_userLog = $userLog;
    $this->_explore = $explore;
  }

  public function __toString(){
    $group = "";
    $group .= '<div class="col-lg-3 col-md-4 col-sm-6 portfolio-item" id="picture-'. $this->_id_pict .'">';
    $group .=  '<div class="card h-100">';
    $group .=    '<a href="post/' . $this->_id_pict . '">';
    $group .=     '<img class="card-img-top" src=" http://localhost:8888/Storage/' . $this->_path .'" alt=""></a>';
    $group .=    '<div class="card-body">';
    $group .=      '<h4 class="card-title">';
    $group .=        '<a href="post/' . $this->_id_pict . '">' . htmlspecialchars($this->_title) . '</a> - <small> ' . htmlspecialchars($this->_username) . '</small>';
    if (!$this->_explore)
    {
      $group .=        '<p class="pull-right"><span class="badge primary">'
      . $this->_likes . ' <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></span>';
      $group .=        ' <span class="badge success">'
      . $this->_comment . ' <span class="glyphicon glyphicon-comment" aria-hidden="true"></span></span>';
    } else {
      $class = 'like';
      if ($this->getUserLike() == 1) $class = 'unlike';
      $group .=        '<p class="pull-right"><button id="like-'. $this->_id_pict .'"class="push '. $class .' badge primary">'
                        . $this->_likes . ' <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></button>';
      $group .=        ' <button id="'. $this->_id_pict .'"class="comment badge success">'
                        . $this->_comment . ' <span class="glyphicon glyphicon-comment" aria-hidden="true"></span></button>';
    }
    $group .=      '</p></h4>';
    $group .= $this->_userLog ? '<button class="btn btn-danger remove" id="remove-'. $this->_id_pict .'"> x </button>' : ''; 
    $group .=      '<p class="card-text">' . htmlspecialchars($this->_description) .'</p>';
    $group .=    '</div>';
    $group .=  '</div>';
    $group .='</div>';
    return ($group);
  }

  public function insert($user) {
    $db = $GLOBALS['db'];
    $id = $user->getId_user();
    $query = $db->prepare("INSERT INTO pictures (id_pict, user_id, path, description, creation_time, title)
     values(default, :id, :path, :description, default, :title);");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->bindValue(":title", htmlspecialchars($this->_title), PDO::PARAM_STR);
    $query->bindValue(":description", htmlspecialchars($this->_description), PDO::PARAM_STR);
    $query->bindValue(":path", htmlspecialchars($this->_path), PDO::PARAM_STR);
    return ($query->execute());
  }

  public function merge ($logo, $shirt) {
    $logo = imagecreatefrompng("logo.png");
    $shirt = imagecreatefrompng("shirt.png");
    $logo_x = imagesx($logo); 
    $logo_y = imagesy($logo);
    imagecopy($shirt, $logo, 0, 0, 0, 0, $logo_x, $logo_y);
    header('Content-Type: image/png');
    imagepng($shirt);
    imagedestroy($shirt);
    imagedestroy($logo);
  }

  public function create($post) {
    $img = $post['test'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $path = uniqid() . ".png";
    file_put_contents("/var/www/html/Storage/" . $path, $data);
    $this->_path = $path;
    $this->_title = htmlspecialchars($post['title']);
    $this->_description = htmlspecialchars($post['description']);
  }

  public function like ($id) {
    $db = $GLOBALS['db'];
    $query = $db->prepare("INSERT INTO likes values(:pict_id,	:likes_id, :liked_id)");
    $query->bindValue(":pict_id", $this->_id_pict, PDO::PARAM_INT);
    $query->bindValue(":likes_id", $this->_user_id, PDO::PARAM_INT);
    $query->bindValue(":liked_id", $id, PDO::PARAM_INT);
    return ($query->execute());
  }

  public function unlike ($id) {
    $db = $GLOBALS['db'];
    $query = $db->prepare("DELETE FROM likes WHERE pict_id = :id_pict AND likes_id = :likes_id AND liked_id = :liked_id");
    $query->bindValue(":id_pict", $this->_id_pict, PDO::PARAM_INT);
    $query->bindValue(":likes_id", $this->_user_id, PDO::PARAM_INT);
    $query->bindValue(":liked_id", $id, PDO::PARAM_INT);
    return ($query->execute());
  }
  private function getUserLike() {
    if (isset($_SESSION['user']))
    {
      $user = unserialize($_SESSION['user']);
      $id = $user->getId_user();
      $db = $GLOBALS['db'];
      $query = $db->prepare("SELECT * FROM likes WHERE pict_id = :id_pict AND likes_id = :likes_id AND liked_id = :liked_id");
      $query->bindValue(":id_pict", $this->_id_pict, PDO::PARAM_INT);
      $query->bindValue(":likes_id", $this->_user_id, PDO::PARAM_INT);
      $query->bindValue(":liked_id", $id, PDO::PARAM_INT);
      $query->execute();
      $count = $query->rowCount();
      return ($count == 1);
    }
    return (0);
  }
  public function suppress() {
    $db = $GLOBALS['db'];
    $query = $db->prepare("DELETE FROM pictures WHERE id_pict = :id_pict");
    $query->bindValue(":id_pict", $this->_id_pict, PDO::PARAM_INT);
    $ret = $query->execute();
    $query = $db->prepare("DELETE FROM likes WHERE id_pict = :id_pict");
    $query->bindValue(":id_pict", $this->_id_pict, PDO::PARAM_INT);
    $ret = $ret && $query->execute();
    $query = $db->prepare("DELETE FROM comment WHERE id_pict = :id_pict");
    $query->bindValue(":id_pict", $this->_id_pict, PDO::PARAM_INT);
    $ret = $ret && $query->execute();
    return (unlink("/var/www/html/Storage/" . $this->_path) && $ret);
  }

  private function setId_pict($val) { $this->_id_pict = $val; }
  private function setUser_id($val) { $this->_user_id = $val; }
  private function setUsername($val) { $this->_username = $val; }
  private function setPath($val) { $this->_path = $val; }
  private function setTitle($val) { $this->_title = $val; }
  private function setDescription($val) { $this->_description = $val; }
  private function setLikes($val) { $this->_likes = $val; }
  private function setComment($val) { $this->_comment = $val; }

  public function getId_pict() { return $this->_id_pict; }
  public function getUser_id() { return $this->_user_id; }
  public function getUsername() { return $this->_username; }
  public function getPath() { return $this->_path; }
  public function getTitle() { return $this->_title; }
  public function getDescription() { return $this->_description; }
  public function getLikes() { return $this->_likes; }
  public function getComment() { return $this->_comment; }

}
?>
