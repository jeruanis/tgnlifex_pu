<?php

require_once('../../../configuration/config.php');

if(isset($_POST['userlogin'])){
  $date_now = date("Y-m-d");
  $userlogin = $_POST['userlogin'];
  $query=mysqli_query($conn, "UPDATE exp_monitor SET exp_limit='0', exp_input='0', date_set='$date_now',  acc_amt='0' WHERE user='$userlogin'");

  if($query){
    mysqli_close($conn);
  }
  echo json_encode('Successfully Reset');
}
