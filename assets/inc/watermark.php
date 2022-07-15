<?php /* meant to resolve a URL image path and add a watermark to it, see past examples */ ?>
<?php
// The file
$imgSrc =  $_SERVER['DOCUMENT_ROOT'] . $_GET["img"];
$stampSrc = $_SERVER['DOCUMENT_ROOT'] . "/assets/img/watermark.png";

$type = strtolower(substr(strrchr($imgSrc,"."),1));

switch($type){
  case 'bmp': $image = imagecreatefromwbmp($imgSrc); break;
  case 'gif': $image = imagecreatefromgif($imgSrc); break;
  case 'jpg': $image = imagecreatefromjpeg($imgSrc); break;
  case 'png': $image = imagecreatefrompng($imgSrc); break;
  default : return "Unsupported picture type!";
}


// First we create our stamp image manually from GD
$_stamp = imagecreatefrompng($stampSrc);

if(!list($w, $h) = getimagesize($imgSrc)) return "Unsupported picture type!";

if(!list($_sw, $_sh) = getimagesize($stampSrc)) return "Unsupported picture type!";




$sw = $w * .5;

$ratio = $sw / $_sw;



$sh = $_sh * $ratio;





$stamp = imagecreatetruecolor($sw, $sh);

imagealphablending( $stamp, false );
imagesavealpha( $stamp, true );
imagecopyresampled($stamp, $_stamp, 0, 0, 0, 0, $sw, $sh, $_sw, $_sh);






$right = ($w / 2) - ($sw / 2);
$bottom = 50;

// Merge the stamp onto our photo with an opacity of 50%

$out = imagecreatetruecolor($w, $h);

imagecopyresampled($out, $image, 0, 0, 0, 0, $w, $h, $w, $h);
// imagecopyresampled($out, $stamp, $right, ($h - $sh) - 10, 0, 0, $sw, $sh, $sw, $sh);

// Merge the stamp onto our photo with an opacity of 50%
imagecopymerge_alpha($out, $stamp, $right, ($h - $sh) - $bottom, 0, 0, $sw, $sh, 50);

// Save the image to file and free memory


switch($type){
  case 'bmp': header('Content-type: image/bmp'); imagewbmp($out); break;
  case 'gif': header('Content-type: image/gif'); imagegif($out); break;
  case 'jpg': header('Content-type: image/jpeg'); imagejpeg($out); break;
  case 'png': header('Content-type: image/png'); imagepng($out); break;
}

imagedestroy($image);
imagedestroy($out);
imagedestroy($stamp);

function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
  // creating a cut resource
  $cut = imagecreatetruecolor($src_w, $src_h);

  // copying relevant section from background to the cut resource
  imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
 
  // copying relevant section from watermark to the cut resource
  imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
 
  // insert cut resource to destination image
  imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
}

?>
