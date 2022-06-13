<?php

    require_once("../../../configuration/config.php");

    if(isset($_POST['log_id']))
      $log_id= $_POST['log_id'];

    if(isset($_POST['userloggedin']))
      $userloggedin= $_POST['userloggedin'];

    if(isset($_POST['result'])) {
        if($_POST['result'] == 'true'){   //answer from bootbox
             $query = mysqli_query($conn, "UPDATE messages_group SET unjoined='yes', left_group='yes' WHERE id='$log_id' AND user_from ='$userloggedin'");

              }
          }


?>
