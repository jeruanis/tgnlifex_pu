<?php
	include('../main/base.php');
	include('../main/navbar.php');
	$error_array = array();
  include("../profile/profileDummy.php");
  $aid=$_REQUEST['id'];
 ?>

<body>
	<div class="">
		<?php
      $sql = "SELECT name, adesc, user_from FROM tbl_album where albumid='$aid'";
      $rs_result = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_assoc($rs_result)){
        $aname=$row['name'];
        $adesc=$row['adesc'];
        $user_from=$row['user_from'];
        echo '<h2 class="pl-2">'.ucwords($aname).'</h2>';
        echo "<p class='pl-2'>".ucfirst($adesc)."</p>";
	    }?>

			<div class="one-whole text-justify">
	     <?php
	        $sql = "SELECT gimages FROM tbl_gallery where aid=$aid AND status='process'";
	        if($num_rows = mysqli_num_rows(mysqli_query($conn, $sql)) > 0){
	          $result = mysqli_query($conn, $sql);
            echo'<div class="main_gallery border mx-1">';
    	        while($row = mysqli_fetch_array($result)){
    	            $gimage=$row['gimages'];

									// to change from gif to mp4 extension for anchor tag and gupload to gcatch
									$base_name = basename($gimage);
									$imageFileType = pathinfo($base_name, PATHINFO_EXTENSION);
									if(strtolower($imageFileType) == 'gif'){
										// if($hd){$gc=$gimage;}else{$gc = str_replace('gupload', 'gcatch', $gimage);}
										$gc = str_replace('gupload', 'gcatch', $gimage);
										$gc = str_replace('.gif', '.mp4', $gc);
									}else{
										$gc = str_replace('gupload', 'gcatch', $gimage);
									}
									// $gc = str_replace('gupload', 'gcatch', $gimage);
    	            echo "<div class='item-gallery'><a href='../../../$gc' target='_self' data-fancybox='gallery'>
    	                    <img style='max-width: 153px;max-height: 153px;padding: 3px 6px;border-raius: 10%;border-radius: 10%;' src='../../../$gimage' alt='video' class='imgs inline-block' />
    									 </a></div>";
    	         }

           }else{

            $images_query = mysqli_query($conn, "SELECT image FROM posts WHERE aid='$aid' AND status='process'");

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

				<div class="p-3 mt-3 text-center">
					<a href="<?php echo $user_from; ?>" class="text-decoration-none"><-- Back to <?php echo '<h5 class="d-inline">'.ucwords(str_replace('-', ' ',($user_from))).'</h5>\'s'; ?> album</a>
				</div>
	</div>

<script>
$(document).ready(function(){
  gotoBottom();
});

function gotoBottom(){
   var element = document.querySelector('html');
   target_top = element.scrollHeight - element.clientHeight;
   $('html').animate({scrollTop:target_top}, 900);
  }
</script>

</body>
</html>
