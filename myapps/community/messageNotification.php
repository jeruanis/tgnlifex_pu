<?php
include("../../../configuration/config.php");
include("../../includes/classes/Message.php");
include("../../includes/classes/User.php");
include("../../includes/classes/Notification.php");

if(isset($_SESSION['username'])){$userloggedin=$_SESSION['username'];$user_details_query=mysqli_query($conn,"SELECT * FROM users WHERE username='$userloggedin'");$user=mysqli_fetch_array($user_details_query);}else {header("Location: ../userlogin/registration_signup_page?please-sign-up");}$messages=new Message($conn,$userloggedin);$num_messages=$messages->getUnreadNumber();echo $num_messages;?>
