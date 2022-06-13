<?php
  include("../../../configuration/config.php");
  include("../../includes/classes/User.php");
  include("../../includes/classes/Post.php");
  include("../../includes/classes/Message.php");
  include("../../includes/classes/Notification.php");

  if (isset($_SESSION['username'])) {
	$userloggedin = $_SESSION['username'];
	$user_details_query = mysqli_query($conn, "SELECT * FROM users WHERE username='$userloggedin'");
	$user = mysqli_fetch_array($user_details_query);

    $tm=date("Y-m-d H:i:s");
    $q=mysqli_query($conn, "UPDATE users SET status='ON',tm='$tm' WHERE username='$userloggedin'");
    }
  else {
	header("Location: register.php");
    }

$tm=date ("Y-m-d H:i:s", mktime (date("H"),date("i")-$gap,date("s"),date("m"),date("d"),date("Y")));
$qt=mysqli_query($conn, "SELECT profile_pic, username FROM users WHERE tm < '$tm' AND username != '$userloggedin'");

       $str="";
       while($nt=mysqli_fetch_array($qt)){
       $propic = $nt['profile_pic'];
       $user_name = $nt['username'];
       $user_name = $nt['username'];
       $user_name1 = ucwords(str_replace('_', ' ', $user_name));
       $user_name2 = $nt['username'];

        $str .= '<ul style="list-style:none;display:inline-block;margin:0"><li><a href="'.$user_name2.'"><img style="width:200px;height:200px;margin-right:10px" src="'.$propic.'"></a></li></ul>';
       }
      echo $str;
?>
