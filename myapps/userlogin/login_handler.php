<?php

 if( isset($_POST['login_button'])) {

     function validateFormDataLog($formData) {
        $formData = trim( stripslashes( htmlspecialchars( strip_tags( str_replace( array( '(', ')', ' ' ), '_', $formData ) ), ENT_QUOTES ) ) );
        return $formData;
        }

     $passwordLog = validateFormDataLog( $_POST['log_password'] );
     $id_log = validateFormDataLog( $_POST['id'] );

     $retrieve_users = mysqli_query($conn, "SELECT username, email, password, id FROM users");
     while($row = mysqli_fetch_array($retrieve_users)){

        $id = $row['id'];
        $username = $row['username'];
        $emailHassed = $row['email'];
        $passwordHassed = $row['password'];

        $emailDecoded =  decryptthis($emailHassed, $key);
     if(password_verify($passwordLog, $passwordHassed)) {
            if($id_log == $_COOKIE['QTSSTYU']){

             $username1 = $username;
             $c_id = $id;
             $c_id = $id;
             $user_closed = 'yes';

             $user_closed_query = "SELECT username FROM users WHERE id = ? AND user_closed=?"); 
             $stmt = mysqli_stmt_init($conn);
             mysqli_stmt_prepare($stmt, $user_closed_query);
             mysqli_stmt_bind_param($stmt, "is", $c_id, $user_closed);
             mysqli_stmt_execute($stmt);
             $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) == 1){
                $user_closed = 'no';
                $reopen_account = mysqli_query($conn, "UPDATE users SET user_closed=? WHERE id=?");
                mysqli_stmt_prepare($stmt, $reopen_account);
                mysqli_stmt_bind_param($stmt, "si", $user_closed, $c_id);
                mysqli_stmt_execute($stmt);
             }

             $_SESSION['username'] = $username1;
             $_SESSION['id'] = $c_id;

             if(!empty($_POST['chckbox'])) {
              setcookie('QTSSTYU', $c_id, time()+34500000, '/');
              setcookie('PTSSPOL',$passwordHassed, time()+34500000, '/');
                } else {
                 setcookie('QTSSTYU','', time()-3600, '/');
                 setcookie('PTSSPOL','', time()-3600, '/');
                 }

              header("Location: ../../index?enjoy-playing-music");
               exit();

            }else{
                // header("Location: ../../player?you-are-not-login");

              }
        }else{
        //   header("Location: ../../player?you-are-not-login1");

          }
      }
      header("Location: ../../index?you-are-not-login");
       exit();
   }


?>
