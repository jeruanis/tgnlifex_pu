<?php

    if(isset($_POST['upload1']) ||
    isset($_POST['post_text']) ||
    isset($_POST['userloggedin']) ||
    isset($_POST['gname']) ||
    isset($_POST['gid'])){

        $gdate = date('Y-m-d H:i:s');
        $status='process';
        $gid = $_POST['gid'];
        $gname = $_POST['gname'];
        $rd = rand();
        $userloggedin = $_POST['userloggedin'];
        $body = $_POST["post_text"];
        $body = str_replace("http"," http", $body);

            function checkEmoji($str) {
            $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
            preg_match($regexEmoticons, $str, $matches_emo);
            if (!empty($matches_emo[0])) {
                return false;
            }
            $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
            preg_match($regexSymbols, $str, $matches_sym);
            if (!empty($matches_sym[0])) {
                return false;
            }
            $regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
            preg_match($regexTransport, $str, $matches_trans);
            if (!empty($matches_trans[0])) {
                return false;
            }
            $regexMisc = '/[\x{2600}-\x{26FF}]/u';
            preg_match($regexMisc, $str, $matches_misc);
            if (!empty($matches_misc[0])) {
                return false;
            }
            $regexDingbats = '/[\x{2700}-\x{27BF}]/u';
            preg_match($regexDingbats, $str, $matches_bats);
            if (!empty($matches_bats[0])) {
                return false;
            }
            return true;
          }
            include('../utilities/compimg_multi_funct.php');

        if(substr($body, 0, 4) == "http"){
          $body =htmlspecialchars(strip_tags(nl2br($body)));}
        elseif(checkEmoji($body) !== false){
            $body =ucfirst(htmlspecialchars(strip_tags(nl2br($body))));
        }else{
          $body =htmlspecialchars(strip_tags(nl2br($body)));}

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

          if($file_size <= 12000000){
            if(empty($errors)==true){
                $rd = rand();
                $file_nameU = '../../../assets/gallery_photo/gcatch/'.$rd.basename($imageName);
                $file_name_content = '../../../assets/gallery_photo/gupload/'.basename($imageName);
                $imageFileType = pathinfo($file_nameU, PATHINFO_EXTENSION);
                  if(strtolower($imageFileType) == "jpeg" || strtolower($imageFileType) == "jpg" || strtolower($imageFileType) == "png") {
                    if(move_uploaded_file($imageTmp_Name, $file_nameU)){

                        $filename_out=  $file_nameU;
                        include('../utilities/comping_multi_bot.php');
                        $filenameNew = '../gallery/'.$imageNameOut;

                        $filenameNew = substr($filenameNew, 3);

                        $filenameNewPost = $filenameNew;
                        $gid=mysqli_real_escape_string($conn, $gid);
                        $gname=mysqli_real_escape_string($conn, $gname);
                        $filenameNew=mysqli_real_escape_string($conn, $filenameNew);

                        $gdate=mysqli_real_escape_string($conn, $gdate);
                        $status=mysqli_real_escape_string($conn, $status);
                        $userloggedin=mysqli_real_escape_string($conn, $userloggedin);
                        $filenameNewPost=mysqli_real_escape_string($conn, $filenameNewPost);

                        $query = mysqli_query($conn, "INSERT INTO posts VALUES ('', '$body', '$userloggedin', 'none', '$gdate', 'no', 'no', '0', '$gid', '$gname', '$status', '$filenameNewPost', 'none', 'no', 'none', 'none', 'none', 'none', 'none', '')");
                    }

                  }elseif(strtolower($imageFileType) == "gif") {
                    $file_nameU = '../../../assets/gallery_photo/gcatch/'.$rd.basename($imageName);
                    $file_name_content = '../../../assets/gallery_photo/gupload/'.basename($file_name);
                    if(move_uploaded_file($imageTmp_Name, $file_nameU)){

                        $filename_out= $file_nameU;
                        include('../utilities/compimg_multi_bot.php');
                        $filenameNew = '../gallery/'.$imageName;
                        $filenameNew = substr($filenameNew, 3);

                        $filenameNewPost = $filenameNew;
                        $gid=mysqli_real_escape_string($conn, $gid);
                        $gname=mysqli_real_escape_string($conn, $gname);
                        $filenameNew=mysqli_real_escape_string($conn, $filenameNew);

                        $gdate=mysqli_real_escape_string($conn, $gdate);
                        $status=mysqli_real_escape_string($conn, $status);
                        $userloggedin=mysqli_real_escape_string($conn, $userloggedin);
                        $filenameNewPost=mysqli_real_escape_string($conn, $filenameNewPost);

                      $query = mysqli_query($conn, "INSERT INTO posts VALUES ('', '$body', '$userloggedin', 'none', '$gdate', 'no', 'no', '0', '$gid', '$gname', '$status', '$filenameNew', 'none', 'no', 'none', 'none', 'none', 'none', 'none', '')");

                    }
                  }else{
                      $errors = "Upload image file. This type of file cannot be uploaded";
                    }
              }
          }else{
              array_push($error_array, "Sorry, there was an error uploading your file...<br>");
              }
        }

      if(empty($errors)){
        header("Location: ../profile/$userloggedin");
      }else{
         array_push($error_array, "Sorry, there was an error uploading your file...<br>");
       }
}

?>
