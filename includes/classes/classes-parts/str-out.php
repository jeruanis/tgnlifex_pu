 <?php

    if ($videoPath != "none") {
        $videoDiv = "<center>
            <video controls controlslist='nodownload' oncontextmenu='return false' loop>
               <source src='../../../$videoPath#t=0.001' type='video/mp4'>
               <source src='../../../$videoPath#t=0.001' type='video/webm'>
               <source src='../../../$videoPath#t=0.001' type='video/ogg'>
               Your browser doesn't support HTML5 video tag.
            </video>
          </center>";
    } else {
        $videoDiv = "";
    }

    if ($decriptUrl != "none") {
        if (strpos($body1, "http") > 1) {
            $bodyDiv = "<div class='postedBody' style='padding: 3px 18px 3px 18px;diplay: inline-block; display: inline-block; border-radius: 3px;margin-bottom:6px;overflow: auto;word-break:break-word;'>$body</div>";
        } else {
            $bodyDiv = "";
        }
    }

    // if ($bodyYou != "none" || $bodyYou != "") {
    //     if (strpos($body1, "http") > 1) {
    //         $bodyDiv = "<div class='postedBody' style='padding: 3px 18px 3px 18px;diplay: inline-block; display: inline-block; border-radius: 3px;margin-bottom:6px;overflow: auto;word-break:break-word;'>$body</div>";
    //     } else {
    //         $bodyDiv = "";
    //     }
    // }

    // do not remove youtuve if bodyYou is not empty
    if ($bodyYou != "none" || $bodyYou != "") {
        $bodyDiv = "<div class='postedBody' style='padding: 3px 18px 3px 18px;diplay: inline-block; display: inline-block; border-radius: 3px;margin-bottom:6px;overflow: auto;word-break:break-word;'>$body</div>";
    } // this is removed from loading in the post but kept for single post

    if ($body != "" && ($bodyYou == "none" || $bodyYou == "") && $decriptUrl == "none") {
        $bodyDiv = "<div class='postedBody' style='padding: 3px 18px 3px 18px;diplay: inline-block; display: inline-block; border-radius: 3px;margin-bottom:6px;overflow: auto;word-break:break-word;'>$body</div>";
    }

    if ($videoPath != "none") {
        if ($body1 != "") {
            $bodyDiv = "<div class='postedBody' style='padding: 3px 18px 3px 18px;diplay: inline-block; display: inline-block; border-radius: 3px;margin-bottom:6px;overflow: auto;word-break:break-word;'>$body</div>";
        } else {
            $bodyDiv = "";
        }
    }

    if ($imagePath != "none") {
        if ($body1 != "") {
            $bodyDiv = "<div class='postedBody' style='padding: 3px 18px 3px 18px;diplay: inline-block; display: inline-block; border-radius: 3px;margin-bottom:6px;overflow: auto;word-break:break-word;'>$body</div>";
        } else {
            $bodyDiv = "";
        }
    }

   if(strpos($_SERVER['REQUEST_URI'], "ajax_load_profile_posts.php")) {
     $url_link = "...<a class='text-success font-weight-bold text-decoration-none' href='../community/post?id=$id'>               Read more >> </a>";
   }else{
     $url_link = "...<a class='text-success font-weight-bold text-decoration-none' href='post?id=$id'>               Read more >> </a>";
   }

    $strLenght = strlen($bodyDiv);
    if ($strLenght > 900){
        $bodyDiv = substr($bodyDiv, 0, 800) . $url_link;
    }

    $delOption = "<div style='float:right;display:inline-block;padding:0 18px'>
        <div class='newsfeedPostOption option$id' style='float:right;padding:0 18px;'>$option</div>
        <div class='post_option' id='toggleOption$id' style='display:none;padding-top:18px;'>
            <div id='option_section' class='opsec$id border p-2'>
                $delete_button
                $hide_inTimeline
                $show_inTimeline
            </div>
          </div>
        </div>";

    $user_logged_obj = new User($this->conn, $username);
    $userFirstLastName = $user_logged_obj->getFirstAndLastName();
    $username = ucwords(str_replace('_', ' ', $username));
    $str .= "<div  class='status_post $id' style=''><div>
        <div id='delOption' style='display:inline-block;margin-bottom:9px;'> <img src='../../../$profile_pic' width='40' height='40' style='border-radius: 20px;float: left;margin: 5px 0 5px 10px;'>
            <table border='0' cellpadding='0' cellspacing='0' style='left: 9px;position: relative;top: 6px;'>

                <tr>
                    <td> <small class='text-muted'>$time_message</span> </td>
                </tr>
            </table>
          </div>
           $delOption

          <div id='post_bodyi'>
          <div> $bodyDiv $urlExtract $imageDiv $videoDiv</div>
                </div>
                <div id='postBot' style='display: flex;height:50px;width:100%'>
                    <div class='pl-3 newsfeedPostOption comment$id' style='display: -webkit-inline-box;-moz-inline-box'>
                        <table border='0'>
                            <tr>
                              <td>
                                <div class='ui labeled button' tabindex='0'>
                                  <div class='ui button'>
                                    <i class='comment icon'></i> Comment
                                  </div>
                                  <a class='ui basic label'>
                                    $comments_check_num
                                  </a>
                                 </div>
                              </td>
                              <td>
                                <iframe class='likeId' src='../likes/like.php?post_id=$id' scrolling='no' style='height: 37px;width:200px;border:none;margin-top:.3rem'>
                                </iframe>
                              </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class='post_comment' id='toggleComment$id' style='display:none;'>
                    <iframe src='../comment/comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0' height='600px' width='80%'>
                    </iframe>
                </div>
            </div><hr></div>";
  ?>
