<?php if (isset($_POST['respond_request'])) {
    header("Location: request.php");
  }
    include('../main/base.php');
    include('../main/navbar.php');
    include('profile_top_user_info.php');
    $logged_in_user_obj = new User($conn, $userloggedin);
?>
<style media="screen">
   .content-container{
     display:flex;
     justify-content:space-evenly;
   }
   .content-items {
     flex-grow:1
   }
   .content-items:nth-child(2){
     flex-grow:50
   }

</style>
</head>
<main>
 <section class="mb-3 py-3 bg-white" style="border-bottom:12px solid #f2f2f2">
    <div class="px-3">
      <div class="row">

      <?php
        include('profile_sidebar.php'); ?>

       <section class="col-md-9">
         <article class="">
           <div class="">
             <div class="row gutters-sm">
               <div class="col-md-4 mb-3">
                 <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">

                    <?php
                          if ($logged_in_user_obj -> isFriend($username)) {
                               if ($username == 'support-service') {
                                   echo $profile_pic1; ?>
                                   <div class="pt-3">
                                   <form action="<?php echo $username; ?>" method="POST">
                                    <?php
                                       $profile_user_obj = new User($conn, $username);
                                       if ($profile_user_obj->isClosed()) {
                                           header("Location: user_closed?account_closed");
                                       }
                                       if ($logged_in_user_obj -> isFriend($username)) {
                                           echo '<center><input type="submit" name="remove_friend" class="default border-0"  value="Unfollow"></center><br>';
                                       } elseif ($logged_in_user_obj->didRecievedRequest($username)) {
                                           echo '<center><input type="submit" name="respond_request" class="default border-0"  value="Respond to Request"></center><br>';
                                       } elseif ($logged_in_user_obj->didSendRequest($username)) {
                                           echo '<center><input type="submit" name="" class="default border-0"  value="Request Sent"></center><br>';
                                       } else {
                                           echo '<center><input type="submit" name="add_friend" class="default border-0" value="Follow></center><br>';
                                       }
                                      ?>
                                     </form>
                                   </div>
                                 <?php
                                 } else {
                                     echo '<a href="../../../'.$profile_pic.'" data-fancybox>'.$profile_pic1.'</a>'; ?>
                                     <div class="pt-3">
                                       <form action="<?php echo $username; ?>" method="POST">
                                           <?php
                                           $profile_user_obj = new User($conn, $username);
                                           if ($profile_user_obj->isClosed()) {
                                               header("Location: user_closed.php");
                                           }
                                           if ($logged_in_user_obj -> isFriend($username)) {
                                               echo '<center><input type="submit" name="remove_friend" class="default border-0" value="Unfollow"></center><br>';
                                           } elseif ($logged_in_user_obj->didRecievedRequest($username)) {
                                               echo '<center><input type="submit" name="respond_request" class="default border-0" value="Respond to Request"></center><br>';
                                           } elseif ($logged_in_user_obj->didSendRequest($username)) {
                                               echo '<center><input type="submit" name="" class="default border-0" value="Request Sent"></center><br>';
                                           } else {
                                               echo '<center><input type="submit" name="add_friend" class="default border-0" value="Follow></center><br>';
                                           }
                                          ?>
                                      </form>
                                    </div>
                                <?php
                                }

                         } elseif ($username == $userloggedin) {
                             echo '<a href="../../../'.$profile_pic1.'" data-fancybox>'.$profile_pic1.'</a><br>';
                         } else {
                              echo "<img src='../../../".$profile_pic."' style='width:150px;height:150px;border-radius:50%;'>"; ?>
                              <div class="pt-3">
                               <form action="<?php echo $username; ?>" method="POST">
                                  <?php
                                  $profile_user_obj = new User($conn, $username);
                                  if ($profile_user_obj->isClosed()) {
                                     header("Location: user_closed.php");
                                  }

                                  if ($logged_in_user_obj -> isFriend($username)) {
                                     echo '<center><input type="submit" name="remove_friend" class="default border-0"  value="Unfollow"></center><br>';
                                  } elseif ($logged_in_user_obj->didRecievedRequest($username)) {
                                     echo '<center><input type="submit" name="respond_request" value="Respond to Request"></center><br>';
                                  } elseif ($logged_in_user_obj->didSendRequest($username)) {
                                     echo '<center><input type="submit" name="" class="default border-0" value="Request Sent"></center><br>';
                                  } else {
                                     echo '<center><input type="submit" name="add_friend" class="default border-0" value="Follow"></center><br>';
                                  }
                                  ?>
                              </form>
                             </div>
                           <?php
                           }
                       ?>

                         <div class="mt-3">
                           <h4><?php  echo $username ?></h4>
                           <p class="text-secondary mb-1"><?php  echo $skillsP; ?></p>
                           <p class="text-muted font-size-sm"><?php  echo $cityP; echo $countryP; ?></p>
                         </div>
                          <?php

                          if ($username == $userloggedin) {
                              echo'<a style="background:grey;padding:3px 12px;color:#fff;borde" href="settings_key?edit-info">Edit Info</a>';
                          } else {} ?>

                       </div>
                     </div>

                 </div>

                       <div class="col-md-8">
                         <div class="mb-3">
                           <div class="">
                             <div class="row">
                               <div class="col-sm-3">
                                 <h6 class="mb-0">Full Name</h6>
                               </div>
                               <div class="col-sm-9 text-secondary">

                                <?php if($username==$userloggedin) {echo $loggedNameP.' '.$loggedLastNameP;}else{
                                    echo '* * * * * * * *';
                                  } ?>

                               </div>
                             </div>

                             <div class="row">
                               <div class="col-sm-3">
                                 <h6 class="mb-0">Email</h6>
                               </div>
                               <div class="col-sm-9 text-secondary">

                                <?php  if($username==$userloggedin){echo $email;
                                   }else{
                                      echo '* * * * * * * *';
                                    } ?>

                               </div>
                             </div>

                             <div class="row">
                               <div class="col-sm-3">
                                 <h6 class="mb-0">Address</h6>
                               </div>
                               <div class="col-sm-9 text-secondary">
                                 <?php  echo $cityP; echo $countryP; ?>
                               </div>
                             </div>

                             <div class="row">
                               <div class="col-sm-3">
                                 <h6 class="mb-0">Profession</h6>
                               </div>
                               <div class="col-sm-9 text-secondary">
                                 <?php  echo $skillsP; ?>
                               </div>
                             </div>
                           </div>
                         </div>
                          <?php include('album-link.php'); ?>
                       </div>

                     </div>
              </div>

              <div class="date_area">
                 <?php
                    include('profile_inv_cond.php');
                    include('prfile_group_cond.php');
                    if ($userloggedin == 'support-service') {
                      $guest_query=mysqli_query($conn, "SELECT date_1, date_now, country, page FROM user_ip");
                      $i=0;
                      $j=0;
                      $now=date("Y-m-d H:i:s");

                      echo 'List of todays Guest<br>';
                      $page_list = [];
                      $country_list = [];
                      while ($result = mysqli_fetch_array($guest_query)) {
                        // $country=$result['country'];
                        $days_now=$result['date_now'];

                        $d1= new DateTime($days_now);
                        $d2= new DateTime($now);
                        $interval=$d1->diff($d2);
                        $diff_days=$interval->d;
                        if($diff_days <= 1){
                          $i++;
                          $page=$result['page'];
                          $country=$result['country'];
                          array_push($page_list, $page);
                          array_push($country_list, $country);
                        }
                      }

                      echo '<hr>';
                      echo 'List with returning Guest more than or equal to 7 days<br>';
                      while ($resultb = mysqli_fetch_array($guest_query)) {
                        $country=$resultb['country'];
                        $days_now=$resultb['date_now'];
                        $first_date=$resultb['date_1'];
                        $page=$resultb['page'];

                        $d1= new DateTime($days_now);
                        $d3= new DateTime($first_date);
                        $intervalb=$d3->diff($d1);
                        $diff_dayb=$intervalb->d;
                        if( $diff_dayb >= 7 ){
                          $j++;
                          }
                        }

                         echo'<table border="1" cellpadding="5px"><tr><td>';
                         printf("<em style='margin:auto'>Current Members : %d</em>\n", $rowcount);

                         if ($logged_in_user_obj -> getUsername($username)) {
                             $username1=$logged_in_user_obj;
                             $last_online_query = mysqli_query($conn, "SELECT tm FROM users where username = '$username'");
                             $resultLastOnline = mysqli_fetch_array($last_online_query);
                             $LastTime = $resultLastOnline['tm'];
                         }
                         echo '</td><td>';

                         $date = date("M / d / Y", strtotime("+8 hour", strtotime($LastTime)))." "." ". date("l, \a\\t g.i a", strtotime("+8 hour", strtotime($LastTime)));

                         echo '<center>Last time active:  '.$date.'</center>';
                         echo'</td></tr><tr><td>Today Guests: <span class="border-left px-2">'.$i.'</span></td><td><span class="border-left px-2">Returning >= 7 days</span><span class="border-left px-2">'.$j.'</span></td></tr><tr><td>';
                         foreach($page_list as $pages){
                           echo $pages.'<br>';
                         }
                         echo '</td><td>';
                         foreach($country_list as $countries){
                           echo $countries.'<br>';
                         }
                         echo '</td></tr></table>';
                     }
                 ?>
               </div>
            </article> <!-- order-group.// -->
          </section>
      </div> <!-- row.// -->
     </div>
 </section>
  <!-- posts part -->

 <?php  if($userloggedin == 'support-service') { ?>
  <section class="bg-white">
   <?php
    if ($logged_in_user_obj -> isFriendcopy($username) || $userloggedin == 'support-service') {?>
       <div class="post_area"></div>
       <center><img id="loading" src="../../../assets/images/icon/loading.gif"></center>
       <div class="d-inline-block" style="margin-left:-23px;position:relative;left:50%;"><a href="#" class="back-to-top"></a></div>
    <?php } ?>
  </section>
</main>
 <?php } ?>
  <?php
     include('../main/footer.php');
     include('profilejs.php');
   ?>

</body>
</html>
