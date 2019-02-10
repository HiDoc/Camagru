<?php
function include_page($page)
{
  $content = "";
  if (file_exists($page))
  {
    ob_start();
    include $page;
    $content = ob_get_contents();
    ob_end_clean();
  }
  return $content;
}

function html_array($arr = [])
{
  foreach ($arr as $key => $value) {
    $arr[$key] = htmlspecialchars($value);
  }
  return $arr;
}
?>
