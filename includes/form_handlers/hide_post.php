<?php

    require_once('../../../configuration/config.php');
    if(isset($_GET['post_id']) || isset($_GET['aid'])) {
        $aid= $_GET['aid'];
        $post_id= $_GET['post_id'];
            $queryId = mysqli_query($conn, "UPDATE posts SET posting ='no' WHERE id='$post_id'");

        
        if($aid == 0 || $aid == ""){
           //
        }else{ $queryAid = mysqli_query($conn, "UPDATE posts SET posting ='no' WHERE aid='$aid'"); }

    }

   ?>
