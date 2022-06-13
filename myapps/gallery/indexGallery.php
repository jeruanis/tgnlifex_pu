<?php
  include('../main/base.php');
	include('../main/navbar.php');
	$error_array = array();
?>

<div class="container">
  <div class="card-body">
  <section>
    <div class="card card-body">
      <?php
			// pagination 1st part begin
      if (isset($_GET["page"])) { $page = $_GET["page"]; } else { $page=1; };
	      $start_from = ($page*4)-4;
	      $sql = "SELECT * FROM tbl_album where status='process' and user_from='$userloggedin' ORDER BY albumid DESC LIMIT $start_from, 4";
	      $rs_result = mysqli_query($conn, $sql);

	      echo "<div class='main'>";

      while ($row = mysqli_fetch_assoc($rs_result)) {
          $aimage=$row['image'];
          $aid=$row['albumid'];
          $aname=$row['name'];
          $astatus=$row['status'];
      ?>

        <div class='item-album m-1'>
				<div class="">
					<div class="pt-2">
          	<?php echo "<a href='gallery?id=$aid' class='text-decoration-none'>
               <div><img id='album_image' class='d-block mx-auto' height='100' style='max-width:200px' src='../../../$aimage' alt='$aname'></div>
               <span class='d-block mt-2 text-center mx-2'>".ucfirst($aname)."</span>
						</a>";
				    	?>
			 </div>
			</div>
		  </div>
        <?php
			   } ?>
     </div>
     </div>
    </section>
	  <section>
    <?php
       $sql = "SELECT COUNT(name) FROM tbl_album WHERE status = 'process' AND user_from='$userloggedin'";
       $rs_result = mysqli_query($conn, $sql);
       $row = mysqli_fetch_row($rs_result);
       $total_records = $row[0];
       $total_pages = ceil($total_records / 4);
           if($total_records > 0) { ?>
              <nav class="mt-4" aria-label="Page navigation sample">
               <ul class="pagination"><li class="page-item disabled"><a class="page-link" href="">Page</a></li>
                 <?php for ($i=1; $i<=$total_pages; $i++) { ?>
                    <li class="page-item"><a class="page-link" href="indexGallery?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                  <?php } ?>
               </ul>
              </nav>

         <?php  } else {
               echo "*** No Album Found ***";
           }
        ?>
    </section>
  </div>
</div>
