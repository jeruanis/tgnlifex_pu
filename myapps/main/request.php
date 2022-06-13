<?php
  include('../main/base.php');
  include('../main/navbar.php');
?>
 <center>
  <div class="container">
    <div class="row">
      <div class="col-sm">
        <div class="card card-body">
        <h3 class="mb-4">Friend Rquests</h4>
        <div class="request_wrapper">
        <div class="request_wrapper_in mb-5">

<?php
    $query=mysqli_query($conn, "SELECT * FROM friend_requests WHERE user_to='$userloggedin'");
    if(mysqli_num_rows($query) == 0)
        echo "<p>You have no friend requests at this time!</p>";
    else {

        while($row=mysqli_fetch_array($query)) {
            $user_from = $row['user_from'];
            $user_from_obj=new User($conn, $user_from);
            $loggedNamepost = str_replace('_', ' ', $user_from_obj -> getFirstAndLastName());
            echo "<h4 class='mb-3'><a href='$user_from'>$loggedNamepost</a></h4>"." Sent you a friend request!";
            $user_from_friend_array=$user_from_obj->getFriendArray();

            if(isset($_POST['accept_request' . $user_from])) {
                $add_friend_query=mysqli_query($conn, "UPDATE users SET friend_array=CONCAT(friend_array, '$user_from,') WHERE username= '$userloggedin'");
                $add_friend_query=mysqli_query($conn, "UPDATE users SET friend_array=CONCAT(friend_array, '$userloggedin,') WHERE username= '$user_from'");
                $delete_query = mysqli_query($conn, "DELETE FROM friend_requests WHERE user_to='$userloggedin' AND user_from='$user_from'");
                echo "You are now friends!";
                header("Location: ../profile/$userloggedin");
            }
            if(isset($_POST['ignore_request' . $user_from])) {
                $delete_query = mysqli_query($conn, "DELETE FROM friend_requests WHERE user_to='$userloggedin' AND user_from='$user_from'");
                echo "Request Ignored!";
                header("Location: request.php");
            }
             print "<form action='request.php' method='POST'>
                   <input class='btn btn-sm-block btn-info' type='submit' name='accept_request".$user_from."' id='accept_button' value='Accept'>
                   <input class='btn btn-sm-block btn-warning' type='submit' name='ignore_request".$user_from."' id='ignore_button' value='Ignore'>
                </form>";
        }
    } ?>
  </div>
</div>
</div>
</div>
</div>

</div>
</center>
</body>
</html>
