<?php
/**
 *
 */
class Form
{
  private $form;

  function __construct($arr = [], $action, $submit)
  {
    $this->form = '<form class="form-horizontal" action="' . $action . '" method="post">';
    foreach($arr as $key => $option)
    {
      if (isset($option['type']) && $option['type'] == 'textarea')
        $this->form .= self::create_textarea($key, $option);
      else
        $this->form .= self::create_input($key, $option);
    }
    $this->form .= '<p class="col-md-3 control-label">*<small>required field</small></p>';
    if ($submit != 'Sign in') :
      $this->form .= self::create_submit($submit);
    else :
      $this->form .= self::create_submit_button($submit);
    endif;
    $this->form .= '</form>';
  }

  public function __toString()
  {
      return $this->form;
  }

  private function create_submit($value)
  {
    $group = '<div class="form-group">' .
    '<div class="col-sm-offset-3 col-md-7">' .
    ' <input type="submit" class="btn btn-default" name="submit" value="'. $value .'">' .
    ' </div>' .
    ' </div>';
    return $group;
  }

  private function create_submit_button($value)
  {
    $group = '<div class="form-group">' .
    '<div class="col-sm-offset-3 col-md-7">' .
    ' <button type="button" class="btn btn-default" id="submit">' . $value .'</button>' .
    ' </div>' .
    ' </div>';
    return $group;
  }

  public function create_input($name, $option)
  {
    $required = isset($option['required']);
    $type = isset($option['type']) ? $option['type'] : 'text';
    $group = '<div class="form-group row">' .
      '<label for="input' . ucfirst($name) . '" class="col-md-3 control-label">'. ucfirst($name) . ($required ? "*":"") . '</label>' .
      '<div class="col-md-7">'.
      '<div class="input-group"><div class="input-group-addon">'.
      self::getGlyphicon($name) .
      '</div>' .
      '<input type="' . $type . '" class="form-control" id="input' . ucfirst($name) .
      '" name="' . $name . '" placeholder="' . $name . '" ' .
      ( $required ? 'required' : '') . '>' .
      '</div>' .
      '</div>' .
      '</div>';
      return $group;
  }

  private function getGlyphicon($name) {
    switch ($name) {
      case 'name':
        $name = "tags";
        break;
      case 'username':
        $name = "user";
        break;
      case 'email':
        $name = "envelope";
        break;
      case 'password':
        $name = "lock";
        break;
      case 'verify password':
        $name = "lock";
        break;
      case 'bio':
        $name = "pencil";
        break;
      case 'location':
        $name = "map-marker";
        break;
      default:
        $name = "asterisk";
        break;
    }
    return ('<span class="glyphicon glyphicon-' . $name . '" aria-hidden="true"></span>');
  }

  public function create_textarea($name, $option)
  {
    $rows = (isset($option['rows'])) ? (isset($option['rows'])) : '3';
    $group = '<div class="form-group row">' .
      '<label for="input' . ucfirst($name) . '" class="col-md-3 control-label">'. ucfirst($name) . '</label>' .
      '<div class="col-md-7">' .
      '<textarea rows="'. $row .'" class="form-control" id="input' . ucfirst($name) .
      '" name="' . $name . '" placeholder="' . $name . '" ' .
      (isset($option['required']) ? 'required' : '') . '>' .
      '</textarea>' .
      '</div>' .
      '</div>';
      return $group;
  }
}

 ?>
