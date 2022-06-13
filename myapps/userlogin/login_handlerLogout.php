<?php

 if( isset($_POST['login_button'])) {

     function validateFormDataLog($formData) {
        $formData = trim( stripslashes( htmlspecialchars( strip_tags( str_replace( array( '(', ')', ' ' ), '_', $formData ) ), ENT_QUOTES ) ) );
        return $formData;
        }

     $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);
     $_SESSION['log_email'] = strtolower($email);
     $emailLog = validateFormDataLog(strtolower($_POST['log_email']));
     $passwordLog = validateFormDataLog( $_POST['log_password'] );
     $cok=$_COOKIE['PHPSESSID'];

     $retrieve_users = mysqli_query($conn, "SELECT username, email, password, id FROM users");
     while($row = mysqli_fetch_array($retrieve_users)){

        $username = $row['username'];
        $emailHassed = $row['email'];
        $passwordHassed = $row['password'];
        $userid = $row['id'];
        $c_id = $row['id'];

        $emailDecoded =  decryptthis($emailHassed, $key);

     if( password_verify($passwordLog, $passwordHassed)) {
            if($emailLog == $emailDecoded || $emailLog  == $username){
             $username1 = $username;
             $user_closed_query = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username1' AND user_closed='yes'");
            if(mysqli_num_rows($user_closed_query) == 1)
             $reopen_account = mysqli_query($conn, "UPDATE users SET user_closed = 'no' WHERE username = '$username1'");

             //pwc change vaue back to zero
             mysqli_query($conn, "UPDATE users SET login = '1', cok='$cok' WHERE id = '$c_id'");

             $_SESSION['username'] = $username1;
             $_SESSION['id'] = $c_id;

             if(!empty($_POST['chckbox'])) {
              setcookie('QTSSTYU', $c_id, time()+34500000, '/');
              setcookie('PTSSPOL',$passwordHassed, time()+34500000, '/');
                } else {
                 setcookie('QTSSTYU','', time()-3600, '/');
                 setcookie('PTSSPOL','', time()-3600, '/');
                 }

              header("Location: ../../index");
              exit();

        }else{
           array_push($error_array, "Email or Password incorrect!!<br>");
          }
     }else{
           array_push($error_array, "Email or Password incorrect!!<br>");

          }
    }

 }

?>
