<?php
class Post{
  private $user_obj;
  private $conn;

  public function __construct($conn, $user){
      $this->conn = $conn;
      $this->user_obj = new User($conn, $user);
      }

  public function __destruct(){
      mysqli_close($this->conn);
      }

  public function calculateTrend($term){
      if ($term != '') {
          $query = mysqli_query($this->conn, "SELECT * FROM trends WHERE title='$term'");
          if (mysqli_num_rows($query) == 0) {
              $insert_query = mysqli_query($this->conn, "INSERT INTO trends(title, hits) VALUES('$term', '1')");
          } else {
              $insert_query = mysqli_query($this->conn, "UPDATE trends SET hits=hits+1 WHERE title='$term'");
          }
      }
    }


  public function loadPostsFriends($data, $limit){
      function url($text){
        $text = html_entity_decode($text);
        $text = " " . $text;
        $text = preg_replace('/(https{0,1}:\/\/[\w\-\.\/#?&=+%:;]*)/', '<a style="color:#0088cc;text-decoration:underline" href="$1"target="_blank">$1</a>', $text);
        return $text;
       }

      $page = $data['page'];
      $userloggedin = $this->user_obj->getUsername();
      if ($page == 1) {
          $start = 0;
      } else {
          $start = ($page - 1) * $limit;
      }

      $noPost = "<p id=noPost class='text-center'>No posts yet!</p>";
      $str = "";
      $urlExtract = "";
      $deleted='no';
      $posting='yes';

      $data_query = "SELECT * FROM posts WHERE deleted=? AND posting=? ORDER BY id DESC";
      $stmt = mysqli_stmt_init($this->conn);
      mysqli_stmt_prepare($stmt, $data_query);
      mysqli_stmt_bind_param($stmt, "ss", $deleted, $posting);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if (mysqli_num_rows($result) > 0) {
            $num_iterations = 0;
            $count = 1;
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['id'];
                $body = $row['body'];
                $body1 = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];
                $imagePath = $row['image'];
                $bodyYou = $row['youtube'];
                $videoPath = $row['video'];
                $titleUrl = $row['title_url'];
                $imageUrl = $row['image_url'];
                $decriptUrl = $row['descript_url'];
                $bodyCleared = $row['body_cleared'];
                $gname = $row['gname'];
                $aid = $row['aid'];
                $status = $row['status'];
                $vidpost = $row['vidpost'];

                include('../../myapps/utilities/badwords.php');

                $imageUrlDiv = '<center><div class="postedImage postImg"><img src="' . $imageUrl . '" alt="Unable to display the photo" loading="lazy"></div></center>';
                $option = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#adb5bd"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>';

                if ($imageUrl == '') {
                    $imageUrlDiv = ' ';
                }

                if ($decriptUrl != 'none') {
                    if (strpos($body, "http") !== false) {
                        $body = substr($body, 0, strpos($body, "http"));
                    }
                }

                if ($titleUrl == 'none') {
                    $titleUrlDiv = '';
                } else {
                    $titleUrlDiv = '<a href="' . $bodyCleared . '" target="_blank">' . $titleUrl . '</a>';
                }

                if ($decriptUrl == 'none') {
                    $decriptUrlDiv = '';
                } else {
                    $decriptUrlDiv = "<span style='color:#777;'>$decriptUrl</span>";
                }

                if ($bodyYou == "" || $bodyYou == "none") {
                    $bodyYouDiv = "";
                } else {
                    $bodyYouDiv = "<center>$bodyYou</center>";
                }

                if ($titleUrl == 'none' || $titleUrl == ' ') {
                    $urlExtract = ' ';
                } else {
                    $urlExtract = '<table border="0" cellpadding="0" cellspacing="0"> <tr> <td style="display:block;">' . $imageUrlDiv . '</td></tr><tr> <th style="display:block;width:97%;margin:0 auto">' . $titleUrlDiv . '</th> </tr><tr> <td style="display:block;width:97%;margin:0 auto">' . $decriptUrlDiv . '</td></tr></table>';
                }

                $gap = 5;
                $tm = date("Y-m-d H:i:s", mktime(date("H"), date("i") - $gap, date("s"), date("m"), date("d"), date("Y")));
                $ut = "UPDATE users SET status=? where tm < ?";
                mysqli_stmt_prepare($stmt, $ut);
                mysqli_stmt_bind_param($stmt, "ss", $status, $tm);
                mysqli_stmt_execute($stmt);

                // if (strpos($body, "https://www.youtube.com") == true) {
                //     $body = substr($body, 0, strpos($body, "https://www.youtube.com"));
                // }

                $body = url($body);
                $body = stripslashes($body);
                $body = nl2br($body);
                $posted = $row['posting'];

                // showing image start
                if ($imagePath == 'none') {
                    $imageDiv = "";
                } elseif ($gname != "") {

                    $process='process';
                    $images_query = "SELECT id FROM posts WHERE id IN (SELECT MAX(id) FROM posts WHERE aid=? AND added_by=? AND status=? GROUP BY aid) ORDER BY id DESC";

                    mysqli_stmt_prepare($stmt, $images_query);
                    mysqli_stmt_bind_param($stmt, 'iss', $aid, $added_by, $process);
                    mysqli_stmt_execute($stmt);
                    $result1 = mysqli_stmt_get_result($stmt);
                    $rowlastId = mysqli_fetch_array($result1);

                    $lastImageId = $rowlastId['id'];
                    if ($id !== $lastImageId) {
                        continue;
                    }

                    $album = "SELECT count(aid) FROM posts WHERE aid=? AND added_by=? AND status=?";
                    mysqli_stmt_prepare($stmt, $album);
                    mysqli_stmt_bind_param($stmt, 'iss', $aid, $added_by, $process);
                    mysqli_stmt_execute($stmt);
                    $result2 = mysqli_stmt_get_result($stmt);

                    $rowcount = mysqli_fetch_row($result2);
                    $qty = $rowcount[0];
                    if (strpos($gname, "'")) {
                        $gname = str_replace("'", "&#39", $gname);
                    }

                    $images_query = mysqli_query($this->conn, "SELECT * FROM posts WHERE aid='$aid' AND added_by='$added_by' AND status='process'");
                    mysqli_stmt_prepare($stmt, $images_query);
                    mysqli_stmt_bind_param($stmt, 'iss', $aid, $added_by, $process);
                    mysqli_stmt_execute($stmt);
                    $result3 = mysqli_stmt_get_result($stmt);

                    $imageDiv = "";


                  include("classes-parts/post-mul-image.php");

                } elseif ($imagePath !== 'none') {
                    $imagePath_extract = basename($imagePath);
                    $imageFileType = pathinfo($imagePath_extract, PATHINFO_EXTENSION);
                    if (strtolower($imageFileType) == "pdf") {
                        $filename = substr($imagePath, 33);
                        $imageDiv= "<div style='text-align:left;padding-left:21px;'>$filename</div><a href='post_pdf_reader?title=$imagePath' target='_blank'><div class='postedImage'><img src='../../../assets/images/icon/pdf.png' width='inherit'></div></a>";
                    } else {
                        $imageDiv="<a href='../../../$imagePath' target='_self' data-fancybox><div class='postedImage'><img src='../../../$imagePath' width='inherit' loading='lazy'> </div></a>";
                    }
                }

                // showimg image end
                $added_by_obj = new User($this->conn, $added_by);
                if ($added_by_obj->isClosed()) {
                    continue;
                }

                $user_logged_obj = new User($this->conn, $added_by);
                if ($num_iterations++ < $start) {
                    continue;
                }

                if ($count > $limit) {
                    break;
                } else {
                    $count++;
                }



                $show_inTimeline = $hide_inTimeline = $delete_button = "";
                if ($userloggedin == $added_by || $userloggedin == 'support-service') {
                    $delete_button = "<button class='delete_button d-block m-0 bg-white text-secondary' id='post$id'>Delete post</button>";
                    $edit_button = "<button class='delete_button d-block m-0 bg-white text-secondary' id='edit_post$id'>Edit post</button>";

                    if ($posted == 'yes') {
                        $hide_inTimeline = "<button class='delete_button d-block m-0 bg-white text-secondary' id='posthide$id'>Show in profile page only</button>";
                        $show_inTimeline = "";
                    } else {
                        $show_inTimeline = "<button class='delete_button d-block m-0 bg-white text-secondary' id='postshow$id'>Show in general</button>";
                        $hide_inTimeline = "";
                    }

                } else {

                    $delete_button = $hide_inTimeline = $show_inTimeline = $option = $edit_button ="";
                }



                $user_details_query = "SELECT first_name, last_name, username, profile_pic FROM users WHERE username=?";
                mysqli_stmt_prepare($stmt, $user_details_query);
                mysqli_stmt_bind_param($stmt, 's', $added_by);
                mysqli_stmt_execute($stmt);
                $result4 = mysqli_stmt_get_result($stmt);
                $user_row = mysqli_fetch_array($result4);

                $profile_pic = $user_row['profile_pic'];
                $username = $user_row['username'];

                include("classes-parts/tog-option-com.php");


         $comments_check = "SELECT * FROM comments WHERE post_id=?";
         mysqli_stmt_prepare($stmt, $comments_check);
         mysqli_stmt_bind_param($stmt, 'i', $id);
         mysqli_stmt_execute($stmt);
         $result5 = mysqli_stmt_get_result($stmt);

         $comments_check_num = mysqli_num_rows($result5);

         include('../../myapps/utilities/time-frame.php');
         include('classes-parts/str-out.php');
         include('classes-parts/str-out-bottom.php');


          }

            if ($count > $limit) {
                $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
                <input type='hidden' class='noMorePosts' value='false'>";
            } else {
                $str .= "<input type='hidden' class='noMorePosts' value='true'> <center style='background:white;padding:20px;'>No more post to show!</center><br>";
            }

            echo $str;
        } else {
            echo "<br><br>" . $noPost;
        }

  }


  public function loadProfilePosts($data, $limit){
        function url($text){
          $text=html_entity_decode($text);
          $text=" ".$text;
          $text=preg_replace('/(https{0,1}:\/\/[\w\-\.\/#?&=+%]*)/', '<a style="color:#0088cc;text-decoration:underline" href="$1"target="_blank">$1</a>', $text);
          return $text;
        }

        $page=$data['page'];
        $profileUser=$data['profileUsername'];
        $userloggedin=$this->user_obj->getUsername();
        if ($page==1) {
            $start=0;
        } else {
            $start=($page - 1) * $limit;
        }

        $noPost="<p id='noPost' class='text-center'>No posts yet!</p>";
        $str="";
        $data_query1=mysqli_query($this->conn, "SELECT * FROM posts WHERE deleted='no' AND ( added_by='$profileUser' OR user_to='$profileUser')ORDER BY id DESC");

        $data_query=mysqli_query($this->conn, "SELECT * FROM posts WHERE deleted='no' AND ( added_by='$profileUser' OR user_to='$profileUser')ORDER BY id DESC");

        if (mysqli_num_rows($data_query) > 0) {
            $num_iterations=0;
            $count=1;
            while ($row=mysqli_fetch_array($data_query)) {
                $id=$row['id'];
                $body=$row['body'];
                $body1=$row['body'];
                $added_by=$row['added_by'];
                $date_time=$row['date_added'];
                $imagePath=$row['image'];
                $videoPath=$row['video'];
                $bodyYou=$row['youtube'];
                $titleUrl=$row['title_url'];
                $imageUrl=$row['image_url'];
                $decriptUrl=$row['descript_url'];
                $bodyCleared=$row['body_cleared'];
                $gname=$row['gname'];
                $aid=$row['aid'];
                $status=$row['status'];

                include('../../myapps/utilities/badwords.php');

                $imageUrlDiv='<center><div class="postedImage postImg"><a href="'.$imageUrl.'" target="_blank"><img src="'.$imageUrl.'" style="max-width:96%;" alt="Unable to display the photo" loading="lazy"></a></div></center>';

                $option = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#adb5bd"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>';


                if ($imageUrl=='') {
                    $imageUrlDiv=' ';
                }

                if ($decriptUrl !='none') {
                    if (strpos($body, "http")==true) {
                        $body=substr($body, 0, strpos($body, "http"));
                    }

                }

                if ($titleUrl=='none') {
                    $titleUrlDiv='';
                } else {
                    $titleUrlDiv='<a href="'.$bodyCleared.'" target="_blank">'.$titleUrl.'</a>';
                }

                if ($decriptUrl=='none') {
                    $decriptUrlDiv='';
                } else {
                    $decriptUrlDiv="<span style='color:#777;'>$decriptUrl</span>";
                }

                if ($bodyYou=="" || $bodyYou=="none") {
                    $bodyYouDiv="";
                } else {
                    $bodyYouDiv="<center>$bodyYou</center>";
                }

                if ($titleUrl=='none' || $titleUrl==' ') {
                    $urlExtract=' ';
                } else {
                    $urlExtract='<table border="0" cellpadding="0" cellspacing="0" style="margin:15px auto;"> <tr> <td style="display:block;">'.$imageUrlDiv.'</td></tr><tr> <th style="display:block;width:72%;margin:0 auto">'.$titleUrlDiv.'</th> </tr><tr> <td style="display:block;width:90%;margin:0 auto">'.$decriptUrlDiv.'</td></tr></table>';
                }

                $gap=5;
                $tm=date("Y-m-d H:i:s", mktime(date("H"), date("i")-$gap, date("s"), date("m"), date("d"), date("Y")));
                $ut=mysqli_query($this->conn, "UPDATE users SET status='OFF' where tm < '$tm'");
                // if (strpos($body, "https://www.youtube.com")==true) {
                //     $body=substr($body, 0, strpos($body, "https://www.youtube.com"));
                // }

                $body=url($body);
                $body = stripslashes($body);
                $body = nl2br($body);
                $posted=$row['posting'];

                if ($num_iterations++ < $start) {
                    continue;
                }
                if ($count > $limit) {
                    break;
                } else {
                    $count++;
                }



                $show_inTimeline=$hide_inTimeline=$delete_button="";
                if ($userloggedin==$added_by) {
                   $delete_button = "<button class='delete_button d-block m-0 bg-white text-secondary' id='post$id'>Delete post</button>";
                   $edit_button = "<button class='delete_button d-block m-0 bg-white text-secondary' id='edit_post$id'>Edit post</button>";
                    if ($posted == 'yes') {
                        $hide_inTimeline = "<button class='delete_button d-block m-0 bg-white text-secondary' id='posthide$id'>Show in profile page only</button>";
                        $show_inTimeline = "";
                    } else {
                        $show_inTimeline = "<button class='delete_button d-block m-0 bg-white text-secondary' id='postshow$id'>Show in general</button>";
                        $hide_inTimeline = "";
                    }
                } else {
                    $delete_button=$hide_inTimeline=$show_inTimeline=$option="";
                }


                $user_details_query=mysqli_query($this->conn, "SELECT first_name, last_name, username, profile_pic FROM users WHERE username='$added_by'");
                $user_row=mysqli_fetch_array($user_details_query);
                $profile_pic=$user_row['profile_pic'];
                $username=$user_row['username'];


             include("classes-parts/tog-option-com.php");


          $comments_check = mysqli_query($this->conn, "SELECT * FROM comments WHERE post_id='$id'");
          $comments_check_num = mysqli_num_rows($comments_check);

          include('../../myapps/utilities/time-frame.php');

          if ($imagePath == 'none') {
            $imageDiv = "";
          } elseif ($gname != "") {
              if ($status == 'process') {
                  $images_query = mysqli_query($this->conn, "SELECT id FROM posts WHERE id IN (SELECT MAX(id) FROM posts WHERE aid='$aid' AND added_by='$added_by' GROUP BY aid) ORDER BY id DESC");
                  $rowlastId = mysqli_fetch_array($images_query);
                  $lastImageId = $rowlastId['id'];

                  if ($id !== $lastImageId) {
                      continue;
                  }

                  $album = mysqli_query($this->conn, "SELECT count(aid) FROM posts WHERE aid='$aid' AND added_by='$added_by'");
                  $rowcount = mysqli_fetch_row($album);
                  $qty = $rowcount[0];

                  if (strpos($gname, "'")) {
                      $gname = str_replace("'", "&#39", $gname);
                  }

                  $images_query = mysqli_query($this->conn, "SELECT * FROM posts WHERE aid='$aid' AND added_by='$added_by' AND status='process'");
                  $imageDiv = "";

                  include("classes-parts/post-mul-image.php");
              }
          } elseif ($imagePath !== 'none') {
            $imagePath_extract = basename($imagePath);
            $imageFileType = pathinfo($imagePath_extract, PATHINFO_EXTENSION);
            if (strtolower($imageFileType) == "pdf") {
                $filename = substr($imagePath, 33);
                $imageDiv= "<div style='text-align:left;padding-left:21px;'>$filename</div><a href='post_pdf_reader?title=$imagePath' target='_blank'><div class='postedImage'><img src='../../../assets/images/icon/pdf.png' width='inherit'></div></a>";
            } else {
                $imageDiv="<a href='$imagePath' target='_self' data-fancybox><div class='postedImage'><img src='../../../$imagePath' width='inherit' loading='lazy'> </div></a>";
            }
          }

          include('classes-parts/str-out.php');
          include('classes-parts/str-out-bottom.php');


        }
            if ($count > $limit) {
                $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'> <input type='hidden' class='noMorePosts' value='false'>";
            } else {
                $str .= "<input type='hidden' class='noMorePosts' value='true'> <center id='noMore' style='background:white;padding:20px;margin-top: 10px;'>No more post to show!</center><br>";
            }
            echo $str;
        } else {
            echo "<br><br>" . $noPost;
        }
    }


  public function getSinglePost($post_id){
        function url($text){
            $text = html_entity_decode($text);
            $text = " " . $text;
            $text = preg_replace('/(https{0,1}:\/\/[\w\-\.\/#?&=+%]*)/', '<a style="color:#0088cc;text-decoration:underline" href="$1"target="_blank">$1</a>', $text);
            return $text;
        }

        $userloggedin = $this->user_obj->getUsername();
        $opened_query = mysqli_query($this->conn, "UPDATE notifications SET opened='yes', viewed='yes' WHERE user_to='$userloggedin' AND link LIKE '%=$post_id'");

        $str = "";
        $data_query = mysqli_query($this->conn, "SELECT * FROM posts WHERE deleted='no' AND id=$post_id");
        if (mysqli_num_rows($data_query) > 0) {
            $row = mysqli_fetch_array($data_query);
            $id = $row['id'];
            $body = $row['body'];
            $body1 = $row['body'];
            $added_by = $row['added_by'];
            $date_time = $row['date_added'];

            if ($row['user_to'] == "none") {
                $user_to = "";
            } else {
                $user_to_obj = new User($this->conn, $row['user_to']);
                $user_to_name = $user_to_obj->getFirstAndLastName();
                $user_to = " to <a href='" . $row['user_to'] . "'>" . $user_to_name . "</a>";
            }

            $added_by_obj = new User($this->conn, $added_by);

            if ($added_by_obj->isClosed()) {
                return;
            }

            $user_logged_obj = new User($this->conn, $userloggedin);
            if ($userloggedin == $added_by) {
                $delete_button = "<button class='delete_button' data-tooltip='delete post' id='post$id'>x</button>";
            } else {
                $delete_button = "";
            }

            $user_details_query = mysqli_query($this->conn, "SELECT first_name, last_name, username, profile_pic FROM users WHERE username='$added_by'");

            $user_row = mysqli_fetch_array($user_details_query);
            $first_name = $user_row['first_name'];
            $last_name = $user_row['last_name'];
            $profile_pic = $user_row['profile_pic'];
            $username = $user_row['username'];
            $imagePath = $row['image'];
            $videoPath = $row['video'];
            $bodyYou = $row['youtube'];
            $titleUrl = $row['title_url'];
            $imageUrl = $row['image_url'];
            $decriptUrl = $row['descript_url'];
            $bodyCleared = $row['body_cleared'];
            $gname = $row['gname'];
            $aid = $row['aid'];
            $status = $row['status'];
            $vidpost = $row['vidpost'];

            include('../../myapps/utilities/badwords.php');

            $imageUrlDiv = '<center><div class="postedImage"><a href="' . $imageUrl . '" target="_blank"><img src="' . $imageUrl . '" alt="Unable to display the photo"></a></div></center>';

            $option = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#adb5bd"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>';

            if ($imageUrl == '') {
                $imageUrlDiv = ' ';
            }

            if ($decriptUrl != 'none') {
              if (strpos($body, "http") == true) {
                  $body = substr($body, 0, strpos($body, "http"));
                }
            }

            if ($titleUrl == 'none') {
                $titleUrlDiv = '';
            } else {
                $titleUrlDiv = '<a href="' . $bodyCleared . '" target="_blank">' . $titleUrl . '</a>';
            }

            if ($decriptUrl == 'none') {
                $decriptUrlDiv = '';
            } else {
                $decriptUrlDiv = "<span style='color:#777;'>$decriptUrl</span>";
            }

            if ($bodyYou == "" || $bodyYou == "none") {
                $bodyYouDiv = "";
            } else {
                $bodyYouDiv = "<center>$bodyYou</center>";
            }

            if ($titleUrl == 'none' || $titleUrl == ' ') {
                $urlExtract = ' ';
            } else {
                $urlExtract = '<table border="0" cellpadding="0" cellspacing="0" style="margin:15px auto;"> <tr> <td style="display:block;">' . $imageUrlDiv . '</td></tr><tr> <th style="display:block;width:72%;margin:0 auto">' . $titleUrlDiv . '</th> </tr><tr> <td style="display:block;width:90%;margin:0 auto">' . $decriptUrlDiv . '</td></tr></table>';

            }

            // if (strpos($body, "https://www.youtube.com") == true) {
            //     $body = substr($body, 0, strpos($body, "https://www.youtube.com"));
            // }

            $body = ucfirst($body);
            $body = url($body);
            $body = stripslashes($body);
            $body = nl2br($body);
            $posted = $row['posting'];

            $show_inTimeline=$hide_inTimeline=$delete_button="";
            if ($userloggedin==$added_by || $userloggedin=='support-service') {
              $delete_button = "<button class='delete_button d-block m-0 bg-white text-secondary' id='post$id'>Delete post</button>";
              $edit_button = "<button class='delete_button d-block m-0 bg-white text-secondary' id='edit_post$id'>Edit post</button>";
              if ($posted == 'yes') {
                    $hide_inTimeline = "<button class='delete_button d-block m-0 bg-white text-secondary' id='posthide$id'>Show in profile page only</button>";
                    $show_inTimeline = "";
               } else {
                    $show_inTimeline = "<button class='delete_button d-block m-0 bg-white text-secondary' id='postshow$id'>Show in general</button>";
                    $hide_inTimeline = "";
                }
            } else {
                $delete_button=$hide_inTimeline=$show_inTimeline=$option="";
            }

            include("classes-parts/tog-option-com.php");

      $comments_check = mysqli_query($this->conn, "SELECT * FROM comments WHERE post_id='$id'");
      $comments_check_num = mysqli_num_rows($comments_check);

      include('../../myapps/utilities/time-frame.php');

      $gap = 5;
      $tm = date("Y-m-d H:i:s", mktime(date("H"), date("i") - $gap, date("s"), date("m"), date("d"), date("Y")));
      $ut = mysqli_query($this->conn, "UPDATE users SET status='OFF' WHERE tm < '$tm'");

      if ($added_by_obj->isFriend($userloggedin)) {
      }

      if ($imagePath == 'none') {
          $imageDiv = "";
      } elseif ($gname != "") { /*if($status=='process'){}*/
          $album = mysqli_query($this->conn, "SELECT count(aid) FROM posts WHERE aid='$aid' AND added_by='$added_by' AND status='process'");
          $rowcount = mysqli_fetch_row($album);
          $qty = $rowcount[0];
          if (strpos($gname, "'")) {
              $gname = str_replace("'", "&#39", $gname);
          }

          $stmt = mysqli_stmt_init($this->conn);
          // $images_query = mysqli_query($this->conn, "SELECT * FROM posts WHERE aid='$aid' AND added_by='$added_by' AND status='process'");
          $images_query = "SELECT * FROM posts WHERE aid=? AND added_by=? AND status=?";
          mysqli_stmt_prepare($stmt, $images_query);
          mysqli_stmt_bind_param($stmt, 'iss', $aid, $added_by, $process);
          mysqli_stmt_execute($stmt);
          $result3 = mysqli_stmt_get_result($stmt);
          $imageDiv = "";

         include("classes-parts/post-mul-image.php");

      } else {
          $imagePath_extract = basename($imagePath);
          $imageFileType = pathinfo($imagePath_extract, PATHINFO_EXTENSION);
          if (strtolower($imageFileType) == "pdf") {
              $filename = substr($imagePath, 33);
              $imageDiv= "<div style='text-align:left;padding-left:21px'>$filename</div><a href='post_pdf_reader?title=$imagePath' target='_blank'><div class='postedImage'><img src='assets/images/icon/pdf.png' width='inherit'></div></a>";
          } else {
              $imageDiv="<a href='../../../$imagePath' target='_self' data-fancybox><div class='postedImage'><img src='../../../$imagePath' width='inherit'> </div></a>";
          }
      }

         include('classes-parts/str-out-single.php');
         include('classes-parts/str-out-bottom.php');

        } else {
            echo "<p>No post found it might be deleted.</p>";
            return;
        }
        echo $str;

    }


  public function submitPost($body, $user_to, $imageName, $videoName, $friends, $vidPoster){
        $body = htmlspecialchars(strip_tags($body));
        $body = mysqli_real_escape_string($this->conn, $body);
        $imageName = mysqli_real_escape_string($this->conn, $imageName);
        $videoName = mysqli_real_escape_string($this->conn, $videoName);

        if (strpos($body, ".youtube.com/watch?v=") !== false) {
          $value = substr($body, 0, 44);
          $value = preg_replace("!watch\?v=!", "embed/", $value . "?enablejsapi=1&amp;rel=0");
          $value = "<iframe width='840' height='473' src='" . $value . "' frameborder='0' allowfullscreen></iframe>";

          $title_url = 'none';
          $image_url = 'none';
          $decript_url = 'none';
          $bodyCleared = 'none';
          $clear_url = 'none';
          $bodyYou = $value;
          $body=substr($body, 44);

        } elseif (strpos($body, "http") !== false) {
            $body_Notarray = "";
            $body_Notarray = $body;
            $bodyCleared = '';
            $match = '';
            preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $body_Notarray, $match);
            $extract = ($match[0]);
            foreach ($extract as $extUrl) {
                $extUrl = $extUrl;
                if ($extUrl == "") {
                    $bodyCleared == "";
                } else {
                    $bodyCleared = $extUrl;
                }
            }

            $_POST["url"] = $bodyCleared;
            if (isset($_POST["url"]) && filter_var($_POST["url"], FILTER_VALIDATE_URL)) {
                set_time_limit(1800);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_URL, $_POST["url"]);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                $data = curl_exec($ch);
                curl_close($ch);
                $dom = new DOMDocument();
                @$dom->loadHTML($data);
                $nodes = $dom->getElementsByTagName('title');
                $title = $nodes->item(0)->nodeValue;
                $metas = $dom->getElementsByTagName('meta');
                $bodyUrl = "";
                for ($i = 0;$i < $metas->length;$i++) {
                    $meta = $metas->item($i);
                    if ($meta->getAttribute('name') == 'description') {
                        $bodyUrl = $meta->getAttribute('content');
                    }
                }

                $image_src = "";
                $image_urls = array();
                $images = $dom->getElementsByTagName('img');
                for ($i = 0;$i < $images->length;$i++) {
                    $image = $images->item($i);
                    $src = $image->getAttribute('src');
                    if (filter_var($src, FILTER_VALIDATE_URL)) {
                        $image_src = $src;
                    }
                }

                $output0 = array(
                    'title' => $title
                );
                $output1 = array(
                    'image_src' => $image_src
                );

                $output2 = array(
                    'body' => $bodyUrl
                );

                foreach ($output0 as $value0) {
                    $title_url = mysqli_real_escape_string($this->conn, htmlspecialchars(strip_tags($value0)));
                }

                foreach ($output1 as $value1) {
                    $image_url = mysqli_real_escape_string($this->conn, htmlspecialchars(strip_tags($value1)));
                }

                foreach ($output2 as $value2) {
                    $decript_url = mysqli_real_escape_string($this->conn, htmlspecialchars(strip_tags($value2)));
                }

                $bodyYou = '';
                $clear_url = mysqli_real_escape_string($this->conn, htmlspecialchars(strip_tags($bodyCleared)));

            }

        } else {
          $title_url = 'none';
          $image_url = 'none';
          $decript_url = 'none';
          $bodyYou = '';
          $clear_url = 'none';
        }

        if($friends == 'friends'){
          $posting = 'no';
        }else{
          $posting = 'yes';
        }
        $date_added = date("Y-m-d H:i:s");
        $id;
        $added_by = $this->user_obj->getUsername();
        $user_closed= 'no';
        $deleted = 'no';
        $likes = '0';
        $aid = '';
        $gname = '';
        $status = '';

        $items = ["\\r\\n", "\\r", "\\n"];
        foreach ($items as $item)  {
            $body = str_replace($item, "<br>", $body);
            // $body =substr($body, 4);
        }

        $sql = "INSERT INTO posts(id, body, added_by, user_to, date_added, user_closed, deleted, likes, aid, gname, status, image, youtube, posting, video, title_url, image_url, descript_url, body_cleared, vidpost) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_stmt_init($this->conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "isssssssssssssssssss",$id, $body, $added_by, $user_to, $date_added, $deleted, $user_closed, $likes , $aid, $gname, $status, $imageName, $bodyYou, $posting, $videoName, $title_url, $image_url, $decript_url, $clear_url, $vidPoster);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $num_posts = $this->user_obj->getNumPosts();
        $num_posts++;
        $update_query = mysqli_query($this->conn, "UPDATE users SET num_posts='$num_posts' WHERE username='$added_by'");

        if ($update_query)
          $response = 'success';

    return($response);
    mysqli_close($this->conn);

  }

}

?>
