<?php
    include("../../../configuration/config.php");
    if(isset($_POST['userloggedin'])){
        $user_to = $_POST['userloggedin'];}
        $viewd_queryCount = mysqli_query($conn, "SELECT count(*) FROM messages WHERE viewed = 'no' AND sounded='no' AND user_to='$user_to'");
        $rowViewedcount=mysqli_fetch_row($viewd_queryCount);
        $total_records =  $rowViewedcount[0];

       $count=1;
       $audio="";
       $output = "";
       $num_iterations = 1;
       $audio = "<audio autoplay=true><source src='../../../assets/sounds/piece-of-cake.mp3'></audio>";
       $text = "he<br>";
       if($total_records > 0) {

              while($num_iterations++ <= $total_records) {

              $output.= $audio;

                }
           }

         $gap=5;
         $tm=date ("Y-m-d H:i:s", mktime (date("H"),date("i")-$gap,date("s"),date("m"),date("d"),date("Y")));
         $ut=mysqli_query($conn, "UPDATE users SET status='OFF' where tm < '$tm'");

          $sounded_query = mysqli_query($conn, "UPDATE messages SET sounded='yes' WHERE user_to = '$user_to'");
          exit($output);

?>
