<?php
    require_once('../../../configuration/config.php');

    if(isset($_POST['msge_id'])) {
      $msge_id= $_POST['msge_id'];
      $userlogin= $_POST['userlogin'];
      $image_path= '../../../'.$_POST['image_path'];

      $query=mysqli_query($conn, "DELETE FROM messages_group WHERE (id='$msge_id' AND user_from='$userlogin')");

      if($query){
        if(!empty($_POST['image_path'])){
          if (file_exists ($image_path)){
            unlink($image_path);
           }
        }
         $response='success';
         echo json_encode($response);
      }else{
        $response = 'Error encountered';
        echo json_encode($response);
      }
    }
