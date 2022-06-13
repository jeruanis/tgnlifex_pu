
<?php

   function orientation($data){
      foreach ($data as $key => $val){
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
       $image = imagecreatefromjpeg($fileName);
       }
       elseif( $type == IMAGETYPE_PNG ) {
       $image = imagecreatefrompng($fileName);
       }
       elseif( $type == IMAGETYPE_GIF ) {
       $image = imagecreatefromgif($fileName);
       }
       return $image;
      }
   function resize_image($new_width, $new_height, $image, $width, $height) {
                $new_image = imagecreatetruecolor($new_width, $new_height);
                imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                return $new_image;
        }
   function save_image($new_image, $new_filename, $new_type='jpeg', $quality) {
                if( $new_type == 'jpeg' ) {
                imagejpeg($new_image, $new_filename, $quality);
                }
                elseif( $new_type == 'jpg' ) {
                imagejpeg($new_image, $new_filename, $quality);
                }
                elseif( $new_type == 'png' ) {
                imagepng($new_image, $new_filename);
                }
                elseif( $new_type == 'gif' ) {
                imagegif($new_image, $new_filename);
                }
            }
   function compress($source, $destination, $quality){
                $info = getimagesize($source);

                if ($info['mime'] == 'image/jpeg')
                    $image = imagecreatefromjpeg($source);

                elseif ($info['mime'] == 'image/gif')
                    $image = imagecreatefromgif($source);

                elseif ($info['mime'] == 'image/png')
                    $image = imagecreatefrompng($source);

                imagejpeg($image, $destination, $quality);
                return $destination;
               }

   $exif_data = exif_read_data($filename);
   $orientation = orientation($exif_data);
   $degrees = orientation_flag($orientation);
   list($width, $height, $type) = getimagesize($filename);
   $width = $width;
   $height = $height;
   $orig_ratio = $width / $height;
   $old_image = load_image($filename, $type);
   $new_image = resize_image($width, $width/$orig_ratio, $old_image, $width, $height);

   $image_rotate = imagerotate($new_image, $degrees, 0);
   imagejpeg($image_rotate, $filename1);
   imagedestroy($image_rotate);

   $source_img = $filename1;
   $destination_img = $filename1;
   $d = compress($source_img, $destination_img, 45);
?>
