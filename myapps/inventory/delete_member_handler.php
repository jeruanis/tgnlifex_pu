<?php

    include("../../../configuration/config.php");

    if(isset($_POST['mem_name']) || isset($_POST['userloggedin']) || isset($_POST['result'])){
       $mem_name= $_POST['mem_name'];
       $userlog = $_POST['userloggedin'];
       $mem_nameMod= str_replace(',',"",$mem_name);
       $inv_name = $_POST['inv_name'];

    $inv_creator_query = mysqli_query($conn, "SELECT creator FROM inventory_des WHERE inventory_name='$inv_name'");
    $row = mysqli_fetch_assoc($inv_creator_query);
    $crtor = $row['creator'];
    if($userlog == $crtor){

            if($_POST['result'] == 'true'){
                 $inv_array_extract = mysqli_query($conn, "SELECT member_array FROM inventory_des WHERE creator='$userlog'");
                 $result = mysqli_fetch_array($inv_array_extract);
                 $array_res = $result['member_array'];
                 $to_search = $mem_name;
                 $array_explode =explode(",", $array_res);
                 $a = str_replace($mem_name,"",$array_res);

                 $reindexed_array = mysqli_query($conn, "UPDATE inventory_des SET member_array='$a' WHERE creator='$userlog'");

                 $inv_array_extract = mysqli_query($conn, "SELECT inv_array FROM users WHERE username='$mem_nameMod'");
                 $result = mysqli_fetch_array($inv_array_extract);
                 $array_res = $result['inv_array'];
                 $to_search = $inv_name. ',';
                 $array_explode =explode(",", $array_res);
                 $a = str_replace($to_search,"",$array_res);

                 $reindexed_array = mysqli_query($conn, "UPDATE users SET inv_array='$a' WHERE username='$mem_nameMod'");


               }


        }
        mysqli_close($conn);
     }













?>
