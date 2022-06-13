<?php

    include("../../../configuration/config.php");
    include("../../includes/classes/User.php");
    include("../../includes/classes/Group.php");

    if(isset($_POST['userloggedin']) || isset($_POST['user_to']) || isset($_POST['group_to'])){
        $userloggedin = $_POST['userloggedin'];
        $user_to = $_POST['user_to'];
        $group_to = $_POST['group_to'];

            $fr_online="";
            $num_online = 0;
            $convos = array();
            $member_query = mysqli_query($conn, "SELECT DISTINCT user_to FROM messages_group WHERE (group_name = '$group_to' AND user_to != '$userloggedin')");
            while($row = mysqli_fetch_array($member_query)){
              $member = $row['user_to'];
                $member_profile_pic_query = mysqli_query($conn, "SELECT status FROM users WHERE username = '$member'");
                  while($row=mysqli_fetch_array($member_profile_pic_query)){
                      $online_Status = $row['status'];

                    if($online_Status == 'ON'){
                         $fr_online=array_push($convos, $online_Status);
                         $onlineImg = '<img style="width:18px;" src="../../../assets/images/icon/online.PNG" />';
                         $offlineImg = "";
                    }elseif($online_Status == 'OFF'){
                         $offlineImg = '<img style="width:18px;" src="../../../assets/images/icon/offline.PNG" />';
                         $onlineImg="";
                      }

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
