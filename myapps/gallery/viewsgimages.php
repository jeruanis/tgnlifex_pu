<?php
	include('../main/base.php');
	include('../main/navbar.php');
	$error_array = array();
?>

<body>
  <?php
				$asid=$_REQUEST['ids'];
        $sqlAlName = mysqli_query($conn, "SELECT gname, gid FROM tbl_gallery WHERE status='process' AND aid='$asid' AND user_from='$userloggedin'");
        if(mysqli_num_rows($sqlAlName) > 0){
            $rowResult = mysqli_fetch_array($sqlAlName);
            $AlbumName = $rowResult['gname'];
    ?>
 		  <div class="card-body">
    		<div id="page-wrapper">
      <h3 class="page-header text-center"><?php echo ucwords($AlbumName); ?></h3>
			<h5 class="page-header text-center">Image Gallery</h5>
           <div class="table-responsive table-bordered">
            <?php
                if (isset($_GET["page"])) { $page = $_GET["page"]; } else { $page=1; };
                $start_from = ($page*4)-4;
                $sql = "SELECT * FROM tbl_gallery WHERE status='process' AND aid='$asid' AND user_from='$userloggedin' ORDER BY gid ASC LIMIT $start_from, 4";
                $rs_result = mysqli_query ($conn, $sql);
            ?>
            <table class="table">
            <thead>
                <tr>
                <th>Images</th>
                <th colspan=2 width="18%">Action</th>
                </tr>
            </thead>
            <?php
            while ($row = mysqli_fetch_assoc($rs_result)) {
							$gid = $row['gid'];
            ?>
                <tbody>
                <tr id="image_row<?php echo $gid; ?>">
	                <td><img src="../../../<?php echo $row["gimages"]; ?>"  width="100px"/></td>
	                <td>
										<div id="delete_img<?php echo $gid; ?>" style="cursor:pointer">Delete</div>
										<script>
										 $(document).ready(function(){
											  $('#delete_img<?php echo $gid; ?>').on('click', function(){
													var key1 = '<?php echo $row["gid"]; ?>';
													var key2 = '<?php echo $row["gname"]; ?>';
													var key3 = '<?php echo $row["gimages"]; ?>';
													$.ajax({
														url:"gallerydelete.php",
														method:"POST",
														data:{'key1':key1, 'key2':key2, 'key3':key3},
														dataType:'json',
														cache:false,
														"success": function(data){
															console.log(data);
	                            $('#image_row<?php echo $gid; ?>').fadeOut();
														}
													});
												});
										 });
										</script>
									</td>
                </tr>
              </tbody>
            <?php
            };
            ?>
            </table>
						<?php
					    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
              $sql = "SELECT COUNT(aid) FROM tbl_gallery where aid='$asid' AND status='process'";
              $rs_result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_row($rs_result);
              $total_records = $row[0];
              $total_pages = ceil($total_records/4); ?>
							<nav class="mt-4" aria-label="Page navigation sample">
							 <ul class="pagination"><li class="page-item disabled mt-1 "><a class="page-link" href="#">Pages</a></li>
                <?php  for ($i=1; $i<=$total_pages; $i++) {
									if (strpos($url,'page='.$i) == true){$cl = 'active';}else{$cl='';}
									echo"<li class='page-item $cl m-1'><a class='page-link' href='viewsgimages.php?page=$i&ids=$asid'>$i</a></li>";
							}  ?>
						 </ul>
					 </nav>
         </div>
  </div>
<?php }else{ } ?>
	</div>
</body>
</html>
