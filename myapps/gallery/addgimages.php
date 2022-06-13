<?php
	include('../main/base.php');
	include('../main/navbar.php');
	$error_array = array();
?>

<body>
	<?php
		if(in_array("Sorry, this type of file cannot be upladed", $error_array)) echo "<div role='alert' class='alert-danger'>Sorry, this type of file cannot be upladed<br></div>";
		elseif(in_array("Sorry, this type of file cannot be upladed", $error_array)) echo "<div role='alert' class='alert-danger'>Sorry, this type of file cannot be upladed<br></div>";
		elseif(in_array("Sorry, this type of file cannot be upladed", $error_array)) echo " <div role='alert' class='alert-danger'>Sorry, this type of file cannot be upladed<br></div>";
		elseif(in_array("There was an error uploading the file.", $error_array)) echo " <div role='alert' class='alert-danger'>There was an error uploading the file.<br></div>";
		elseif(in_array("Sorry, your file must be 300MB or lower.", $error_array)) echo " <div role='alert' class='alert-danger'>Sorry, your file must be 300MB or lower.<br></div>";
		elseif(in_array("Sorry, there was an error uploading your file...<br>", $error_array)) echo " <div role='alert' class='alert-danger'>Sorry, there was an error uploading your file...<br></div>";

		$agid= $_REQUEST['id'];
		$sql = "SELECT * FROM tbl_album WHERE albumid='$agid' AND user_from='$userloggedin'";
		$rs_result = mysqli_query ($conn, $sql);
		while ($row = mysqli_fetch_assoc($rs_result)) {
			$aname=$row["name"];
		  };
	 ?>

	 <div class='p-3'>
		<div class="card-body">
	        <h3 class="page-header mb-3"><?php echo '<span>'.ucwords($aname).'</span>'; ?></h3>
			<?php
				$aid=$agid;
				$gname=$aname;
				$gdate = date('Y-m-d H:i:s');
				$status='process';
				$rd=rand();

				$aid=mysqli_real_escape_string($conn, $aid);
				$gname=mysqli_real_escape_string($conn, $gname);
				$gdate=mysqli_real_escape_string($conn, $gdate);
				$status=mysqli_real_escape_string($conn, $status);
				$userloggedin=mysqli_real_escape_string($conn, $userloggedin);

				include('addimagePatch1.php');

			?>
			<form action="" method="POST" enctype="multipart/form-data" name="upload">
				<label for="">Upload photo</label>
				<input type="file" name="upload1[]" multiple id="upload" accept=".jpeg, .jpg, .png, .PNG, .JPG, .mp4" class="mb-3 d-block" />
				<button type="submit" class="btn btn-primary" name="submit" class="form-control">Submit</button>
		 </form>
		 <div class="">
		 	<small class="text-danger">The file name must not contain space when uploading video.</small>
		 </div>

		   </div>
		</div>


</body>
</html>
