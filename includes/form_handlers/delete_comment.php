<?php
    require_once('../../../configuration/config.php');

    if(isset($_GET['com_id']))
        $com_id= $_GET['com_id'];
            $query = mysqli_query($conn, "DELETE FROM comments WHERE id='$com_id'");

            if($query)
                echo json_encode('success');



?>
