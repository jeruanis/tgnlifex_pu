<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
 <title>TgnLife Online Radio FM</title>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="description" content="Online radio station FM 2021 with social media and tools">
 <!--[if lt IE 9]> <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script> <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
 <link rel="icon" type="image/jpg" href="../assets/images/background/favicon.jpg">
 <link rel="stylesheet" type="text/css" href="static/css/style1.css">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
 <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' />

 <link rel="preconnect" href="https://fonts.googleapis.com">
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 <link href="https://fonts.googleapis.com/css2?family=Ceviche+One&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" defer></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" defer></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" defer></script>
 <script src="https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js" defer></script>
 <script src="static/js/javascript_non_myapps.js" defer></script>

 <style>
   .comment-items{
     background:#f8f9fa;
     padding:6px;
     margin:6px;
   }
   .comment-element{
     background:#ffffff;
     margin:6px 0;
     padding: 0 21px 0;
   }
   @media(max-width: 600px){
    .col-md-6{
      padding: 0;
    }
   }

   .news{
       display:flex;
       flex-direction: row;
       justify-content:flex-start;
       flex-wrap:wrap;
   }

   .item-news{
      background:black;
      color:white;
      padding:6px;
      margin:6px;
      width: 20%;
      flex-grow:1
    }
    .imgn, .pn{
     max-width: 100%;
     padding-bottom:9px;
    }
</style>
</head>

<?php
define('DEBUG', false);
error_reporting(E_ALL);

  if (DEBUG){
    ini_set('display_errors', 'On');
  }else{
    ini_set('display_errors', 'Off');
  }

  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
     include('body.php');
  }else{
    echo"<body style='background: #adb5bd;'>";
   }

  echo "<div id='inv-delete-alert'></div>";

 $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
 include('indexjs.php');
 include("../configuration/config.php");
 include("includes/classes/User.php");
 include("includes/classes/Inventory.php");
 include( "includes/classes/Message.php");
 include("includes/classes/Group.php");
 include("includes/classes/Notification.php");

$rquery = mysqli_query($conn, "SELECT tcount FROM radio");
$r_tcount = array();
$sum=0;
while($r_result=mysqli_fetch_array($rquery)){
  $t=$r_result['tcount'];
  $sum+=$t;
  array_push($r_tcount, $t);
}

   $t1c = $r_tcount[0];
   $t2c = $r_tcount[1];
   $t3c = $r_tcount[2];
   $t4c = $r_tcount[3];
   $t5c = $r_tcount[4];
   $t6c = $r_tcount[5];
   $t7c = $r_tcount[6];
   $t8c = $r_tcount[7];
   $t9c = $r_tcount[8];
   $t10c = $r_tcount[9];
   $t11c = $r_tcount[10];
   $t12c = $r_tcount[11];
   $t13c = $r_tcount[12];
   ?>

  <script type="text/javascript">
    var t1c = parseInt("<?php echo $t1c; ?>", 10);
    var t2c = parseInt("<?php echo $t2c; ?>", 10);
    var t3c = parseInt("<?php echo $t3c; ?>", 10);
    var t4c = parseInt("<?php echo $t4c; ?>", 10);
    var t5c = parseInt("<?php echo $t5c; ?>", 10);
    var t6c = parseInt("<?php echo $t6c; ?>", 10);
    var t7c = parseInt("<?php echo $t7c; ?>", 10);
    var t8c = parseInt("<?php echo $t8c; ?>", 10);
    var t9c = parseInt("<?php echo $t9c; ?>", 10);
    var t10c =parseInt( "<?php echo $t10c; ?>", 10);
    var t11c =parseInt( "<?php echo $t11c; ?>", 10);
    var t12c =parseInt( "<?php echo $t12c; ?>", 10);
    var t13c =parseInt( "<?php echo $t13c; ?>", 10);

    $(document).ready(function(){
    var n = document.querySelectorAll(".n");
    if(window.matchMedia("(min-width:600px)").matches){
      n.forEach(
        function(n){
          n.classList.add('item-news');
         })
     }else{
      n.forEach(function(n){
        n.classList.add('col-sm-12','card-body', 'mb-2','text-white');
        n.style.background = 'black';
      })
     }
   });
  </script>

<?php
    if (isset($_COOKIE[ 'QTSSTYU'])){
    	$_SESSION['id']=$_COOKIE['QTSSTYU'];
    	$userloggedin_id=$_COOKIE['QTSSTYU'];
      $user_details_query="SELECT * FROM users WHERE id=?";
      $stmt=mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $user_details_query);
      mysqli_stmt_bind_param($stmt, 'i', $userloggedin_id);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
    	$user=mysqli_fetch_array($result, MYSQLI_ASSOC);
      $pwchange = $user['pwc'];

      if($pwchange==1){
         if( $user['password'] != $_COOKIE[ 'PTSSPOL'] && $user['id'] != $_COOKIE[ 'QTSSTYU'] ) {
              header("Location: myapps/userlogin/logout");
              exit;
          }else{}
        }

    	$_SESSION[ 'username'] = $user['username'];
    	$userloggedin = $user['username'];
      $profile_pic = $user['profile_pic'];

      $messages = new Message($conn, $userloggedin);
      $num_messages = $messages->getUnreadNumber();
      $notifications = new Notification($conn, $userloggedin);
      $num_notifications = $notifications->getUnreadNumberN();
    	$user_obj = new User($conn, $userloggedin);
    	$num_requests = $user_obj->getNumberOfFriendRequests();
    	$loggedNameH = str_replace('_', ' ', $user['first_name']);
    	$error_array    =   array();
      include('non_myapps_core.php');

    }else{

        include('non_myapps_core.php');
        include('vis_check.php');
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
      }
 ?>
</body>
</html>
