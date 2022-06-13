<?php
require_once("../../../configuration/config.php");
include('../classes/User.php');

$query = $_POST['query'];
$userloggedin = $_POST['userloggedin'];
$gname = $_POST['group'];

$names = explode(" ", $query);

if(strpos($query, '_') !== false)
    $usersReturnedQuery = mysqli_query($conn, "SELECT * FROM users WHERE username LIKE '$query%' AND user_closed='no' LIMIT 8");

else if(count($names) == 2)
    $usersReturnedQuery = mysqli_query($conn, "SELECT * FROM users WHERE (username LIKE '$names[0]%' AND username LIKE '$names[1]%') AND user_closed='no' LIMIT 8");

else {
    $usersReturnedQuery = mysqli_query($conn, "SELECT username, first_name, last_name, profile_pic FROM users WHERE (username LIKE '$names[0]%' OR username LIKE '$names[0]%') AND user_closed='no' LIMIT 8");}

        if($query != " ") {
          echo "<div class='col-md-12' style='margin: 0 auto 10px;padding: 60px 20px;background: white;'>";
            while($row = mysqli_fetch_array($usersReturnedQuery)) {
                $user = new User($conn, $userloggedin);

                $profile_pic = $row['profile_pic'];
                $user_name = $row['username'];

                if($user_name != $userloggedin){
                    // $mutual_friends = '<span style="font-size:12px">mutual friends: </span>'.$user->getMutualFriends($row['username']);
                    $mutual_friends='';
                }else{
                    $mutual_friends = "";
                   }
                if($user_name != $userloggedin) {
                   echo "<div class='resultDisplayLiveSearch'>
                         <a href='../profile/".$user_name."?gname=". urlencode($gname)."' style='color: #1485bd' >
                            <div class='liveSearchText'><img src='../../../".$profile_pic."' style='width:51px;margin-right:9px;' > ". $user_name."<br>
                                ".$mutual_friends."
                            </div>
                          </a>
                        <div><br>";
                     }
                }
            echo "</div>";
        }else {
          echo " ";
        }

?>
