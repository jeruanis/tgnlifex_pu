<?php
include('../main/base.php');
$error_array = array();

$mykey1=$_REQUEST['key1'];
$album_name=str_replace("'", "\'",$_REQUEST['name']);
$status='delete';

$del_query_album_pic = mysqli_query($conn, "SELECT name, image FROM tbl_album WHERE albumid = '$mykey1' AND name='$album_name'");
if($result = mysqli_num_rows($del_query_album_pic) > 0){
	$row = mysqli_fetch_array($del_query_album_pic);
	$image = '../../../'.$row['image'];
	$au=str_replace('aupload', 'acatch', $image);
	if (file_exists ($au)){
		unlink($au);
	 }
	 if (file_exists('../../../assets/gallery_photo/acatch/'.str_replace(' ', '_', strtolower($album_name)))) {
			 rmdir('../../../assets/gallery_photo/acatch/'.str_replace(' ', '_', strtolower($album_name)).'/');
		}

    if (file_exists ($image)){
       unlink($image);
      }

	}

if($del_query_album_pic){
	$del_content_query= mysqli_query($conn, "SELECT gname, gimages FROM tbl_gallery WHERE gname = '$album_name' AND aid='$mykey1'");

	if($result = mysqli_num_rows($del_content_query) > 0){
	   while($row = mysqli_fetch_array($del_content_query)){
	   	  $gimages = '../../../'.$row['gimages'];
				$gu=str_replace('gupload', 'gcatch', $gimages, );
				if (file_exists ($gu)){
					unlink($gu);
				}
 	      if (file_exists ($gimages)){
          unlink($gimages);
        }else{
          $error='<div class="alert alert-danger">File not existing</div>';
          echo $error;
        }
	    }

	$q1=mysqli_query($conn, "DELETE FROM tbl_album WHERE (albumid = '$mykey1' AND name='$album_name')");
	$q2=mysqli_query($conn, "DELETE FROM tbl_gallery WHERE gname = '$album_name' AND aid = '$mykey1'");

	if($q1){
       // echo '<div class="pl-3">$q1 - Album record deleted</div><br>';
    }else{
    	$error = '<div class="pl-3">there was an error deleting q1 record from database</div><br>';
        echo $error;
      }
    if($q2){
     	// echo '<div class="pl-3">$q2 - Gallery record deleted</div>';
    }else{
    	$error = '<div class="pl-3">there was an error deleting q2 record from database</div><br>';
        echo $error;
      }
     if(empty($error))
	     echo '<div class="alert alert-info">Succeseesully deleted album</div>';
     else{
     	//
     }
	} else {
		echo '<div class="alert alert-info">Proceed to posts album</div>';
	}
} else {
	echo '<div class="alert alert-danger"Album pic not deleted.</div>';
}


// FOR POSTS ALBUM DELETION COVERAGE
if($del_query_album_pic){
	$del_content_query= mysqli_query($conn, "SELECT image FROM posts WHERE gname = '$album_name' AND aid='$mykey1'");

	if($result = mysqli_num_rows($del_content_query) > 0){
	   while($row = mysqli_fetch_array($del_content_query)){
	   	  $image = substr($row['image'], 11);
   	      if (file_exists ($image)){
            unlink($image);
          }else{
            $error='<div class="alert alert-danger">Posts file not existing</div>';
            echo $error;
          }
	   }

	$q1=mysqli_query($conn, "DELETE FROM tbl_album WHERE (albumid = '$mykey1' AND name='$album_name')");
	$q2=mysqli_query($conn, "DELETE FROM posts WHERE gname = '$album_name' AND aid = '$mykey1'");

	if($q1){
       // echo '<div class="pl-3">$q1 - Album record deleted</div><br>';
    }else{
    	$error = '<div class="pl-3">there was an error deleting posts q1 record from database</div><br>';
        echo $error;
      }
    if($q2){
     	// echo '<div class="pl-3">$q2 - Gallery record deleted</div>';
    }else{
    	$error = '<div class="pl-3">there was an error deleting posts q2 record from database</div><br>';
        echo $error;
      }
     if(empty($error))
	     echo '<div class="alert alert-info">Succeseesully deleted posts album</div>';
     else{
     	//
     }
	} else {
		mysqli_query($conn, "DELETE FROM tbl_album WHERE (albumid = '$mykey1' AND name='$album_name')");
		echo '<div class="alert alert-info">Album record deleted</div>';
	}
} else {
	echo '<div class="alert alert-danger"Posts album pic not deleted.</div>';
}


echo "<div class='text-center pt-5 '><a class='btn btn-outline-secondary' href='viewallalbums'>Back to edit album</a>"

?>
