<?php
  include("../main/base.php");

if (isset($_COOKIE[ 'QTSSTYU'])){
	$_SESSION[ 'id']=$_COOKIE[ 'QTSSTYU'];
	$userloggedin_id=$_COOKIE[ 'QTSSTYU'];
	$user_details_query=mysqli_query($conn, "SELECT * FROM users WHERE id='$userloggedin_id'");
	$user=mysqli_fetch_array($user_details_query);
	$_SESSION[ 'username'] = $user['username'];
	$userloggedin = $user['username'];
    $pro_pic = $user['profile_pic'];

    $messages = new Message($conn, $userloggedin);
    $num_messages = $messages->getUnreadNumber();
    $notifications = new Notification($conn, $userloggedin);
    $num_notifications = $notifications->getUnreadNumberN();
    $user_obj = new User($conn, $userloggedin);
    $num_requests = $user_obj->getNumberOfFriendRequests();
    $loggedNameH = str_replace('_', ' ', $user['first_name']);
    $error_array = array();

    include("../main/navbar.php");
    $startTime = date("Y-m-d H:i:s");

   if(isset($_GET['post_id']))
     $post_id = $_GET['post_id'];

   $query = mysqli_query($conn, "SELECT * FROM posts WHERE id='$post_id'");
   if(mysqli_num_rows($query)>0){
     $row=mysqli_fetch_array($query);
     $body=$row['body'];
   }

   if(!empty($_POST['postext']))
      if(isset($_POST['submit'])){
        $new_body=mysqli_real_escape_string($conn, htmlspecialchars($_POST['postext']));
        $query=mysqli_query($conn, "UPDATE posts SET body='$new_body' WHERE id='$post_id'");
        if($query)
          header("Location: post?id=$post_id");
        else{
          print mysqli_error($query);
        }
      }

   echo "<header class='card-body'>
          <h3>Edit your post below.</h3>
        </header>";
   echo "<hr>";
   echo "<section class='card-body'>
     <form action='' method='POST'>
        <textarea id='posttext' name='postext' rows='30' class='border-0 w-100'>$body</textarea>
        <input type='submit' name='submit' class='btn btn-sm btn-warning float-right'/>
     </form>
   </section>";


  }else{header( "Location: ../userlogin/registration_signup_page");} ?>
