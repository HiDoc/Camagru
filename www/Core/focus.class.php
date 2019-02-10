<?php
/**
 *
 */
class Focus
{
  public $frame;
  public $thumb;

  function __construct($frame_path, $thumb_path)
  {
    $frame = imagecreatefrompng($frame_path);
    $thumb = imagecreatefrompng($thumb_path);
  }

  public function blend()
  {
    $width = imagesx( $this->frame );
    $height = imagesy( $this->frame );
    $img = imagecreatetruecolor( $width, $height );

    imagealphablending($img, true);

    $transparent = imagecolorallocatealpha( $img, 0, 0, 0, 127 );
    imagefill( $img, 0, 0, $transparent );

    imagecopyresampled($img, $this->thumb, 32, 30, 0, 0, 130, 100,
      imagesx( $this->thumb ), imagesy( $this->thumb ) );
    imagecopyresampled($img, $this->frame, 0, 0, 0, 0, $width, $height, $width, $height);
    imagealphablending($img, false);
    imagesavealpha($img,true);
  }
}
?>
