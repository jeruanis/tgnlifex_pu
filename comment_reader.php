  <?php
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

      $queryCount = mysqli_query($conn, "SELECT count(*) FROM comments_general");
      $rowcount=mysqli_fetch_row($queryCount);
      $total_records =  $rowcount[0];
      $get_comments = mysqli_query($conn, "SELECT * FROM comments_general ORDER BY id DESC");
      $count=mysqli_num_rows($get_comments);
      if($count != 0) {
        $count=1;
        $limit = $total_records;

      while($comment = mysqli_fetch_array($get_comments)) {
            $id = $comment['id'];
            $comment_body=$comment['comment_body'];
            $added_by = $comment['added_by'];
            $date_time = $comment['date'];

            include('time_frame.php');
            include('myapps/utilities/badwordsComment.php');
            $user_obj = new User($conn, $added_by);
            $namePoster = $user_obj->getFirstAndLastName();
            $namePoster = ucwords("$namePoster");
            $profile_pic = substr($user_obj->getProfilePic(), 6);
    ?>

    <?php
       echo "<div class='comment-element' id='comment_element_$id'>
          <a href='myapps/profile/".$added_by."' target='_parent'>
            <img src='../".$profile_pic."' title='$added_by' style='width:40px;border-radius:11%;'>
            <small class='text-secondary'>$namePoster</small>
          </a>
          <small class='text-muted'>
            $date_time
          </small>";

        if ($userloggedin == $added_by){
          echo "<div class='d-inline-block float-right'>
            <div id='option_dropdown_$id' class='d-none pr-3'>
                <button id='com_remove_$id' class='border-0 rounded-0 p-3'> <small>remove</small></button>
            </div>
            <div class='comment_option text-muted d-inline-block position-absolute' style='transform: translate(1px, -3px);'><i class='fa fa-ellipsis-v' id='comment_option_$id'></i></div>
            </div>";
          } else {}
          echo "<small class='d-block p-2 mb-0'>$comment_body</small>
          </div>"; ?>

          <script type="text/javascript">
            $(document).ready(function(){
              var dot = document.getElementById("comment_option_<?php echo $id; ?>");
              dot.addEventListener("mouseover", function(e){
                 dot.style.cursor = "pointer";
              });

              var drop_down = document.getElementById("option_dropdown_<?php echo $id; ?>")
              dot.addEventListener("click", (e) => {
                   drop_down.classList.toggle('d-inline-block');
               });

              $('#com_remove_<?php echo $id; ?>').on('click', function() {
                  $.post("includes/form_handlers/delete_comment_player.php?com_player_id=<?php echo $id; ?>");
                  $('#comment_element_<?php echo $id ?>').fadeOut();
              });

             });
          </script>

      <?php
    }
        if($count > $limit){
             echo "<div style='width:93%;height:34px;'><p style='width:168px;margin:0 auto;padding-top:9px;background:#fff;padding-left: 26px;padding-bottom: 3px;border-radius: 6px;'>End of comments</p></div>";
          }
    }else {
        echo '<div class="comment_section" style="padding-bottom:50px;"><center style="color:#999999"><br><br>Be the first to comment ;)</center></div>';
      }

?>
