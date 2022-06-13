<?php
    $error_array = array();
    include('reset-password.inc.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>TGN LIFE</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="title" content="TGN LIFE| The Good News">
<meta name="url" content="httpS://www.tgnlife.com">
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
<meta name="description" content="Online radio station FM 2021 with social media and tools">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
          <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="../../static/js/javascript.js"></script>

<style>
  .form-control-clone{
    text-align: center;
    display: block;
    height: calc(1.5em + .75rem + 2px);
    padding: .375rem .75rem;
    font-size: 1rem;
     font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
  }
</style>

</head>
  <?php include('../../body.php');
    if(in_array("<div class='alert alert-warning' role='alert'>You haven't entered new password yet.</div>", $error_array)) echo "<div class='alert alert-warning' role='alert'>You haven't entered new password yet.</div>";
    elseif(in_array("<div class='alert alert-warning' role='alert'>Password you enter did not matched.</div>", $error_array)) echo "<div class='alert alert-warning' role='alert'>Password you enter did not matched.</div>";
    elseif(in_array("<div class='alert alert-warning' role='alert'>Your pasword must be 5 to 30 characters with atleast one letter and one number </div>", $error_array)) echo "<div class='alert alert-warning' role='alert'>Your pasword must be 5 to 30 characters with atleast one letter and one number </div>";
    elseif(in_array("<div class='alert alert-warning' role='alert'>There was an error5</div>", $error_array)) echo "<div class='alert alert-warning' role='alert'>There was an error5</div>";
    elseif(in_array("<div class='alert alert-warning' role='alert'>You need to resubmit your password reset request1.</div>", $error_array)) echo "<div class='alert alert-warning' role='alert'>You need to resubmit your password reset request1.</div>";
    elseif(in_array("<div class='alert alert-warning' role='alert'>You need to resubmit your password reset request2.</div>", $error_array)) echo "<div class='alert alert-warning' role='alert'>You need to resubmit your password reset request2.</div>";
    elseif(in_array("<div class='alert alert-warning' role='alert'>There was an error1</div>", $error_array)) echo "<div class='alert alert-warning' role='alert'>There was an error1</div>";
    elseif(in_array("<div class='alert alert-warning' role='alert'>There was an error2</div>", $error_array)) echo "<div class='alert alert-warning' role='alert'>There was an error2</div>";
    elseif(in_array("<div class='alert alert-warning' role='alert'>There was an error3</div>", $error_array)) echo "<div class='alert alert-warning' role='alert'>There was an error3</div>";
    elseif(in_array("<div class='alert alert-warning' role='alert'>There was an error4</div>", $error_array)) echo "<div class='alert alert-warning' role='alert'>There was an error4</div>";

  ?>
    <center>
        <div class="container">
          <div class="row">
          <div class="col-sm">
            <div class=" card card-body">
               <h1><a href="registration_signup_page">TGN LIFE</a></h1>
               <label>Enter your new password below</label>
               <br><br>

        <?php if(isset($_GET['newpwd'])) {
                if($_GET['newpwd'] == "empty") {
                  echo "<script>alert('You did not input new password!')</script><br>";
                    }elseif($_GET['newpwd'] == "pwdnotsame"){
                        echo "<script>alert('Paswword do not matched!')</script><br>";
                    }
                }

            $selector = $_GET['selector'];
            $validator = $_GET['validator'];

            if(empty($selector) || empty($validator)) {
                echo"Could not validate your request";
            }else{
               if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false ) {?>

            <form action="" method="POST" class="form-group">
                <input type="hidden" name="selector" value="<?php echo $selector;?>">
                <input type="hidden" name="validator" value="<?php echo $validator;?>">
                <input class="form-control-clone" type="password" name="pwd" placeholder="Enter new password" required><br><br>
                <input class="form-control-clone" type="password" name="pwd-repeat" placeholder="Confirm new password" required><br><br>
                <button class="btn btn-sm btn-warning" type="submit" name="reset-password-submit">Reset password</button>
            </form>

            <?php }
              }
            ?>
        </div></div></div></div>
    </center>
    </body>
</html>
