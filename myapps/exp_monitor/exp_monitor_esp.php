<?php
include("../main/base.php");
include("../main/navbar.php");

$date_now = date("Y-m-d");
$expense_counter = '';
$days_counter = '';

if($userloggedin == 'support-service' || $userloggedin == 'pinky-a1' || $userloggedin == 'honeylyn-l1'){

  $query_exp = mysqli_query($conn, "SELECT user, exp_limit, date_set, exp_input, acc_amt FROM exp_monitor WHERE (user='support-service' || user='pinky-a1' || user='honeylyn-l1')");

  if($row=mysqli_num_rows($query_exp) > 0){
    $row_exp = mysqli_fetch_array($query_exp);
    $exp_limit = $row_exp['exp_limit'];
    $date_set = $row_exp['date_set'];
    $acc_amt = $row_exp['acc_amt'];
    $user_exp = $row_exp['user'];
    $exp_input = $row_exp['exp_input'];
    $d1= new DateTime($date_set);
    $d2= new DateTime($date_now);
    $interval=$d1->diff($d2);
    $diff_days=$interval->d;
    $days_counter = $diff_days;

    if($exp_limit > 0 ){
        if($days_counter > 1 ){
          $expense_counter = $days_counter * $exp_limit - $acc_amt;
          if($expense_counter == 0){
            $exp_status = 'Good, you are maintaining the limit.';
          }else if($expense_counter > 0){
            $exp_status = 'You are good, you have saved '.$expense_counter.' PHP';
          }else{
            $exp_status = 'You are overspending by an amount '.abs($expense_counter).' PHP';
          }
        }else{
          $exp_status = 'Check in few days.';
        }
    }else{
       $exp_status = 'No data';
      }

  }else{
    $exp_limit = 'not set';
    $date_set = 'not set';
    $acc_amt = 0;
    $exp_status = 'no data';
  }

  if($days_counter>1){
    $days_counter = $days_counter;
  }else{
    $days_counter=0;
  }

  if(isset($_POST['submit'])){
    if(!empty($_POST['expense'])){
      $expense = $_POST['expense'];
      $acc_amt+= $expense;
      if($exp_limit > 1){
          if($row=mysqli_num_rows($query_exp) > 0) {
            $expense = mysqli_real_escape_string($conn, $expense);
            $acc_amt = mysqli_real_escape_string($conn, $acc_amt);
            $query_input = mysqli_query($conn, "UPDATE exp_monitor SET exp_input='$expense', acc_amt='$acc_amt', user='$userloggedin' WHERE (user='support-service' || user='pinky-a1' || user='honeylyn-l1')");
            if($query_input){
              mysqli_close($conn);
              header("Location: exp_monitor_esp");
            }
          }else{
            header("Location: exp_monitor_edit_esp?in=$expense");
          }
       }else{
         header("Location: exp_monitor_edit_esp?in=$expense");
       }
    }
  }
}else{
  header("Location: ../../index");
}
?>

<div class="container">

      <div class="p-2 mb-2 text-success main" style="background:#F2DDC1">
        <h5 class="item-gen">Monthly Expense Monitoring <small class="d-block"><em class="text-danger">*Enter the expenses everytime you buy to monitor when are you exceeding the budget*</em></small></h5>

        <div class="item-gen d-flex justify-content-end flex-column">

          <a class="text-decoration-none" href="exp_monitor_edit_esp"><h5 class="text-info float-right">Set limit
          <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#555555"><g><path d="M0,0h24v24H0V0z" fill="none"/><path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.8,11.69,4.8,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/></g></svg> </h5></a>

          <h5 id="reset" class="text-info ml-auto" style="cursor:pointer">Reset
          <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#555555"><g><path d="M0,0h24v24H0V0z" fill="none"/></g><g><g><path d="M12,5V2L8,6l4,4V7c3.31,0,6,2.69,6,6c0,2.97-2.17,5.43-5,5.91v2.02c3.95-0.49,7-3.85,7-7.93C20,8.58,16.42,5,12,5z"/><path d="M6,13c0-1.65,0.67-3.15,1.76-4.24L6.34,7.34C4.9,8.79,4,10.79,4,13c0,4.08,3.05,7.44,7,7.93v-2.02 C8.17,18.43,6,15.97,6,13z"/></g></g></svg></h5>

        </div>
      </div>

     <div id="detail" class="text-center border py-2 btn-info" style="cursor:pointer">show detail</div>
     <div id="detail-cont" class="row pb-3 px-3">
         <div class="col-md-6 mt-2">
             <span style="font-size:21px">Date Started: </span>
             <span class="text-success ml-2"><?php echo $date_set; ?></span>
         </div>
         <div class="col-md-6 mt-2">
             <span style="font-size:21px">Expense per day limit:</span>
             <span class="text-success ml-2"><?php echo $exp_limit.' PHP'; ?></span>
         </div>
         <div class="col-md-6 mt-2">
             <span style="font-size:21px">Number of Days:</span>
             <span class="text-success ml-2"><?php echo $days_counter; ?></span>
         </div>
         <div class="col-md-6 mt-2">
             <span style="font-size:21px">Expenses Total:</span>
             <span class="text-success ml-2"><?php echo $acc_amt.' PHP'; ?></span>
         </div>
         <div class="col-md-6 mt-2">
             <span style="font-size:21px">Latest Input by:</span>
             <span class="text-success ml-2"><?php echo $user_exp; ?></span>
         </div>
         <div class="col-md-6 mt-2">
             <span style="font-size:21px">Latest Input Amount:</span>
             <span class="text-success ml-2"><?php echo $exp_input; ?></span>
         </div>
     </div>

     <form class="" action="" method="POST">
       <div class="p-2 py-3 mb-2 form-group" style="background:#FFAFAF">
         <h6 class="d-inline-block text-white">Expense Input</h6>
         <input type="text" name="expense" placeholder="Input expense" class="ml-2 border rounded">
         <div class="py-2 d-flex justify-content-end">
            <input type="submit" name="submit" Value="Enter" class="ml-2 px-3 border rounded btn-info d-inline-block">
         </div>
       </div>
     </form>
      <div class="p-2 py-3 mb-2" style="background:#519259">
        <h6 class="float-left text-light pr-2">EXPENDITURE STATUS: </h6>
        <p class="col-md-6 text-light">
         <?php echo $exp_status; ?>
        </p>
      </div>

</div>
<script type="text/javascript">
$(function(){
  var userlogin = "<?php echo $userloggedin; ?>";
 $('#reset').on('click', function(){
  $.ajax({
    type:'POST',
    url: '../../includes/form_handlers/reset_exp_monitoring_esp.php',
    data:{'userlogin':userlogin},
    cache:false,
    "success":function(data, textStatus){
      alert(data);
      window.location.href='exp_monitor_esp';
    }
  });
});

 $('#detail-cont').hide();
 $('#detail').on('click', function(){
   $('#detail-cont').slideToggle();
 });
});
</script>


</body>
</html>
