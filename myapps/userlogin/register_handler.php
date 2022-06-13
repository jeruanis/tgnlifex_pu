<?php
    $fname          =   "";
    $lname          =   "";
    $em             =   "";
    $em2            =   "";
    $password       =   "";
    $password2      =   "";
    $date           =   "";
    $city           =   "";
    $country        =   "";
    $skills         =   "";
    $error_array    =   array();

    if( isset($_POST['register_button'])) {

        function validateFormData($formData) {
    $formData = trim( stripslashes( htmlspecialchars( strip_tags( str_replace( array( '(', ')', ' ' ), '_', $formData ) ), ENT_QUOTES ) ) );
    return $formData;
   }

    if (!$_POST["reg_fname"]){
       array_push($error_array,  "Name is required..<br>");
    }else if (!preg_match("/^[a-zA-Z ]*$/",($_POST["reg_fname"]))){
        array_push($error_array, "Only letters and white space allowed for First Name..<br>");
        header('Location: registration_signup_page?Fail=Only-letters-and-space-allowed-for-First-Name');
    }else {
        $fname = validateFormData($_POST['reg_fname']);
    }
    $_SESSION['reg_fname'] = $fname;

    if ( !$_POST["reg_lname"]) {
        array_push($error_array,  "Lastname is required..<br>");
    }else if (!preg_match("/^[a-zA-Z ]*$/",($_POST["reg_lname"]))) {
        array_push($error_array, "Only letters and white space allowed for Last Name..<br>");
        header('Location: registration_signup_page?Fail=Only-letters-and-space-allowed-for-Last-Name');
    }else {
        $lname = validateFormData($_POST['reg_lname']);
     }
    $_SESSION['reg_lname'] = $lname;

    if ( !$_POST["reg_email"]) {
        array_push($error_array,  "Email is required..<br>");
    }elseif (!filter_var(( $_POST["reg_email"]), FILTER_VALIDATE_EMAIL)) {
        array_push($error_array, "Invalid email format..<br>");
    }else{
        $em = validateFormData($_POST['reg_email']);
    }
    $_SESSION['reg_email'] = $em;

    if ( !$_POST["reg_email2"]) {
        array_push($error_array,  "Confirming Email is required..<br>");
    }elseif (!filter_var(( $_POST["reg_email2"]), FILTER_VALIDATE_EMAIL)) {
         array_push($error_array, "Invalid email format..<br>");
    }else{
        $em2  = validateFormData($_POST['reg_email2']);
    }
    $_SESSION['reg_email2'] = $em2;

    if (!$_POST["reg_password"]) {
        array_push($error_array,  "Password is required..<br>");
    }else{
        $password = validateFormData($_POST['reg_password']);
     }

    $password2 = validateFormData($_POST['reg_password2']);

    $date = date("Y-m-d");

    if($em == $em2) {
        if(filter_var($em, FILTER_VALIDATE_EMAIL)) {
            $em= filter_var($em, FILTER_VALIDATE_EMAIL);

            /**************************************/

            $retrieve_users = mysqli_query($conn, "SELECT email FROM users");
            while($row = mysqli_fetch_array($retrieve_users)){
                $emailHassed = $row['email'];
                $emailDecoded =  decryptthis($emailHassed, $key);
                if($em == $emailDecoded){
                array_push($error_array, "Email already in use..<br>");
             }}

        }else{
           array_push($error_array, "Invalid Email Format<br>");
        }
    }else{
        array_push($error_array, "Emails don't match<br>");
    }
    if(strlen($fname) > 25 || strlen($fname) <2 ) {
        array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
    }
    if(strlen($lname) > 25 || strlen($lname) <2 ) {
        array_push($error_array,  "Your last name must be between 2 and 25 characters<br>");
     }
    if($password != $password2){
        array_push($error_array,  "Your password do not match<br>");
    }else{
        if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{5,30}$/', $password)) {
            array_push($error_array, "Your pasword must be 5 to 30 characters with atleast one letter and one number <br>");
            }
        }

    $fname = strtolower($fname);
    $lname = strtolower($lname);
    $em = strtolower($em);

    if(empty($error_array)) {
        $password = password_hash($_POST['reg_password'], PASSWORD_DEFAULT);

        if($fname == "support" || $fname == "Support" || $fname == "supports" || $fname == "Supports" || $fname == "SUPPORT" || $fname == "SUPPORTS"){
            array_push($error_array, "First name cannot be used!<br>");
        }else if($lname == "support" || $lname == "Support" || $lname == "supports" || $lname == "Supports" || $lname == "SUPPORT" || $lname == "SUPPORTS" ){
            array_push($error_array,  "Last name cannot be used!<br>");
              }elseif(strpos($fname, "support") !== false){
                  array_push($error_array,  "first name cannot be used!<br>");
           }else{


        function randLetter(){
            $int = rand(0,26);
            $a_z = "abcdefghijklmnopqrstuvwxyz";
            $rand_letter = $a_z[$int];
            return $rand_letter;
          }

        $userNhalf = substr(substr($em, 0, strpos($em, "@")),0,3);
        $userNhalfb = substr(substr($em, 0, strpos($em, "@")),6,10);
        $userNhalfa = randLetter();
        $userNint = rand(2, 9);

        $username =   $userNhalf.$userNhalfb;

        if(strlen($username) < 4){
          $username = $username.$userNhalfa.$userNint;
        }

        $first_username = $username;
        $check_username_query = "SELECT username FROM users WHERE username = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $check_username_query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $i=0;

        while(mysqli_num_rows($result) !=0 ) {
            $i++;
            $username_split=(str_split($username, strlen($first_username)));
            $username = $username_split[0].$i;
            $check_username_query = "SELECT username FROM users WHERE username = ?";
            mysqli_stmt_prepare($stmt, $check_username_query);
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        }

        $rand = rand(1, 2);
        if($rand == 1)
            $profile_pic = "assets/images/profile_pics/default/head_alizarin.png";
        elseif($rand == 2)
            $profile_pic = "assets/images/profile_pics/default/head_deep_blue.png";

        $fname = encryptthis($fname, $key);
        $lname = encryptthis($lname, $key);
        $email = encryptthis($em, $key);
        $num_post = 0;
        $num_likes = 0;
        $user_closed = 'no';
        $friend_array = ',';
        $city='';
        $country = '';
        $skills = '';
        $hobby = '';
        $status = '';
        $tm='';
        $group_array = ',';
        $inv_array = ',';
        $pwc=0;

        $query = "INSERT INTO users VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        mysqli_stmt_prepare($stmt, $query);
        mysqli_stmt_bind_param($stmt, "isssssssiissssssssssi", 
            $id, 
            $fname,
            $lname,
            $username,
            $email,
            $password,
            $date,
            $profile_pic,
            $num_post,
            $num_likes,
            $user_closed,
            $friend_array,
            $city,
            $country,
            $skills,
            $hobby,
            $status,
            $tm,
            $group_array,
            $inv_array,
            $pwc);
        mysqli_stmt_execute($stmt);

        array_push($error_array, "<span style='color:#14c800'>You are all set! Go ahead and login!</span><br>");

        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";
        $_SESSION['city'] = "";
        $_SESSION['country'] = "";
        $_SESSION['skills'] = "";
        $_SESSION['username'] = $username;



     }
   }

}
?>
