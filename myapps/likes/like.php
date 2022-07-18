<?php
//turn off error reporting
define('DEBUG', false);
error_reporting(E_ALL);
  if (DEBUG)
  {
    ini_set('display_errors', 'On');
  }
  else
  {
    ini_set('display_errors', 'Off');
  }
   
    require('../main/base.php');

    if(isset( $_SESSION['username'])) {
        $userloggedin = $_SESSION['username'];
        $user_detail_query = mysqli_query($conn, "SELECT * FROM users WHERE username ='$userloggedin'");
        $user = mysqli_fetch_array($user_detail_query);
    }else{
        header("Location: ../../");
    }

    if( isset($_GET['post_id']))
        $post_id = $_GET['post_id'];

    $data_query = mysqli_query($conn, "SELECT * FROM posts WHERE likes ='-1'");
        if(mysqli_num_rows($data_query) > 0) {
            while($row=mysqli_fetch_array($data_query)) {
                $p_id=$row['id'];
                $queryCorrectPost = mysqli_query($conn, "UPDATE posts SET likes='0' WHERE id='$p_id'");
                $queryCorrectUser = mysqli_query($conn, "UPDATE users SET likes='0' WHERE id='$p_id'");
         }}else{

    $get_likes = mysqli_query($conn, "SELECT likes, added_by FROM posts WHERE id='$post_id'");
    $row=mysqli_fetch_array($get_likes);
    $total_likes=$row['likes'];
    $user_liked = $row['added_by'];
    $user_details_query=mysqli_query($conn, "SELECT * FROM users WHERE username='$user_liked'");
    $row=mysqli_fetch_array($user_details_query);
    $total_user_likes = $row['num_likes'];


    if(isset($_POST['like_button'])) {
        $total_likes++;
        $query = mysqli_query($conn, "UPDATE posts SET likes='$total_likes' WHERE id='$post_id'");
        $total_user_likes++;
        $user_likes = mysqli_query($conn,"UPDATE users SET num_likes='$total_user_likes' WHERE username='$user_liked'");
        $insert_user = mysqli_query($conn, "INSERT INTO likes VALUES('','$userloggedin','$post_id')");

        if($user_liked != $userloggedin){
        $notifications = new Notification($conn, $userloggedin);
        $notifications->insertNotification($post_id, $user_liked, 'like');
        }

    }elseif(isset($_POST['unlike_button'])) {
        $total_likes--;
        $query = mysqli_query($conn, "UPDATE posts SET likes='$total_likes' WHERE id='$post_id'");
        $total_user_likes--;
        $user_likes = mysqli_query($conn,"UPDATE users SET num_likes='$total_user_likes' WHERE username='$user_liked'");
        $insert_user = mysqli_query($conn, "DELETE FROM likes WHERE username='$userloggedin' AND post_id = '$post_id'");
    }



    $check_query=mysqli_query($conn, "SELECT * FROM likes WHERE username='$userloggedin' AND post_id='$post_id'");
    $num_rows=mysqli_num_rows($check_query);
    mysqli_close($conn);

    if($num_rows >= 1) {
      echo '<form action="like.php?post_id=' .$post_id.'" method="POST" style="margin-top:3%">
          <div class="like_value">
            <button type="submit" class="comment_like" name="unlike_button" style="border:none;outline:none;background:white;">

                  <i class="fa fa-heart" style="font-size:16px;color:pink;"></i>


                  '.$total_likes.'


            </button>
          </div>
          </form>';

    }else{
      echo '<form action="like.php?post_id=' .$post_id.'" method="POST" style="margin-top:3%">
        <div class="like_value">
        <button type="submit" class="comment_like" name="like_button" style="border:none;outline:none;background:white;">


            <i class="fa fa-heart" style="font-size:16px;color:#A5BECC;"></i>


            '.$total_likes.'


        </button></div>
        </form>';
        }
    }
  ?>
