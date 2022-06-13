<?php

    include("../../../configuration/config.php");
    include("../../includes/classes/User.php");

    if(isset($_POST['userloggedin']))
        $userloggedin = $_POST['userloggedin'];

    $fr_online="";
    $num_online = 0;
    $convos = array();
    $all_user_query = mysqli_query($conn, "SELECT profile_pic FROM users WHERE username != 'support-service'");

while($row = mysqli_fetch_array($all_user_query)){
              $user_profile_pic = $row['profile_pic'];
             $user_array = "<div style='height:45px;padding: 3px;'><img src='../../../$user_profile_pic' style='width:42px;border-radius:21px'></div>";
             echo $user_array;
}

?>
