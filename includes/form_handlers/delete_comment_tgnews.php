<?php
    require_once('../../../configuration/config.php');

    if(isset($_GET['com_tgnews_id']))
        $com_tgnews_id= $_GET['com_tgnews_id'];
            $query = mysqli_query($conn, "DELETE FROM comment_tgnews WHERE id='$com_tgnews_id'");

?>
