<?php

    require '../../../configuration/config.php';

    if(isset($_POST['day']) || isset($_POST['item']) || isset($_POST['username'])) {
        $item= $_POST['item'];
        $day= $_POST['day'];
        $username= $_POST['username'];

        $item = htmlspecialchars(strip_tags(nl2br($item)));
        $day =htmlspecialchars(strip_tags(nl2br($day)));
        $item= mysqli_real_escape_string($conn, $item);
        $day = mysqli_real_escape_string($conn,  $day);
        $username =htmlspecialchars(strip_tags(nl2br($username)));
        $username= mysqli_real_escape_string($conn, $username);
        $item = encryptthis($item, $key);


           if($day == 'monday')
              $query = mysqli_query($conn, "INSERT INTO todo VALUES ('', '$item', '', '', '', '', '', '', '', '$username')");
           elseif($day == 'tuesday')
              $query = mysqli_query($conn, "INSERT INTO todo VALUES ('', '', '$item', '', '', '', '', '', '', '$username')");
           elseif($day == 'wednesday')
              $query = mysqli_query($conn, "INSERT INTO todo VALUES ('', '', '', '$item', '', '', '', '', '', '$username')");
           elseif($day == 'thursday')
              $query = mysqli_query($conn, "INSERT INTO todo VALUES ('', '', '', '', '$item', '', '', '', '', '$username')");
           elseif($day == 'friday')
              $query = mysqli_query($conn, "INSERT INTO todo VALUES ('', '', '', '', '', '$item', '', '', '', '$username')");
           elseif($day == 'saturday')
              $query = mysqli_query($conn, "INSERT INTO todo VALUES ('', '', '', '', '', '', '$item', '', '', '$username')");
           elseif($day == 'sunday')
              $query = mysqli_query($conn, "INSERT INTO todo VALUES ('', '', '', '', '', '', '', '$item', '', '$username')");
           elseif($day == 'planning')
              $query = mysqli_query($conn, "INSERT INTO todo VALUES ('', '', '', '', '', '', '', '', '$item', '$username')");

            }
        exit();



?>
