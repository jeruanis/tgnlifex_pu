<?php
    include('../main/base.php');
    include('settings_handler.php');
    ?>
    <head>
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
        .container{
          padding-top:18px;
        }
      </style>
    </head>
    <p>&nbsp;</p>
   <div class="container">
    <div class="row">
     <div class="col-md-9">
       <div class="card card-body">
        <?php include('settings_mid.php'); ?>
       </div>
      </div></div></div>
<p>&nbsp;</p>
</body>
</html>
