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
        $member_query = mysqli_query($conn, "SELECT DISTINCT user_to FROM messages_group WHERE (group_name = '$group_to' AND user_to!='$userloggedin')");
          while($row = mysqli_fetch_array($member_query)){
               $member = $row['user_to'];
                $member_profile_pic_query = mysqli_query($conn, "SELECT profile_pic FROM users WHERE username = '$member'");
                  while($row=mysqli_fetch_array($member_profile_pic_query)){
                      $member_profile_pic = '../../../'.$row['profile_pic'];

                $strLenght = strlen($member);
                 if ($strLenght > 16) {
                    $friendsList3 = substr($member, 0, 16)."...";

                 $friendsList3a = ucwords(str_replace('_',' ', $friendsList3));
                 $friendsList4 = "<div style='height:45px;padding: 3px;background: #f8f8ff;'><img src='$member_profile_pic' style='width:42px;border-radius:21px'></div>";
                    echo $friendsList4;

                 }else {
                     $friendsList3a = ucwords(str_replace('_',' ', $member));
                     $friendsList5 = "<div style='height:45px;padding: 3px;background: #f8f8ff;'><img src='$member_profile_pic' style='width:42px;border-radius:21px'></div>";
                     echo $friendsList5;
                 }
               }
           }
        }


?>
