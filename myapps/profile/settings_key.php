<?php
  require('../main/base.php');
  $prof_pic = $user['profile_pic'];

  $error_array    =   array();
  if( isset($_POST['log_button'])) {
       function validateFormDataLog($formData) {
          $formData = trim( stripslashes( htmlspecialchars( strip_tags( str_replace( array( '(', ')', ' ' ), '_', $formData ) ), ENT_QUOTES ) ) );
          return $formData;
          }
       $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);
       $emailLog = validateFormDataLog( $_POST['log_email'] );
       $passwordLog = validateFormDataLog( $_POST['log_password'] );

       $retrieve_users_count = mysqli_query($conn, "SELECT count(*) FROM users");
       $rowcount=mysqli_fetch_row( $retrieve_users_count);
       $limit =  $rowcount[0];
       $count = 1;
       $retrieve_users = mysqli_query($conn, "SELECT username, email, password, id FROM users");
       while($row = mysqli_fetch_array($retrieve_users)){
          $emailHassed = $row['email'];
          $passwordHassed = $row['password'];
          $emailDecoded =  decryptthis($emailHassed, $key);

          if( password_verify($passwordLog, $passwordHassed)){
             if($emailLog == $emailDecoded){

                $username_query = mysqli_query($conn, "SELECT username FROM users WHERE email='$emailHassed' AND username = '$userloggedin'");
                if($result= mysqli_num_rows($username_query) > 0 ){
                  $row = mysqli_fetch_array($username_query);
                  $usernameVer = $row['username'];
                  if($userloggedin == $usernameVer){
                  $user_closed_query = mysqli_query($conn, "SELECT username FROM users WHERE username = '$usernameVer' AND user_closed='yes'");

                  if(mysqli_num_rows($user_closed_query) == 1)
                   $reopen_account = mysqli_query($conn, "UPDATE users SET user_closed = 'no' WHERE username = '$usernameVer'");

      include('settings_handler.php');
       ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

   <script>
         $(document).ready(function() {
             $('.main_column_setting_key').hide();
         });
      </script>
      <head>
            <link rel="icon" type="image/jpg" href="../../../assets/images/icon/favicon.jpg">
            <style media="screen">
              img{
                width:210px;
                display:block;
                border-radius:50%;
                }
              .main_column_settings{
                position:absolute;
                margin:0;
                padding:6px;
                box-sizing:border-box;
                top:51px;
                 }
              a:hover{
                text-decoration:none;
                 }
            </style>
      </head>
      <p>&nbsp;</p>
       <div class="col-md-9">
         <div class="card card-body">
          <?php include('settings_mid.php'); ?>
         </div>

      <?php
      }
               else{
                   if($count > $limit ) {
                       break;
                      }
                     else{
                    $count++;
                         }
                  }
               }else{
                if($count > $limit ) {
                    break;
                   }
                  else{
                 $count++;
                      }
               }
            }
              else{
               if($count > $limit ) {
                   break;
                  }
                 else{
                $count++;
                     }
              }
           }else{
               if($count > $limit) {
                   break;
                  }
                 else{
                $count++;
                    }
               }
        }
            if($count > $limit){
              echo "<center class='alert alert-danger'>Email or Password incorrect!!<br></center>";
                 }
            else{}


    }
 mysqli_close($conn);
  ?>

      <div class="card card-body text-center main_column_setting_key" style="width: 300px;top: 40%;position: absolute;left: 50%;margin-left: -150px;margin-top: -150px;">
        <p>You are about to change your details.<br>
        Enter your Email and Password below.</p>
        <form action="settings_key" method="POST">
           <div class="mb-3">
            <label class="float-left" for="log_email">Email:</label>
            <input type="email" name="log_email" placeholder="Enter email" required class="form-control">
           </div>
           <div class="form-group">
             <label class="float-left" for="log_password">Password:</label>
            <input type="password" name="log_password" placeholder="Password" required class="form-control"><br>
           </div>
           <div class="form-group">
            <input type="submit" name="log_button" id="proceed" value="Proceed" class="btn btn-warning">
           </div>
         </form>
         <div class="form-group mt-2">
           <a href="../../index"><button class="btn btn-primary">Home</button></a>
         </div>
        </div>

      </div></div></div>
     <p>&nbsp;</p>
    </body>
    </html>
