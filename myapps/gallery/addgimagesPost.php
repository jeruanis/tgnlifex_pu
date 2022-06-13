<?php
    include('../main/base.php');
    include('../main/navbar.php');
    $error_array = array();

    if(in_array("File size must not be greater than 25 MB..<br>", $error_array)) echo "<div style='color: red';>File size must not be greater than 25 MB..<br></div>";
    elseif(in_array("Sorry, there was an error uploading your file...<br>", $error_array)) echo " <div style='color: red';>Sorry, there was an error uploading your file...<br></div>";
    elseif(in_array("Sorry, there was an error uploading your file...<br>", $error_array)) echo "<div style='color: red';>Sorry, there was an error uploading your file...<br></div>";
    elseif(in_array("Upload image file. This type of file cannot be uploaded", $error_array)) echo " <div style='color: red';>Upload image file. This type of file cannot be uploaded</div>";

    $agid= $_REQUEST['id'];

    $sql = "select * from tbl_album where albumid='$agid' AND user_from='$userloggedin'";
    $rs_result = mysqli_query ($conn, $sql);
    $row = mysqli_fetch_assoc($rs_result);
        $aname=$row["name"];
        $adesc = $row["adesc"];

    $gid=$agid;
    $gname=$aname;

    include('addimagePatchPost.php');
?>

<body>

<div class="col-lg-6">
  <h3 class="page-header">Add Photo</h3>
  <div class="panel panel-default">

    <form action="" method="post" enctype="multipart/form-data" id="uploadImage">
      <div class="mb-4">
         Album Description :
           <input  type="text" style="width:100%" name="post_text" id="post_text" placeholder="Description here" value="<?php echo $adesc; ?>" class="indTextarea border-0">
      </div>
        <div class="mb-3">
          <input type="file" name="upload1[]" multiple id="upload" accept = ".jpg, .jpeg, .gif, .png"/>
        </div>
        <div class="mb-2">
          <input type="submit" id="uploadSubmit" class="btn btn-primary" value="Upload">
        </div>
        <input type="hidden" name="userloggedin" value="<?php echo $userloggedin; ?>"/>
        <input type="hidden" name="gid" value="<?php echo $gid; ?>"/>
        <input type="hidden" name="gname" value="<?php echo $gname; ?>"/>

        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
     </form>
     </div>
    </div>

</body>
</html>
