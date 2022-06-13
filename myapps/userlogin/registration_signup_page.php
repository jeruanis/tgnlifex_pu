<?php
  require_once("../../../configuration/config.php");
  require 'register_handler.php';
  require 'login_handlerLogout.php';
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"
lang="en">
<head>
    <title>TGN LIFE</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../static/css/registration.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="shortcut icon"  type="image/jpg" href="../../../assets/images/background/favicon.jpg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../../static/js/register.js"></script>
</head>

   <?php
       if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
          include('../../body.php');
       }else{
         echo"<body>";
        }

      include('registration_signup_page_mid.php');
    ?>
  <div class="login_box">
    <div id="first">
        <form action="registration_signup_page" method="POST">
            <br>
        <?php if(isset($_SESSION['username'])){
           echo "<div style='position:relative'><i class='far fa-user' style='position:absolute;top: 3px;left: 3px;'></i>
                <input type='text' name='log_email' placeholder='Username or Email' value='".$_SESSION['username']."'>
               </div>";
            } else{
                echo "<div style='position:relative'><i class='far fa-user' style='position:absolute;top: 10px;left: 3px;'></i>
                <input class='form-control' type='text' name='log_email' placeholder='Username or Email'>

               </div>";
              } ?>

                <br><br>

            <div style='position:relative'>
                <i class="fas fa-lock" style="position:absolute;top: 10px;left: 3px;"></i>
                <input class="form-control" type="password" name="log_password" placeholder="Password">
            </div>
              <br>

                <p style="float: left;"><a href="reset-password?sendemail-linkforpassword">Forgot Password?</a></p>
                <br><br><br>
                    <hr style="width:45%;min-width:300px;margin:20px auto;">
            <input class="btn btn-md btn-info" type="submit" name="login_button" value="Log in">
                <br><br>

            <div style='float: left;display: inline-block;padding: 5px 0 0 15px;'>
                <input type="checkbox" name="chckbox" style="font-size:12px;" checked>
                <span>Stay logged in</span>&nbsp;&nbsp;
                <span data-tooltip='For safety do not check when on public network or computer'>
                    <i class="fas fa-question-circle qmark"></i>
                </span>

            </div>

              <a style="color:#007bff;font-weight:bold" class="btn" href="../../index">Home</a>

                <br>

                <?php

                  if(in_array("Email or Password incorrect!!<br>", $error_array))
                        echo "<div class='alert alert-danger' role='alert'>Email or Password incorrect!!<br></div>";

                   if(isset($_GET['newpwd'])) {
                     if($_GET['newpwd'] == "passwordupdated") {
                        echo "<div class='alert alert-warning' role='alert'>Your password has been reset!</div>";
                        }
                     }

                    if(isset($_GET['v'])) {
                      if($_GET['v'] == "account_deactivation_successful")
                         echo "<div class='alert alert-warning' role='alert'>Your account has successfully deactivated!</div>";
                      elseif($_GET['v'] == "logout_success")
                         echo "<div class='alert alert-warning' role='alert'>Your have succesfully logedout!</div>";
                     }

                ?>

                <br><br>

            <div id="Signup" style="border: none">
              <span>Not yet a member?&nbsp;</span><a href="#" id="signup" class="signup" style="text-align: center; position: relative;border:none;color:#3742fa;">Sign up</a>
            </div>
        </form>
    </div> <!--//first-->

    <div id="second">
        <form action="registration_signup_page" method="POST">
            <input class="form-control" type="text" name="reg_fname" placeholder="First Name" value="<?php
                if(isset($_SESSION['reg_fname'])) {
                    echo $_SESSION['reg_fname'];
                } ?>" required>
            <input class="form-control" type="text" name="reg_lname" placeholder="Last Name" value="<?php
                if(isset($_SESSION['reg_lname'])) {
                    echo $_SESSION['reg_lname'];
                } ?>" required>
                 <br>
            <input class="form-control" type="email" name="reg_email" placeholder="Email" value="<?php
                if(isset($_SESSION['reg_email'])) {
                    echo $_SESSION['reg_email'];
                } ?>" required>
            <input class="form-control" type="email" name="reg_email2" placeholder="Confirm Email" value="<?php
                if(isset($_SESSION['reg_email2'])) {
                    echo $_SESSION['reg_email2'];
                } ?>" required>
                  <br>
            <input class="form-control" type="password" name="reg_password" placeholder="Password" required>
            <input class="form-control" type="password" name="reg_password2" placeholder="Confirm Password" required>
                <br><br>

            <?php

                if(in_array("Your password do not match<br>", $error_array)) echo "<div style='color: red';>Your password do not match<br></div>";
                elseif(in_array(" Your password can only contain english characters or numbers<br>", $error_array)) echo " <div style='color: red';>Your password can only contain english characters or numbers<br></div>";
                elseif(in_array("Your pasword must be 5 to 30 characters with atleast one letter and one number <br>", $error_array)) echo "<div style='color: red';>Your pasword must be 5 to 30 characters with atleast one letter and one number <br></div>";

                if(in_array("Username already in use!<br>", $error_array)) echo "<div style='color: red';>Username already in use!<br></div>";
                elseif(in_array("First name cannot be used!<br>", $error_array)) echo "<div style='color: red';>First name cannot be used!<br></div>";
                elseif(in_array("Last name cannot be used!<br>", $error_array)) echo "<div style='color: red';>Last name cannot be used!<br></div>";

                if(in_array("Name is required..<br>", $error_array)) echo "<div style='color: red';> Name is required..<br></div> ";
                elseif(in_array("Only letters and white space allowed..<br>", $error_array)) echo "<div style='color: red';> Only letters and white space allowed..<br></div> ";
                elseif(in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "<div style='color: red';> Your first name must be between 2 and 25 characters<br></div> ";
                elseif(in_array("Lastname is required..<br>", $error_array)) echo "<div style='color: red';> Lastname is required..<br></div> ";
                elseif(in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "<div style='color: red';> Your last name must be between 2 and 25 characters<br></div> ";

                if(in_array("Confirm your email..<br>", $error_array)) echo "<div style='color: red';> Confirm your email..<br></div> ";
                elseif(in_array("Email already in use..<br>", $error_array)) echo "<div style='color: red';> Email already in use..<br></div> ";
                elseif(in_array("Invalid Email Format<br>", $error_array)) echo "<div style='color: red';> Invalid Email Format<br></div> ";
                elseif(in_array("Emails don't match<br>", $error_array)) echo "<div style='color: red';> Emails don't match<br></div> ";

            ?>

            <input type="submit" name="register_button" value="Join" style="width:100%;color:white;background:#f9980e;height:40px;font-size: 17px;">

            <br><br>

            <span id="account">Already have an account?
               <a href="registration_signup_page?thankyoucomeagain" id="signin" class="signin">Log in</a>
            </span>
        </form>
    </div>
  </div>
</body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
</html>
