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

        $name_obj = new User($conn, $friendsList2[$i]);
        $friendsListflname[$i]=$name_obj->getUsername();

        if($online_Status == 'ON'){
             $onlineImg = '<img style="width:12px;position:absolute;margin-left:-3px;padding-top:22px;" src="../../../assets/images/icon/online1.PNG" />';
             $offlineImg = "";

                $strLenght = strlen($friendsListflname[$i]);
                 if ($strLenght > 16) {
                    $friendsList3 = substr($friendsListflname[$i], 0, 16)."...";

                 // $friendsList3a = ucwords(str_replace('-',' ', $friendsList3));
                 $friendsList4 = "<div style='height:45px;padding: 3px;text-align:left'>$onlineImg$offlineImg<a href='".$friendsList2[$i]."' style='position: relative;top: 9px;color:#565052;padding-left:12px;'>$friendsList3<br></a></div>";
                       echo $friendsList4;

                 }else {
                     // $friendsList3a = ucwords(str_replace('-',' ', $friendsListflname[$i]));
                     $friendsList5 = "<div style='height:45px;padding: 3px;text-align:left;'>$onlineImg$offlineImg<a href='".$friendsList2[$i]."' style='position: relative;top: 9px;color:#565052;padding-left:12px;'>$friendsListflname[$i]<br></a></div>";
                     echo $friendsList5;
                 }

           }elseif($online_Status == 'OFF'){
                    $fr_online=array_push($convos, $online_Status);
                     $onlineImg = '';
                     $offlineImg = '<img style="width:12px;position:absolute;margin-left:-3px;padding-top:22px;" src="../../../assets/images/icon/offline1.PNG" />';

                    $strLenght = strlen($friendsListflname[$i]);
                     if ($strLenght > 16) {
                        $friendsList3 = substr($friendsListflname[$i], 0, 16)."...";

                     // $friendsList3a = ucwords(str_replace('-',' ', $friendsList3));
                     $friendsList4 = "<div style='height:45px;padding: 3px;text-align:left'><a href='".$friendsList2[$i]."' style='position: relative;top: 9px;color:#565052;padding-left:12px;'>$friendsList3<br></a></div>";
                           echo $friendsList4;

                     }else {
                         // $friendsList3a = ucwords(str_replace('-',' ', $friendsListflname[$i]));
                         $friendsList5 = "<div style='height:45px;padding: 3px;text-align:left;'><a href='".$friendsList2[$i]."' style='position: relative;top: 9px;color:#565052;padding-left:12px;'>$friendsListflname[$i]<br></a></div>";
                         echo $friendsList5;
                     }

                  }
               }
             }


?>
