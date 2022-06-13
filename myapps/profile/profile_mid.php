<div class="profile_left" >
   <?php
      $fr_online="";
      $num_online = 0;
      $convos = array();
      $logged_in_user_obj = new User($conn, $userloggedin);
   ?>
   <div class="clearFix">
    <div>
          <?php
          if ($logged_in_user_obj -> isFriend($username)) {
               if ($username == 'support-service') {
                   echo "<img class='propic' src='$profile_pic'><br>"; ?>
                   <form action="<?php echo $username; ?>" method="POST">
                    <?php
                       $profile_user_obj = new User($conn, $username);
                       if ($profile_user_obj->isClosed()) {
                           header("Location: user_closed?account_closed");
                       }
                       if ($logged_in_user_obj -> isFriend($username)) {
                           echo '<center><input type="submit" name="remove_friend" value="Unfollow"></center><br>';
                       } elseif ($logged_in_user_obj->didRecievedRequest($username)) {
                           echo '<center><input type="submit" name="respond_request" value="Respond to Request"></center><br>';
                       } elseif ($logged_in_user_obj->didSendRequest($username)) {
                           echo '<center><input type="submit" name="" class="default" value="Request Sent"></center><br>';
                       } else {
                           echo '<center><input type="submit" name="add_friend" value="Follow></center><br>';
                       }
                    ?>
                   </form>
                 <?php
                 } else {
                     echo '<a href="'.$profile_pic.'" data-fancybox>'.$profile_pic1.'</a>'; ?>
                     <form action="<?php echo $username; ?>" method="POST">
                         <?php
                         $profile_user_obj = new User($conn, $username);
                         if ($profile_user_obj->isClosed()) {
                             header("Location: user_closed.php");
                         }
                         if ($logged_in_user_obj -> isFriend($username)) {
                             echo '<center><input type="submit" name="remove_friend" value="Unfollow"></center><br>';
                         } elseif ($logged_in_user_obj->didRecievedRequest($username)) {
                             echo '<center><input type="submit" name="respond_request" value="Respond to Request"></center><br>';
                         } elseif ($logged_in_user_obj->didSendRequest($username)) {
                             echo '<center><input type="submit" name="" class="default" value="Request Sent"></center><br>';
                         } else {
                             echo '<center><input type="submit" name="add_friend" value="Follow></center><br>';
                         }
                        ?>
                    </form>
                <?php
                }
         } elseif ($username == $userloggedin) {
             echo '<a href="'.$profile_pic.'" data-fancybox>'.$profile_pic1.'</a><br>';
         } else {
              echo "<img class='propic' src='$profile_pic'>"; ?>
              <form action="<?php echo $username; ?>" method="POST">
                  <?php
                  $profile_user_obj = new User($conn, $username);
                  if ($profile_user_obj->isClosed()) {
                     header("Location: user_closed.php");
                  }

                  if ($logged_in_user_obj -> isFriend($username)) {
                     echo '<center><input type="submit" name="remove_friend" value="Unfollow"></center><br>';
                  } elseif ($logged_in_user_obj->didRecievedRequest($username)) {
                     echo '<center><input type="submit" name="respond_request" value="Respond to Request"></center><br>';
                  } elseif ($logged_in_user_obj->didSendRequest($username)) {
                     echo '<center><input type="submit" name="" class="default" value="Request Sent"></center><br>';
                  } else {
                     echo '<center><input type="submit" name="add_friend" value="Follow"></center><br>';
                  }
                  ?>
             </form>
           <?php
           }

       if ($username == "support-service") {
           echo '<table border="0" cellspacing="5" cellpadding="3" style="margin:10px;">';
           echo '<tr><td style="width:25%">Username<strong>:</strong></td><td>'.$username.'</td></tr>';
           echo'<tr><td>Services Offered<strong>:</strong></td><td>'.$skillsP.'</td></tr>';
           if ($userloggedin == 'support-service') {
               echo'<tr><td>Email<strong>:</strong></td><td>'.$email.'</td></tr>';
               echo'<a style="background:grey;padding:3px 12px;color:#fff;borde" href="settings_key?edit-info">Edit Info</a>';
           } else {
           }

           echo  '</table>';
       } elseif ($username == $userloggedin) {
           echo '</span><table border="0" cellspacing="5" cellpadding="3" style="margin:10px;">';
           echo '<tr><td style="width:25%">Username<strong>:</strong></td><td>'.$username.'</td></tr>';
           echo '<tr><td>City<strong>:</strong></td><td>'.$cityP.'</td></tr>';
           echo'<tr><td>Country<strong>:</strong></td><td>'.$countryP.'</td></tr>';
           echo'<tr><td>Skills<strong>:</strong></td><td>'.$skillsP.'</td></tr>';
           echo '<tr><td>Hobby<strong>:</strong></td><td>'.$hobbyP.'</td></tr>';
           echo'<tr><td>Email<strong>:</strong></td><td>'.$email.'</td></tr>';
           echo  '</table>';
           echo'<a style="background:grey;padding:3px 12px;color:#fff;borde" href="settings_key?edit-info">Edit Info</a>';
       } else {
           echo '</span>

                 <table border="0" cellspacing="5" cellpadding="3" style="margin:10px;">';
           echo '<tr><td style="width:25%">Username<strong>:</strong></td><td>'.$username.'</td></tr>';
           echo '<tr><td>City<strong>:</strong></td><td>'.$cityP.'</td></tr>';
           echo'<tr><td>Country<strong>:</strong></td><td>'.$countryP.'</td></tr>';
           echo'<tr><td>Skills<strong>:</strong></td><td>'.$skillsP.'</td></tr>';
           echo '<tr><td>Hobby<strong>:</strong></td><td>'.$hobbyP.'</td></tr>';
           echo  '</table>';
       } ?>
   </div><br>
         <div id="uers">
           <?php include('profile_midinmid.php'); ?>
         </div>
   </div>
</div>
