<?php

class User {
    private $_id_user;
    private $_username;
    private $_name;
    private $_email;
    private $_bio;
    private $_location;
    private $_active;
    private $_posts;

    public function __construct($username = "") {
        $db = $GLOBALS['db'];
        $username = htmlspecialchars($username);
        $query = $db->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);
        $this->hydrate($user);
        $query = $db->prepare("SELECT count(*) as posts FROM pictures where user_id =". $this->_id_user);
        $query->execute();
        $posts = $query->fetch(PDO::FETCH_ASSOC);
        $this->_posts = $posts;
    }

    public function hydrate($data = []) {
      foreach ($data as $key => $value)
      {
        $method = 'set'.ucfirst($key);
        if (method_exists($this, $method))
          $this->$method(htmlspecialchars($value));
      }
    }

    static public function exists($username){
      $db = $GLOBALS['db'];
      $query = $db->prepare("SELECT * FROM users WHERE username=:username");
      $query->bindParam(':username', htmlspecialchars($username), PDO::PARAM_STR);
      $query->execute();
      return ($query->rowCount() > 0);
    }
    
    static public function verify($username, $password){
      $db = $GLOBALS['db'];
      $username = htmlspecialchars($username);
      $query = $db->prepare("SELECT * FROM users WHERE username=:username");
      $query->bindParam(':username', $username, PDO::PARAM_STR);
      $query->execute();
      $user = $query->fetch(PDO::FETCH_ASSOC);
      return (password_verify($password, $user['password']));
    }

    static public function create($arr = []){
      $db = $GLOBALS['db'];

      if ($arr['password'] != $arr['verify_password'])
        return ("Incorrect Password");
      $query = $db->prepare('INSERT INTO users (username, name, email, bio, location, active, id_user, password)
      values(:username, :name, :email, :bio, :location, default, default, :password)');
      $query->bindParam(':username', htmlspecialchars($arr['username']), PDO::PARAM_STR);
      $query->bindParam(':name', htmlspecialchars($arr['name']), PDO::PARAM_STR);
      $query->bindParam(':email', htmlspecialchars($arr['email']), PDO::PARAM_STR);
      $query->bindParam(':bio', htmlspecialchars($arr['bio']), PDO::PARAM_STR);
      $query->bindParam(':location', htmlspecialchars($arr['location']), PDO::PARAM_STR);
      $query->bindParam(':password', password_hash($arr['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
      try {
        mailto(htmlspecialchars($arr['email']), 'Confirmation', 'click this link to confirm your account');
        return ($query->execute());
      } catch (Exception $e) {
        return ($e->getMessage());
      }

    }

    public function update() {
      $db = $GLOBALS['db'];
      $query = "UPDATE users SET ";
      $lol = [];
      $where = "";
      foreach (get_object_vars($this) as $key => $value) {
        if ($key == '_id_user')
          $where = "WHERE id_user =" . $value;
        else if ($key == '_active')
          $query .= ltrim($key, "_") . " = " . $value ;
        else
        {
          if (($key != '_posts'))
            $query .= ltrim($key, "_") . " = " . ($value == '' ? "' '," : "'" . $value . "'" . ', ');
          else
            $query = rtrim($query, ", ");
        }
      }
      $db->query($query . ' ' . $where);
    }

    public function my_dump(){
      var_dump(get_object_vars($this));
    }

    public function setId_user($val) { $this->_id_user = $val; }
    public function setUsername($val) { $this->_username = $val; }
    public function setName($val) { $this->_name = $val; }
    public function setEmail($val) { $this->_email = $val; }
    public function setBio($val) { $this->_bio = $val; }
    public function setLocation($val) { $this->_location = $val; }
    public function setActive($val) { $this->_active = $val; }
    public function setPosts($val) { $this->_posts = $val; }

    public function getId_user() { return $this->_id_user; }
    public function getUsername() { return $this->_username; }
    public function getName() { return $this->_name; }
    public function getEmail() { return $this->_email; }
    public function getBio() { return $this->_bio; }
    public function getLocation() { return $this->_location; }
    public function getActive() { return $this->_active; }
    public function getPosts() { return $this->_posts; }
    
}

 ?>
