
<!DOCTYPE html>
<html>
<head>
<title>TGN LIFE</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js">
</script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js">
</script>
<![endif]-->

<link rel="icon" type="image/jpg" href="../../../assets/images/background/favicon.jpg">
<link rel="stylesheet" type="text/css" href="../../static/css/style1.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="../../static/js/javascript.js"></script>


<?php
require "reset-request.inc.php";

if(in_array("Invalid email format..<br>", $error_array)) echo "<div class='alert alert-danger' role='alert'>Invalid email format..<br></div>";
    elseif(in_array("This email is not registered..<br>", $error_array)) echo "<div class='alert alert-danger' role='alert'>This email is not registered..<br></div>";
     if(isset($_GET['resetpwdlink'])) {
            if($_GET['resetpwdlink'] == "sent") {
                echo'
                    <script>
                      $(document).ready(function(){
                           $("#myInput").click();
                       });
                    </script>
                    <div class="modal" tabindex="-1" role="dialog" id="myModal">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Link Sent</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Please check your email for a link to reset your Password</p>
                        </div>
                        <div class="modal-footer">
                          <a href="registration_signup_page" class="btn btn-primary">Ok</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" data-toggle="modal" data-target="#myModal" id="myInput"/>';
              }
        }
?>

<html style="background: url(../../../assets/images/posts/5e1ae80b3cb7e20170103_124335.jpg) no-repeat center center fixed; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">

<body>
  <div class="container">
  <div class="row">
  <div class="col-sm">
<div class=" card card-body">
  <center>
    <form action=" "  method="POST" >
       <div id="enterEmailAddress"><br><br>
        <h1><a href="registration_signup_page">TGN LIFE</a></h1>
          <center style="font-size: 25;color:#636e72;"><label>Enter your email address</label>
            <label>We will send a link to your email to reset your password.</label><br><br>
           <input class="form-control" type="text" name="email" style="width: 300px;
                  height: 2.5rem;
                  border: 1px solid rgba(0,0,0,.125);"></center><br>
           <center>
               <button class="btn btn-sm-block btn-info" type="submit" name="reset-request-submit">Submit</button>
           </center><br>
       </div>
    </form>
  </center>
    </div></div>  </div>  </div>
</body>
</html>
