<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
 <title>TgnLife Word of Salvation</title>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="description" content="Word of Salvation">
 <!--[if lt IE 9]> <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script> <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 <script data-ad-client="ca-pub-4336888148151250" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
 <link rel="icon" type="image/jpg" href="../assets/images/background/favicon.jpg">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
 <link rel="stylesheet" type="text/css" href="static/css/style1.css">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
 <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' />
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js"></script>
 <script src="static/js/javascript_non_myapps.js"></script>
 <script src="static/js/verses_voice.js" defer></script>
 <style>
 .comment-items{
   background:#f8f9fa;
   padding:6px;
   margin:6px;
 }
 .comment-element{
   background:#ffffff;
   margin:6px 0;
   padding: 5px 21px 0 21px;
 }

</style>
</head>
<?php

if (!isset($_SESSION['username'])){ ?>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-primary" style="justify-content:space-between!important;">

        <div class="reg-in text-decoration-none"> <a href="myapps/userlogin/registration_signup_page">Welcome Guest!</a> </div>

     <div class="reg-in text-decoration-none"> <a href="myapps/userlogin/registration_signup_page">Register | Login</a> </div>


     <div class="collapse navbar-collapse" id="navbarNav">
       <ul class="navbar-nav">
         <li class="nav-item">
           <a class="nav-link" href="index?enjoy-your-listening">
              <span style="color:#fff"><span id="id_confirm" class="material-icons"><span style="color:#fff">Home</span></span>
              <span class="sr-only"></span>
            </a>
         </li>

         <li class="nav-item"> <a class="nav-link" href="myapps/userlogin/registration_signup_page?You-need-to-signup"><span><span style="color:#fff">Posts</span></span><span class="sr-only"></span></a>
         </li>
         <li class="nav-item">
           <a href="myapps/userlogin/registration_signup_page?You-need-to-signup" class="nav-link">
             <span style="color:#fff">Todo</span>
             <span class="sr-only"></span>
           </a>
         </li>
         <li class="nav-item">
           <a href="myapps/userlogin/registration_signup_page?You-need-to-signup" class="nav-link">
             <span style="color:#fff">Chat</span>
             <span class="sr-only"></span>
           </a>
         </li>
         <li class="nav-item">
           <a href="myapps/userlogin/registration_signup_page?You-need-to-signup" class="nav-link">
             <span style="color:#fff">Tools</span>
             <span class="sr-only"></span>
           </a>
         </li>

         <?php
             if (isset($_SESSION['username'])){
                 $userloggedin = $_SESSION['username'];
                 echo '<li class="nav-link"> <div class="logout-in"><a class="ui image label" href="myapps/profile/' . $userloggedin . '" target="_blank">
                      <img src="' . $profile_pic. '" alt="profile image">
                      '.$userloggedin.'
                    </a><hr> <a href="myapps/userlogin/logoutbridge"><i class="fa fa-sign-out" title="logout"></i></a> </div></li> </ul>';
             }else{
             }

             if (isset($_SESSION['username'])){
                 $userloggedin = $_SESSION['username'];
                 echo '</div><div class="logout-out"><a class="ui image label" href="myapps/profile/' . $userloggedin . '" target="_blank">
                    <img src="' . $profile_pic. '" alt="profile image">
                          '.$userloggedin.'
                  </a> <a href="myapps/userlogin/logoutbridge"><i class="fa fa-sign-out" title="logout"></i></a> </div>';
             }else{
                 echo '</div><div class="reg-out"> <a href="myapps/userlogin/registration_signup_page">Welcome Guest! Register | Login</a> </div>';
             }
           ?>

   </nav>
   <div class="dropdown_data_window" style="height:0px"></div>
   <input type="hidden" id="dropdown_data_type" value="">

 <?php    include('vis_check.php'); }else{
   include("non_myapps_navbar.php");
 } ?>

    <?php 	if(isset($_POST['postComment'])){
       if(!empty($_POST['post_body'])){
         if(isset($_SESSION['username'])){
           $userloggedin = $_SESSION[ 'username'];
           $post_body=$_POST['post_body'];
           $post_body=ucfirst(htmlspecialchars( strip_tags( mysqli_real_escape_string($conn, $post_body), '<br>')));
           $date_time_now=date( "Y-m-d H:i:s");
           $insert_post=mysqli_query($conn, "INSERT INTO comment_tgnews VALUES('','$post_body', '$userloggedin', '$date_time_now')");

           }else{
           echo '<script>$(document).ready(function(){$("#myInput").click();}); </script> <div class="modal" tabindex="-1" role="dialog" id="myModal"> <div class="modal-dialog" role="document">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title">Error Warning</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <p>You can only comment when you are loggedin. Thank you.</p>
               </div>
               <div class="modal-footer"></div>
             </div>
           </div>
           </div>
           <input type="hidden" data-toggle="modal" data-target="#myModal" id="myInput" />';
             }
        }
     }
    ?>


  <div class="container" style="min-height:88vh;">
   <div class="container">
     <div id="online_radioCont">
       <?php include('paradise.php'); ?>
     </div>
     <br>

     <h4>Comments</h4>

     <form action="" method="POST">
       <div class="d-flex flex-row chat-message-input-container">
        <div class="input-group-append">
          <img src="../assets/images/profile_pics/default/head_wet_asphalt.png" width="50px" height="50px" style="border-radius:.25rem 0 0 .25rem;">
        </div>
         <textarea name="post_body" class="flex-grow-1 chat-message-input form-control type_msg" id="ms_text" placeholder="Comment"></textarea>

         <div class="input-group-append">
             <button type="submit" id="ms-sub" class="input-group-text" name="postComment" style="background:#37425e;border-radius:0 .25rem .25rem 0;">
               <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff"><path d="M0 0h24v24H0z" fill="none"/><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
             </button>
           </div>
       </div>
     </form>

   </div>

    <div class="comment-items">
    <?php include('comment_reader_tgnews.php'); ?>
    </div>
  </div>

  <?php include('myapps/main/footer.php'); ?>
</body>

 <script>
 $(document).ready(function(){
        $('.btp').fadeOut();
        $( 'body' ).scroll(function() {
          var showAfter = 2100;
            if ($(this).scrollTop() > showAfter ) {
                $('.btp').fadeIn();
            } else {
                $('.btp').fadeOut();
                }
            $('.btp').css('opacity', '0.72');
        });
        $('.btp').click(function(){
            $('html, body').animate({scrollTop : 0});
        });
            $("#ms_text").keypress(function(e) {
                if(e.which == 13) {
                  $(this).blur();
                  $("#ms-sub").focus().click();
                }
             });
         });
 </script>
  </html>
