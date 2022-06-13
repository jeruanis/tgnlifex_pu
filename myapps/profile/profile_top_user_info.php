 <?php
    $message_obj = new Message($conn, $userloggedin);
    $num_friends = (substr_count($user['friend_array'], ","))-1;
    if( isset($_GET['profile_username']))
        $username = $_GET['profile_username'];

    if(isset($_GET['notid']))
        $notid= $_GET['notid'];
    if(!empty($notid)){
        $set_viewed_query = mysqli_query($conn, "UPDATE notifications SET viewed='yes', opened='yes' WHERE (user_to='$userloggedin' AND id='$notid')");
      }


        $check_database_query = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
        $check_login_query = mysqli_num_rows($check_database_query);
        if( $check_login_query === 1) {
            $user_details_query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
            $user_array = mysqli_fetch_array($user_details_query);
            $profile_pic = $user_array['profile_pic'];
            $num_friends = (substr_count($user_array['friend_array'], ","))-1;
            $friendsList =  $user_array['friend_array'];
            $friendsList2 = explode("," ,$friendsList);

            $profile_pic1 = "<img src='../../../".$profile_pic."' style='width:150px;height:150px;border-radius:50%;'>";
        }else{

            header('Location: ../../');
            exit();
            }

           $loggedNameP = ucwords(strtolower(str_replace('_', ' ', decryptthis($user_array['first_name'], $key))));
           $loggedLastNameP = ucwords(strtolower(str_replace('_', ' ', decryptthis($user_array['last_name'], $key))));
           $cityP = str_replace('_', ' ', decryptthis($user_array['city'], $key));
           $countryP = str_replace('_', ' ', decryptthis($user_array['country'], $key));
           $skillsP = str_replace('_', ' ', $user_array['skills']);
           $hobbyP = str_replace('_', ' ', $user_array['hobby']);
           $email = str_replace('_', ' ', decryptthis($user_array['email'], $key));

           if($cityP=='' && $countryP=='')
              $cityP='Not specified';
            if($skillsP=='')
                $skillsP='Not specified';


       if( isset($_GET['gname'])) {
         $gname = $_GET['gname'];
         $inv_name="";

        $get_creator= mysqli_query($conn, "SELECT creator FROM messages_group WHERE group_name ='$gname' AND creator !=''" );
            $res = mysqli_fetch_array($get_creator);
                $creator = $res['creator'];

         $gpname = str_replace('_', ' ', $username);
         $inTextBody = ucwords($creator)." joined " .ucwords($gpname)." to the group";
         $inTextBody = htmlspecialchars(strip_tags($inTextBody));
         $inTextBody = mysqli_real_escape_string($conn, $inTextBody);

         $date = date("Y-m-d H:i:s");
         $gname = htmlspecialchars(strip_tags($gname));
         $gname = mysqli_real_escape_string($conn, $gname);

        if(isset($_POST['addTOgroup'])){
          $add_group_query = mysqli_query($conn, "UPDATE users SET group_array=CONCAT(group_array, '$gname,') WHERE username= '$username'");
          $group_create_query = mysqli_query($conn, "INSERT INTO messages_group VALUES('', '$username', '$username', '$inTextBody', '$date', 'no', 'no', 'no', '', '', '$gname', '$creator', 'no', 'no', '', '', '', '', '', '')");

           }elseif(isset($_POST['addTOgroupRevive'])){
             $last_message_query  = mysqli_query($conn, "UPDATE messages_group SET unjoined ='no', left_group='no' WHERE id IN (SELECT MAX(id) FROM messages_group WHERE username='$username' AND group_name='$gname' GROUP BY user_from) ORDER BY date DESC");

            }
        }elseif(isset($_GET['inventory_name'])) {
         $gname= "";
         $inv_name = $_GET['inventory_name'];
         $inv_name = htmlspecialchars(strip_tags($inv_name));
         $inv_name = mysqli_real_escape_string($conn, $inv_name);

            if(isset($_POST['addTOinv'])){
                $add_member_to_inv_des = mysqli_query($conn, "UPDATE inventory_des SET member_array=CONCAT(member_array, '$username,') WHERE inventory_name= '$inv_name'");

                $add_inv_name = mysqli_query($conn, "UPDATE users SET inv_array=CONCAT(inv_array, '$inv_name,') WHERE username= '$username'");

             }elseif(isset($_POST['delTOinv'])){
                 $inv_array_extract = mysqli_query($conn, "SELECT member_array FROM inventory_des WHERE inventory_name='$inv_name'");
                 $usernameMod = $username.',';
                 $result = mysqli_fetch_array($inv_array_extract);
                 $array_res = $result['member_array'];
                 $to_search = $inv_name;
                 $array_explode =explode(",", $array_res);

                 $a = str_replace($usernameMod,"",$array_res);

                 $reindexed_array = mysqli_query($conn, "UPDATE inventory_des SET member_array='$a' WHERE inventory_name='$inv_name'");

             }
            }else{
              $gname="";
              $inv_name="";
              }


    $sql="SELECT first_name FROM users";
    $result_member=mysqli_query($conn,$sql);
    $rowcount=mysqli_num_rows($result_member);
    if(isset($_POST['remove_friend'])) {

      echo'<script>
            myFunction();
          </script>';

        $user= new User($conn, $userloggedin);
        $user->removeFriend($username);
    }
    if(isset($_POST['add_friend'])) {
        $user= new User($conn, $userloggedin);
        $user->sendRequest($username);
    }



?>
