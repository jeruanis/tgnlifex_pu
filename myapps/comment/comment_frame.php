<?php
   include('../main/base.php');

    if(isset( $_SESSION['username'])) {
      $userloggedin = $_SESSION['username'];
      $user_detail_query = "SELECT * FROM users WHERE username in(?)";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $user_detail_query);
      mysqli_stmt_bind_param($stmt, "s", $userloggedin);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_get_result($stmt);

    }else{
        header("Location: register_afterLogout?comment=fail&youmustlogin");
    }

    if( isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];
    }

    $user_query = "SELECT added_by, user_to FROM posts WHERE id=?";
    $stmt=mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $user_query);
    mysqli_stmt_bind_param($stmt, 's', $post_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $posted_to = $row['added_by'];
        $user_to = $row['user_to'];
    }


    if(!empty($_POST['post_body'])) {
    if( isset($_POST['postComment' . $post_id])) {
        $post_body = $_POST['post_body'];
         $post_body =ucfirst(htmlspecialchars( strip_tags( mysqli_real_escape_string($conn, $post_body), '<br>')));
        $date_time_now = date("Y-m-d H:i:s");
        $removed='no';
        $id;

        $insert_post = "INSERT INTO comments VALUES (?,?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $insert_post);
        mysqli_stmt_bind_param($stmt, "issssss", $id, $post_body, $userloggedin, $posted_to, $date_time_now, $removed, $post_id);
        mysqli_stmt_execute($stmt);


        if($posted_to != $userloggedin) {
            $notifications  = new Notification($conn, $userloggedin);
            $notifications->insertNotification($post_id, $posted_to, 'comment');
        }
         if ($user_to != 'none' && $user_to != $userloggedin) {
            $notifications  = new Notification($conn, $userloggedin);
            $notifications->insertNotification($post_id, $user_to, 'profile_comment');
         }

        $get_commenters = "SELECT posted_by, posted_to FROM comments WHERE post_id=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $get_commenters);
        mysqli_stmt_bind_param($stmt, "i", $post_id);
        mysqli_execute($stmt);
        $res=mysqli_stmt_get_result($stmt);

        $notified_users = array();
        while($row=mysqli_fetch_array($res, MYSQLI_ASSOC)){
          $posted_by=$row['posted_by'];
          $posted_to=$row['posted_to'];

          if($posted_by != $posted_to && $posted_to != $user_to && $posted_by != $userloggedin && !in_array($posted_by, $notified_users)) {

          $notifications  = new Notification($conn, $userloggedin);
          $notifications->insertNotification($post_id, $posted_by, 'comment_non_owner');
              array_push($notified_users, $posted_by);
          }
        }

      }
    }else {}

    ?>

   <body id="comFrame">
    <form class="form-group px-2" action="comment_frame.php?post_id=<?php echo $post_id; ?>" id="comment_form" name="postComment<?php echo $post_id; ?>" method="POST">
        <textarea class="form-control" name="post_body" id="ms_text" placeholder="comment here"></textarea>
        <input class="btn btn-sm btn-secondary mt-2 float-right" type="submit" id="ms-sub" name="postComment<?php echo $post_id; ?>" placeholder="Submit" style='width:130px'>
    </form>
    <?php

      function url($text){
        $text = html_entity_decode($text);
        $text = " " . $text;
        $text = preg_replace('/(https{0,1}:\/\/[\w\-\.\/#?&=+;%]*)/', '<a style="color:#0088cc;text-decoration:underline" href="$1"target="_blank">$1</a>', $text);
        return $text;
       }

    $queryCount = "SELECT count(*) FROM comments WHERE post_id=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $queryCount);
    mysqli_stmt_bind_param($stmt, 'i', $post_id);
    mysqli_stmt_execute($stmt);
    $result_query=mysqli_stmt_get_result($stmt);
    $rowcount = mysqli_fetch_row($result_query);
    $total_records =  $rowcount[0];

    $get_comments = "SELECT * FROM comments WHERE post_id =? ORDER BY id DESC";
     $stmt =mysqli_stmt_init($conn);
     mysqli_stmt_prepare($stmt, $get_comments);
     mysqli_stmt_bind_param($stmt, 'i', $post_id);
     mysqli_stmt_execute($stmt);
     $res_count=mysqli_stmt_get_result($stmt);

    if($total_records != 0) {
        $counter=0;
        $limit = $total_records;
   ?>

    <div id='commentContainer' style='clear:both'>
      <?php
        while($comment = mysqli_fetch_array($res_count, MYSQLI_ASSOC)) {
            $id = $comment['id'];
            $comment_body=$comment['post_body'];
            $posted_by = $comment['posted_by'];
            $posted_to = $comment['posted_to'];
            $date_time = $comment['date_added'];
            $removed = $comment['removed'];
            $delete_button ="";
            $option="";
            $option = "<span><svg style='right:0;margin-right:4px;' xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 0 24 24' width='24px' fill='#adb5bd'><path d='M0 0h24v24H0z' fill='none'/><path d='M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z'/></svg></span>";

            include('../utilities/badwordsComment.php');
            if($counter > $limit) {
                break;
            }else{
               $counter++;
               }

            $comment_body = url($comment_body);
            if($removed=='no'){
                $comment_removed = "";
                $comment_body = "<div style='padding-top:9px'><span id='comment_body$id' style='word-break:break-word;font-fmaily:'arial';><span id='com_bud$id' style='top:-3px;position: relative;color:#555;z-index:-1;'>$comment_body</span></span></div>";
            }else{
                $comment_removed = "<p><em style='font-size: 12px;padding: 3px 9px 5px 9px;border-radius: 6px;color: #999;background: #f6f6f6;border:#dfe6e9;'>comment removed</em></p>";
                $comment_body = "";
            }

            include('../utilities/time-frame.php');

          $user_obj = new User($conn, $posted_by);
          $namePoster = $user_obj->getFirstAndLastName();
          $namePoster = ucwords($namePoster);
            if($userloggedin == $posted_by || $userloggedin == $post_owner){
                if($removed=='no'){
                     $optionDiv = "<div class='CnewsfeedPostOption Coption$id' style='cursor:pointer'>$option</div>";
                     $delete_button="<button class='position-absolute delete_button p-2 bg-white' id='comment$id' style='width:127px;right:1px;'>Remove comment</button>";
                   }else{
                      $optionDiv="";
                      $delete_button="";
                    }
            }else{
                $optionDiv = "";
            }?>

           <?php
              echo "<div class='px-3 pt-3'><div class='ui comments' id='comment_section$id'>
                  <div class='comment'>
                  <a class='avatar' href='".$posted_by."' target='_parent'>
                    <img src='../../../".$user_obj->getProfilePic()."' title='$posted_by' style='height:41px;width:41px;'>
                   </a>
                   <div class='content'>
                     <span class='author'>
                       $namePoster
                     </span>
                       <div style='position:absolute; right:0;margin-right:4px;display:inline-block;'>
                         $optionDiv
                         <div class='Cpost_option' id='CtoggleOption$id' style='display:none;z-index:1'>
                           <div id='Coption_section position-absolute'>
                             <div class='text-white' style='right:1px;'>
                                <div>$delete_button</div>
                             </div>
                           </div>
                         </div>
                       </div>
                     <div class='metadata'>
                      <span class='date'>
                      $time_message
                      </span>
                     </div>
                     <div class='text'>
                       $comment_body
                     </div>
                  </div>
                  </div></div></div>";
            ?>
              <script>
                  $(document).ready(function(){
                      $.fn.toggleOp<?php echo $id; ?> =function() {
                          var ele = $('#CtoggleOption<?php echo $id; ?>');
                          $(ele).slideToggle(300);
                      }

                      $('.Coption<?php echo $id ?>').click(function(e){
                           e.stopPropagation();
                          $.fn.toggleOp<?php echo $id; ?>();
                      });

                      $(document).click(function() {
                          $('#CtoggleOption<?php echo $id; ?>').hide();
                          });

                       $(document).scroll(function(){
                          $('#CtoggleOption<?php echo $id; ?>').hide();
                       })
                  });
              </script>
              <script>
                    $(document).ready(function() {
                        $('#comment<?php echo $id; ?>').on('click', function() {
                            $.post("../../includes/form_handlers/delete_comment.php?com_id=<?php echo $id; ?>" , function(data){
                               $("#comment_section<?php echo $id ?>").fadeOut();
                            });
                        });
                     });
                </script>
           <?php

        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        if($counter > $limit){

            }
    }
    else {
        echo '<div class="comment_section" style="padding-bottom:50px;"><center style="color:#999999"><br><br>Be the first to comment ;)</center></div>';

       }

    ?>

  <script>
    $(document).ready(function(){
        $('#ms_text').keypress(function(e) {
                  if(e.which == 13) {
                    $(this).blur();
                    $('#ms-sub').focus().click();
                }
             });
     });

  </script>

</body>
</html>
