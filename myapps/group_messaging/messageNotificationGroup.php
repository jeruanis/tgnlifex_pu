<?php

include("../../../configuration/config.php");

include("../../includes/classes/Group.php");include("../../includes/classes/User.php");include("../../includes/classes/Notification.php");

if(isset($_SESSION['username'])){$userloggedin=$_SESSION['username'];$user_details_query=mysqli_query($conn,"SELECT * FROM users WHERE username='$userloggedin'");$user=mysqli_fetch_array($user_details_query);}else {header("Location: register.php");}$messages=new Group($conn,$userloggedin);$num_messages=$messages->getUnreadNumber();echo $num_messages;?>
