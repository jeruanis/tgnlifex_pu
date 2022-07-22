
<!-- ////////////////////////////////////// -->

<?php
include("../../../configuration/config.php");
include("../../includes/classes/User.php");
include("../../includes/classes/Inventory.php");
include("../../includes/classes/Message.php");
include("../../includes/classes/Group.php");
include("../../includes/classes/Notification.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
 <title>Learn to read word for toddlers and pre schoolers with Online Flash Card</title>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="description" content="Learn to read word for toddlers and pre schoolers with Online Flash Card">
 <?php if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){ ?>
   <!--[if lt IE 9]> <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script> <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
   <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" defer></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" defer></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" defer></script>
   <link rel="icon" type="image/jpg" href="../../../assets/images/background/favicon.jpg">
   <link rel="stylesheet" type="text/css" href="../../static/css/style1.css">
   <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   <script src="../../static/js/javascript.js"></script>
   <script type="module" src="flash_mid.js"></script>
 <?php }else{ ?>
   <link rel="icon" type="image/jpg" href="../../../assets/images/background/favicon.jpg">
   <link rel="stylesheet" href="../../static/css/jquery.Jcrop.css" type="text/css" />
   <link rel="stylesheet" href="../../static/css/normalize_v8.css" type="text/css" />
   <link rel="stylesheet" type="text/css" href="../gallery/fancybox-master/src/css/slideshow.css">
   <link rel="stylesheet" type="text/css" href="../../static/css/style1.css">
   <link rel="stylesheet" type="text/css" href="../../static/css/todo.css">

   <link rel="stylesheet" href="../../static/css/semantic_ui_241_min.css">
   <!-- <link rel="stylesheet" href="../../static/css/font_awesome_611.min.css"> -->
   <link href="../../static/css/fonts/fontawesome/css/all.min.css" type="text/css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="../gallery/fancybox-master/src/css/slideshow.css">
   <link rel="stylesheet" href="../../static/css/bootstrap.css">
   <link rel="stylesheet" href="../../static/css/semantic_ui_241_min.css">

   <script src="../../static/js/code.jquery.3.5.1.min.js"></script>
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
   <script src="../gallery/fancybox-master/src/js/core.min.js"></script>
   <script src="../../static/js/bootstrap.bundle.min.js"></script>
   <script type="module" src="flash_mid.js"></script>
 <?php } ?>
 <style>
     .main_abc{
         /* border: 1px solid red;
         background:skyblue; */
         display:flex;
         flex-direction: row;
         justify-content:flex-start;
         flex-wrap:wrap;
     }
    .item_abc{
         /* background:orange;
         border:1px solid red; */
         /* padding:6px;
         margin:6px; */
         flex-grow:1
     }

     .fg.mb-3>span, .sg.mb-3>span,.tg.mb-3>span{
         border:1px solid #f2f2f2;cursor:pointer;font-size:24px;
     }
     .fg, .sg, .tg{
        overflow:auto;
        overflow-y:hidden;
     }
     #first,#second,#third{
        font-size:10rem;
        cursor:pointer;
     }
     .clearfix::after {
       content: "";
       clear: both;
       display: table;
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
  include("../main/navbar.php");

 }else{
   $userloggedin='';
   if (!isset($_SESSION['username'])){ ?>
     <nav class="navbar navbar-expand-lg navbar-light bg-info py-3">
          <div class="reg-in text-decoration-none"> <a href="../userlogin/registration_signup_page">Welcome Guest!</a> </div>
           <div class="reg-in text-decoration-none"> <a href="../userlogin/registration_signup_page">Register | Login</a> </div>
           <?php echo '</div><div class="reg-out"> <a href="../userlogin/registration_signup_page">Welcome Guest! Register | Login</a> </div>';?>
     </nav>
     <section>
       <div class="dropdown_data_window" style="height:0px"></div>
       <input type="hidden" id="dropdown_data_type" value="">
     </section>
     <main class="container px-0">
   <?php }
     include('../../vis_check.php');
   }
   ?>

<!-- ////////////////////////////////////////// -->
      <section class="disp_cov main_abc mx-auto clearfix" style="max-width:360px;background:#f8f8f8;">
        <div class="item_abc">
             <div>
                 <p id="first" class="display-1 text text-info b text-center">a</p>
             </div>
         </div>

         <div class="item_abc">
             <div>
                 <p id="second" class="display-1 text-warning b text-center">b</p>
             </div>
         </div>

         <div id='titem' class="item_abc">
             <div>
                 <p id="third" class="display-1 text-success text-center">c</p>
             </div>
         </div>
      </section>

      <section class="position-relative">
          <section class="position-fixed bg-white w100" style="bottom:0">
                <div class="col-md-12">
                  <div id="option" style="display:inline-block">
                      <button id="small" class="btn btn-primary d-block my-1">small Letter</button>
                      <button id="capital" class="btn btn-primary d-block my-1">CAPITAL LETTER</button>
                      <button id="two_letter_word" class="btn btn-primary d-block my-1">Two Letter Word</button>
                  </div>
                  <p class="float-right id-inline-block mb-0" id="arrow_down">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                  </p>
                  <span id="arrow_up" class="btn btn-sm btn-info d-none">show option</span>
                </div>
                <div class="text-right mr-3">
                  <button id="clear" class="btn btn-warning">clear</button>
                </div>
                <hr>
                <div class="col-md-12">
                  <div class="fg mb-3">
                        <span class="px-3" id="a">a</span><span class="px-3" id="e">e</span><span class="px-3" id="i">i</span><span class="px-3"   id="o">o</span><span class="px-3" id="u">u</span><span class="px-3" id="b">b</span><span class="px-3" id="c">c</span><span class="px-3"   id="d">d</span><span class="px-3"   id="f">f</span><span class="px-3"   id="g">g</span><span class="px-3"   id="h">h</span><span class="px-3"   id="j">j</span><span class="px-3"   id="k">k</span><span class="px-3"   id="l">l</span><span class="px-3"   id="m">m</span><span class="px-3"   id="n">n</span><span class="px-3"   id="p">p</span><span class="px-3"   id="q">q</span><span class="px-3"   id="r">r</span><span class="px-3"   id="s">s</span><span class="px-3"   id="t">t</span><span class="px-3"   id="v">v</span><span class="px-3"   id="w">w</span><span class="px-3"   id="x">x</span><span class="px-3"   id="y">y</span><span class="px-3"   id="z">z</span><span class="px-3"   id="zo"></span>
                    </div>

                    <div class="sg mb-3">
                        <span class="px-3"   id="ab">a</span><span class="px-3"   id="eb">e</span><span class="px-3"   id="ib">i</span><span class="px-3"   id="ob">o</span><span class="px-3"   id="ub">u</span><span class="px-3"   id="bb">b</span><span class="px-3"   id="cb">c</span><span class="px-3"   id="db">d</span><span class="px-3"   id="fb">f</span><span class="px-3"   id="gb">g</span><span class="px-3"   id="hb">h</span><span class="px-3"   id="jb">j</span><span class="px-3"   id="kb">k</span><span class="px-3"   id="lb">l</span><span class="px-3"   id="mb">m</span><span class="px-3"   id="nb">n</span><span class="px-3"   id="pb">p</span><span class="px-3"   id="qb">q</span><span class="px-3"   id="rb">r</span><span class="px-3"   id="sb">s</span><span class="px-3"   id="tb">t</span><span class="px-3"   id="vb">v</span><span class="px-3"   id="wb">w</span><span class="px-3"   id="xb">x</span><span class="px-3"   id="yb">y</span><span class="px-3"   id="zb">z</span><span class="px-3"   id="zbo"></span>
                   </div>

                    <div class="tg mb-3">
                        <span class="px-3"   id="cc">a</span><span class="px-3"   id="ec">e</span><span class="px-3"   id="ic">i</span><span class="px-3"   id="oc">o</span><span class="px-3"   id="uc">u</span><span class="px-3"   id="bc">b</span><span class="px-3"   id="cc">c</span><span class="px-3"   id="dc">d</span><span class="px-3"   id="fc">f</span><span class="px-3"   id="gc">g</span><span class="px-3"   id="hc">h</span><span class="px-3"   id="jc">j</span><span class="px-3"   id="kc">k</span><span class="px-3"   id="lc">l</span><span class="px-3"   id="mc">m</span><span class="px-3"   id="nc">n</span><span class="px-3"   id="pc">p</span><span class="px-3"   id="qc">q</span><span class="px-3"   id="rc">r</span><span class="px-3"   id="sc">s</span><span class="px-3"   id="tc">t</span><span class="px-3"   id="vc">v</span><span class="px-3"   id="wc">w</span><span class="px-3"   id="xc">x</span><span class="px-3"   id="yc">y</span><span class="px-3"   id="zc">z</span><span class="px-3"   id="zco"></span>
                    </div>
                </div>
          </section>
        </section>
    </main>

</body>
</html>
