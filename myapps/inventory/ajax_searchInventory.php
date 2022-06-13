<?php

include('../../../configuration/config.php');
include('../../includes/classes/User.php');

$query = $_POST['query'];
$userloggedin = $_POST['userloggedin'];
$inventory_name = $_POST['inventory'];

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

      echo "<div class='liveSearchWrap'>";
        if ($query != " ") {
            while ($row = mysqli_fetch_array($usersReturnedQuery)) {
                $user = new User($conn, $userloggedin);

                $firstNameHassed = $row['first_name'];
                $lastNameHassed = $row['last_name'];
                $firstNameDecoded =  decryptthis($firstNameHassed, $key);
                $lastNameDecoded =  decryptthis($lastNameHassed, $key);

                $profile_pic = $row['profile_pic'];
                $username = $row['username'];

                if ($row['username'] != $userloggedin) {
                    $mutual_friends = '<span style="font-size:12px">mutual friends: </span>'.$user->getMutualFriends($row['username']);
                } else {
                    $mutual_friends = "";
                }
                if ($row['username'] != $userloggedin) {

                    echo "<div class='resultDisplayLiveSearch'>
                        <div style='max-width:360px; text-align:left;'>
                         <a href='../profile/".$username."?inventory_name=". urlencode($inventory_name)."' style='color: #1485bd' >
                              <div class='liveSearchText'>
                            <table>
                            <tr>
                             <td>
                              <img src='".$profile_pic."' style='width:51px;margin-right:9px;border-radius:50%;' >
                             </td><td>
                               ".$username."<br>
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
    echo "</div>";

?>
