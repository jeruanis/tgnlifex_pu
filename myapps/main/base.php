<?php

include( "../../../configuration/config.php");
include( "../../includes/classes/User.php");
include( "../../includes/classes/Post.php");
include( "../../includes/classes/Inventory.php");
include( "../../includes/classes/Notification.php");
include( "../../includes/classes/Message.php");
include("../../includes/classes/Group.php");

if (isset($_COOKIE[ 'QTSSTYU'])){
	$_SESSION[ 'id']=$_COOKIE[ 'QTSSTYU'];
	$userloggedin_id=$_COOKIE[ 'QTSSTYU'];
	$user_details_query=mysqli_query($conn, "SELECT * FROM users WHERE id='$userloggedin_id'");
	$user=mysqli_fetch_array($user_details_query);
	$pwchange=$user['pwc'];

	if($pwchange==1){
		 if( $user['password'] != $_COOKIE[ 'PTSSPOL']|| $user['id'] != $_COOKIE[ 'QTSSTYU'] ) {
					header("Location: ../userlogin/logout");
					exit;
			}else{
				// passed
			 }
		}

	$_SESSION['username'] = $user['username'];
	$username = $user['username'];
	$userloggedin = $user['username'];
	$profile_pic = $user['profile_pic'];
	$tm=date("Y-m-d H:i:s");
  $q=mysqli_query($conn, "UPDATE users SET status='ON',tm='$tm' WHERE username='$userloggedin'");

	$messages = new Message($conn, $userloggedin);
	$num_messages = $messages->getUnreadNumber();
	$notifications = new Notification($conn, $userloggedin);
	$num_notifications = $notifications->getUnreadNumberN();
	$user_obj = new User($conn, $userloggedin);
	$num_requests = $user_obj->getNumberOfFriendRequests();
	$loggedNameH = str_replace('_', ' ', $user['first_name']);
	$error_array    =   array();

}else{
	echo '<!DOCTYPE html>
	<html>
<head>
	<title>TgnLife</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Online radio station FM 2021 with social media and tools">
	<!--[if lt IE 9]> <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"> </script> <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"> </script><![endif]-->
	<link rel="icon" type="image/jpg" href="../../../assets/images/background/favicon.jpg">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">'; echo '
	<div class="row">
		<div class="col-md">
			<div class="card card-body">
				<div class="alert alert-secondary" role="alert">You have to login or signup in order to proceeed. <a class="text-decoration-none" href="../userlogin/registration_signup_page">Register | Login </a>or <a class="text-decoration-none" href="../../index">Home</a>
				</div>
			</div>
		</div>
	</div>';
	exit();
} ?>

<!DOCTYPE html>
<html lang='en'>
<head>
	<title>TgnLife</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="TgnLife your life.">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script><script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
	<link rel="icon" type="image/jpg" href="../../../assets/images/background/favicon.jpg">
	<link rel="stylesheet" href="../../static/css/jquery.Jcrop.css" type="text/css" />
	<link rel="stylesheet" href="../../static/css/normalize_v8.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="../gallery/fancybox-master/src/css/slideshow.css">
	<link rel="stylesheet" type="text/css" href="../../static/css/style1.css">
	<link rel="stylesheet" type="text/css" href="../../static/css/todo.css">

	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' />
	<link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">



  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="../../static/js/jquery-ui-1.12.1/jquery-ui.js"></script>
	<script src="../../static/js/jquery.ui.touch-punch.js"></script>
	<!-- footer -->
	<script src="../../static/js/jquery.Jcrop.js"></script>
	<script src="../../static/js/jcrop_bits.js"></script>
	<script src="../../static/js/jquery.visible.min.js"></script>
	<!-- navbar -->
	<script src="../../static/js/bootbox.min.js"></script>
	<script src="../../static/js/javascript.js"></script>
	<script src="../../static/js/query.form.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>
