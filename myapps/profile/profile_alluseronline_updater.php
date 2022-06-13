<?php

    include("../../../configuration/config.php");
    include("../../includes/classes/User.php");

    if(isset($_POST['userloggedin']))
        $userloggedin = $_POST['userloggedin'];

    $fr_online="";
    $num_online = 0;
    $convos = array();
    $all_user_query = mysqli_query($conn, "SELECT status, username FROM users WHERE username != 'support-service'");
   while($row = mysqli_fetch_array($all_user_query)){
       $online_Status = $row['status'];
       $username = $row['username'];
        $name_obj = new User($conn, $username);
        $allusername=$name_obj->getFirstAndLastName();

        if($online_Status == 'ON'){
             $onlineImg = '<img style="width:12px;margin-left:-3px;padding-top:22px;" src="../../../assets/images/icon/online1.PNG" />';
             $offlineImg = "";

                $strLenght = strlen($allusername);
                 if ($strLenght > 16) {
                    $friendsList3 = substr($allusername, 0, 16)."...";

                 $friendsList3a = ucwords(str_replace('-',' ', $friendsList3));
                 $friendsList4 = "<div style='height:45px;padding: 3px;text-align:left;'>$onlineImg$offlineImg<a href='".$username."' style='position: relative;top: 9px;color:#565052;padding-left:12px;'>$friendsList3a<br></a></div>";
                       echo $friendsList4;

                 }else {
                     $friendsList3a = ucwords(str_replace('-',' ', $allusername));
                     $friendsList5 = "<div style='height:45px;padding: 3px;text-align:left;'>$onlineImg$offlineImg<a href='".$username."' style='position: relative;top: 9px;color:#565052;padding-left:12px;'>$friendsList3a<br></a></div>";
                     echo $friendsList5;
                 }

           }elseif($online_Status == 'OFF'){
                    $fr_online=array_push($convos, $online_Status);
                     $onlineImg = '';
                     $offlineImg = '<img style="width:12px;margin-left:-3px;padding-top:22px;" src="../../../assets/images/icon/offline1.PNG" />';

                    $strLenght = strlen($allusername);
                     if ($strLenght > 16) {
                        $friendsList3 = substr($allusername, 0, 16)."...";

                     $friendsList3a = ucwords(str_replace('-',' ', $friendsList3));
                     $friendsList4 = "<div style='height:45px;padding: 3px;text-align:left'><a href='".$username."' style='position: relative;top: 9px;color:#565052;padding-left:12px;'>$friendsList3a<br></a></div>";
                           echo $friendsList4;

                     }else {
                         $friendsList3a = ucwords(str_replace('-',' ', $allusername));
                         $friendsList5 = "<div style='height:45px;padding: 3px;text-align:left'><a href='".$username."' style='position: relative;top: 9px;color:#565052;padding-left:12px;'>$friendsList3a<br></a></div>";
                         echo $friendsList5;
                     }

                  }
               }

?>
