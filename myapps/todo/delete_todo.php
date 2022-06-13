<?php

     require '../../../configuration/config.php';

    if(isset($_POST['id']) || isset($_POST['username'])) {
        $id= $_POST['id'];
        $username= $_POST['username'];

        $id = htmlspecialchars(strip_tags(nl2br($id)));
        $id= mysqli_real_escape_string($conn, $id);
        $username =htmlspecialchars(strip_tags(nl2br($username)));
        $username= mysqli_real_escape_string($conn, $username);
            $del_todo_query = mysqli_query($conn, "DELETE FROM todo WHERE id='$id' AND username ='$username'");
         }
       exit();

?>
