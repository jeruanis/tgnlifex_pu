<?php
  include('../main/base.php');
  include('../main/navbar.php');
  $error_array = array();
  $mykey1=$_REQUEST['key0'];
?>

<body>
<div class="p-3">
  <div class="col-lg-6">
     <h3 class='mb-4'>Update album Image</h3>

<?php

if(isset($_POST['submit'])){
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

	if(move_uploaded_file($_FILES['upload']['tmp_name'], $imageName)){

  $filename_out= $imageName;
  include('../utilities/compimg.php');

  // remove ../ before creating record to the database
  $imageName = substr($imageNameOut, 9);

	mysqli_query($conn, "UPDATE tbl_album SET image='$imageName' WHERE albumid = '$mykey1'");
	echo "<script>location.href='viewallalbums.php'</script>";

   }
 }
?>
      <form action="" method="post" enctype="multipart/form-data" name="upload">
        <div class="form-group">
          <input type="file" name="upload"  id="upload"/>
        </div>
        <button type="submit" class="btn btn-primary mt-2" name="submit">Submit</button>
      </form>
      </div>
  </div>

</body>
</html>
