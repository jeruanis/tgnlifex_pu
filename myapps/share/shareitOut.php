<?php

       if(isset($_GET['id'])) {
        $id = $_GET['id'];
         }
       else {
           $id = 0;
       }

    include('../main/base.php'); ?>
    <style>
      html{overflow-x:hidden;}
      .bg-light{background-color:#219bc3!important;}#logo{color:yellow;}
      .col-column,body,html{
        overflow:unset;
      }
      #shareit button{
        padding:revert;
      }
   </style>
   </head>
  <?php include("../main/navbar.php"); ?>

   <div id="shareit">

    <button class="button" data-sharer="twitter" data-title="TGN | The Good News" data-hashtags="Act Now" data-url="https://www.tgnlife.com"><i class='fa fa-twitter-square'></i></button>

    <button class="button" data-sharer="facebook" data-title="TGN | The Good News" data-hashtags="Act Now" data-url="https://www.tgnlife.com"><i class='fa fa-facebook-square'></i></button>

    <button class="button" data-sharer="linkedin" data-title="TGN | The Good News" data-hashtags="Act Now" data-url="https://www.tgnlife.com"><i class='fa fa-linkedin-square'></i></button>

    <button class="button" data-sharer="pinterest" data-title="TGN | The Good News" data-hashtags="Act Now" data-url="https://www.tgnlife.com"><i class='fa fa-pinterest-square'></i></button>

  </div>
</body>
</html>
