<?php

  include('../main/base.php');
  include('../main/navbar.php');
  $inventory_to=$_REQUEST['inventory'];
 ?>

<center><div class="container">
	<div class="col-sm">
		<div class="card card-body">
			<h2>Members Lists</h2>
			<br>
			<?php
			  $inv_member_query=mysqli_query($conn, "SELECT member_array FROM inventory_des WHERE inventory_name='$inventory_to'");
			  $user_array=mysqli_fetch_assoc($inv_member_query);
			  $num_inv_member=(substr_count($user_array['member_array'], ","))-1;
			  $invMemList=$user_array['member_array'];
			  $invMemList2=explode("," ,$invMemList);
			  if($num_inv_member >=1){
			  	for($i=1; $i<=$num_inv_member; $i++){
			  		$invList3a=ucwords(str_replace('_',' ', $invMemList2[$i]));
			  		$invList5="<div class='mehdiv_b".$invMemList2[$i]."' style='height:36px;'>
				  		<div>
				  			<a href='#' style='color:#565052;'>&#127744;&nbsp;&nbsp;$invList3a &nbsp;</a>
				  		</div>
				  		<span style='float:right' class='meb".$invMemList2[$i]."' class='we1'>
				  			<img style='height: 15px; margin-top: -54px; cursor: pointer; position: relative; right: 6px; padding: 13px;box-sizing: content-box;' src='../../../assets/images/background/group_opPNG.PNG'/>
				  		</span>
			  		</div>
			  		<hr>"; 
			  		echo $invList5;
			        ?>

					 <script>
					 	$(document).ready(function(){
					 		var urloc='index';
					 		var mem_name='<?php echo $invMemList2[$i].','; ?>';
					 		var mem_nameP='<?php echo $invMemList2[$i]; ?>';
					 		var userloggedin='<?php echo $userloggedin; ?>';
					 		var inv_name='<?php echo $inventory_to; ?>';
					 		$('.meb<?php echo $invMemList2[$i]; ?>').on('click', function(){
					 			bootbox.confirm("Delete <?php echo $invMemList2[$i]; ?> from members list?", function(result){
					 				 if(result){
					 				 	$.ajax({
					 				 		url: "delete_member_handler.php",
					 				 		method: "POST",
					 				 		data:{"mem_nameP": mem_nameP, "mem_name" : mem_name, "userloggedin" : userloggedin, "inv_name" : inv_name, "result":result
					 				 	       },
					 				 	    cache:false,
					 				 	    "success": function(data){
					 				 	    	console.log(data);
					 				 	    	$('.mehdiv_b<?php echo $invMemList2[$i]; ?>').fadeOut();
					 				 	     }
					 				 	 });
					 				  }
					 			   }) //boobox function
					 		   });
					 	    });
					   </script>
			 	    <?php }

			    }else{
			    	echo 'There are no members yet for '.$inventory_to;
			      } ?>
		  </div></div></div><br><br>
		  <div>
		  	<!-- <small>Advertisement</small> -->
		  </div>
		</center></body></html>
