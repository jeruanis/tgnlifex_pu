<?php

$fileName = $imageName;
function orientation($exif_data){
   foreach ($exif_data as $key => $val){
       if(strtolower($key) == 'orientation'){
           return $val;
       }
     }
    }

function orientation_flag($orientation){
   switch($orientation):
       case 1:
           return 0;
       case 8:
           return 90;
       case 3:
           return 180;
       case 6:
           return 270;
       endswitch;
  }

function load_image($fileName, $type) {
  if( $type == IMAGETYPE_JPEG ) {
  $image = @imagecreatefromjpeg($fileName);
  }
  elseif( $type == IMAGETYPE_PNG ) {
  $image = @imagecreatefrompng($fileName);
  }
  elseif( $type == IMAGETYPE_GIF ) {
  $image = @imagecreatefromgif($fileName);
  }
  return $image;
 }

function resize_image($new_width, $new_height, $image, $width, $height) {
   $new_image = imagecreatetruecolor($new_width, $new_height);
   imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
   return $new_image;
   }

function save_image($new_imag, $new_filename, $new_type='jpeg', $quality=100) {
   if( $new_type == 'jpeg' || $new_type == 'png' || $new_type == 'gif' || $new_type == 'jpg') {
     imagejpeg($new_imag, $new_filename, $quality);
   }
  }

$newFileName = "tmp_folder/".basename($fileName);

$imageFileType = pathinfo($newFileName, PATHINFO_EXTENSION);
if(strtolower($imageFileType) == "png"){
  list($width, $height, $type) = getimagesize($fileName);
  $width = $width;
  $height = $height;
  $orig_ratio = $width / $height;
  $type = $type;
  $old_image = load_image($fileName, $type);
  $new_image = resize_image($width, $width/$orig_ratio, $old_image, $width, $height);
  save_image($new_image, $file_name_content, 'jpeg', 70);

}else{

$exif_data = exif_read_data($fileName);
$orientation = orientation($exif_data);
$degrees = orientation_flag($orientation);
$image_data = imagecreatefromjpeg($fileName);
$image_rotate = imagerotate($image_data, $degrees, 0);
imagejpeg($image_rotate, $fileName);
imagedestroy($image_rotate);
imagedestroy($image_data);

list($width, $height, $type) = getimagesize($fileName);
$width = $width;
$height = $height;
$orig_ratio = $width / $height;
$type = $type;
$old_image = load_image($fileName, $type);
$new_image = resize_image($width, $width/$orig_ratio, $old_image, $width, $height);

save_image($new_image, $file_name_content, 'jpeg', 5);
}

imagedestroy($old_image);
imagedestroy($new_image);

if (file_exists ($newFileName)){
    unlink($newFileName);
  }

if (file_exists ($fileName)){
  unlink($fileName);
}

$imageNameOut = $file_name_content;

?>
