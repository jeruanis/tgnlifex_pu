<?php
include("../main/base.php");

$get_deleted_query = mysqli_query($conn, "SELECT * FROM messages_group WHERE deleted='yes' ORDER BY id DESC");
   echo" <h1>This is from messages_group</h1>
      <table border='1' width='90%'>
      <thead>
        <tr><th width='10%'>Id</th><th width='20%'>Body</th><th width='10%'>Date</th><th width='20%'>image</th><th width='20%'>gif</th><th width='10%'>more than 24 hours</th><th width='5%'>gif Photo</th><th width='5%'>image Photo</th></tr>
      </thead>
    ";

        while($row=mysqli_fetch_assoc($get_deleted_query)){
            $body = $row['body'];
            $date = $row['date'];
            $id = $row['id'];
            $image = '../../../'.$row['image'];
            $gif = '../../../'.$row['gif'];
            $start_date = new DateTime($row['date']);
            $date_time_now=date("Y-m-d H:i:s");
            $end_date=new DateTime($date_time_now);
            $age = date_diff($start_date, $end_date);
            $ageShow = $age->format('%a');

            $ageShowNum = (int)$ageShow;
            if($gif != ""){
                $photoGif = '<img src="'.$gif.'" width="50px" height="50px"/>';
            }else{
                $photoGif="";
            }
            if($image != ""){
                $photoImage = '<img src="'.$image.'" width="50px" height="50px"/>';
            }else{
                $photoImage="";
            }


            if($ageShowNum >= 1) {
                if($gif != ""){
                    if (file_exists ($gif)){
                        unlink($gif);
//                        echo 'yeah gif';
                     }
                }
                if($image != ""){
                    if (file_exists ($image)){
                        unlink($image);
//                         echo 'yeah image';
                    }
                }

                // check before executing this
                // $del_request = mysqli_query($conn, "DELETE FROM messages_group WHERE id='$id'");
            }

            echo"
             <tr><td>$id</td><td >$body</td><td>$date</td><td>$image</td><td>$gif</td><td>$ageShow</td><td>$photoGif</td><td>$photoImage</td></tr>
              ";

         }

    echo"</table>";

?>

<head>
  <style>
      body{
          margin-top:100px;
      }
    </style>
</head>
