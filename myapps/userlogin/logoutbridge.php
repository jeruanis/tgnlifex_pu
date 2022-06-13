<?php
$u=$_REQUEST['u'];

if($u=='')
  $v=$_GET['v'];
else
  $v=$u;

include("../../../configuration/config.php");
if (isset($_SESSION['username'])) {
     $username2 = $_SESSION['username'];
     $q=mysqli_query($conn, "UPDATE users SET status='OFF' WHERE username='$username2'");
    }
  mysqli_close($conn);
header("Location: logout.php?v=$v");
?>
