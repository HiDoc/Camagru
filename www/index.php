<?php
session_start();
/**
* Require class and helpers
*/
foreach (glob("Core/*.php") as $filename)
  require_once ($filename);

/**
 * New connection to the database
 */
global $db;
$db = new db();

/**
 * Css class for body
 */
$class = "";

/**
 * Reroute traffic with URL rewrite
 */
session_start();
if (isset($_GET['ajax']) && $_GET['ajax'] == 'true' && isset($_POST) && isset($_GET['require'])) {
  $page = "Controller/".$_GET['require'].".php";
  if (file_exists($page)) include_once ($page);
} else {
  if (isset($_GET['page'])) {
    if ($_GET['page'] == "logout") :
      include_once("Controller/logout.php");
      $_GET['page'] = 'home';
    endif;
    $page = "Controller/".$_GET['page'].".php";
    if (!file_exists($page)) $page = 'Controller/404.php';
    if (($content = include_page($page)) == "") :
      $content = include_page("Controller/404.php");
      $_GET['page'] = '404';
      $class = "404";
      else :
        $class = $_GET['page'];
      endif;
  } else if ( (isset($_GET['posts'])) ){
    $class = "post";
    $content = include_page("Controller/post.php");
  } else {
    $class = "home";
    $content = include_page("Controller/home.php");
  }
  /**
   * Session start and header
   */
  $header;
  if (!(isset($_SESSION['user']))) :
    $header = new Header();
    else :
      $header = new Header(true);
    endif;
    require_once "Controller/layout.php";
}
?>
