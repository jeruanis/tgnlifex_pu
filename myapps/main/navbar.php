<?php
  include('bodyjs.php');
?>
	<script>
		 $(function(){
        messageNotif();
	   })
     window.speechSynthesis.cancel()
 	</script>


	<nav class="navbar navbar-expand-lg navbar-light bg-info py-3">
		<button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M4 15h16v-2H4v2zm0 4h16v-2H4v2zm0-8h16V9H4v2zm0-6v2h16V5H4z"/></svg>
     </button>
		<div class="collapse navbar-collapse" id="navbarNav">

       <ul class="navbar-nav">
       <?php if ($curPageName != 'index.php' ) {  ?>
				<li class="nav-item">
					<a class="nav-link" href="../../index?enjoy-your-listening" title="Radio">
						 <span style="color:#fff"><span id="id_confirm">
						 	<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
						 </span></span>
						 <span class="sr-only"></span>
				   </a>
				</li>
			<?php } ?>

			   <li class="nav-item">
					<a class="nav-link" href="../todo/todo" title="To do task">
							<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff"><rect fill="none" height="24" width="24"/><path d="M22,5.18L10.59,16.6l-4.24-4.24l1.41-1.41l2.83,2.83l10-10L22,5.18z M12,20c-4.41,0-8-3.59-8-8s3.59-8,8-8 c1.57,0,3.04,0.46,4.28,1.25l1.45-1.45C16.1,2.67,14.13,2,12,2C6.48,2,2,6.48,2,12s4.48,10,10,10c1.73,0,3.36-0.44,4.78-1.22 l-1.5-1.5C14.28,19.74,13.17,20,12,20z M19,15h-3v2h3v3h2v-3h3v-2h-3v-3h-2V15z"/></svg>
						 <span class="sr-only"></span>
					 </a>
				</li>

         <li class="nav-item">
           <a class="nav-link" href="../community/community" title="Posts">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M21 3H3c-1.11 0-2 .89-2 2v14c0 1.11.89 2 2 2h18c1.11 0 2-.89 2-2V5c0-1.11-.89-2-2-2zm0 16.02H3V4.98h18v14.04zM10 12H8l4-4 4 4h-2v4h-4v-4z"/></svg>
             <span class="sr-only"></span>
           </a>
        </li>

				<li class="nav-item">
					<a class="nav-link" href="javascript:void(0);" onClick="getDropdownData('<?php echo $userloggedin; ?>', 'message')" title="Message">
						<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff"><path d="M0 0h24v24H0z" fill="none"/><path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 9h12v2H6V9zm8 5H6v-2h8v2zm4-6H6V6h12v2z"/></svg>
						<?php
	              if ($num_messages) {
	                  echo '<sup class="notification_badge" id="unread_message">'.$num_messages.'</sup>';
	                }
	             ?>
					</a>
				  </li>

				  <li class="nav-item">
						<a  class="nav-link" href="javascript:void(0);" onClick="getDropdownData('<?php echo $userloggedin; ?>', 'notifications')">

							<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff"><path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/></svg>

							<?php if ($num_notifications) {
	    						echo '<sup class="notification_badge" id="unread_notifications">'.$num_notifications.'</sup>';
								}
							?>
						 </a>
				</li>

        <li class="nav-item">
         <a class="nav-link"  href="../main/request" title="Friend request">

            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff"><g><rect fill="none" height="24" width="24"/><rect fill="none" height="24" width="24"/></g><g><g><polygon points="22,9 22,7 20,7 20,9 18,9 18,11 20,11 20,13 22,13 22,11 24,11 24,9"/><path d="M8,12c2.21,0,4-1.79,4-4s-1.79-4-4-4S4,5.79,4,8S5.79,12,8,12z"/><path d="M8,13c-2.67,0-8,1.34-8,4v3h16v-3C16,14.34,10.67,13,8,13z"/><path d="M12.51,4.05C13.43,5.11,14,6.49,14,8s-0.57,2.89-1.49,3.95C14.47,11.7,16,10.04,16,8S14.47,4.3,12.51,4.05z"/><path d="M16.53,13.83C17.42,14.66,18,15.7,18,17v3h2v-3C20,15.55,18.41,14.49,16.53,13.83z"/></g></g></svg>

            <?php if ($num_requests) {
              echo '<sup class="notification_badge" id="unread_requests">'.$num_requests.'</sup>';
             } ?>
         </a>
        </li>

				<li class="nav-item dropdown">
				   <a class="nav-link text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="more">

				   	<?php if($curPageName == 'inventory_create_form.php' || $curPageName == 'house_needs_inventory_edit.php' || $curPageName == 'house_needs_inventory.php' || $curPageName == 'add_member_inv.php' || $curPageName == 'delete_member_inv.php'){ }else{?>

    					<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff"><path d="M0 0h24v24H0z" fill="none"/><path d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"/></svg>


    				 <?php } ?>

 					 </a>
           <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="width:300px;max-height:400px;overflow:auto;">
           <?php
            if ($curPageName != 'inventory_create_form.php' )
               echo'<a id="ci" class="dropdown-item" href="../inventory/inventory_create_form">Create inventory</a>';
               echo '<hr>';
               include( "../utilities/inventory_name_loader.php");
               echo '<hr>';

               if($userloggedin == 'support-service' || $userloggedin =='pinky-a1'){
               if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
                  $url=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                     if (strpos($url, '/group_messaging/') == false)
                         echo'<a class="dropdown-item" href="../group_messaging/group_create_form">Create new chat group</a>';
                     echo '<hr>';
                  include( "../utilities/group_name_loader.php");
               }else{
                 $url=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                  if (strpos($url, '/group_messaging/') == false)
                      echo'<a class="dropdown-item" href="../group_messaging/group_create_form">Create new chat group</a>';
                  echo '<hr>';
                   include( "../utilities/group_name_loader.php");
                }
               } ?>

          </div>
				 </li>

         <?php
           if($curPageName == 'messages_group.php') {
             if($userloggedin == 'support-service' || $userloggedin =='pinky-a1') {?>
             <li>
               <form action="../utilities/search" method="GET" name="search_form" class="form-inline my-2 my-lg-0 form-control" >
                  <span class="se-ico"></span>
                  <input class="no-outline border-0 mr-sm-2" type="text" onkeyup="getLiveSearchUsersGroup(this.value,'<?php echo $userloggedin; ?>','<?php echo $group_to; ?>')" name="q" placeholder="Add friend to the group" autocomplete="off" id="search_text_input">
                  <input type="hidden" name="group" value="<?php echo $group_to; ?>">
                </form>
                <div class="search_results gp_searchResult" style="z-index:3;"></div>
              </li>
           <?php }} ?>

           <?php
             if($curPageName == 'profile.php') { ?>
               <li>
                 <form action="../utilities/search" method="GET" name="search_form" class="form-inline my-2 my-lg-0 form-control" >
                    <span class="se-ico"></span>
                    <input class="no-outline border-0 mr-sm-2" type="text" onkeyup="getLiveSearchUsers(this.value,'<?php echo $userloggedin; ?>')" name="q" placeholder="Search username" id="search_text_input">
                    <input type="hidden">
                  </form>
                  <div class="search_results gp_searchResult" style="z-index:3;"></div>
                </li>
             <?php }else { ?>
               <li>
                 <form action="../utilities/search_content" method="GET" name="search_form" class="form-inline my-2 my-lg-0 form-control" >
                    <span class="se-ico"></span>
                    <input class="no-outline border-0 mr-sm-2" type="text" onkeyup="getLiveSearchContent(this.value)" name="q" placeholder="Search " id="search_text_input">
                    <input type="hidden">
                  </form>
                  <div class="search_results gp_searchResult" style="z-index:3;"></div>
                </li>
            <?php } ?>


         <!-- for gallery -->
        <?php   $url=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
          if (strpos($url, '/gallery/') == true) { ?>
           <li class="nav-item">
             <a class="nav-link text-white" href="indexGallery">Albums</a>
           </li>
           <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              album
             </a>
             <div class="dropdown-menu" aria-labelledby="navbarDropdown">
               <a class="dropdown-item" href="../gallery/addalbum">Create New Album</a>
               <a class="dropdown-item" href="../gallery/viewallalbums">Edit Album</a>
               <div class="dropdown-divider"></div>
               <a class="dropdown-item" href="#"></a>
             </div>
           </li>
            <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               gallery
             </a>
             <div class="dropdown-menu" aria-labelledby="navbarDropdown">
               <a class="dropdown-item" href="../gallery/addgallery">Add Photo to Album</a>
               <a class="dropdown-item" href="../gallery/viewsgallery">Edit Photo Gallery</a>
               <div class="dropdown-divider"></div>
               <a class="dropdown-item" href="#"></a>
             </div>
           </li>
           <!-- <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Image Quality
               </a>
               <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                 <form class="" action="" method="post">
                   <input type="text" class="dropdown-item" name="" value="HD">
                   <input type="text" class="dropdown-item" name="" value="Super HD">
                 </form>

               </div>
           </li> -->
         <?php } ?>

				 <li id="f-screen" class="nav-item">
					<span class="nav-link">
						 <span id="full-screen" style="color:#fff" title="Fit to page">[ ]</span>
						 <span class="sr-only"></span>
					 </a>
        </li>
				<li class="nav-item">
					<span class="nav-link">
						 <span id="normal-screen" style="color:#fff" title="normal screen">][</span>
						 <span class="sr-only"></span>
					 </a>
        </li>

				 <?php
           if (isset($_SESSION['username'])){
             $userloggedin = $_SESSION['username'];
             echo '<li class="nav-link"> <div class="logout-in">';
             echo '<a class="ui image label" href="../profile/' . $userloggedin . '">
                      <img src="../../../' . $profile_pic. '" alt="profile image">
                      '.$userloggedin.'
                    </a>';
             echo '<hr>';
             echo '<a href="../userlogin/logoutbridge" title="logout">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="red"><path d="M0 0h24v24H0z" fill="none"/><path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/></svg>
             </a> </div></li>';
          }else{
             echo '<li class="nav-link"> <div class="reg-in text-decoration-none"> <a href="../userlogin/registration_signup_page">Welcome Guest! Register | Login</a> </div></li>
             </ul>';
          }

          if (isset($_SESSION['username'])){
             $userloggedin = $_SESSION['username'];
             echo '</div><div class="logout-out" style="position:absolute;top:21px;">';
             echo '<a class="ui image label" href="../profile/' . $userloggedin . '">
                      <img src="../../../' . $profile_pic. '" alt="profile image">
                      '.$userloggedin.'
                    </a>';
             echo '<a href="../userlogin/logoutbridge" title="logout">
               <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="red"><path d="M0 0h24v24H0z" fill="none"/><path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/></svg>
             </a> </div>';
          }else{
             echo '</div><div class="reg-out text-decoration-none"> <a href="myapps/userlogin/registration_signup_page">Welcome Guest! Register | Login</a> </div>';
          }
				 ?>

	</nav>
	<div class="dropdown_data_window" style="height:0px"></div>
	<input type="hidden" id="dropdown_data_type" value="">
	<!-- <div class="search_results gp_searchResult" style="z-index:3;"></div> -->

   <div class="container px-0">
