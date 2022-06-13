<?php
include('../main/base.php');
include('../main/navbar.php');
$error_array = array();
?>

<body>
<div class="p-3">
    <h3>Add Gallery</h3>
    <?php
       if(isset($_POST['submit'])){
          $ename = $_POST['gname'];
        }
    ?>
      <div class="col-lg-6">
        <form action="glinkPost.php" method="post" enctype="multipart/form-data" name="upload"> 
            <div class="form-group">
              <label>Select Album</label>
              <?php
                $sql = "SELECT * FROM tbl_album WHERE status='process' AND user_from = '$userloggedin' ORDER BY albumid DESC";
                $rs_result = mysqli_query ($conn, $sql);
                echo "<select class='form-control' name='gname'>";
                while ($row = mysqli_fetch_assoc($rs_result)) {
                   echo "<option value=$row[albumid]>$row[name]</option>";
                  };
                  echo "</select>";
               ?>
               </div><br>
                 <button type="submit" class="btn btn-primary" name="submit">Next</button>
            </form>
        </div>
      </div>

</body>
</html>

