<?php
include('../../../configuration/config.php');

if(isset($_POST['key1'])){
	$key1=$_POST['key1'];
	$key2=$_POST['key2'];
	$key3=$_POST['key3'];

  $del_content_query= mysqli_query($conn, "SELECT gimages FROM tbl_gallery WHERE gid = '$key1'");
  if($result = mysqli_num_rows($del_content_query) > 0){
     while($row = mysqli_fetch_array($del_content_query)){
        $gimages = '../../../'.$row['gimages'];

        $gu=str_replace('gupload', 'gcatch', $gimages, );
        if (file_exists ($gu)){
          unlink($gu);
        }else{
          $error = 'File not exist';
        }

        if (file_exists($gimages)) {
          unlink($gimages);
        }else{
          $error = 'File not exist';
        }
      }
  }

  if(empty($error) || $error == 'File not exist'){
    $q2=mysqli_query($conn, "DELETE FROM tbl_gallery WHERE gid = '$key1'");
    if($q2)
      $response = 'Success';
   }else{
     $response = $error;
   }

  echo json_encode($response);
  clearstatcache();
  mysqli_close($conn);
}

?>
