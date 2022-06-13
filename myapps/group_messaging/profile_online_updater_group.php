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

            $member_profile_pic_query = mysqli_query($conn, "SELECT status FROM users WHERE username = '$member'");
             while($row=mysqli_fetch_array($member_profile_pic_query)){
                 $online_Status = $row['status'];

                $name_obj = new User($conn, $member);
                $memberflName=$name_obj->getFirstAndLastName();

                if($online_Status == 'ON'){
                     $onlineImg = '<img style="width:12px;" src="../../../assets/images/icon/online1.PNG" />';
                     $offlineImg = "";

                        $strLenght = strlen($memberflName);
                         if ($strLenght > 16) {
                            $friendsList3 = substr($memberflName, 0, 16)."...";

                         $friendsList3a = ucwords(str_replace('-',' ', $friendsList3));
                         $friendsList4 = "<div style='height:45px;padding: 3px;'>$onlineImg $offlineImg<a href='../profile/".$member."' style='position: relative;top: 9px;color:#565052;padding-left:12px;'>$friendsList3a<br></a></div>";
                               echo $friendsList4;

                         }else {
                             $friendsList3a = ucwords(str_replace('-',' ', $memberflName));
                             $friendsList5 = "<div style='height:45px;padding: 3px;'>$onlineImg$offlineImg<a href='../profile/".$member."' style='position: relative;top: 9px;color:#565052;padding-left:12px;'>$friendsList3a<br></a></div>";
                             echo $friendsList5;
                         }

                   }elseif($online_Status == 'OFF'){
                            $fr_online=array_push($convos, $online_Status);
                             $onlineImg = '';
                             $offlineImg = '<img style="width:12px;" src="../../../assets/images/icon/offline1.PNG" />';

                            $strLenght = strlen($memberflName);
                             if ($strLenght > 16) {
                                $friendsList3 = substr($memberflName, 0, 16)."...";

                             $friendsList3a = ucwords(str_replace('-',' ', $friendsList3));
                             $friendsList4 = "<div style='height:45px;padding: 3px;'><a href='../profile/".$member."' style='position: relative;top: 9px;color:#565052;padding-left:12px;'>$friendsList3a<br></a></div>";
                                   echo $friendsList4;

                             }else {
                                 $friendsList3a = ucwords(str_replace('-',' ', $memberflName));
                                 $friendsList5 = "<div style='height:45px;padding: 3px;'><a href='../profile/".$member."' style='position: relative;top: 9px;color:#565052;padding-left:12px;'>$friendsList3a<br></a></div>";
                                 echo $friendsList5;
                             }

                          }
                       }
                     }
            }

?>
