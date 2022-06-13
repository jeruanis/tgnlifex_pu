<?php
	include('../main/base.php');
	include('../main/navbar.php');
	$error_array = array();
?>

<body>

<div class="p-3">
    <h3>View Gallery</h3>
    <?php
			if(isset($_POST['submit'])){
				$ename = $_POST['gname'];
				}
			?>

      <div class="col-lg-6">
          <form action="gslink.php" method="post" enctype="multipart/form-data" name="upload">
              <div class="form-group">
                  <label>Select album to view gallery</label>
                  <?php
								    $sql = "select * from tbl_album where status='process' and user_from='$userloggedin'";
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
        </div>
    </div>
</body>
</html>
