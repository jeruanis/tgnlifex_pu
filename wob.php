<?php

 include("../configuration/config.php");
 include("includes/classes/User.php");
 include("includes/classes/Inventory.php");

 include( "includes/classes/Post.php");
 include( "includes/classes/Notification.php");
 include( "includes/classes/Message.php");
 include("includes/classes/Group.php");

if (isset($_COOKIE[ 'QTSSTYU'])){
	$_SESSION[ 'id']=$_COOKIE[ 'QTSSTYU'];
	$userloggedin_id=$_COOKIE[ 'QTSSTYU'];
	$user_details_query=mysqli_query($conn, "SELECT username, profile_pic FROM users  WHERE id='$userloggedin_id'");
	$user=mysqli_fetch_array($user_details_query);
	$_SESSION[ 'username'] = $user['username'];
	$userloggedin = $user['username'];
	$profile_pic = $user['profile_pic'];

  $messages = new Message($conn, $userloggedin);
	$num_messages = $messages->getUnreadNumber();
	$notifications = new Notification($conn, $userloggedin);
	$num_notifications = $notifications->getUnreadNumberN();
	$user_obj = new User($conn, $userloggedin);
	$num_requests = $user_obj->getNumberOfFriendRequests();

	$error_array    =   array();

  include('the_good_news.php');
}else{include('the_good_news.php');}

 ?>
