<?php

    require_once('../../../configuration/config.php');

    if(isset($_GET['post_id']) || iseet($_GET['aid'])) {

        $aid= $_GET['aid'];
        $post_id= $_GET['post_id'];
            $queryId = mysqli_query($conn, "UPDATE posts SET posting ='yes' WHERE id='$post_id'");

        if($aid == 0 || $aid == ""){
        }else{ $queryAid = mysqli_query($conn, "UPDATE posts SET posting ='yes' WHERE aid='$aid'"); }

     }



?>
