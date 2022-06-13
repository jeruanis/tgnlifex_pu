<?php
    include('../main/base.php');
    include('../main/navbar.php');
    $error_array = array();
?>

<body>
<?php
if(isset($_POST['submit'])){
    $aname =htmlspecialchars( strip_tags( mysqli_real_escape_string($conn, $_POST['aname'])));
    $adesc =htmlspecialchars( strip_tags( mysqli_real_escape_string($conn, $_POST['adesc'])));
    $adate = date('Y-m-d H:i:s');
    $status='process';
    $rd=rand();

    $file_name = $_FILES['upload']['name'];
    $file_tmp = $_FILES['upload']['tmp_name'];

    $imageName = str_replace("(", " ", $file_name);
    $imageName = str_replace(")", " ", $file_name);
    $imageName = str_replace("'", " ", $file_name);
    $imageName = str_replace('\"', ' ', $file_name);

    $imageTmp_Name = $file_tmp;
    $imageTmp_Name = str_replace("(", " ", $file_tmp);
    $imageTmp_Name = str_replace(")", " ", $imageTmp_Name);
    $imageTmp_Name = str_replace("'", " ", $imageTmp_Name);
    $imageTmp_Name = str_replace('\"', ' ', $imageTmp_Name);

    $imageName = '../../../assets/gallery_photo/acatch/'.$rd.basename($imageName);
    $file_name_content = '../../../assets/gallery_photo/aupload/'.basename($imageName);
    $imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);
    if(strtolower($imageFileType) == "jpeg" || strtolower($imageFileType) == "jpg" || strtolower($imageFileType) == "png"){
        if (empty($aname)){
            echo " <div class='alert alert-danger'><strong>ERROR</strong> - Album Title Required !</div>";
        }else{
            if(move_uploaded_file($imageTmp_Name, $imageName)){

               $filename_out= $imageName;
               include('../utilities/compimg.php');
              $imageName = substr($imageNameOut, 9);

               $first_aname = $aname;
               $albumName_query = mysqli_query($conn, "SELECT name FROM tbl_album WHERE name ='$aname' AND user_from='$userloggedin'");
               $i=0;
               while(mysqli_num_rows($albumName_query) !=0 ) {
                 $i++;
                 $aname_split=(str_split($aname, strlen($first_aname)));
                 $aname = $aname_split[0].$i;
                 $albumName_query = mysqli_query($conn, "SELECT name FROM tbl_album WHERE name ='$aname' AND user_from='$userloggedin'");
                }

                $query="INSERT INTO tbl_album(name,adesc,image,date,status,user_from) VALUES ('$aname','$adesc','$imageName','$adate','$status','$userloggedin')";
                if(mysqli_query($conn, $query)){
                    echo " <div class='alert alert-success'><a href='addgalleryPost.php' class='text-decoration-none'>Your Album named<span style='padding: 0 6px;color: #f88d02;font-weight: bold;'>".ucwords($aname)."</span> is ready. Click Here to Add Photos to your new Album</a></div>";
                }else{
                    echo "There was an error in uploading the photos";
                        print mysqli_error();
                    }
            }//end if moved upload
       }
    }elseif(strtolower($imageFileType) == "gif") {
        $filenameNew = '../../../assets/gallery_photo/aupload/'.$rd.basename($imageName);
          if(move_uploaded_file($imageTmp_Name, $filenameNew)){

           $first_aname = $aname;
           $albumName_query = mysqli_query($conn, "SELECT name FROM tbl_album WHERE name ='$aname' AND user_from='$userloggedin'");
           $i=0;
           while(mysqli_num_rows($albumName_query) !=0 ) {
             $i++;
             $aname_split=(str_split($aname, strlen($first_aname)));
             $aname = $aname_split[0].$i;
             $albumName_query = mysqli_query($conn, "SELECT name FROM tbl_album WHERE name ='$aname' AND user_from='$userloggedin'");
            }

          $filenameNew = substr($filenameNew, 9);
          $query="INSERT INTO tbl_gallery VALUES ('','$gid','$gname','$filenameNew','$gdate','$status','$userloggedin')";
          if(mysqli_query($conn, $query)){
            echo " <div class='alert alert-success'><a href='addgalleryPost.php' class='text-decoration-none'>Your Album named<span style='padding: 0 6px;color: #f88d02;font-weight: bold;'>".ucwords($aname)."</span> is ready. Click Here to Add Photos to your new Album</a></div>";
          }else{
            echo "There was an error in uploading the photos";
                print mysqli_error();
            }
            } else{ $errors ="There was an error uploading."; }
    }else{
         $errors = "Upload image file. This type of file cannot be uploaded";
      }

      }

?>


</body>
</html>
