<?php
    include("../../../configuration/config.php");

    if(isset($_POST['userloggedin'])){
        $user_to = $_POST['userloggedin'];}

        $viewd_queryCount = mysqli_query($conn, "SELECT count(*) FROM messages_group WHERE viewed = 'no' AND sounded='no' AND user_to='$user_to'");
        $rowViewedcount=mysqli_fetch_row($viewd_queryCount);
        $total_records =  $rowViewedcount[0];

       $count=1;
       $audio="";
       $output = "";
       $num_iterations = 1;
       $audio = "<audio autoplay=true><source src='../../../assets/sounds/piece-of-cake.mp3'></audio>";
       if($total_records > 0) {

              while($num_iterations++ <= $total_records) {

              $output.= $audio;

                }
           }

          $sounded_query = mysqli_query($conn, "UPDATE messages_group SET sounded='yes' WHERE user_to = '$user_to'");
          exit($output);

?>
