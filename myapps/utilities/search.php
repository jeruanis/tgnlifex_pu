<?php
 include("../main/base.php");
  include("../main/navbar.php");

if(isset($_GET['q'])) {
    $query = $_GET['q'];
    }
 else {
     $query = " ";
   }

  if(isset($_GET['group'])){
    $gname = $_GET['group'];
    $url_name = 'gname';
  }elseif(isset($_GET['inventory'])){
    $gname = $_GET['inventory'];
    $url_name = 'inventory_name';
  }else{
    $gname = '';
    $url_name = '';
  }

    $names = explode(" ", $query);

    if(strpos($query, '_') !== false)
        $usersReturnedQuery = mysqli_query($conn, "SELECT * FROM users WHERE username LIKE '$query%' AND user_closed='no' LIMIT 8");
    else if(count($names) == 2)
        $usersReturnedQuery = mysqli_query($conn, "SELECT * FROM users WHERE (username LIKE '$names[0]%' AND username LIKE '$names[1]%') AND user_closed='no' LIMIT 8");
    else {
        $usersReturnedQuery = mysqli_query($conn, "SELECT username, first_name, last_name, profile_pic FROM users WHERE (username LIKE '$names[0]%' OR username LIKE '$names[0]%') AND user_closed='no' LIMIT 8");}

          echo "<div class='card'><div class='card-body'>";
          echo "<div class='liveSearchWrap'>";
            if($query != " ") {
                while($row = mysqli_fetch_array($usersReturnedQuery)) {
                    $user = new User($conn, $userloggedin);

                    $user_name = $row['username'];
                    $profile_pic = $row['profile_pic'];
                    if($user_name != $userloggedin){
                        // $mutual_friends = '<span style="font-size:12px">mutual friends: </span>'.$user->getMutualFriends($row['username']);
                        $mutual_friends = '';
                    }else{
                        $mutual_friends = "";
                       }
                          if($user_name != $userloggedin) {
                                 echo "<div class='resultDisplayLiveSearch'>
                                       <a href='../profile/".$user_name."?".$url_name."=". urlencode($gname)."' style='color: #1485bd' >
                                            <div class='liveSearchText'><img src='../../../".$profile_pic."' style='width:51px;margin-right:9px;' > ". $user_name ."<br>
                                                ".$mutual_friends."
                                            </div>
                                        </a>
                                      <div><br>";

                                   }
                                }
                            }

            else {
                echo " ";
            }
        echo "</div>";
        echo '</div></div>';
