<?php
include('../../../configuration/config.php');
include("../../includes/classes/User.php");
include("../../includes/classes/Message.php");

	if (isset($_SESSION['username'])) {
		$userloggedin = $_SESSION['username'];
		$user_details_query = mysqli_query($conn, "SELECT * FROM users WHERE username='$userloggedin'");
		$user = mysqli_fetch_array($user_details_query);
	}
	else {
		header("Location: register.php");
	}
	$messages = new Message($conn, $userloggedin);
	      $num_messages = $messages->getUnreadNumber();

	        if($num_messages > 0)

	      echo $num_messages;

?>
