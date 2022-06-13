
  <?php
     if($userloggedin == $username) {
  ?>
        <nav>
          <h4><i class="far fa-images"></i> Photo Album</h4>
          <div class="main mb-3" style="background:#e9ecef">

                <div class="item-gen border"><a class=" text-decoration-none" href="../gallery/addalbum">Create Album</a> </div>

                <div class="item-gen border"><a class=" text-decoration-none" href="../gallery/addgallery">Add Photo to Album </a></div>

                <div class="item-gen border"><a class=" text-decoration-none" href="../gallery/indexGallery">View Album </a></div>


                <div class="item-gen border"><a class=" text-decoration-none" href="../gallery/viewallalbums">Edit Album</a> </div>

                <div class="item-gen border"><a class=" text-decoration-none" href="../gallery/viewsgallery">Edit Photo Gallery </a></div>

          </div>
       </nav>

       <?php }else if($logged_in_user_obj -> isFriend($username)) {?>
               <nav>
                   <div>
                       <?php echo "<a class='btn btn-outline-primary' href='../gallery/".$_GET['profile_username']."'>View Album</a>"; ?>
                       <?php echo '<a class="btn btn-outline-info" href="../messaging/messages?u='.$username.'"><span>Message</span>
                       </a>';?>
                  </div>
               </nav>
      <?php } else  {?>
         <nav>
              <div>
                <?php echo '<a class="btn btn-outline-info mb-2" href="../messaging/messages?u='.$username.'"><span>Message</span></a>';
                ?>
             </div>
        </nav>
    <?php } ?>
