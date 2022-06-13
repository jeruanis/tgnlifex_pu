<?php
    include("../../../configuration/config.php");
    include("../../includes/classes/User.php");
        if(isset($_POST['user_to']))
            $user_to = $_POST['user_to'];
            $status_query = mysqli_query($conn, "SELECT status FROM users WHERE username = '$user_to'" );
            while($row = mysqli_fetch_array($status_query)){
                $online_Status = $row['status'];
            }
            if($online_Status == 'ON'){
                 $onlineImg = '<img width="12px"src="../../../assets/images/icon/online.PNG" />';
                 $offlineImg = "";
            }elseif($online_Status == 'OFF'){
                 $offlineImg = '<img width="12px" src="../../../assets/images/icon/offline.PNG" />';
                 $onlineImg="";
              }
           $result = $onlineImg.$offlineImg;

           exit($result);
?>
