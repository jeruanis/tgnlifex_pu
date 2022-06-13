<?php

include("../main/base.php");

$get_deleted_query = mysqli_query($conn, "SELECT * FROM posts WHERE deleted='yes' ORDER BY id DESC");
   echo" <h1>This is from posts</h1>
      <table border='1' width='60%'>
      <thead>
        <tr>
            <th width='10%'>Id</th>
            <th width='10%'>Body</th>
            <th width='10%'>Date</th>
            <th width='10%'>image</th>
            <th width='10%'>more than 24 hours</th>
            <th width='10%'>image Photo</th>
            <th width='10%'>video</th>
            <th width='10%'>video_display</th>
            <th width='10%'>vidpost</th>
            <th width='10%'>vidpost_display</th>

        </tr>
      </thead>
    ";

        while($row=mysqli_fetch_assoc($get_deleted_query)){
            $body = $row['body'];
            $date = $row['date_added'];
            $id = $row['id'];
            $image = $row['image'];
            $video = $row['video'];
            $vidpost = $row['vidpost'];
       
            $start_date = new DateTime($row['date_added']); 
            $date_time_now=date("Y-m-d H:i:s");
         
            $end_date=new DateTime($date_time_now); 
            $age = date_diff($start_date, $end_date);
            
            $ageShow = $age->format('%a');
          
            $ageShowNum = (int)$ageShow;
            if($image != ""){
                $photoImage = '<img src="'.$image.'" width="50px" height="50px"/>';
            }else{
                $photoImage="";
            }
            if($vidpost != ""){
                $vidpost_display = '<img src="'.$vidpost.'" width="50px" height="50px"/>';
            }else{
                $vidpost_display="";
            }
            if($video != 'none'){
                $video_display="<video>
                                      <source src='$video' type='video/mp4'>
                                      <source src='$video' type='video/webm'>
                                      <source src='$video' type='video/ogg'>
                                      Your browser doesn't support HTML5 video tag.
                                    </video>";
            }else{
                $video_display="";
            }
         
            if($ageShowNum >= 1) {
                if($image != ""){
                    if (file_exists ($image)){
                        unlink($image);

                    }
                }
                if($vidpost != ""){
                    if (file_exists ($vidpost)){
                        unlink($vidpost);

                    }
                }
                if($video != ""){
                    if (file_exists ($video)){
                        unlink($video);

                    }
                }

             $del_request = mysqli_query($conn, "DELETE FROM posts WHERE id='$id'");

            }

            echo"
             <tr><td>$id</td><td >$body</td><td>$date</td><td>$image</td><td>$ageShow</td><td>$photoImage</td><td>$video</td><td>$video_display</td><td>$vidpost</td><td>$vidpost_display</td></tr>
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
