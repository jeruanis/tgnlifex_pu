<?php

    $num_friends = (substr_count($user['friend_array'], ","))-1;

    if( isset($_GET['profile_username'])) {
        $username = $_GET['profile_username'];
        $user_details_query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
        $user_array = mysqli_fetch_array($user_details_query);
        $profile_pic = $user_array['profile_pic'];
        $num_friends = (substr_count($user_array['friend_array'], ","))-1;
          }
    if(isset($_POST['remove_friend'])) {
        $user= new User($conn, $userloggedin);
        $user->removeFriend($username);

    }

  ?>
