<?php

$fileName = $imageName;
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
  $new_image = resize_image(1080, 1080/$orig_ratio, $old_image, $width, $height);
  save_image($new_image, $file_name_content, 'jpeg', 70);
}

imagedestroy($old_image);
imagedestroy($new_image);

if (file_exists ($newFileName)){
    unlink($newFileName);
  }

 $imageNameOut = $file_name_content;

 ?>
