<?php
	 $v=$_REQUEST['v'];
	 require_once('../../../configuration/config.php');
	 $username1 ="";
	 $username1 = $_SESSION['username'];
	     if (isset($_SESSION['username'])) {
	        $userloggedin = $_SESSION['username'];
	        $user_details_query = mysqli_query($conn, "SELECT * FROM users WHERE username='$userloggedin'");
	        $user = mysqli_fetch_array($user_details_query);
	       }
	 $close_query = mysqli_query($conn, "UPDATE users SET user_closed='yes' WHERE username='$userloggedin'");
	 mysqli_close($conn);
	 header("Location: ../userlogin/logoutbridge?v=$v");
?>
