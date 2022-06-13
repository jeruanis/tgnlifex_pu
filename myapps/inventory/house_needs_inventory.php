<?php
include('../main/base.php');
include('../main/navbar.php');

$inventory_obj=new Inventory($conn, $userloggedin);
if( isset($_GET['inventory']))
$inventory_to=$_GET['inventory'];

if(isset($_GET['invnotid']))
   $invnotid=$_GET['invnotid'];

if(isset($_GET['invnotid']))
    $invnotid= $_GET['invnotid'];

if(!empty($invnotid)){
    $set_viewed_query = mysqli_query($conn, "UPDATE notifications SET viewed='yes', opened='yes' WHERE (user_to='$userloggedin' AND id='$invnotid')");
  }


$inventory=$inventory_obj->getInventory($inventory_to);
$inv_query=mysqli_query($conn, "SELECT inv_array FROM users WHERE username='$userloggedin'");
$user_array=mysqli_fetch_array($inv_query);

$num_inv=(substr_count($user_array['inv_array'], ","))-1;

$invList=$user_array['inv_array'];

$invList2=explode("," ,$invList);
if(array_search($inventory_to, $invList2, true)==false){
  header("Location: ../../index");
}
?>

  <div class="container">
    <div class="main">
      <div class="item-inv">
        <a class="btn btn-sm btn-info" href="house_needs_inventory_edit?invname=<?php echo $inventory_to; ?>">Edit values</a>
      </div>

      <?php
          $inv_creator_query=mysqli_query($conn, "SELECT creator FROM inventory_des WHERE inventory_name='$inventory_to '");
          if($inv_creator_query)
            $row=mysqli_fetch_assoc($inv_creator_query);

          mysqli_close($conn);
          $crtor=$row['creator'];

          if($userloggedin==$crtor){
            echo '<div class="item-inv"><a class="btn btn-sm btn-info" href="add_member_inv?add=member&inventory='.$inventory_to.'">Add Member</a></div>';
            echo '<div class="item-inv"><a class="btn btn-sm btn-danger" href="delete_member_inv?delete=member&inventory='.$inventory_to.'">Delete Member</a></div>';
           }
       ?>
    </div>

    <div class="">
      <?php echo $inventory; ?>
    </div>

  </div>
  <?php include('../main/footer.php'); ?>
  </body>
  </html>
