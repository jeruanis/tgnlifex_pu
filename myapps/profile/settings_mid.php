<?php
  if (in_array("Invalid email format..<br>", $error_array)) echo "<div class='alert alert-danger'>Invalid email format..<br></div>";
  elseif (in_array("Email already in use..<br>", $error_array)) echo "<div class='alert alert-danger'> Email already in use..<br> </div>";
  elseif (in_array("Email Successfully Updated!<br>", $error_array)) echo "<div class='alert alert-danger'>Email Successfully Updated!<br></div>";
  elseif (in_array("Successfully Updated!<br>", $error_array)) echo "<div class='alert alert-danger'>Successfully Updated!</div>";
  elseif (in_array("Your password must be greater than 4 characters", $error_array)) echo "<div class='alert alert-danger'>Your password must be greater than 4 characters</div>";
  elseif (in_array("Password Successfully Updated!<br>", $error_array)) echo "<div class='alert alert-danger'>Password Successfully Updated!<br></div>";
  elseif (in_array("Your password did not match!<br>", $error_array)) echo "<div class='alert alert-danger'>Your password did not match!<br></div>";
  elseif (in_array("The old password is incorrect!<br>", $error_array)) echo "<div class='alert alert-danger'>The old password is incorrect!<br></div>";
  elseif (in_array("Your pasword must be 5 to 30 characters with atleast one letter and one number", $error_array)) echo "<div class='alert alert-danger'>Your pasword must be 5 to 30 characters with atleast one letter and one number</div>";
  elseif (in_array("There was an error updating passoword", $error_array)) echo "<div class='alert alert-danger'>There was an error updating passoword</div>";

      $user_data_query = mysqli_query($conn, "SELECT * FROM users WHERE username='$userloggedin'");
      $row = mysqli_fetch_array($user_data_query);

        $firstNameHassed = $row['first_name'];
        $lastNameHassed = $row['last_name'];
        $emailHassed =  $row['email'];
        $cityHassed = $row['city'];
        $countryHassed = $row['country'];
        $firstName = ucfirst(decryptthis($firstNameHassed, $key));
        $lastName = ucfirst(decryptthis($lastNameHassed, $key));
        $email = decryptthis($emailHassed, $key);
         if($cityHassed != "")
              $city = decryptthis($cityHassed, $key);
          if($countryHassed)
              $country = decryptthis($countryHassed, $key);
        $skills = $row['skills'];
        $hobby = $row['hobby'];
        $skills1=str_replace('_', ' ', $skills);
        $hobby1=str_replace('_', ' ', $hobby);
        $prof_pic = $user['profile_pic'];
?>

      <h4>Acount Settings</h4>
      <a  href='#'><img src="<?php echo '../../../'.$prof_pic; ?>" id='small_profile_pics'></a>

      <div id='upload_link'></div>
    <script>
        $(document).ready(function(){

         if(window.matchMedia("(min-width:600px)").matches){
          var div =document.getElementById('upload_link');
          var a = document.createElement('a');
          div.classList.add('m-3');
          a.classList.add('pl-4');
          a.href = 'upload';
          a.innerText = 'Upload photo';
          div.appendChild(a);
        }else{
          var div =document.getElementById('upload_link');
          var p = document.createElement('p');
          div.classList.add('m-3');
          p.innerText = 'Go to website to upload photo';
          a2 = document.createElement('a');
          a2.href = 'https://tgnlife.com';
          a2.innerText = 'Click here.';
          a2.classList.add('pl-2');
          a2.classList.add('font-weight-bold');
          a2.style.color= '#007bff'
          p.appendChild(a2);
          div.appendChild(p);
        }

       });
    </script>

  <div class='settings_info'>
    <?php if($userloggedin != 'support-service') { ?>
      <form action='settingsACleaned?update_info'  method='POST'>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type='text' name='email' value='<?php echo $email; ?>' class='form-control'>
          </div>
          <div class="form-group">
            <label for="name">Name:</label>
            <input type='text' name='fname' id='nameuse' class='form-control' value='<?php echo $firstName." ".$lastName; ?>'><br>
          </div>
          <div class="form-group mt-2 pb-5">
           <input type='submit' name='update_email' class='btn btn-info btn-sm' value='Update Email'>
         </div>
          <div class="form-group">
            <label for="city">City</label>
            <input type='text' name='city'  value='<?php echo $city; ?>' class='form-control'>
          </div>
          <div class="form-group">
            <label for="country">Country</label>
            <input type='text' name='country'  value='<?php echo $country; ?>' class='form-control'>
          </div>
          <div class="form-group">
            <label for="skills">Profession</label>
            <textarea type='text' name='skills' class='form-control'><?php echo $skills1; ?></textarea>
          </div>
          <div class="form-group">
            <label for="hobby">Hobby</label>
            <textarea type='text' name='hobby' class='form-control'><?php echo $hobby1; ?></textarea>
          </div>
          <div class="form-group mt-2 pb-5">
             <input type='submit' name='update_address' class='btn btn-info btn-sm' value='Update City, Country, Skills, Hobby'>
          </div>
      </form>
  <?php }else{ ?>
      <form action='settingsACleaned?update_info'  method='POST'>
        <div class="form-group">
          <label for="email">Email</label>
          <input type='text' name='email' value='<?php echo $email; ?>' class='form-control'>
        </div>
        <div class="form-group">
          <label for="name">Name</label>
          <input type='text' id='nameuse' class='form-control' value='<?php echo $firstName." ".$lastName; ?>'>
        </div>
        <div class="form-group mt-2 pb-5">
          <input type='submit' name='update_email' class='btn btn-info btn-sm' value='Update Email'>
        </div>
        <div class="form-group">
          <label for="city">City</label>
          <input type='text' name='city'  value='<?php echo $city; ?>' class='form-control'>
        </div>
        <div class="form-group">
          <label for="country">Country</label>
          <input type='text' name='country'  value='<?php echo $country; ?>' class='form-control'>
        </div>
        <div class="form-group">
          <label for="skills">Profession</label>
          <textarea rows='4' cols='50' type='text' name='skills' class='form-control'><?php echo $skills1; ?></textarea>
        </div>
        <div class="form-group">
          <label for="hobby">Hobby</label>
          <textarea rows='4' cols='50' type='text' name='hobby' class='form-control'><?php echo $hobby1; ?></textarea>
        </div>
        <div class="form-group mt-2 pb-5">
          <input type='submit' name='update_address' class='btn btn-info btn-sm' value='Update City, Country, Skills, Hobby'>
        </div>
      </form>
   <?php } ?>
  <h4>Change Password</h4>
  <form action='settingsACleaned?update_info'  method='POST'>
    <div class="form-group">
      <label for="old_password">Old Password</label>
      <input type='password' name='old_password' class='form-control' required>
    </div>
    <div class="form-group">
      <label for="new_password1">New Password</label>
      <input type='password' name='new_password1' class='form-control' required>
    </div>
    <div class="form-group">
      <label for="new_password2">New Password Confirm</label>
      <input type='password' name='new_password2' class='form-control' required>
    </div>
    <div class="form-group mt-2 pb-5">
      <input type='submit' name='update_password' class='btn btn-info btn-sm' id='save_details' value='Update Password'>
    </div>
  </form>

  <button data-toggle="modal" data-target="#myModal" class="btn btn-danger btn-md">Close Account</button>
  <a href="settings_key" class="btn btn-primary btn-md">Exit</a>

<?php echo "<script>
   $('#nameuse').attr('disabled','disabled');
  </script>";
?>
</div>
