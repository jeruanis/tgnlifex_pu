<?php

class Notification {
    private $user_obj;
    private $conn;

    public function __construct($conn, $user){
        $this->conn = $conn;
        $this->user_obj = new User($conn, $user);
    }


    public function getUnreadNumberN() {
        $userloggedin = $this->user_obj->getUsername();
        $query = mysqli_query($this->conn, "SELECT * FROM notifications WHERE viewed='no' AND user_to='$userloggedin'");
        return mysqli_num_rows($query);
    }


    public function getNotifications($data, $limit) {
        $page = $data['page'];
        $userloggedin = $this->user_obj->getUsername();
        $return_string = "";

        if($page == 1)
            $start = 0;
        else
            $start = ($page - 1) * $limit;

        $query = mysqli_query($this->conn, "SELECT * FROM notifications WHERE (user_to='$userloggedin' AND viewed='no') ORDER BY id DESC");

        if(mysqli_num_rows($query) == 0) {
            echo "<small class='text-center d-block p-3' style='color:#8c8c8c'>You have no new notifications!</small>";
            return;
        }else{
          $num_iterations = 0;
          $count = 1;
          $link_f='';

          while($row = mysqli_fetch_array($query)) {
              $date_time=$row['datetime'];
              $link = $row['link'];
              $notification_id = substr($link, 0, 7);

              $user_from = $row['user_from'];
              $user_data_query = mysqli_query($this->conn, "SELECT profile_pic FROM users WHERE username='$user_from'");
              $user_data = mysqli_fetch_array($user_data_query);
              $styleImg="height:54px;width:54px;border-radius:23%;float:left;margin-right:6px;";
              $opened = $row['opened'];
              $style = ($row['opened'] == 'no') ? "background-color: #DDEDFF;padding: 6px 18px;" : "";
              include('../../myapps/utilities/time-frame.php');

              // conditions
              $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
              if ($curPageName != 'ajax_load_notifications_non_myapps.php' ) {
                  if($notification_id == 'post?id')
                     $link_f = '../community/'.$link;
                  else if($notification_id == 'pro_pic')
                      $link_f ='../profile/'.$row['user_from'].'?notid='.$row['id'];
                  else
                      $link_f = '../inventory/house_needs_inventory?inventory='.$row['link'].'&invnotid='.$row['id'];

                  $img = "<img src='../../../". $user_data['profile_pic']."' style='".$styleImg."'>";
              }else{
                  if($notification_id == 'post?id')
                      $link_f = 'myapps/community/'.$link;
                  else if($notification_id == 'pro_pic')
                      $link_f ='myapps/profile/'.$row['user_from'].'?notid='.$row['id'];
                  else
                      $link_f = 'myapps/inventory/house_needs_inventory?inventory='.$row['link'].'&invnotid='.$row['id'];

                  $img = "<img src='../". $user_data['profile_pic']."' style='".$styleImg."'>";
                }

              //pusher
              if($num_iterations++ < $start)
                  continue;
              if($count > $limit)
                  break;
              else
                  $count++;

              $return_string .= "<a href='$link_f' class='d-block p-2 pb-3 text-decoration-none'>
                  <div class='resultDisplay resultDisplayNotification' style='".$style ."'>".
                  $img."
                  <small class='timestamp_smaller' id='notif'>".$time_message."</small>". $row['message']."
                  </div>
              </a>";
           }
       }
        //If posts were loaded
        if($count > $limit)
            $return_string .= "<input type='hidden' class='nextPageDropdownData' value='" . ($page + 1) . "'><input type='hidden' class='noMoreDropdownData' value='false'>";
        else
            $return_string .= "<input type='hidden' class='noMoreDropdownData' value='true'> <div style='text-align:center;'><small>No more notifications to load!</small></div>";
        return $return_string;
        mysqli_close($this->conn);

        }


    public function insertNotification($post_id, $user_to, $type) { //used in like,cooment_frame,post
        $userloggedin = $this->user_obj->getUsername();
        $userloggedinName = $this->user_obj->getFirstAndLastName();
        $date_time = date("Y-m-d H:i:s");

        $message = "";
        if($type == 'inv_update' || $type == 'profile_pic')
          $link = $post_id;
        else
          $link = "post?id=" . $post_id;

        switch($type) {
                case 'comment':
                     $message = $userloggedinName . " commented on your post";
                     break;
                case 'like':
                     $message = $userloggedinName . " liked your post";
                     break;
                case 'profile_post':
                     $message = $userloggedinName . " posted on your profile";
                     break;
                case 'comment_none_owner':
                     $message = $userloggedinName . " commented on a post you commented on";
                     break;
                case 'profile_comment':
                     $message = $userloggedinName . " commented on your profile post";
                     break;
                case 'profile_pic':
                     $message = $userloggedinName . " Updated profile picture";
                     break;
                case 'inv_update':
                     $message = $userloggedinName . " Updated". $post_id;
                     break;

        }

       $insert_query = mysqli_query($this->conn, "INSERT INTO notifications VALUES('','$user_to', '$userloggedin', '$message', '$link', '$date_time', 'no', 'no')");
   }
}

?>
