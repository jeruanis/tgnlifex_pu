<?php
    require_once('../../../configuration/config.php');


    if(isset($_GET['member_id'])) {
        $member_id= $_GET['member_id'];

//     if(isset($_POST['post_id'])) {
//         if($_POST['result'] == 'true')

            $query = mysqli_query($conn, "UPDATE messages_group SET unjoined ='yes' WHERE id='$member_id'");
         }

   ?>
