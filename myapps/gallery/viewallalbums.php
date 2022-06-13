<?php
	include('../main/base.php');
	include('../main/navbar.php');
	$error_array = array();
?>

 <body>
	<div class="card-body">
		<h3 class="page-header">Edit Album</h3>
         <div class="table-responsive table-bordered">
       <?php
          if (isset($_GET["page"])) {
				$page = $_GET["page"];
				} else {
					$page=1;
				}

        $start_from = ($page*20)-20;
        $sql = "SELECT * FROM tbl_album WHERE status='process' AND user_from='$userloggedin' ORDER BY albumid DESC LIMIT $start_from, 20";
        $rs_result = mysqli_query ($conn, $sql);
       ?>

      <section>
          <table class="table mb-0">
              <thead>
                 <tr>
                   <th width="20%">Title</th>
                   <th>Description</th>
                   <th>Images ( Click to edit )</th>
                   <th colspan=2 width="18%">Edit</th>
                 </tr>
              </thead>
          <?php
            while ($row = mysqli_fetch_assoc($rs_result)) {
                if(strpos($row["name"], "'")){
								$row["name"] = str_replace("'", "&#39", $row["name"]);
							}
			                if(strpos($row["adesc"], "'")){
								$row["adesc"] = str_replace("'", "&#39", $row["adesc"]);
							}
           ?>

             <tbody>
              <tr>
                 <td> <?php echo $row["name"]; ?></td>
                 <td><?php echo $row["adesc"]; ?></td>
                 <td>
        					 <a href='achangeimage?key0=<?php echo  $row["albumid"];?>'>
        						 <img src="../../../<?php echo $row["image"]; ?>"  width="100px"/>
        					 </a>
				         </td>
                 <td>
        					 <a href='albumdelete?key1=<?php echo $row["albumid"]; ?>&name=<?php echo $row["name"]; ?>'>Delete</a> |
        					 <a href = 'editalbum?key0=<?php echo $row["albumid"]; ?>&key1=<?php echo $row["name"]; ?>&key2=<?php echo $row["adesc"]; ?>&key3=<?php echo $row["image"]; ?> '>Edit Title
        					 </a>
				        </td>
                </tr>
             </tbody>
      <?php };?>
         </table>
    </section>

    <section>
			<div class="card-body">
	      <?php
	        $sql = "SELECT COUNT(name) FROM tbl_album WHERE status = 'process' AND user_from='$userloggedin'";
	        $rs_result = mysqli_query($conn, $sql);
	        $row = mysqli_fetch_row($rs_result);
	        $total_records = $row[0];
	        $total_pages = ceil($total_records / 20);

	        echo "Page: ";
	        for ($i=1; $i<=$total_pages; $i++) {
		        echo "<a class='btn btn-outline-secondary' href='viewallalbums?page=".$i."' class='navigation_item selected_navigation_item'>".$i."</a> ";
	        };
		   ?>
		 </div>
		</section>
</div>
  </div>
</body>
</html>
