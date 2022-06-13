<?php
  include("../main/base.php");

if (isset($_COOKIE[ 'QTSSTYU'])){
	$_SESSION[ 'id']=$_COOKIE[ 'QTSSTYU'];
	$userloggedin_id=$_COOKIE[ 'QTSSTYU'];
	$user_details_query=mysqli_query($conn, "SELECT * FROM users WHERE id='$userloggedin_id'");
	$user=mysqli_fetch_array($user_details_query);
	$_SESSION[ 'username'] = $user['username'];
	$userloggedin = $user['username'];
    $pro_pic = $user['profile_pic'];

    $messages = new Message($conn, $userloggedin);
    $num_messages = $messages->getUnreadNumber();
    $notifications = new Notification($conn, $userloggedin);
    $num_notifications = $notifications->getUnreadNumberN();
    $user_obj = new User($conn, $userloggedin);
    $num_requests = $user_obj->getNumberOfFriendRequests();
    $loggedNameH = str_replace('_', ' ', $user['first_name']);
    $error_array = array();

    include("../main/navbar.php");
    $startTime = date("Y-m-d H:i:s");
 ?>
 <div class="">
      <form class="post_form indexForm mb-3 p-2" action="upload_imageAndVideo.php" method="POST" enctype="multipart/form-data">
          <textarea name="post_text" id="post_text" placeholder="Type your post here.." class="indTextarea form-control"></textarea>
          <input type="submit" name="post" id="post_button" value="Enter" class="form-control indSubmit btn btn-warning" style="width:118px;float:right;">
          <input type="hidden" name="userloggedin" value="<?php echo $userloggedin; ?>">
          <input type="hidden" name="bitrate" value="2500k">
          <div class="main_msg_grp">
            <div class="item-gif" id="rb">
              <label>
                <input type="radio" id="radio_button_disable" name="rb" value="disable"><span class="pl-1 pr-3">Disable Enter (for long writing)</span>
              </label>
              <label>
                <input type="radio" id="radio_button_enable" name="rb" value="enable"> <span class="pl-1" id="rb_default">Default</span>
              </label>
            </div>
          </div>

      </form>
      <center id="spinner" class="d-none">
         <img style="width:50px" src="../../../assets/images/icon/loading.gif"/>
         <div id="pwait" class="d-none"><p>Please wait it takes longer time...</p></div>
      </center>
      <div class="progress mb-4">
         <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      <div class="post_area"></div>
      <center><img id="loading" src="../../../assets/images/icon/loading.gif"></center>
      <div class="d-inline-block" style="margin-left:50%"><a href="#" class="back-to-top"></a></div>

   </div>
<?php include('../main/footer.php');
 ?>
 <script>

 var userloggedin = '<?php echo $userloggedin; ?>';
 $(document).ready(function () {
   	loadPosts();

   	$(window).scroll(function () {
 		var bottomElement = $(".status_post").last();
 		var noMorePosts = $('.post_area').find('.noMorePosts').val();
 		if (isElementInView(bottomElement[0]) && noMorePosts == 'false') {
 			loadPosts();
 		}
 	});
   });
  var inProgress = false;
 	function loadPosts() {
 		if (inProgress) {
 			return;
 		}
 		inProgress = true;
 		$('#loading').show();
 		var page = $('.post_area').find('.nextPage').val() || 1;
 		$.ajax({
 			url: "../../includes/handlers/ajax_load_posts.php",
 			method: "POST",
 			data: "page=" + page + "&userloggedin=" + userloggedin,
 			cache: false,
 			success: function (response) {
 				$('.post_area').find('.nextPage').remove();
 				$('.post_area').find('.noMorePosts').remove();
 				$('.post_area').find('.noMorePostsText').remove();
 				$('#loading').hide();
 				$(".post_area").append(response);
 				inProgress = false;
 			}
 		});
 	}
 	function isElementInView(el) {
 		if (el == null) {
 			return;
 		}
 		var rect = el.getBoundingClientRect();
 		return (rect.bottom <= (window.innerHeight || document.documentElement.clientHeight));
 	}



     function supportAjaxUploadWithProgress() {
         return supportFileAPI() && supportAjaxUploadProgressEvents() && supportFormData();

         function supportFileAPI() {
         var fi = document.createElement('INPUT');
         fi.type = 'file';
         return 'files' in fi;
         };

         function supportAjaxUploadProgressEvents() {
         var xhr = new XMLHttpRequest();
         return !! (xhr && ('upload' in xhr) && ('onprogress' in xhr.upload));
         };

         function supportFormData() {
         return !! window.FormData;
         }
     }


     $(document).ready(function(){

         // messageNotif();
         supportAjaxUploadWithProgress();
         x=document.getElementById('radio_button_disable');
         y=document.getElementById('radio_button_enable');
         rb=document.getElementById('rb');
         $('#radio_button_enable').hide();
         $('#rb_default').hide();
         $('input[type=radio][name=rb]').change(function() {
           if(this.value == 'disable'){
              alert('Are going to write a long phrase? You disabled Enter, use Submit button instead');
              x.checked == true;
              y.checked == false;
             $('#radio_button_enable').show();
             $('#rb_default').show();
           }else{
             alert('You reset to default');
             x.checked == false;
             y.checked == true;
           }
          });
         $('#post_text').keypress(function(e) {
           if(x.checked == false){
               if(e.which == 13) {
                 $(this).blur();
                 $('#post_button').focus().click();
                }
            }
          });


     });
     // function messageNotif(){
     //    $('#unread_message').load('messageNotification.php');
     //    setTimeout("messageNotif();", 5100);
     // }
     var debugMode = true;
     function displayError(message) {
         location.reload();
      }

     function displayPHPError(error){
         displayError ("Error number :" + error.errno + "\r\n" +
         "Text :"+ error.text + "\r\n" +
         "Location :" + error.location + "\r\n" +
         "Line :" + error.line + + "\r\n");
     }


     $(document).ready(function(){
       $('.indexForm').on('submit', function(event){
             $.ajax({
                 method: 'POST',
                 url: 'upload_imageAndVideo.php',
                 data: new FormData(this),
                 // dataType: 'json',   //to prevent refresh
                 cache: false,
                 contentType: false,
                 processData:false,
                 beforeSend: function(){
                 $('#post_button').removeAttr();
                 $('.indexForm').css("opacity",".3");
                 $('#spinner').removeClass('d-none');
                 setTimeout('p_show();', 6000);
                 },
                 error: function(xhr, textStatus, errorThrown) {
                   displayError(textStatus);
                   },
                 success: function(response, textStatus){
                     if(response.errno != null)
                        displayPHPError(response);
                     else{
                         $('#fileToUpload').val('');
                         $('#loader-icon').addClass('d-none');
                         $('#post_button').attr("enabled","enabled");
                         $('.indexForm').css("opacity","1");
                         location.reload();
                     }
                 },
             });
             event.preventDefault();

         });
     });

     function p_show(){
        $("#pwait").removeClass("d-none");
      }

 </script>
</body>
</html>
<?php }else{header( "Location: ../userlogin/registration_signup_page");} ?>
