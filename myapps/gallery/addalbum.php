<?php
include('../main/base.php');
include('../main/navbar.php');
$error_array = array();
?>

<body>
 <div class="p-3">
    <h3>Add Album</h3>

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

        if (!file_exists('../../../assets/gallery_photo/acatch/'.str_replace(' ', '_', $aname))) {
            mkdir('../../../assets/gallery_photo/acatch/'.str_replace(' ', '_', $aname).'/', 0777, true);
        }

        $imageName = '../../../assets/gallery_photo/acatch/'.$rd.basename($imageName);
        if (!file_exists('../../../assets/gallery_photo/aupload/'.str_replace(' ', '_', $aname))) {
            mkdir('../../../assets/gallery_photo/aupload/'.str_replace(' ', '_', $aname).'/', 0777, true);
        }
        $file_name_content = '../../../assets/gallery_photo/aupload/'.str_replace(' ', '_', $aname).'/'.basename($imageName);

        if (empty($aname)){
         echo " <div class='alert alert-danger'><strong>ERROR</strong> - Album Title Required !</div>";
           }else{
        if(move_uploaded_file($imageTmp_Name, $imageName)){
  			$filename_out= $imageName;
  			include('../utilities/compimg.php');
        $imageName = substr($imageNameOut, 9);

        $query="INSERT INTO tbl_album VALUES ('', '$aname', '$adesc', '$imageName', '$adate', '$status', '$userloggedin')";
        if(mysqli_query($conn, $query)){
             header("Location: addgallery?album=add-photo");
          }else{
				  echo 'There was an error creating the album';
                }
               }
            }
        }
?>
        <div class="col-lg-6">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Album Name or Title</label>
                    <input class="form-control" placeholder="Enter Title" name="aname">
                </div><br>
                <div class="form-group">
                     <label>Description</label>
                     <textarea class="form-control" rows="3" placeholder="Max 1000 Character" name="adesc" maxlength="1000"></textarea>
                </div><br>
                <div class="form-group mb-1">
                    <label>Album Cover Image</label><br>
                    <input type="file" name="upload"  id="upload" accept = ".jpg, .jpeg, .png" />
                </div><br>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>
      </div>
      <form id='formAdalbum' action="addalbumPost_action.php" method="post" enctype="multipart/form-data" name="upload">

</body>
</html>
