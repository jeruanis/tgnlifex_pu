<?php
    require_once('../../../configuration/config.php');


    $userloggedin = $_SESSION['username'];
    if(isset($_GET['msge_id'])) {
        $msge_id= $_GET['msge_id'];

            $query = mysqli_query($conn, "UPDATE messages SET deleted ='yes' WHERE id='$msge_id'");

    header("Location: ../../myapps/messaging/delmessageExtractorMessage.php");

     }

?>
