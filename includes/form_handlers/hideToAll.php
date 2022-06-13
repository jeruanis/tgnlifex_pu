<?php
    require_once('../../../configuration/config.php');

    if(isset($_GET['post_id']))
        $post_id= $_GET['post_id'];


    if(isset($_POST['result'])) {
        if($_POST['result'] == 'true')
            $query = mysqli_query($conn, "UPDATE posts SET me_only ='yes' WHERE id='$post_id'");
    }

?>
