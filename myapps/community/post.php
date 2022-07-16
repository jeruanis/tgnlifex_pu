<?php
//turn off error reporting
define('DEBUG', false);
error_reporting(E_ALL);
  if (DEBUG)
  {
    ini_set('display_errors', 'On');
  }
  else
  {
    ini_set('display_errors', 'Off');
  }

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
