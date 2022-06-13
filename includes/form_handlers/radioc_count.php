<?php

    require_once('../../../configuration/config.php');

    if(isset($_POST['tname']))
        $tname= $_POST['tname'];
    if(isset($_POST['tcount']))
        $tcount= $_POST['tcount'];
        

    $query = mysqli_query($conn, "UPDATE radio SET tcount ='$tcount' WHERE tname='$tname'");
    if($query){
       // $response = 'success';
       // echo json_encode($response);
    }



?>
