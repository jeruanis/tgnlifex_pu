<?php
    require_once('../../../configuration/config.php');


    if(isset($_POST['userlog']))
        $userlog = $_POST['userlog'];
    if(isset($_POST['userother']))
        $userother = $_POST['userother'];


   // delete all the conversation with username

    if(isset($_POST['result'])) {
        if($_POST['result'] == 'true'){

           $count_query = mysqli_query($conn, "SELECT user_to, user_from FROM messages WHERE (user_from='$userlog' AND user_to='$userother') OR (user_to='$userlog' AND user_from='$userother')");


            $i=0;
            if($result=mysqli_num_rows($count_query) > 0) {
              while($row=mysqli_fetch_array($count_query)){
                 $query = mysqli_query($conn, "UPDATE messages SET deleted ='yes', opened='yes', viewed='yes' WHERE (user_from='$userlog' AND user_to='$userother') OR (user_to='$userlog' AND user_from='$userother')");
                  $note = $i++;
                }
              }


           if($note > 0 ){
             $response = 'success';
             echo json_encode($response);
           }else{
             $response = 'Failed deleting the message';
             echo json_encode($response);
            }
        }
     }

?>
