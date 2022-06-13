<?php
require_once("../../../configuration/config.php");
include("../classes/User.php");
include("../classes/Post.php");

$limit = 6;

if(isset($_POST['userloggedin'])){
$userloggedin = $_POST['userloggedin'];
$tm=date("Y-m-d H:i:s");
$q=mysqli_query($conn, "UPDATE users SET status='ON',tm='$tm' WHERE username='$userloggedin'");
}

$posts = new Post($conn, $_REQUEST['userloggedin']);
$posts->loadProfilePosts($_REQUEST, $limit);
?>
