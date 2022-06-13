<?php  include("../main/base.php");
    $error_array = array();
    $gpname="";
    if(isset($_POST['submit'])) {
      if(!$_POST["groupName"]) {
          header("Location: ../../index");
          exit();
        }else {
           $gpname = $_POST["groupName"];
           if (!preg_match("/^[a-zA-Z0-9 ]*$/",($_POST["groupName"]))){
               array_push($error_array, "Only letters, numbers and white space allowed for group name..<br>");
           }else{
               $gpnamePost = ucwords($gpname);
               $gpname = str_replace(' ', '_', $gpname);

                    $gpname_query=mysqli_query($conn,  "SELECT group_name FROM messages_group WHERE group_name='$gpname'");
                    $i=0;
                         while(mysqli_num_rows($gpname_query) !=0 ) {
                            $i++;
                            $gpname = $gpname.$i;
                            $gpname_query = mysqli_query($conn, "SELECT group_name FROM messages_group WHERE group_name = '$gpname'");
                           }

                    $gpname = htmlspecialchars(strip_tags($gpname));
                    $gpname = mysqli_real_escape_string($conn, $gpname);

                    $gpnamePost = ucwords($gpname);
                    $inTextBody = "Welcome to ".$gpnamePost;
                    $inTextBody = htmlspecialchars($inTextBody);
                    $date = date("Y-m-d H:i:s");
                    $gpname = str_replace(' ', '_', $gpname);
                        $group_create_query = mysqli_query($conn, "INSERT INTO messages_group VALUES ('', '$userloggedin', '$userloggedin', '$inTextBody', '$date', 'no', 'no', 'no', '', '', '$gpname', '$userloggedin', 'no', 'no', '', '', '', '', '', '')");
                        $add_group = mysqli_query($conn, "UPDATE users SET group_array=CONCAT(group_array, '$gpname,') WHERE username= '$userloggedin'");
                        header("Location: ../todo/todo");
                    mysqli_close();
              }
            }
          }

    include('../main/navbar.php');
 ?>
       <div class="container" style="min-height:72vh">
        <div class="row">
         <div class="col-sm">
            <div class="card card-body">
              <?php
                 if(in_array("This group title is already existing<br>", $error_array))
                 echo "<div style='color:#e5e5e5;padding: 6px;background: #bc4558;text-align: center;font-size: 21px;margin: 0 auto;';>This group title is already existing<br></div>";
                 elseif(in_array("Only letters, numbers and white space allowed for group name..<br>", $error_array))
                 echo " <div style='color:#e5e5e5;padding: 6px;background: #bc4558;text-align: center;font-size: 21px;margin: 0 auto;';>Only letters, numbers and white space allowed for group name..<br>
                 </div>";
               ?>

                    <form action="" method="POST" class="form-group">
                      <div class="d-flex flex-row chat-message-input-container py-5" style="max-width:600px">
                       <input type="text" name="groupName" placeholder="Create group name"  class="form-control">
                       <div class="input-group-append">
                         <input type="submit" name="submit" class="btn btn-sm btn-info" placeholder="Create">
                      </div>
                    </div>
                    </form>

                  </div>
              </div>
           </div>
         </div>

</body>
<?php
  include('../main/footer.php');
?>
</html>
