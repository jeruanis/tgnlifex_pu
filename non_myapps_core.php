
<?php if (!isset($_SESSION['username'])){ ?>
   <nav class="navbar navbar-expand-lg navbar-light bg-info py-3" style="justify-content:space-between!important;">

        <div class="reg-in text-decoration-none"> <a href="myapps/userlogin/registration_signup_page">Welcome Guest!</a> </div>

         <div class="reg-in text-decoration-none"> <a href="myapps/userlogin/registration_signup_page">Register | Login</a> </div>

     <div class="collapse navbar-collapse" id="navbarNav">
         <?php
           if (isset($_SESSION['username'])){
               $userloggedin = $_SESSION['username'];
               echo '<li class="nav-link"> <div class="logout-in"> <a href="myapps/profile/' . $userloggedin . '" target="_blank"><img src="' . $profile_pic. '" style="width:42px;border-radius:50%" alt="profile image"></a><hr> <a href="myapps/userlogin/logoutbridge"><i class="fa fa-sign-out" title="logout"></i></a> </div></li> </ul>';
           }else{

           }

           if (isset($_SESSION['username'])){
               $userloggedin = $_SESSION['username'];
               echo '</div><div class="logout-out"> <a href="myapps/profile/' . $userloggedin . '" target="_blank"><img src="' . $profile_pic. '" style="width:42px;border-radius:50%" alt="profile image"></a> <a href="myapps/userlogin/logoutbridge"><i class="fa fa-sign-out" title="logout"></i></a> </div>';
           }else{
               echo '</div><div class="reg-out"> <a href="myapps/userlogin/registration_signup_page">Welcome Guest! Register | Login</a> </div>';
           }
         ?>
   </nav>

   <div class="dropdown_data_window" style="height:0px"></div>
   <input type="hidden" id="dropdown_data_type" value="">
 <?php }else{
   include("non_myapps_navbar.php");
 } ?>

<div class="container bg-white" style="min-height:88vh;padding-bottom:16px">
   <div class="row">
   <div class="col-md-6" style="border-bottom: 12px solid lightgrey;padding-bottom: 24px;background: radial-gradient(darkcyan, transparent);">
    <?php   if(isset($_POST['postComment'])){
       if(!empty($_POST['post_body'])){
         if(isset($_SESSION['username'])){
           $userloggedin = $_SESSION[ 'username'];
           $post_body=$_POST['post_body'];
           $post_body=ucfirst(htmlspecialchars( strip_tags( mysqli_real_escape_string($conn, $post_body), '<br>'))); $date_time_now=date( "Y-m-d H:i:s");
           $insert_post=mysqli_query($conn, "INSERT INTO comments_general VALUES('','$post_body', '$userloggedin', '$date_time_now')");

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

     <center>

       <div id="online_radioTit" style="padding:7px;background: radial-gradient(darkcyan, transparent);">
          <h2 class="d-inline-block" style="color:yellow"><em>Online</em></h2>
          <h1 class="d-inline-block" style="color:darkslateblue;font-family:'Ceviche One', cursive;">Radio</h1>
       </div>

       <div id="equalizer" style="width:100%;height:51px;display:none"></div>
     </center>
     <div id="online_radioCont">
       <?php include( 'playercore.php'); ?>
       <div id="trackbox"></div>
     </div>
     <br>

     <?php $startTime=date( "Y-m-d H:i:s"); echo "

     <div class='d-block main_msg_grp time'>
         <div class='p-2 mb-2 d-inline-block rounded item-inv'>Today is <span>" . date( "M / d / Y", strtotime( "+8 hour", strtotime($startTime))) . " <span id='curTime'></span><br>Be thankful and have a nice day &#128150;&#128150;&#128150;</span></div>"; ?>

        <script>
          $(document).ready(function(){
            if(window.matchMedia('(min-width:600px)').matches){
              const txt = '<a href="https://play.google.com/store/apps/details?id=com.tgnradiomusic"><div class="d-inline-block item-inv float-right" style="width:40%"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" style="enable-background:new 0 0 64 64;width: 53px;height: 53px;margin-left:31%;" version="1.1" viewBox="0 0 64 64" xml:space="preserve"><style type="text/css">.st0{fill:#57CEF3;}.st1{fill:#FFF200;}.st2{fill:#48FF48;}.st3{fill:#FF6C58;}.st4{fill:#FF3333;}.st5{fill:#0779E4;}.st6{fill:#314A52;}</style><g id="Play_Store"><polygon class="st0" points="7,3 7,61 40,32  "/><polygon class="st1" points="36,32 44,22 59,32 44,42  " style="&#10;&#10; &#10;"/><polygon class="st2" points="36,32 7,3 11,3 45,23  "/><polygon class="st3" points="36,32 7,61 11,61 45,41  "/><path class="st4" d="M9.1,64L9.1,64c-1.9,0-3.6-1-4.5-2.6L8,58.2v0.7c0,0.3,0.1,0.6,0.3,0.8L24,44c7.4,0,14.1-1.2,18.3-3.1l5.8-3.4   v4.6L11.7,63.3C11,63.8,10.1,64,9.1,64L9.1,64z"/><path class="st5" d="M9.1,4C8.5,4,8,4.5,8,5.1V36c0,4.4,7.2,8,16,8L5.5,62.5C4.6,61.6,4,60.3,4,58.9V5.1C4,2.3,6.3,0,9.1,0V4z"/><path class="st6" d="M8.3,4.3C8.5,4.1,8.8,4,9.1,4c0.2,0,0.4,0.1,0.6,0.2l45.5,26.6C55.7,31,56,31.5,56,32c0,0.5-0.3,1-0.7,1.3   l-11.4,6.6l2.9,2.9l10.4-6.1c1.7-1,2.7-2.8,2.7-4.7c0-1.9-1-3.8-2.7-4.7L11.7,0.7C11,0.2,10.1,0,9.1,0C7.7,0,6.4,0.6,5.5,1.5   L8.3,4.3z"/></g></svg><p>Download the app in Google Play Store</p></div></a>';

               $('.time').append(txt);
            }
          });
        </script>

      </div>

      <div id='rb' class='pb-3'>
         <div  class='d-block mb-4 pl-2'>
           <input type='radio' id='rbe' name='rb' value='enable'/> <span id='ichecked'>Check Internet Speed</span>

           <svg style="margin-bottom:4px" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M15.9 5c-.17 0-.32.09-.41.23l-.07.15-5.18 11.65c-.16.29-.26.61-.26.96 0 1.11.9 2.01 2.01 2.01.96 0 1.77-.68 1.96-1.59l.01-.03L16.4 5.5c0-.28-.22-.5-.5-.5zM1 9l2 2c2.88-2.88 6.79-4.08 10.53-3.62l1.19-2.68C9.89 3.84 4.74 5.27 1 9zm20 2l2-2c-1.64-1.64-3.55-2.82-5.59-3.57l-.53 2.82c1.5.62 2.9 1.53 4.12 2.75zm-4 4l2-2c-.8-.8-1.7-1.42-2.66-1.89l-.55 2.92c.42.27.83.59 1.21.97zM5 13l2 2c1.13-1.13 2.56-1.79 4.03-2l1.28-2.88c-2.63-.08-5.3.87-7.31 2.88z"/></svg>
          </div>
          <h4 style="color:darkgoldenrod" class="pl-2">Top on the list</h4>
      <?php
        $color = ['#781D42', '#A3423C', '#DE834D', '#F0D290', '#E4CDA7', '#FFE6BC'];
        $i=0;
        $ra_query = mysqli_query($conn, "SELECT tname_true, tcount FROM radio ORDER BY tcount DESC limit 0,6");
         while($ra_result = mysqli_fetch_array($ra_query)){
          $tn = $ra_result['tname_true'];
          $tc = $ra_result['tcount'];
          echo '<div class="ml-2"><p class="pl-2 mb-0" style="background:'.$color[$i].';color:magenta; border-radius:0 18px 18px 0; padding:3px 0; width:'.(int)(($tc/$sum) * 100+40).'%">'.$tn.'<span style="color:white;float:right;padding-right:10px;">'.(int)(($tc/$sum) * 100).' %</span></p></div><br>';
          $i++;
         }
      ?>
      </div>
 </div>
 <div class="col-md-6">
    <div id="contents-list" class="card-body" style="max-height:100%;overflow:hidden;">
    </div>
 </div>
</div>
</div>
  <?php include('footer.php');
   include('non_myapps_corejs.php'); ?>
