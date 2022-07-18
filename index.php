<?php
include("../configuration/config.php");
include("includes/classes/User.php");
include("includes/classes/Inventory.php");
include( "includes/classes/Message.php");
include("includes/classes/Group.php");
include("includes/classes/Notification.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
 <title>TgnLife</title>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="description" content="Online Web partner">
 <?php if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){ ?>
     <!--[if lt IE 9]> <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script> <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
     <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' />

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
     <link rel="icon" type="image/jpg" href="../assets/images/background/favicon.jpg">
     <link rel="stylesheet" type="text/css" href="static/css/style1.css">
     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" defer></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" defer></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" defer></script>
     <script src="https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js" defer></script>
     <script src="static/js/javascript_non_myapps.js" defer></script>
 <?php }else{ ?>
    <link rel="icon" type="image/jpg" href="../assets/images/background/favicon.jpg">
    <link rel="stylesheet" type="text/css" href="static/css/style1.css">
    <link rel="stylesheet" href="static/css/bootstrap.css">
    <link rel="stylesheet" href="static/css/semantic_ui_241_min.css">
    <script src="static/js/code.jquery.3.5.1.min.js"></script>
    <!-- <script src="static/js/bootstrap.min.js"></script> -->
    <script src="static/js/javascript_non_myapps.js"></script>
    <script src="static/js/bootstrap.bundle.min.js"></script>
<?php } ?>
 <style media="screen">
 button{
   border: none;
   background: none;
  }
 </style>
</head>
<body class="bg-class" style="-webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">

<?php
  $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
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
  include("non_myapps_navbar.php");

 }else{
   $userloggedin='';
   if (!isset($_SESSION['username'])){ ?>
    <header>
     <nav class="navbar navbar-expand-lg navbar-light bg-class py-3" style="justify-content:space-between!important">
          <div class="reg-in text-decoration-none"> <a href="myapps/userlogin/registration_signup_page">Welcome Guest!</a> </div>
           <div class="reg-in text-decoration-none"> <a href="myapps/userlogin/registration_signup_page">Register | Login</a> </div>
       <div class="collapse navbar-collapse" id="navbarNav">
           <?php
             if (isset($_SESSION['username'])){
               $userloggedin = $_SESSION['username'];
               echo '<li class="nav-link"> <div class="logout-in">
                <a class="ui image label" href="myapps/profile/' . $userloggedin . '" target="_blank">
                    <img src="' . $profile_pic. '" alt="profile image">
                    '.$userloggedin.'
                  </a><hr> <a href="myapps/userlogin/logoutbridge"><i class="fa fa-sign-out" title="logout"></i></a> </div></li> </ul>';
           }else{
           }
           if (isset($_SESSION['username'])){
               $userloggedin = $_SESSION['username'];
               echo '</div><div class="logout-out">
               <a class="ui image label" href="myapps/profile/' . $userloggedin . '" target="_blank">
                  <img src="' . $profile_pic. '" alt="profile image">
                        '.$userloggedin.'
                </a><a href="myapps/userlogin/logoutbridge"><i class="fa fa-sign-out" title="logout"></i></a> </div>';
           }else{
               echo '</div><div class="reg-out"> <a href="myapps/userlogin/registration_signup_page">Welcome Guest! Register | Login</a> </div>';
           }
        ?>
     </nav>
     <section>
       <div class="dropdown_data_window" style="height:0px"></div>
       <input type="hidden" id="dropdown_data_type" value="">
     </section>
  </header>
   <?php }
}
   ?>

<main class="container pt-1 pb-3 mt-5 footer-height">
      <a class="text-decoration-none" href="index_home">
      <div class="cov" style="background:#A3423C">
        <h6 class="con">ONLINE RADIO </h6>
        <p class="col-md-6 text-light">

        </p>
      </div>
      </a>
          <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4336888148151250"
       crossorigin="anonymous"></script>
          <ins class="adsbygoogle"
               style="display:block; text-align:center;"
               data-ad-layout="in-article"
               data-ad-format="fluid"
               data-ad-client="ca-pub-4336888148151250"
               data-ad-slot="2276987390"></ins>
          <script>
               (adsbygoogle = window.adsbygoogle || []).push({});
          </script>
      <p></p>
      <?php if($userloggedin == 'support-service' || $userloggedin == 'pinky-a1' || $userloggedin == 'honeylyn-l1') { ?>
      <a class="text-decoration-none" href="myapps/exp_monitor/exp_monitor_esp">
      <div class="cov" style="background:#DE834D">
        <h6 class="con">EXPENSE MONITOR</h6>
        <p class="col-md-6 text-light">
        </p>
      </div>
      </a>
     <?php }else{ ?>
       <a class="text-decoration-none" href="myapps/exp_monitor/exp_monitor">
        <div class="cov" style="background:#DE834D">
          <h6 class="con">EXPENSE MONITOR</h6>
          <p class="col-md-6 text-light">
            <small class="d-inline-block"><em class="lr text-danger">*login required*</em></small>
          </p>
        </div>
        </a>
      <?php  } ?>

     <?php if (isset($_SESSION['username'])){ ?>
      <a class="text-decoration-none" href="myapps/todo/todo">
      <div class="cov" style="background:#5584AC">
        <h6 class="con">TO DO LIST</h6>
        <p class="col-md-6 text-light">
          <small class="d-inline-block"><em class="lr text-danger">*login required*</em></small>
        </p>
      </div>
      </a>

      <a class="text-decoration-none" href="myapps/news/latestnews.html">
      <div class="cov" style="background:#E2C2B9">
        <h6 class="con">NEWS UPDATE</h6>
        <p class="col-md-6 text-light">
          <small class="d-inline-block"><em class="text-danger">*will go to other website*</em></small>
        </p>
      </div>
     </a>

     <a class="text-decoration-none" href="myapps/community/community">
      <div class="cov" style="background:#FC997C">
        <h6 class="con">POST</h6>
        <p class="col-md-6 text-light">
          <small class="d-inline-block"><em class="lr text-danger">*login required*</em></small>
        </p>
      </div>
     </a>

     <a class="text-decoration-none" href="myapps/todo/todo?d=dm">
     <div class="cov" style="background:#99A799">
       <h6 class="con">INVENTORY</h6>
       <p class="col-md-6 text-light">
         <small class="d-inline-block"><em class="lr text-danger">*login required*</em></small>
       </p>
     </div>
     </a>
    <?php  } ?>

     <a class="text-decoration-none" href="myapps/abc/flashcard">
     <div class="cov" style="background:#ff9800;">
       <h6 class="con">WORD LEARNING FOR KIDS</h6>
       <p class="col-md-6 text-light">

       </p>
     </div>
    </a>

      <!-- <div class="col-md-6 px-0 pb-1">
         <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4336888148151250"
           crossorigin="anonymous"></script>
      <ins class="adsbygoogle"
           style="display:block"
           data-ad-format="fluid"
           data-ad-layout-key="-d4+5n+2h-1n-4w"
           data-ad-client="ca-pub-4336888148151250"
           data-ad-slot="3720564020"></ins>
      <script>
           (adsbygoogle = window.adsbygoogle || []).push({});
      </script>
    </div> -->


    <a class="text-decoration-none" href="wob">
    <div class="cov" style="background:rgb(92 182 223)">
      <h6 class="con">BIBLE PASSAGES</h6>
      <p class="col-md-6 text-light">

      </p>
    </div>
   </a>

    <?php if (isset($_SESSION['username'])){ ?>
      <!-- <a class="text-decoration-none" href="https://jv-store.one/">
      <div class="cov" style="background:#96C7C1">
        <h6 class="con">JV STORE</h6>
        <p class="col-md-6 text-light">
          <small class="d-inline-block"><em class="text-danger">*will go to other website*</em></small>
        </p>
      </div>
     </a> -->
   <?php  } ?>

</main>

  <?php include('footer_index.php'); ?>
</body>
</html>
