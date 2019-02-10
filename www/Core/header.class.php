<?php
class Header
{
  private $_group;

  function __construct($active = false)
  {
    $_group = "";
    $_group .= '<ul class="nav navbar-nav">';
    $_group .=  '<li class="active"><a href="/home">Home</a></li>';
    if ($active)
      $_group .=  '<li><a href="/profile">Profile</a></li>';
    $_group .=  '<li><a href="/explore">Explore</a></li>';
    if ($active) {
      $_group .=  '<li><a href="/posts">Posts</a></li>';
      $_group .=  '<li><a href="/picture">New picture</a></li>';
      $_group .=  '<li><a href="/logout">Logout</a></li>';
    }
    else {
      $_group .=  '<li><a href="/signup">Sign up</a></li>';
      $_group .=  '<li><a href="/login">Sign in</a></li>';
    }
    $_group .= '</ul>';
    $this->_group = $_group;
  }

  function __toString(){
    return $this->_group;
  }
}

?>
