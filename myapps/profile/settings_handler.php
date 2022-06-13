<?php

$username=$email=$first_name=$password=$country=$city=$gender=$last_name = $skills= $fname=$lname=$num_rows="";
$usernameError=$emailError=$aboutError=$nameError=$passwordError=$countryError=$cityError=$genderError=$err_message=$rows=$ema="";
$error_array = array();

   if (isset($_POST['update_email'])) {
       function validateFormDataLog($formData){
         $formData = trim(stripslashes(htmlspecialchars(strip_tags(str_replace(array( '(', ')', ' ' ), '_', $formData)), ENT_QUOTES)));
         return $formData;
       }

       if (!$_POST["email"]) {
       } elseif (!filter_var(($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
           array_push($error_array, "Invalid email format..<br>");
       } else {
           $email = validateFormDataLog($_POST["email"]);
       }

       $retrieve_users_count = mysqli_query($conn, "SELECT count(*) FROM users");
       $rowcount=mysqli_fetch_row($retrieve_users_count);
       $limit =  $rowcount[0];
       $count = 1;
       $retrieve_users = mysqli_query($conn, "SELECT email FROM users");
       while ($row = mysqli_fetch_array($retrieve_users)) {
           $emailHassed = $row['email'];
           $emailDecoded =  decryptthis($emailHassed, $key);

           if ($email == $emailDecoded) {
               array_push($error_array, "Email already in use..<br>");
               break;
           } else {
               if ($count > $limit) {
                   break;
               } else {
                   $count++;
               }
           }
       }
       if ($count > $limit) {
           if (empty($error_array)) {
               $emailUpdated = encryptthis($email, $key);
               $query = mysqli_query($conn, "UPDATE users SET email='$emailUpdated' WHERE username='$userloggedin'");
               array_push($error_array, "Email Successfully Updated!<br>");
           }
       } else {
       }
   }


  if (isset($_POST['update_address'])) {
      function validateFormDataLog($formData){
          $formData = trim(stripslashes(htmlspecialchars(strip_tags(str_replace(array( '(', ')', ' ' ), '_', $formData)), ENT_QUOTES)));
          return $formData;
      }

      if (!$_POST["city"]) {
          $cityHassed="";
      } else {
          $city = validateFormDataLog($_POST["city"]);
          $cityHassed = encryptthis($city, $key);
      }


      if (!$_POST["country"]) {
        $countryHassed ="";
      } else {
          $country = validateFormDataLog($_POST["country"]);
          $countryHassed = encryptthis($country, $key);
      }


      if (!$_POST["skills"]) {
      } else {
          $skills = validateFormDataLog($_POST["skills"]);
      }
      if (!$_POST["hobby"]) {
      } else {
          $hobby = validateFormDataLog($_POST["hobby"]);
      }



      if (empty($error_array)) {
          $query = mysqli_query($conn, "UPDATE users SET city='$cityHassed', country='$countryHassed', skills='$skills', hobby='$hobby' WHERE username='$userloggedin'");
          array_push($error_array, "Successfully Updated!<br>");
      }
  }


if (isset($_POST['update_password'])) {
    function validateFormDataLog($formData){
        $formData = trim(stripslashes(htmlspecialchars(strip_tags(str_replace(array( '(', ')', ' ' ), '_', $formData)), ENT_QUOTES)));
        return $formData;
    }

    if (!$_POST["old_password"]) {
    } else {
        $old_password = validateFormDataLog($_POST['old_password']);
    }

    if (!$_POST["new_password1"]) {
    } else {
        $new_password1 = validateFormDataLog($_POST['new_password1']);
    }
    if (!$_POST["new_password2"]) {
    } else {
        $new_password2 = validateFormDataLog($_POST['new_password2']);
    }

    $password_query = mysqli_query($conn, "SELECT password FROM users WHERE username='$userloggedin'");
    $row = mysqli_fetch_array($password_query);
    $db_password = $row['password'];

    if (password_verify($old_password, $db_password)) {
        if ($new_password1 == $new_password2) {
            if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{5,30}$/', $new_password1)){
                array_push($error_array, "Your pasword must be 5 to 30 characters with atleast one letter and one number");
            }else{
                $new_password1 = password_hash($_POST['new_password1'], PASSWORD_DEFAULT);
                $password_query = mysqli_query($conn, "UPDATE users SET password='$new_password1', pwc='1' WHERE username='$userloggedin'");
                if($password_query)
                    array_push($error_array, "Password Successfully Updated!<br>");
                else {
                  array_push($error_array, "There was an error updating passoword");
                }
            }
        } else {
            array_push($error_array, "Your password did not match!<br>");
        }
    } else {
        array_push($error_array, "The old password is incorrect!<br>");
    }
} else {
    $password_message = "";
}

?>
    
  <!-- //placed here since common to Acleaned -->
  <div class="modal" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Notice</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>You are about to deactivate your account? People cannot be able to search you nor see all your posts once deactivated. You can come back anytime just signin to reactivate.</p>
        </div>
        <div class="modal-footer">
          <a href="close_account_confirmation?v=account_deactivation_successful" class="btn btn-primary">Proceed</a>
          <a href="#" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
        </div>
      </div>
    </div>
    </div>
