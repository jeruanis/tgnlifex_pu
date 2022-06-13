<?php
// $error_array = array();
if(isset($_POST['submit'])) {
  include('../utilities/compimg_multi_funct.php');
  foreach($_FILES['upload1']['tmp_name'] as $key => $tmp_name){
    $file_name = $key.$rd.$_FILES['upload1']['name'][$key];
    $file_size =$_FILES['upload1']['size'][$key];
    $file_tmp =$_FILES['upload1']['tmp_name'][$key];
    $file_type=$_FILES['upload1']['type'][$key];

    $imageName = str_replace("(", " ", $file_name);
    $imageName = str_replace(")", " ", $file_name);
    $imageName = str_replace("'", " ", $file_name);
    $imageName = str_replace('\"', ' ', $file_name);

    $imageTmp_Name = $file_tmp;
    $imageTmp_Name = str_replace("(", " ", $file_tmp);
    $imageTmp_Name = str_replace(")", " ", $imageTmp_Name);
    $imageTmp_Name = str_replace("'", " ", $imageTmp_Name);
    $imageTmp_Name = str_replace('\"', ' ', $imageTmp_Name);

  if($file_size <= 200000){
         if (!file_exists('../../../assets/gallery_photo/gcatch/'.str_replace(' ', '_', $aname))) {
             mkdir('../../../assets/gallery_photo/gcatch/'.str_replace(' ', '_', $aname).'/', 0777, true);
         }
         if (!file_exists('../../../assets/gallery_photo/gupload/'.str_replace(' ', '_', $aname))) {
             mkdir('../../../assets/gallery_photo/gupload/'.str_replace(' ', '_', $aname).'/', 0777, true);
         }

         $imageName = '../../../assets/gallery_photo/gcatch/'.str_replace(' ', '_', $aname).'/'.$rd.basename($imageName);

         $file_name_content = '../../../assets/gallery_photo/gupload/'.str_replace(' ', '_', $aname).'/'.basename($imageName);

         $imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);
         if(strtolower($imageFileType) == "jpeg" || strtolower($imageFileType) == "jpg" || strtolower($imageFileType) == "png"){
            if(move_uploaded_file($imageTmp_Name, $imageName)){
              copy($imageName, $file_name_content);
              $filenameNew = substr($file_name_content, 9);

              $filenameNew=mysqli_real_escape_string($conn, $filenameNew);
              $query="INSERT INTO tbl_gallery VALUES(?, ?, ?, ?, ?, ?, ?)";
              $stmt = mysqli_stmt_init($conn);
              mysqli_stmt_prepare($stmt, $query);
              mysqli_stmt_bind_param($stmt, "iisssss", $gid, $aid, $gname, $filenameNew, $gdate, $status, $userloggedin);
              mysqli_stmt_execute($stmt);
              }
          }else{
            $response = 'Sorry, this type of file cannot be upladed';
            array_push($error_array, $response);
            // echo json_encode($response);
            // exit();
            }

  }elseif($file_size <= 310000000) {
      if(empty($errors)==true){
         $rd = rand();

         if (!file_exists('../../../assets/gallery_photo/gcatch/'.str_replace(' ', '_', $aname))) {
             mkdir('../../../assets/gallery_photo/gcatch/'.str_replace(' ', '_', $aname).'/', 0777, true);
         }
         if (!file_exists('../../../assets/gallery_photo/gupload/'.str_replace(' ', '_', $aname))) {
             mkdir('../../../assets/gallery_photo/gupload/'.str_replace(' ', '_', $aname).'/', 0777, true);
         }

         $imageName = '../../../assets/gallery_photo/gcatch/'.str_replace(' ', '_', $aname).'/'.$rd.basename($imageName);

         $file_name_content = '../../../assets/gallery_photo/gupload/'.str_replace(' ', '_', $aname).'/'.basename($imageName);

         $imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);
         if(strtolower($imageFileType) == "jpeg" || strtolower($imageFileType) == "jpg" || strtolower($imageFileType) == "png"){
            if(move_uploaded_file($imageTmp_Name, $imageName)){
               include('../utilities/comping_multi_bot.php');
              $filenameNew = substr($imageNameOut, 9);
              $filenameNew=mysqli_real_escape_string($conn, $filenameNew);
              $query="INSERT INTO tbl_gallery VALUES(?, ?, ?, ?, ?, ?, ?)";
              $stmt = mysqli_stmt_init($conn);
              mysqli_stmt_prepare($stmt, $query);
              mysqli_stmt_bind_param($stmt, "iisssss", $gid, $aid, $gname, $filenameNew, $gdate, $status, $userloggedin);
              mysqli_stmt_execute($stmt);
              }


        }elseif(strtolower($imageFileType) == "gif") {
          $response = 'Sorry, this type of file cannot be upladed';
          array_push($error_array, $response);
          // echo json_encode($response);
          // exit();
          }elseif(strtolower($imageFileType) == "mp4"){
              $filePath = '../../../assets/gallery_photo/gcatch/'.str_replace(' ', '_', $aname).'/'. $rd . basename($imageName, '.tmp');
              $targetDirScreenShot = '../../../assets/gallery_photo/gupload/'.str_replace(' ', '_', $aname).'/'. basename($filePath, '.mp4');
              $commandclip = "ffmpeg -ss 15 -t 3 -i $imageTmp_Name -vf \"fps=10,scale=320:-1:flags=lanczos,split[s0][s1];[s0]palettegen[p];[s1][p]paletteuse\" -loop 0 $targetDirScreenShot.gif";
              system($commandclip);

              ############## chunk method #################
              $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
              $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
              $out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
              if ($out) {
                $in = @fopen($imageTmp_Name, "rb");
                if ($in) {
                   while ($buff = fread($in, 4096)) { fwrite($out, $buff); }
                } else {
                   verbose(0, "Failed to open input stream");
                }
                @fclose($in);
                @fclose($out);
                // @unlink($imageTmp_Name);
              } else {
                $response = "Failed to open output stream";
              }
              // check if file was uploaded
              if (!$chunks || $chunk == $chunks - 1) {
                rename("{$filePath}.part", $filePath);
              }
                $response = "Upload OK";
              ###############################################

              //  use ffmpeg instead of if move upload file this working for gcatch
              // $command = "ffmpeg -i $imageTmp_Name -b:v $bitrate -bufsize $bitrate $targetDirVid";
              // system($command);
              $vidposter = substr($targetDirScreenShot.'.gif', 9);
              @unlink($imageName);
              @unlink($imageTmp_Name);

              $filenameNew=mysqli_real_escape_string($conn, $vidposter);

              $query="INSERT INTO tbl_gallery VALUES(?, ?, ?, ?, ?, ?, ?)";
              $stmt = mysqli_stmt_init($conn);
              mysqli_stmt_prepare($stmt, $query);
              mysqli_stmt_bind_param($stmt, "iisssss", $gid, $aid, $gname, $filenameNew, $gdate, $status, $userloggedin);
              mysqli_stmt_execute($stmt);

        }else{
          $response = 'Sorry, this type of file cannot be upladed';
          array_push($error_array, $response);
          // echo json_encode($response);
          // exit();
          }
     }else{
         $response = 'There was an error uploading the file.';
         array_push($error_array, $response);
         // echo json_encode($response);
            // exit();
       }
    } else {
      $response = 'Sorry, your file must be 300MB or lower.';
      array_push($error_array, $response);
      // echo json_encode($response);
         // exit();
     }
 }

   if(empty($errors)){
     header("Location: ../gallery/indexGallery");
   }else{
     array_push($error_array, "Sorry, there was an error uploading your file...<br>");
   }

   $stmt->close();
   mysqli_close($conn);

}


?>
