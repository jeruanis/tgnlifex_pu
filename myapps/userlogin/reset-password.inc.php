<?php

if (isset($_POST['reset-password-submit'])) {
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["pwd"];
    $passwordRepeat = $_POST["pwd-repeat"];

    if (empty($password) || empty($passwordRepeat)) {

          array_push($error_array, "<div class='alert alert-warning' role='alert'>You haven't entered new password yet.</div>");
    }elseif ($password != $passwordRepeat) {

            array_push($error_array, "<div class='alert alert-warning' role='alert'>Password you enter did not matched.</div>");
    }elseif(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{5,30}$/', $password)) {

            array_push($error_array, "<div class='alert alert-warning' role='alert'>Your pasword must be 5 to 30 characters with atleast one letter and one number </div>");
      }else{

    $currentDate = date("U");
    require "../../../configuration/config.php";
    $sql = "SELECT * FROM pwdreset WHERE pwdResetSelector=? AND pwdResetExpires>='$currentDate'";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {

        array_push($error_array, "<div class='alert alert-warning' role='alert'>There was an error5</div>");
      } else {
        mysqli_stmt_bind_param($stmt, "s", $selector);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result)) {

            array_push($error_array, "<div class='alert alert-warning' role='alert'>You need to resubmit your password reset request1.</div>");
          } else {
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row['pwdResetToken']);

            if ($tokenCheck === false) {

                array_push($error_array, "<div class='alert alert-warning' role='alert'>You need to resubmit your password reset request2.</div>");
              } else {
                $tokenEmail = $row['pwdResetEmail'];
                $retrieve_users_email = mysqli_query($conn, "SELECT email FROM users");
                while ($row = mysqli_fetch_array($retrieve_users_email)) {
                    $emailHassed = $row['email'];
                    $emailDecoded =  decryptthis($emailHassed, $key);
                    if ($tokenEmail == $emailDecoded) {
                        $tokenEmail = $emailHassed;
                        $sql = "SELECT * FROM users WHERE email=?;";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {

                            array_push($error_array, "<div class='alert alert-warning' role='alert'>There was an error1</div>");
                           } else {
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                if (!$row = mysqli_fetch_assoc($result)) {

                                    array_push($error_array, "<div class='alert alert-warning' role='alert'>There was an error2</div>");
                                    exit();
                                    } else {
                                        $sql = "UPDATE users SET password=?, pwc=?, cok=? WHERE email = ?;";
                                        $stmt = mysqli_stmt_init($conn);
                                        if (!mysqli_stmt_prepare($stmt, $sql)) {

                                            array_push($error_array, "<div class='alert alert-warning' role='alert'>There was an error3</div>");
                                            exit();
                                            } else {
                                                $pwc=1;
                                                $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
                                                mysqli_stmt_bind_param($stmt, "siss", $newPwdHash, $pwc, $tokenEmail);
                                                mysqli_stmt_execute($stmt);

                                                $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?;";
                                                $stmt = mysqli_stmt_init($conn);
                                                if (!mysqli_stmt_prepare($stmt, $sql)) {

                                                    array_push($error_array, "<div class='alert alert-warning' role='alert'>There was an error4</div>");
                                                    exit();
                                                } else {
                                                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail)  ;
                                                    mysqli_stmt_execute($stmt);
                                                    header("Location: registration_signup_page?password-updated");
                                                }
                                         }
                                  }
                              }
                      }

                    //   else{echo "<div class='alert alert-secondary' role='alert'>Email doesn't exists.</div>";
                    //     array_push($error_array, "<div class='alert alert-secondary' role='alert'>Email doesn't exists.</div>");} //if email decoded

                 } //while loop
              }//tokenCheck
          }
        }
      }
     }
