<?php
  include('../main/base.php');
	include('../main/navbar.php');
	$error_array = array();
	$aid=$_REQUEST['id'];
?>
<div class="">
    <?php
      $sql = "SELECT name, adesc FROM tbl_album where albumid='$aid'";
      $rs_result = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_assoc($rs_result)){
        $aname=$row['name'];
        $adesc=$row['adesc'];
        echo '<h2 class="pl-2">'.ucwords($aname).'</h2>';
        echo "<p class='pl-2'>".ucfirst($adesc)."</p>";
	    }?>

	   <div class="one-whole text-justify">
	     <?php
	        $sql = "SELECT * FROM tbl_gallery where aid=$aid AND status='process' AND user_from='$userloggedin'";
	        if($num_rows = mysqli_num_rows(mysqli_query($conn, $sql)) > 0){
	          $result = mysqli_query($conn, $sql);
            echo'<div class="main_gallery border mx-1">';
    	        while($row = mysqli_fetch_array($result)){
    	            $gimage=$row['gimages'];
                  $base_name = basename($gimage);
                  $imageFileType = pathinfo($base_name, PATHINFO_EXTENSION);
                  if(strtolower($imageFileType) == 'gif'){
                      $gc = str_replace('gupload', 'gcatch', $gimage);
                      $gc = str_replace('.gif', '.mp4', $gc);
                  }else{
                    $gc = str_replace('gupload', 'gcatch', $gimage);
                  }
    	            echo "<div class='item-gallery'><a href='../../../$gc' target='_self' data-fancybox='gallery'>
    	                    <img style='max-width: 153px;max-height: 153px;padding: 3px 6px;border-raius: 10%;border-radius: 10%;' src='../../../$gimage' alt='video' class='imgs inline-block' />
    									 </a></div>";
    	         }

           }else{

            $images_query = mysqli_query($conn, "SELECT * FROM posts WHERE aid='$aid' AND added_by='$userloggedin' AND status='process'");

            if ($result = mysqli_num_rows($images_query) > 0) {
               echo'<div class="main_gallery border mx-1">';
              while($row = mysqli_fetch_array($images_query)){
                  $gimage=substr($row['image'], 11);
                  echo "<div class='item-gallery'><a href='../../../$gimage' target='_self' data-fancybox='gallery'>
                          <img style='max-width: 153px;max-height: 153px;padding: 3px 6px;border-raius: 10%;border-radius: 10%;' src='../../../$gimage' alt='video' class='imgs inline-block' />
                       </a></div>";
                  }
               }else{
               echo 'No image to show';
             }
           }

        ?>
      </div>
	  </div>

</body>
</html>
