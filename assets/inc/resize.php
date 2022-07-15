<?php /* path include to resize images for thumbnail purposes. trade off between compute and file transfer size. */ ?>
<?php
// The file
$imgSrc =  $_SERVER['DOCUMENT_ROOT'] . $_GET["img"];

if (isset($_GET["thumbratio"])) {
  $thumbratio = $_GET["thumbratio"];
}

// //Your Image

// //getting the image dimensions
// list($width, $height) = getimagesize($imgSrc);

// //saving the image into memory (for manipulation with GD Library)
// $myImage = imagecreatefromjpeg($imgSrc);

// // calculating the part of the image to use for thumbnail
// if ($width > $height) {
//   $y = 0;
//   $x = ($width - $height) / 2;
//   $smallestSide = $height;
// } else {
//   $x = 0;
//   $y = ($height - $width) / 2;
//   $smallestSide = $width;
// }

// // copying the part into thumbnail
// $thumbSize = 400;
// $thumb = imagecreatetruecolor($thumbSize, $thumbSize);
// imagecopyresampled($thumb, $myImage, 0, 0, $x, $y, $thumbSize, $thumbSize, $smallestSide, $smallestSide);

// //final output
// header('Content-type: image/jpeg');
// imagejpeg($thumb);


if ($thumbratio == "tall") {
  image_resize($imgSrc, 250, 400);
}
elseif ($thumbratio == "wide") {
  image_resize($imgSrc, 400, 250);
}
elseif ($thumbratio == "square") {
  image_resize($imgSrc, 400, 400);
}
else {
  image_resize($imgSrc, 400, 400);
}

function image_resize($src, $width, $height, $crop=1){
  if(!list($w, $h) = getimagesize($src)) return "Unsupported picture type!";
  
  
  $type = strtolower(substr(strrchr($src,"."),1));
  if($type == 'jpeg') $type = 'jpg';
  switch($type){
    case 'bmp': $img = imagecreatefromwbmp($src); break;
    case 'gif': $img = imagecreatefromgif($src); break;
    case 'jpg': $img = imagecreatefromjpeg($src); break;
    case 'png': $img = imagecreatefrompng($src); break;
    default : return "Unsupported picture type!";
  }

  $xw = $w;
  $xh = $h;

  
  // resize
  if($crop){
    $ratio = max($width/$w, $height/$h);
    $h = $height / $ratio;
    $x = ($w - $width / $ratio) / 2;
    $w = $width / $ratio;
  }
  else{
    $ratio = min($width/$w, $height/$h);
    $width = $w * $ratio;
    $height = $h * $ratio;
    $x = 0;
    $y = 0;
  }

  $new = imagecreatetruecolor($width, $height);

  // preserve transparency
  if($type == "gif" or $type == "png"){
    imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
    imagealphablending($new, false);
    imagesavealpha($new, true);
  }

  if ($xh > $xw) {
    $y = ($xh - $height / $ratio) / 2;
  }
  
  $y = ($xh - $height / $ratio) / 2;

  imagecopyresampled($new, $img, 0, 0, $x, $y, $width, $height, $w, $h);
  
  switch($type){
    case 'bmp': header('Content-type: image/bmp'); imagewbmp($new); break;
    case 'gif': header('Content-type: image/gif'); imagegif($new); break;
    case 'jpg': header('Content-type: image/jpeg'); imagejpeg($new); break;
    case 'png': header('Content-type: image/png'); imagepng($new); break;
  }
  
  return true;
}
?>
