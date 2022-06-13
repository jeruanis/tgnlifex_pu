<?php

class Message{
    private $user_obj;
    private $conn;
    public function __construct($conn, $user){
        $this->conn = $conn;
        $this->user_obj = new User($conn, $user);
    }
    public function getMostRecentUser(){
        $userloggedin = $this->user_obj->getUsername();
        $query = mysqli_query($this->conn, "SELECT user_to, user_from FROM messages WHERE user_to='$userloggedin' OR user_from='$userloggedin' WHERE deleted='no'");
        if (mysqli_num_rows($query) == 0) return false;
        $row = mysqli_fetch_array($query);
        $user_to = $row['user_to'];
        $user_from = $row['user_from'];
        if ($user_to != $userloggedin) return $user_to;
        else return $user_from;
    }

    public function getUser(){
        $userloggedin = $this->user_obj->getUsername();
        $query = mysqli_query($this->conn, "SELECT user_to, user_from FROM messages WHERE user_to='$userloggedin' OR user_from='$userloggedin' ORDER BY id DESC LIMIT 1");
        $row = mysqli_fetch_array($query);
        $user_to = $row['user_to'];
        $user_from = $row['user_from'];
        return $userloggedin;
    }

    public function sendMessageGif($user_to, $body, $date, $gif, $lastMessageId){
        $user_to = mysqli_real_escape_string($this->conn, $user_to);
        $body = mysqli_real_escape_string($this->conn, $body);
        $date = mysqli_real_escape_string($this->conn, $date);
        $gif = mysqli_real_escape_string($this->conn, $gif);
        $lastMessageId = mysqli_real_escape_string($this->conn, $lastMessageId);
        $userloggedin = $this->user_obj->getUsername();
        $query = mysqli_query($this->conn, "INSERT INTO messages VALUES('', '$user_to', '$userloggedin', '$body', '$date', 'no', 'no', 'no', '$gif', 'no', '', '', '', '', '', '$lastMessageId')");
        if ($query){
            $response['message'] = 'success';
        }
        $gap = 5;
        $tm = date("Y-m-d H:i:s", mktime(date("H") , date("i") - $gap, date("s") , date("m") , date("d") , date("Y")));
        $ut = mysqli_query($this->conn, "UPDATE users SET status='OFF' where tm < '$tm'");
        echo json_encode($response);
        mysqli_close($this->conn);
        exit;
    }

    public function retrieveNewMessages($otherUser, $lastMessageId){
        $otherUser = mysqli_real_escape_string($this->conn, $otherUser);
        $lastMessageId = mysqli_real_escape_string($this->conn, $lastMessageId);
        function url($text){
            $text = html_entity_decode($text);
            $text = " " . $text;
            $text = preg_replace('/(https{0,1}:\/\/[\w\-\.\/#?&=+;%]*)/', '<a style="color:#0088cc;text-decoration:underline" href="$1"target="_blank">$1</a>', $text);
            return $text;
          }

        $userloggedin = $this->user_obj->getUsername();
        $data = "";
        $query = mysqli_query($this->conn, "UPDATE messages SET opened='yes', viewed='yes' WHERE user_to='$userloggedin' AND user_from='$otherUser'");

        $mesge_query = mysqli_query($this->conn, "SELECT count(*) FROM messages WHERE ((user_to='$userloggedin' AND user_from='$otherUser') OR (user_from='$userloggedin' AND user_to='$otherUser'))");
        $rowcount=mysqli_fetch_row($mesge_query);
        $total_records =  $rowcount[0];

        if ($lastMessageId > 0){
            $get_messages_query = mysqli_query($this->conn, "SELECT * FROM messages WHERE ((user_to='$userloggedin' AND user_from='$otherUser') OR (user_from='$userloggedin' AND user_to='$otherUser')) AND id >'$lastMessageId' ORDER BY id ASC");

        }else{
            $get_messages_query = mysqli_query($this->conn, "SELECT * FROM (SELECT * FROM messages WHERE ((user_to='$userloggedin' AND user_from='$otherUser') OR (user_from='$userloggedin' AND user_to='$otherUser')) ORDER BY id DESC LIMIT 50) AS Last50 ORDER BY id ASC");
        }

        $response = array();
        $response['messages'] = array();
        $response['clear'] = $this->isDatabaseCleared($lastMessageId);

        while ($row = mysqli_fetch_assoc($get_messages_query)){
          $message = array();
          $user_from1 = $row['user_from'];
          $message['user_from1'] = $row['user_from'];
          $message['id'] = $row['id'];
          $id = $row['id'];
          $message['user_to'] = $row['user_to'];
          $message['user_from'] = ucwords(str_replace('_', ' ', $user_from1));
          $message['date'] = $row['date'];
          $date_time = $row['date'];
          $message['gif'] = $row['gif'];
          $body = $row['body'];
          $body = url($body);
          $message['deleted'] = $row['deleted'];
          $message['image'] = $row['image'];
          $message['title_url'] = $row['title_url'];
          $message['image_url'] = $row['image_url'];
          $message['descript_url'] = $row['descript_url'];
          $decriptUrl = $row['descript_url'];
          $message['body_cleared'] = $row['body_cleared'];
          if ($decriptUrl != ''){
              if (strpos($body, "http") !== false){
                  $body = substr($body, 0, strpos($body, "http"));
              }
          }
          include ('../utilities/badwords.php');
          $message['body'] = $body;
          include ('../utilities/time-frame.php');
          $message['date'] = $time_message;
          $get_loggedinPic_query = mysqli_query($this->conn, "SELECT profile_pic FROM users WHERE username='$user_from1'");

          while ($row = mysqli_fetch_array($get_loggedinPic_query)){
              $profile_pic = $row['profile_pic'];
              $profile_pic = "<img src='$profile_pic' style='width:40px;border-radius:20px;'/>";
              $message['profile_pic'] = $row['profile_pic'];
          }
          array_push($response['messages'], $message);

          //update online status
          $gap = 5;
          $tm = date("Y-m-d H:i:s", mktime(date("H") , date("i") - $gap, date("s") , date("m") , date("d") , date("Y")));
          $ut = mysqli_query($this->conn, "UPDATE users SET status='OFF' where tm < '$tm'");
        }

        return $response;
        mysqli_close($this->conn);
        exit;
    }

    public function submitMediaMessage($body, $user_to, $imageName, $videoName, $lastMessageId){
        $gap = 5;
        $tm = date("Y-m-d H:i:s", mktime(date("H") , date("i") - $gap, date("s") , date("m") , date("d") , date("Y")));
        $ut = mysqli_query($this->conn, "UPDATE users SET status='OFF' where tm < '$tm'");

        $body_Notarray = "";
        $body_Notarray = $body;
        $bodyCleared = '';
        $match = '';
        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $body_Notarray, $match);
        $extract = ($match[0]);
        foreach ($extract as $extUrl){
            $extUrl = $extUrl;
            if ($extUrl == "") $bodyCleared == "";
            else $bodyCleared = $extUrl;
        }
        if ($bodyCleared != ''){
            $_POST["url"] = $bodyCleared;
            if (isset($_POST["url"]) && filter_var($_POST["url"], FILTER_VALIDATE_URL)){
                set_time_limit(30);
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
                for ($i = 0;$i < $metas->length;$i++)
                {
                    $meta = $metas->item($i);
                    if ($meta->getAttribute('name') == 'description')
                    {
                        $bodyUrl = $meta->getAttribute('content');
                    }
                }
                $image_src = "";
                $image_urls = array();
                $images = $dom->getElementsByTagName('img');
                for ($i = 0;$i < $images->length;$i++)
                {
                    $image = $images->item($i);
                    $src = $image->getAttribute('src');
                    if (filter_var($src, FILTER_VALIDATE_URL))
                    {
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
                foreach ($output0 as $value0)
                {
                    $title_url = mysqli_real_escape_string($this->conn, htmlspecialchars(strip_tags($value0)));
                }
                foreach ($output1 as $value1)
                {
                    $image_url = mysqli_real_escape_string($this->conn, htmlspecialchars(strip_tags($value1)));
                }
                foreach ($output2 as $value2)
                {
                    $decript_url = mysqli_real_escape_string($this->conn, htmlspecialchars(strip_tags($value2)));
                }
                $bodyYou = '';
                $clear_url = mysqli_real_escape_string($this->conn, htmlspecialchars(strip_tags($bodyCleared)));
            }
        }else{
            $title_url = '';
            $image_url = '';
            $decript_url = '';
            $bodyYou = '';
            $clear_url = '';
        }

        $body = htmlspecialchars(strip_tags($body));
        $body = mysqli_real_escape_string($this->conn, $body);
        $user_to = mysqli_real_escape_string($this->conn, strip_tags($user_to));
        $imageName = mysqli_real_escape_string($this->conn, strip_tags($imageName));
        $lastMessageId = mysqli_real_escape_string($this->conn, strip_tags($lastMessageId));

        $date = date("Y-m-d H:i:s");
        $added_by = $this->user_obj->getUsername();
        $query = mysqli_query($this->conn, "INSERT INTO messages VALUES('','$user_to', '$added_by', '$body','$date', 'no','no','no', '', 'no', '$imageName', '$title_url', '$image_url', '$decript_url', '$clear_url', '$lastMessageId')");
        if ($query){
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
            header('Cache-Control: no-cache, must-revalidate');
            header('Pragma: no-cache');
            header('Content-Type: application/json');
            $message['sent'] = 'success';
        }

        return ($message);
        mysqli_close($this->conn);
        exit;
    }

    public function isDatabaseCleared($lastMessageId){
        if ($lastMessageId > 0){
            $check_clear = mysqli_query($this->conn, "SELECT count(*) lastmessage_id FROM messages WHERE id <= '$lastMessageId'");
            $row = mysqli_fetch_assoc($check_clear);
            if ($row['lastmessage_id'] == 0)
                return true;
            else
              return false;
         }
        return true;
    }

    public function getLatestMessage($userloggedin, $user2){
        $details_array = array();
        $query = mysqli_query($this->conn, "SELECT body, user_to, date FROM messages WHERE (user_to='$userloggedin' AND user_from='$user2') OR (user_to='$user2' AND user_from='$userloggedin') ORDER BY id DESC LIMIT 1");
        $row = mysqli_fetch_array($query);
        $sent_by = ($row['user_to'] == $userloggedin) ? " " : " ";
        $date_time = $row['date'];
        include('../../myapps/utilities/time-frame.php');
        array_push($details_array, $sent_by);
        array_push($details_array, $row['body']);
        array_push($details_array, $time_message);
        return $details_array;
    }

    public function getConvos(){
        $userloggedin = $this->user_obj->getUsername();
        $return_string = "";
        $convos = array();
        $query = mysqli_query($this->conn, "SELECT user_to, user_from FROM messages WHERE (user_to='$userloggedin' OR user_from='$userloggedin') AND deleted='no' ORDER BY id DESC");
        while ($row = mysqli_fetch_array($query))
        {
            $user_to_push = ($row['user_to'] != $userloggedin) ? $row['user_to'] : $row['user_from'];
            if (!in_array($user_to_push, $convos))
            {
                array_push($convos, $user_to_push);
            }
        }
        foreach ($convos as $username){
            $user_found_obj = new User($this->conn, $username);
            $latest_message_details = $this->getLatestMessage($userloggedin, $username);
            $dots = (strlen($latest_message_details[1]) >= 30) ? "..." : "";
            $split = str_split($latest_message_details[1], 30);
            $split = strip_tags($split[0] . $dots);

            $user_name = $user_found_obj->getUsername();
            if(strlen($user_name) > 15){
               $user_name = substr($user_name, 0, 12)."...";
              }

            $return_string .= "
              <div class='comment clearfix'>
               <a href='../messaging/messages?u=$username' class='avatar' style='text-decoration:none;'>
                  <img src='../../../" . $user_found_obj->getProfilePic() . "' style='height:41px;width:41px;'>
               </a>
               <div class='content'>
                 <span class='author'>
                   $user_name
                 </span>
                 <div class='metadata'>
                  <span class='date'>
                    $latest_message_details[2]
                  </span>
                 </div>
                 <div class='text'>
                  $split
                 </div>
              </div>
              </div>";

        }
        return $return_string;
    }


    public function getConvosDropdown($data, $limit){
        $page = $data['page'];
        $userloggedin = $this->user_obj->getUsername();
        $return_string = "";
        $convos = array();
        if ($page == 1) $start = 0;
        else $start = ($page - 1) * $limit;

        ?><script>
           var url = window.location.pathname;
           var filename = url.substring(url.lastIndexOf('/')+1);
           if (filename == 'index' || filename == '') {
               urla =  "includes/form_handlers/";
            }else{
               urla =  "../../includes/form_handlers/";
            }
        </script> <?php


        $query = mysqli_query($this->conn, "SELECT user_to, user_from FROM messages WHERE (user_to='$userloggedin' OR user_from='$userloggedin') AND (deleted='no' OR viewed='no') ORDER BY id DESC");

        if($result = mysqli_num_rows($query) == 0){
             $return_string = "<input type='hidden' class='noMoreDropdownData' value='true'>
             <div id='noMoreMessage'><a class='d-block p-2 m-1 text-muted'><small>No message to load.</small></a></div>";
             exit($return_string);
           }

        while ($row = mysqli_fetch_array($query)){
            $user_to_push = ($row['user_to'] != $userloggedin) ? $row['user_to'] : $row['user_from'];
            if (!in_array($user_to_push, $convos)){
                array_push($convos, $user_to_push);
              }
         }

        $num_iterations = 0;
        $count = 1;

        foreach ($convos as $username){
          if ($num_iterations++ < $start)
            continue;
          if ($count > $limit)
            break;
          else
            $count++;


          $is_unread_query = mysqli_query($this->conn, "SELECT id, opened FROM messages WHERE user_to='$userloggedin' AND user_from='$username' AND deleted='no' ORDER BY id DESC");

          $row = mysqli_fetch_assoc($is_unread_query);
          $id = $row["id"];
          $style = ($row['opened'] == 'no') ? "background-color: #DDEDFF;padding: 6px 18px;margin-bottom:3px;" : "";

          $user_found_obj = new User($this->conn, $username);
          $latest_message_details = $this->getLatestMessage($userloggedin, $username);
          $dots = (strlen($latest_message_details[1]) >= 27) ? "..." : "";
          $split = str_split($latest_message_details[1], 27);
          $split = strip_tags($split[0] . $dots);
          $styleImg="height:41px;width:41px;";

          $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
          if ($curPageName != 'ajax_load_messages_non_myapps.php' ) {
            $img = "<img src='../../../" . $user_found_obj->getProfilePic() . "' style='".$styleImg."'>";
            $anchor = "<a href='../messaging/messages?u=$username' class='avatar'>";
          }else{
            $img = "<img src='../" . $user_found_obj->getProfilePic() . "' style='".$styleImg."'>";
            $anchor = "<a href='myapps/messaging/messages?u=$username' class='avatar'>";
           }

           $user_name = $user_found_obj->getUsername();
            if(strlen($user_name) > 15){
               $user_name = substr($user_name, 0, 12)."...";
              }

          $return_string .= "<div class='ui comments' id = '".$id."'>
              <div class='comment clearfix'>
               $anchor$img
               </a>
               <div class='content'>
                 <span class='author'>
                   $user_name
                 </span>
                    <span id='ddown_msg".$id."'><svg style='position:absolute; right:0;margin-right:4px;' xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 0 24 24' width='24px' fill='#495057'><path d='M0 0h24v24H0z' fill='none'/><path d='M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z'/></svg></span>

                 <div class='metadata'>
                  <span class='date'>
                    $latest_message_details[2]
                  </span>
                 </div>
                 <div class='text'>
                  $split
                 </div>
              </div>
              </div>"; ?>

                 <script>
                   $(document).ready(function(){
                      var id='<?php echo $id ?>';
                      var userlog='<?php echo $userloggedin ?>';
                      var userother='<?php echo $username ?>';
                      $('#ddown_msg'+id).on('click', function() {
                        bootbox.confirm('Delete all conversation with ' + userother + '?',
                          function(result) {
                            if(result){
                               $.ajax({
                                    url: urla+'delete_message_dropdown.php',
                                    method: 'POST',
                                    data: {'userlog':userlog, 'userother': userother, 'result':result},
                                    cache:false,
                                    'success': function(data) {
                                        alert(data)
                                       }
                                   });
                                 }
                              });
                          });

                      });
                </script>
             <?php

           }

        if ($count > $limit){
            $return_string .= "<input type='hidden' class='nextPageDropdownData' value='" . ($page + 1) . "'><input type='hidden' class='noMoreDropdownData' value='false'>";
        }else{
            $return_string .= "<input type='hidden' class='noMoreDropdownData' value='true'>
             <div id='noMoreMessage'><a class='d-block p-2 m-1 text-muted float-left w-100 text-center'>No more messages to load!</a></div></div>";
          }
        return $return_string;
        mysqli_close($this->conn);
     }



    public function getUnreadNumber(){
        $userloggedin = $this->user_obj->getUsername();
        $query = mysqli_query($this->conn, "SELECT * FROM messages WHERE viewed='no' AND user_to='$userloggedin'");
        return mysqli_num_rows($query);
    }

} ?>
