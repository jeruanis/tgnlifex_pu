<?php
   include('../main/base.php');
?>
   <style>
       a{color:revert;}
       font-size:18px;
   </style>

	<?php

    include('../main/navbar.php');

		if(isset($_GET['id'])) {
		  $id = $_GET['id'];
		 }else {
		   $id = 0;
		 }

	  	$loggedNamepost = str_replace('_', ' ', $user['first_name']);
	  	$username = ucwords(str_replace('_', ' ', $user['username']));
	?>
      <div class="container">
	     <?php
	        $post = new Post ($conn, $userloggedin);
	        $post->getSinglePost($id)
	      ?>

       </div>

    </body>
    </html>
