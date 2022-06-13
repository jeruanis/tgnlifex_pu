<?php

class Group{
    private $user_obj;
    private $conn;
    public function __construct($conn, $user){
        $this->conn = $conn;
        $this->user_obj = new User($conn, $user);
    }

    public function getMostRecentUserGroup($groupName){
        $userloggedin = $this->user_obj->getUsername();
        $query = mysqli_query($this->conn, "SELECT user_to, user_from FROM messages_group WHERE group_name = '$groupName' AND user_to='$userloggedin' OR user_from='$userloggedin'");
        if (mysqli_num_rows($query) == 0) return false;
        $row = mysqli_fetch_array($query);
        $user_to = $row['user_to'];
        $user_from = $row['user_from'];
        if ($user_to != $userloggedin) return $user_to;
        else return $user_from;
    }

    public function getUser(){
        $userloggedin = $this->user_obj->getUsername();
        $query = mysqli_query($this->conn, "SELECT user_to, user_from FROM messages_group WHERE group_name = '$groupName' AND (user_to='$userloggedin' OR user_from='$userloggedin') ORDER BY id DESC LIMIT 1");
        $row = mysqli_fetch_array($query);
        $user_to = $row['user_to'];
        $user_from = $row['user_from'];
        return $userloggedin;
    }

    public function sendMessage($user_to, $body, $date, $groupName){
        if ($body != ""){
            $userloggedin = $this->user_obj->getUsername();
            $last_message_query = mysqli_query($this->conn, "SELECT unjoined, left_group, date FROM messages_group WHERE id IN (SELECT MAX(id) FROM messages_group WHERE user_from='$userloggedin' AND group_name='$groupName' GROUP BY user_from) ORDER BY date DESC");
            $res = mysqli_fetch_array($last_message_query);
            $unjoined = $res['unjoined'];
            $left_group = $res['left_group'];
            if ($unjoined == 'yes' || $left_group == 'yes'){
                header("Location: index.php");

            }else{
                $get_creator = mysqli_query($this->conn, "SELECT creator FROM messages_group WHERE group_name ='$groupName' AND creator !=''");
                $res = mysqli_fetch_array($get_creator);
                $creator = $res['creator'];
                $query = mysqli_query($this->conn, "INSERT INTO messages_group VALUES('', '$user_to', '$userloggedin', '$body', '$date', 'no', 'no', 'no', '', 'no', '$groupName', '$creator', 'no', 'no', '', '', '', '', '')");
                if ($query)
                {
                    echo "<audio autoplay=true  style='display:none'><source src='assets/sounds/when.mp3'></audio>";
                }
            }

            //online status time updater
            $gap = 5;
            $tm = date("Y-m-d H:i:s", mktime(date("H") , date("i") - $gap, date("s") , date("m") , date("d") , date("Y")));
            $ut = mysqli_query($this->conn, "UPDATE users SET status='OFF' where tm < '$tm'");
        }
    }

    public function sendMessageGif($user_to, $body, $date, $gif, $groupName, $lastMessageId){
        $user_to = mysqli_real_escape_string($this->conn, $user_to);
        $body = mysqli_real_escape_string($this->conn, $body);
        $date = mysqli_real_escape_string($this->conn, $date);
        $gif = mysqli_real_escape_string($this->conn, $gif);
        $groupName = mysqli_real_escape_string($this->conn, $groupName);
        $lastMessageId = mysqli_real_escape_string($this->conn, $lastMessageId);
        $userloggedin = $this->user_obj->getUsername();

        $last_message_query = mysqli_query($this->conn, "SELECT unjoined, left_group, id, date FROM messages_group WHERE id IN (SELECT MAX(id) FROM messages_group WHERE user_from='$userloggedin' AND group_name='$groupName' GROUP BY user_from) ORDER BY date DESC");
        $res = mysqli_fetch_array($last_message_query);
        $unjoined = $res['unjoined'];
        $left_group = $res['left_group'];
        if ($unjoined == 'yes' || $left_group == 'yes'){
            header("Location: ../../index.php");
        }else{
            $get_creator = mysqli_query($this->conn, "SELECT creator FROM messages_group WHERE group_name = '$groupName' AND creator != ''");
            $res = mysqli_fetch_array($get_creator);
            $creator = $res['creator'];
            $query = mysqli_query($this->conn, "INSERT INTO messages_group VALUES('', '$user_to', '$userloggedin', '$body', '$date', 'no', 'no', 'no', '$gif', 'no', '$groupName', '$creator', 'no', 'no', '', '', '', '', '', '$lastMessageId')");
            if ($query){
                $response['message'] = 'success';
            }
        }
        $gap = 5;
        $tm = date("Y-m-d H:i:s", mktime(date("H") , date("i") - $gap, date("s") , date("m") , date("d") , date("Y")));
        $ut = mysqli_query($this->conn, "UPDATE users SET status='OFF' where tm < '$tm'");
        echo json_encode($response);
        mysqli_close($this->conn);
        exit();

    }

    public function retrieveNewMessageGroup($otherUser, $groupName, $id){
        $otherUser = mysqli_real_escape_string($this->conn, $otherUser);
        $groupName = mysqli_real_escape_string($this->conn, $groupName);
        $id = mysqli_real_escape_string($this->conn, $id);
        function url($text){
            $text = html_entity_decode($text);
            $text = " " . $text;
            $text = preg_replace('/(https{0,1}:\/\/[\w\-\.\/#?&=+%]*)/', '<a style="color:#0088cc;text-decoration:underline" href="$1"target="_blank">$1</a>', $text);
            return $text;
          }

        $userloggedin = $this->user_obj->getUsername();
        $data = "";
        $query = mysqli_query($this->conn, "UPDATE messages_group SET opened='yes' WHERE group_name ='$groupName' AND user_from='$userloggedin'");

        //added this to the original
        $mesge_query = mysqli_query($this->conn, "SELECT count(*) FROM messages_group WHERE group_name='$groupName'");
        $rowcount=mysqli_fetch_row($mesge_query);
        $total_records =  $rowcount[0];


        if ($id > 0){
            $get_messages_query = mysqli_query($this->conn, "SELECT * FROM messages_group WHERE group_name ='$groupName' AND id>'$id' ORDER BY id ASC");
        }
        //this is for 1st loading of the messages
        else{
            $get_messages_query = mysqli_query($this->conn, "SELECT * FROM (SELECT * FROM messages_group WHERE group_name ='$groupName' ORDER BY id DESC LIMIT $total_records) AS Last$total_records ORDER BY id ASC");

        }
        $response = array();
        $response['clear'] = $this->isDatabaseCleared($id);
        $response['messages'] = array();

        while ($row = mysqli_fetch_array($get_messages_query)){
            $message = array();
            $message['id'] = $row['id'];
            $message['user_to'] = $row['user_to'];
            $message['user_from'] = $row['user_from'];
            $user_from1 = $row['user_from'];
            $message['user_from1'] = ucwords(str_replace('_', ' ', $message['user_from']));
            $date_time = $row['date'];
            $message['gif'] = $row['gif'];
            $body = $row['body'];
            $body = url($body);
            $message['deleted'] = $row['deleted'];
            $message['creator'] = $row['creator'];
            $message['unjoined'] = $row['unjoined'];
            $message['group_name'] = $row['group_name'];
            $message['left_group'] = $row['left_group'];
            $message['image'] = $row['image'];
            $message['title_url'] = $row['title_url'];
            $message['image_url'] = $row['image_url'];
            $message['descript_url'] = $row['decript_url'];
            $decriptUrl = $row['decript_url'];
            $message['body_cleared'] = $row['body_cleared'];

            // removing ../../ from older folder asset location using substr
            // if (strpos($row['image'], "../../") !== false) {
            //     $message['image'] =substr($row['image'], 6); //slicing starts at the 6th index
            //     $message['image'] = '../../'.$message['image'];
            //  }else{
            //      $message['image'] = '../../'.$row['image'];
            //  }

            if ($decriptUrl != ''){
                if (strpos($body, "http") !== false){
                    $body = substr($body, 0, strpos($body, "http"));
                }
            }

            include ('../utilities/badwords.php');

            $message['body'] = $body;
            include ('../utilities/time-frame.php');
            $message['date'] = $time_message;

            $last_message_query = mysqli_query($this->conn, "SELECT id, date FROM messages_group WHERE id IN (SELECT MAX(id) FROM messages_group WHERE user_from='$user_from1' AND group_name='$groupName' GROUP BY user_from) ORDER BY date DESC");

            $res = mysqli_fetch_array($last_message_query);
            $last_id = $res['id'];
            $message['last_id_query'] = $last_id;
            $get_loggedinPic_query = mysqli_query($this->conn, "SELECT profile_pic FROM users WHERE username='$user_from1'");

            while ($row = mysqli_fetch_array($get_loggedinPic_query)){
                $profile_pic = $row['profile_pic'];
                $profile_pic = "<img src='$profile_pic' style='width:40px;border-radius:20px;'/>";
                $message['profile_pic'] = '../../'.$row['profile_pic'];
            }
            array_push($response['messages'], $message);
        }
        $gap = 5;
        $tm = date("Y-m-d H:i:s", mktime(date("H") , date("i") - $gap, date("s") , date("m") , date("d") , date("Y")));
        $ut = mysqli_query($this->conn, "UPDATE users SET status='OFF' where tm < '$tm'");

        return $response;
        mysqli_close($this->conn);
        exit;
    }


    // private function isDatabaseCleared($id){
    //     if ($id > 0){
    //         $check_clear = mysqli_query($this->conn, "SELECT count(*) old FROM messages_group WHERE id<='$id'");
    //         $row = mysqli_fetch_array($check_clear);
    //         if ($row['old'] == 0) return 'true';
    //         return 'false';
    //     }
    //     return 'true';
    // }

    private function isDatabaseCleared($id){
        if ($id > 0){
            $check_clear = mysqli_query($this->conn, "SELECT count(*) lastmessage_id FROM messages_group WHERE id<='$id'");
            $row = mysqli_fetch_array($check_clear);
            if ($row['lastmessage_id'] == 0)
              return true;
            else
              return false;
        }
        return true;
    }

    public function getUnreadNumber(){
        $userloggedin = $this->user_obj->getUsername();
        $query = mysqli_query($this->conn, "SELECT * FROM messages WHERE viewed='no' AND user_to='$userloggedin'");
        return mysqli_num_rows($query);
    }

    public function MediaMessageGroup($body, $user_to, $imageName, $groupName, $lastMessageId){
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
                for ($i = 0;$i < $metas->length;$i++){
                    $meta = $metas->item($i);
                    if ($meta->getAttribute('name') == 'description'){
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

        $imageName = mysqli_real_escape_string($this->conn, strip_tags($imageName));
        $groupName = mysqli_real_escape_string($this->conn, strip_tags($groupName));
        $$body = mysqli_real_escape_string($this->conn, strip_tags($body));
        $user_to = mysqli_real_escape_string($this->conn, strip_tags($user_to));
        $lastMessageId = mysqli_real_escape_string($this->conn, strip_tags($lastMessageId));
        $body = addslashes($body);

        $date = date("Y-m-d H:i:s");
        $added_by = $this->user_obj->getUsername();
        $last_message_query = mysqli_query($this->conn, "SELECT unjoined, left_group, date FROM messages_group WHERE id IN (SELECT MAX(id) FROM messages_group WHERE user_from='$added_by' AND group_name='$groupName' GROUP BY user_from) ORDER BY date DESC");
        $res = mysqli_fetch_array($last_message_query);
        $unjoined = $res['unjoined'];
        $left_group = $res['left_group'];

        if ($unjoined == 'yes' || $left_group == 'yes'){
            header('Location: ../../index.php');

        }else{
            $get_creator = mysqli_query($this->conn, "SELECT creator FROM messages_group WHERE group_name ='$groupName' AND creator !=''");
            $res = mysqli_fetch_array($get_creator);
            $creator = $res['creator'];
            $query = mysqli_query($this->conn, "INSERT INTO messages_group VALUES('', '$user_to', '$added_by', '$body', '$date', 'no', 'no', 'no', '', 'no', '$groupName', '$creator', '$unjoined', '$left_group', '$imageName', '$title_url', '$image_url', '$decript_url', '$clear_url', '$lastMessageId')");

            if ($query){
                header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
                header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
                header('Cache-Control: no-cache, must-revalidate');
                header('Pragma: no-cache');
                header('Content-Type: application/json');
                $message['sent'] = 'success'; //need this as a response for ajax
             }
          }

           return ($message);
           mysqli_close($this->conn);
           exit;

    }
} ?>
