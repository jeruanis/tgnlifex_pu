<?php
	include('../main/base.php');
	include('../main/navbar.php');
	$error_array = array();

	$mykey1=$_REQUEST['key0'];
	$mykey2=$_REQUEST['key1'];
	$mykey3=$_REQUEST['key2'];
?>

<body>
<div class='card col-md-6 m-5'>
	<div class="card-body">
        <h3 class="page-header">Edit Album</h3>
    <?php
       if(isset($_POST['submit'])){
        $aname = $_POST['aname'];
        $aname =htmlspecialchars( strip_tags( mysqli_real_escape_string($conn, $_POST['aname']), '<br>'));
        $adesc = $_POST['adesc'];
        $adesc =htmlspecialchars( strip_tags( mysqli_real_escape_string($conn, $_POST['adesc']), '<br>'));
        $adate = date('Y-m-d H:i:s');
        $status='progress';

       if (empty($aname)){
          echo " <div class='alert alert-danger'><strong>ERROR</strong> - Empty fields are not allowed !</div>";
         }else{
        mysqli_query($conn, "update tbl_album set name='$aname',adesc='$adesc' where albumid = '$mykey1'");
        mysqli_query($conn, "UPDATE posts SET gname = '$aname' WHERE aid = '$mykey1'");
        echo "<script>location.href='viewallalbums.php'</script>";
         }
       }
    ?>

        <form action="#" method="post" enctype="multipart/form-data" name="upload">
            <div class="form-group">
                <label>Title</label>
                <input class="form-control" placeholder="Enter Title" name="aname" value="<?php echo $mykey2; ?>">
            </div><br>
           <div class="form-group">
						 <label>Description</label>
             <textarea class="form-control" rows="3" placeholder="Max 1000 Character" name="adesc" maxlength="1000"><?php echo $mykey3; ?></textarea>
           </div><br>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>

    </div>
		</div>
</body>
</html>
