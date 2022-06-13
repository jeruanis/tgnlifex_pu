<?php

require_once("../../../configuration/config.php");
include('../../includes/classes/User.php');

$query = $_POST['query'];
$userloggedin = $_POST['userloggedin'];
$inventory_name = $_POST['inventory'];

//ermove result upon clearing the textarea
if($query==''){
    echo ""; exit;
}

$names = explode(" ", $query);


if (strpos($query, '_') !== false) {
    $usersReturnedQuery = mysqli_query($conn, "SELECT * FROM users WHERE username LIKE '$query%' AND user_closed='no' LIMIT 8");
}

elseif (count($names) == 2) {
    $usersReturnedQuery = mysqli_query($conn, "SELECT * FROM users WHERE (username LIKE '$names[0]%' AND username LIKE '$names[1]%') AND user_closed='no' LIMIT 8");
}

else {
     $usersReturnedQuery = mysqli_query($conn, "SELECT username, first_name, last_name, profile_pic FROM users WHERE (username LIKE '$names[0]%' OR username LIKE '$names[0]%') AND user_closed='no' LIMIT 8");
 }

        if ($query != " ") {
            while ($row = mysqli_fetch_array($usersReturnedQuery)) {
                $user = new User($conn, $userloggedin);

                $profile_pic = $row['profile_pic'];
                $user_name = $row['username'];

                if ($user_name != $userloggedin) {
                    // $mutual_friends = '<span style="font-size:12px">mutual friends: </span>'.$user->getUsername($row['username']);
                    $mutual_friends = '';
                } else {
                    $mutual_friends = "";
                }
                if ($user_name != $userloggedin) {

                    echo "<div class=''>
                        <div style='max-width:360px; text-align:left;'>
                         <a href='../profile/".$user_name."?inventory_name=". urlencode($inventory_name)."' style='color: #1485bd' >
                              <div class='liveSearchText'>
                            <table>
                            <tr>
                             <td>
                              <img src='../../".$profile_pic."' style='width:51px;margin-right:9px;border-radius:50%;' >
                             </td><td>
                               ".$user_name."<br>
                                  ".$mutual_friends."
                            </td>
                            </tr>
                           </table>
                              </div>
                          </a></div>
                        <div><br>";
                }
            }
        } else {
            echo " ";
        }

?>
