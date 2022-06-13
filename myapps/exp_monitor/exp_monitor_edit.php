<?php
include("../main/base.php");
include("../main/navbar.php");

if(isset($_GET['in'])){
  $exp_input = $_GET['in'];
}else{
  $exp_input = 0;
}

$query_date = mysqli_query($conn, "SELECT date_set, acc_amt FROM exp_monitor WHERE user='$userloggedin'");
if($row=mysqli_num_rows($query_date) > 0){
  $result = mysqli_fetch_array($query_date);
  $date_set = $result['date_set'];
  $acc_amt = $result['acc_amt'];
  $acc_amt += $exp_input;
}else{
  $date_set = date("Y-m-d");
  $acc_amt = $exp_input;
}

if(isset($_POST['submit'])){
  if(!empty($_POST['expense_limit'])){
    $exp_limit = $_POST['expense_limit'];
    $exp_limit = htmlspecialchars(strip_tags($exp_limit));
    $exp_limit = mysqli_real_escape_string($conn, $exp_limit);
    $userloggedin = mysqli_real_escape_string($conn, $userloggedin);
    $date_set = mysqli_real_escape_string($conn, $date_set);

    if($row=mysqli_num_rows($query_date) > 0) {
       $query = mysqli_query($conn, "UPDATE exp_monitor SET exp_limit='$exp_limit', exp_input='$exp_input', acc_amt='$acc_amt' WHERE user='$userloggedin'");
    }else{
       $query = mysqli_query($conn, "INSERT INTO exp_monitor VALUES('', '$userloggedin', '$exp_limit', '$exp_input', '$date_set', '$acc_amt')");
    }

    if($query)
      header("Location: exp_monitor");
  }
}
?>

<div class="container">
      <div class="p-2 mb-2 text-success main" style="background:#F2DDC1">
       <h5 class="item-gen">Expense Monitoring setup edit page</h5><a class="text-decoration-none" href="exp_monitor"><h5 class="text-info item-gen">Expense monitor home

       <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#555555"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg></h5></a>
      </div>

    <form class="" action="" method="POST">
      <div class="p-2 py-3 mb-2 form-group" style="background:#97BFB4">
        <h6 class="d-inline-block text-white">Limit of Expense per day</h6>
        <input type="text" name="expense_limit" placeholder="Input limit" class="ml-2 border rounded">
      </div>

      <div class="p-2 py-3 mb-2 form-group">
        <input type="submit" name="submit" Value="Submit" class="ml-2 border rounded float-right btn-info">
      </div>
    </form>

</div>
</body>
</html>
