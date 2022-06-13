<?php

    include("../../../configuration/config.php");
    include("../../includes/classes/User.php");

    if(isset($_POST['userloggedin']))
        $userloggedin = $_POST['userloggedin'];

    $fr_online="";
    $num_online = 0;
    $convos = array();
    $user_friend_query = mysqli_query($conn, "SELECT friend_array FROM users WHERE username = '$userloggedin'");
    $user_array = mysqli_fetch_array($user_friend_query);
    $num_friends = (substr_count($user_array['friend_array'], ","))-1;
    $friendsList =  $user_array['friend_array'];
    $friendsList2 = explode("," ,$friendsList);

     for($i=1; $i<=$num_friends; $i++){
        $friend_profile_pic__query = mysqli_query($conn, "SELECT status FROM users WHERE username = '$friendsList2[$i]'");
          while($row=mysqli_fetch_array($friend_profile_pic__query)){
              $online_Status = $row['status'];

            if($online_Status == 'ON'){
                 $fr_online=array_push($convos, $online_Status);
                 $onlineImg = '<img style="width:18px;" src="assets/images/icon/online.PNG" />';
                 $offlineImg = "";
            }elseif($online_Status == 'OFF'){
                 $offlineImg = '<img style="width:18px;" src="assets/images/icon/offline.PNG" />';
                 $onlineImg="";
              }

       }
    }

      $array  = array_map('intval', str_split($fr_online));
      foreach($array as $num_online_value){
        $num_online_value;
        }
   if($num_online_value==0)
       echo "";
   else
       echo $num_online_value;

?>
