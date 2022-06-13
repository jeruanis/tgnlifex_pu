<?php
class User
{
    private $user;
    private $conn;
    public function __construct($conn, $user)
    {
        $this->conn = $conn;
        $user_details_query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$user'");
        $this->user = mysqli_fetch_array($user_details_query);

    }
    public function getUsername()
    {
        return $this->user['username'];

    }
    public function getNumberOfFriendRequests()
    {
        $username = $this->user['username'];
        $query = mysqli_query($this->conn, "SELECT * FROM friend_requests WHERE user_to = '$username'");
        return mysqli_num_rows($query);

    }
    public function getNumPosts()
    {
        $username = $this->user['username'];
        $query = mysqli_query($this->conn, "SELECT num_posts FROM users WHERE username = '$username'");
        $row = mysqli_fetch_array($query);
        return $row['num_posts'];

    }
    public function getFirstAndLastName()
    {
        $key = 'qkwjdiw239&&jd123421%%%%eihbrhnan&^%$ggdnawhASDFDd4njshjwuuO';
        $username = $this->user['username'];
        $query = mysqli_query($this->conn, "SELECT first_name, last_name FROM users WHERE username = '$username'");
        $row = mysqli_fetch_array($query);
        $firstNameHassed = $row['first_name'];
        $lastNameHassed = $row['last_name'];
        $firstNameDecode = decryptthis($firstNameHassed, $key);
        $lastNameDecode = decryptthis($lastNameHassed, $key);
        $firstName = ucfirst($firstNameDecode);
        $lastName = ucfirst($lastNameDecode);
        return $firstName . " " . $lastName;

    }
    public function getEmailAdd()
    {
        $username = $this->user['username'];
        $query = mysqli_query($this->conn, "SELECT email FROM users WHERE username = '$username'");
        $row = mysqli_fetch_array($query);
        return $row['email'];

    }
    public function getProfilePic()
    {
        $username = $this->user['username'];
        $query = mysqli_query($this->conn, "SELECT profile_pic FROM users WHERE username = '$username'");
        $row = mysqli_fetch_array($query);
        return $row['profile_pic'];

    }
    public function getFriendArray()
    {

        $username = $this->user['username'];
        $query = mysqli_query($this->conn, "SELECT friend_array FROM users WHERE username = '$username'");
        $row = mysqli_fetch_array($query);
        return $row['friend_array'];

    }
    public function isClosed()
    {
        $username = $this->user['username'];
        $query = mysqli_query($this->conn, "SELECT user_closed FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($query);
        if ($row['user_closed'] == 'yes') return true;
        else return false;

    }

    public function isFriend($username_to_check){
        $usernameComma = "," . $username_to_check . ",";
        if ((strstr($this->user['friend_array'], $usernameComma) && $username_to_check != $this->user['username'])){
            return true;
        }else{
            return false;
        }
    }

    public function isFriendcopy($username_to_check)
    {
        $usernameComma = "," . $username_to_check . ",";
        if ((strstr($this->user['friend_array'], $usernameComma) || $username_to_check == $this->user['username']))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function didRecievedRequest($user_from)
    {
        $user_to = $this->user['username'];
        $check_request_query = mysqli_query($this->conn, "SELECT * FROM friend_requests WHERE user_to = '$user_to' AND user_from='$user_from'");
        if (mysqli_num_rows($check_request_query) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }

    }
    public function didRecievedRequestForSelf()
    {
        $user_to = $this->user['username'];
        $check_request_query = mysqli_query($this->conn, "SELECT * FROM friend_requests WHERE user_to = '$user_to'");
        if (mysqli_num_rows($check_request_query) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }

    }
    public function didSendRequest($user_to)
    {
        $user_from = $this->user['username'];
        $check_request_query = mysqli_query($this->conn, "SELECT * FROM friend_requests WHERE user_to = '$user_to' AND user_from='$user_from'");
        if (mysqli_num_rows($check_request_query) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }

    }
    public function removeFriend($user_to_remove)
    {
        $logged_in_user = $this->user['username'];
        $query = mysqli_query($this->conn, "SELECT friend_array FROM users WHERE username='$user_to_remove'");
        $row = mysqli_fetch_array($query);
        $friend_array_username = $row['friend_array'];
        $new_friend_array = str_replace($user_to_remove . ",", "", $this->user['friend_array']);
        $remove_friend = mysqli_query($this->conn, "UPDATE users SET friend_array = '$new_friend_array' WHERE username='$logged_in_user'");
        $new_friend_array = str_replace($this->user['username'] . ",", "", $friend_array_username);
        $remove_friend = mysqli_query($this->conn, "UPDATE users SET friend_array = '$new_friend_array' WHERE username='$user_to_remove'");


    }
    public function sendRequest($user_to)
    {
        $user_from = $this->user['username'];
        $query = mysqli_query($this->conn, "INSERT INTO friend_requests VALUES('', '$user_to', '$user_from')");

    }
    public function getMutualFriends($user_to_check){
        $mf=array();
        $mutualFriends = 0;
        $user_array = $this->user['friend_array'];
        $user_array_explode = explode(",", $user_array);
        $query = mysqli_query($this->conn, "SELECT friend_array FROM users WHERE username='$user_to_check'");
        $row = mysqli_fetch_array($query);
        $user_to_check_array = $row['friend_array'];
        $user_to_check_array_explode = explode(",", $user_to_check_array);
        foreach ($user_array_explode as $i){
            foreach ($user_to_check_array_explode as $j){
                if ($i == $j && $i != ""){
                    $mutualFriends++;
                    array_push($mf, $i);
                }
            }
        }

        if(strlen($user_to_check_array) == 1 ){
            $mg = 'None';
            return $mg;
        }else{
           return $mf;
          }
        
      } 

    public function isUserBlock($username_to_block)
    {
        $usernameComma = "," . $username_to_block . ",";
        if ((strstr($this->user['friend_array'], $usernameComma) && $username_to_block != $this->user['username']))
        {
            $user_from = $this->user['username'];
            $user_to = $username_to_block;
            $query = mysqli_query($this->conn, "INSERT INTO userblocked VALUES('$user_to', '$user_from', 'yes')");
            $querycheck = mysqli_query($this->conn, "SELECT status FROM userblocked WHERE username='$user_to' AND status='yes'");
            if ($row = mysqli_fetch_array($querycheck) > 0);
            return isUserBlock();
        }
        else
        {
            return false;
        }

    }
} ?>
