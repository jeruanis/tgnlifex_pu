<?php

require_once('../../../configuration/config.php');
require 'login_handler.php';
?>

<html>
<head>
    <title>TGN | The Good News</title>
    <link rel="stylesheet" type="text/css" href="../../static/css/registerActivator_style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="icon" type="image/jpg" href="../../../assets/images/background/favicon.jpg">
</head>
<body>
<?php// include('../../body.php'); ?>
<script>
    $(document).ready(function() {
          setInterval(function() {
                 $('#sub').click();
            },2100);
       });
    </script>
    <div class="wrapper" style="opacity:0">
        <div class="login_box">
              <div id="first">
                  <?php// if (isset($_COOKIE['uname'])) {
                     // header("Location: index");
                     // } else {
                      ?>

              <form action="" method="POST">
                <input type="hidden" name="log_id" value="<?php echo $_COOKIE['id'];
                    ?>"><br>
                <input type="hidden" name="log_password" value="<?php echo $_COOKIE['PTSSPOL'];
                    ?>"><br>
                 <input type="checkbox" name="chckbox" style="font-size:12px;opacity:0" checked><span style="opacity:0">Stay logged in&nbsp;&nbsp;<span class = "toggle"><i class="fa fa-question-circle qmark" aria-hidden="true"></i></span></span><br>
                 <input type="submit" name="login_button" value="Please Wait..." style="text-align: center; border: 1px solid transparent; background: none;" id="sub"><br><br>
              </form>
                </div>
            </div>
    </div>
</body>
</html>
