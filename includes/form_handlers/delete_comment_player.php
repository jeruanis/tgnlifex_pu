<?php
    require_once('../../../configuration/config.php');

    if(isset($_GET['com_player_id']))
        $com_player_id= $_GET['com_player_id'];
            $query = mysqli_query($conn, "DELETE FROM comments_general WHERE id='$com_player_id'");



?>
