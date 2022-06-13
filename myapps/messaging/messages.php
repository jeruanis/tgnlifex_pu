<?php
 include('../main/base.php');
 include('../main/navbar.php');
 if (isset($_COOKIE[ 'QTSSTYU'])){
 	$_SESSION[ 'id']=$_COOKIE[ 'QTSSTYU'];
 	$userloggedin_id=$_COOKIE[ 'QTSSTYU'];
 	$user_details_query=mysqli_query($conn, "SELECT * FROM users WHERE id='$userloggedin_id'");
 	$user=mysqli_fetch_array($user_details_query);
 	$_SESSION[ 'username'] = $user['username'];
 	$userloggedin = $user['username'];
    $pro_pic = $user['profile_pic'];

     $tm=date("Y-m-d H:i:s");
     $q=mysqli_query($conn, "UPDATE users SET status='ON',tm='$tm' WHERE username='$userloggedin'");
       }
         else{
         header("Location: registration_signup_page.php");
       }

    $messages = new Message($conn, $userloggedin);
    $num_messages = $messages->getUnreadNumber();
    $notifications = new Notification($conn, $userloggedin);
    $num_notifications = $notifications->getUnreadNumberN();
    $user_obj = new User($conn, $userloggedin);
    $num_requests = $user_obj->getNumberOfFriendRequests();
    $loggedNameH = str_replace('_', ' ', $user['first_name']);
    $error_array    =   array();

    $message_obj = new Message($conn, $userloggedin);

        if( isset($_GET['u'])) {
         $user_to = $_GET['u'];

         $check_database_query = mysqli_query($conn, "SELECT username, profile_pic FROM users WHERE username = '$user_to'");
         $check_login_query = mysqli_num_rows($check_database_query);
         $check_login_profic_query = mysqli_fetch_assoc($check_database_query);
         $friend_profile_pic = '../../../'.$check_login_profic_query['profile_pic'];
         if( $check_login_query == 1) {
             $user_to_obj = new User($conn, $user_to);

             }elseif($user_to === 'new'){
                 }else{
                         header('Location: ../../');
                         exit();
                       }
              }
 // include('../main/navbar_msg.php');
  $lastMessageId = '<script> var lastMessageId = -1; </script>';
  $mode = 'SendAndRetrieveNew';
?>

      <div class="row no-gutters">
       <div class="col-sm-9">
          <div id="id_chatroom_card">
            <div class="d-flex flex-row align-items-center card-header" id="id_room_title" style="background:#516c8a">
            <a href="../profile/<?php echo $user_to; ?>" class="d-flex flex-row" target="_blank" id="id_user_info_container">
              <img class="profile-image rounded-circle img-fluid" alt="Friend Photo" src="<?php echo $friend_profile_pic; ?>" id="id_other_user_profile_pic">

              <h3 class="ml-2 text-white" id="id_other_username"><?php echo ucwords($user_to_obj->getFirstAndLastName()); ?></h3>
            </a>

            </div>
              <div class="d-flex flex-column" id="id_chat_log_container">
                <div class="d-flex flex-row justify-content-center" id="id_chatroom_loading_spinner_container">
                   <center id="spinner" class="d-none"><img style="width:100px; margin-top:27%;" src="../../../assets/images/icon/loading.gif"/></center>
                </div>

                <div class="loaded_messagesMm loaded_messagesM group-msg-view p-3" id="scroll_messages" style="overflow-y:auto; overflow-x:hidden;">
                </div>
                <form id="fupForm" action="" method="POST" enctype="multipart/form-data" class="form-group">
                  <div class="d-flex flex-row chat-message-input-container">
                    <textarea type="text" name="post_text" id="message_textarea" class="flex-grow-1 chat-message-input form-control type_msg"  style="background:#37425e;color:white;overflow-y: auto; border-right:none;outline:none;border-radius:.25rem 0 0 .25rem" placeholder="Type your message..."></textarea>

                    <div class="input-group-append" style="background:#37425e;border-top:1px solid lightgrey;border-bottom:1px solid lightgrey;">
                      <a id="gifOpen" class="item-gif" style="padding-top:.375rem">

                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="50px" viewBox="0 0 24 24" width="50px" fill="#ffffff"><g><rect fill="none" height="24" width="24" x="0"/></g><g><g><rect height="6" width="1.5" x="11.5" y="9"/><path d="M9,9H6c-0.6,0-1,0.5-1,1v4c0,0.5,0.4,1,1,1h3c0.6,0,1-0.5,1-1v-2H8.5v1.5h-2v-3H10V10C10,9.5,9.6,9,9,9z"/><polygon points="19,10.5 19,9 14.5,9 14.5,15 16,15 16,13 18,13 18,11.5 16,11.5 16,10.5"/></g></g></svg>
                     </a>
                    <a id="gifclose" class="item-gif d-none" style="padding-top:.375rem">
                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="50px" viewBox="0 0 24 24" width="50px" fill="#ffffff"><g><rect fill="none" height="24" width="24" x="0"/></g><g><g><rect height="6" width="1.5" x="11.5" y="9"/><path d="M9,9H6c-0.6,0-1,0.5-1,1v4c0,0.5,0.4,1,1,1h3c0.6,0,1-0.5,1-1v-2H8.5v1.5h-2v-3H10V10C10,9.5,9.6,9,9,9z"/><polygon points="19,10.5 19,9 14.5,9 14.5,15 16,15 16,13 18,13 18,11.5 16,11.5 16,10.5"/></g></g></svg>
                    </a>
                    </div>
                    <div class="input-group-append">
                      <button type='submit' name='post' id='message_submit' class="input-group-text chat-send-arrow"  style="background:#37425e;border-left:none;border-radius:0 .25rem .25rem 0;">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff"><path d="M0 0h24v24H0z" fill="none"/><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                      </button>
                    </div>

                  </div>
                    <input type="hidden" name="userloggedin" value="<?php echo $userloggedin; ?>">
                    <input type="hidden" name="user_to" value="<?php echo $user_to; ?>">
                    <input type="hidden" name="id" value="<?php echo $lastMessageId; ?>">
                    <input type="hidden" name="mode" value="<?php echo $mode; ?>">
                  <div class="border">
                      <input type="file" name="fileToUpload" id="fileToUploadMsge" accept="*images" class="item-gif d-none"/>
                  </div>
                </form>
                <!-- sent with different form, the ajax form -->
                <?php include('gif-list_message.php');?>
              </div>

          </div>
        </div>
       <div class="col-sm-3 friends-bar">
        <div class="card">
          <div class="d-flex flex-row align-items-center card-header mb-2">
            <h3 >Recent Messages</h3>
          </div>
            <div class="d-flex flex-column friends-list-container ">
                <div class="d-flex flex-column p-2">
                  <div class='ui comments'>
                    <?php echo $message_obj->getConvos(); ?>
                   </div>
                </div>
            </div>
        </div>
     </div>
     </div>

<?php
    $mege_query = mysqli_query($conn, "SELECT count(*) FROM messages WHERE (user_to='$userloggedin' AND user_from='$user_to') OR (user_from='$userloggedin' AND user_to='$user_to')");
    $rowcount=mysqli_fetch_row($mege_query);
    $total_records =  $rowcount[0];
    include ('../main/footer.php');

?>

<script>
  var lastMessageId = '<?php $lastMessageId; ?>';
  var userloggedin ='<?php echo $userloggedin; ?>';
  var user_to ='<?php echo $user_to; ?>';
  var total = '<?php echo $total_records; ?>';
  var userloggedin = '<?php echo $userloggedin; ?>';
  var debugMode = false;
  var updateInterval = 5000;
  var message_url = "messages_refresher.php";

 $(document).ready(function(){
    supportAjaxUploadWithProgress();
    retrieveNewMessages1();
    retrieveOnlineUser();
    retrieveMessageSound();
    gotoBottom('html');

    $('#scrollDown').on('click',function(){
         $('.loaded_messagesM').animate({scrollTop : ($('.loaded_messagesM').height() * total)});
      });

    $('.btn-group').hide();
    $('#gifOpen').click(function(){
       $('.btn-group').show();
       $(this).hide();
       $('#gifclose').removeClass('d-none');
       gotoBottom('#id_chat_log_container');
     });

   $('#gifclose').click(function(){
      $('.btn-group').hide();
      $('#gifclose').addClass('d-none');
      $('#gifOpen').show();
    });

   $('#message_textarea').keypress(function(e) {
      if(e.which == 13) {
        $(this).blur();
        $('#message_submit').focus().click();
       }
    });

   $('#fupForm').hover(function(){
      $('#message_textarea').focus();
    });

   $('#fupForm').click(function(){
       var div = document.getElementById('scroll_messages');
       div.scrollTop = div.scrollHeight;
    });

   $('.loaded_messagesM').scroll(function(){
          if(window.matchMedia("(max-width:600px)").matches){
            var isScrolledDown = (($('#scroll_messages')[0].scrollHeight - $('#scroll_messages')[0].scrollTop-600) <= $('#scroll_messages')[0].offsetHeight);
                if(isScrolledDown){
                     $('#fupFormG').fadeIn();
                  }else{
                     $('#fupFormG').fadeOut();
                  }
            }else{}
       });

 });

 $(document).ready(function(e){

     $("#fupForm").on('submit', function(e){
       var audioElement = document.createElement('audio');
       audioElement.setAttribute('src', '../../../assets/sounds/message_sent.wav');
       $.ajax({
           method: 'POST',
           url: message_url,
           data: new FormData(this),
           //dataType: 'json',
           cache: false,
           contentType: false,
           processData:false,
           beforeSend: function(){
               $('#message_submit').attr("disabled","disabled");
               $('#spinner').removeClass("d-none");
             },
           error: function(xhr, textStatus, errorThrown) {
                 displayError(textStatus);
                 },
           success: function(response, textStatus){
              if(response.errno != null)
                   displayPHPError(response);
               else{

               if(response === null || response == ''){
                   $('textarea').val('');
                   $('#fupForm').css("opacity","");
                   $("#message_submit").removeAttr("disabled");
                   $("#gifOpen").removeAttr("disabled");
                   $('#fupForm').after('');
                   $('#fileToUploadMsge').val('');
                   $('.loaded_messagesM').css({"opacity":""});
                   $('#gifOpen').css({"opacity":""});
                   $('#bottom').css({"opacity":""});
                   $('button').removeAttr("disabled");
                   $('#spinner').addClass("d-none");
                   console.log(response)

                }else{
                   audioElement.play();
                   $('textarea').val('');
                   $('#fupForm').css("opacity","");
                   $("#message_submit").removeAttr("disabled");
                   $("#gifOpen").removeAttr("disabled");
                   $('#fupForm').after('');
                   $('#fileToUploadMsge').val('');
                   $('.loaded_messagesM').css({"opacity":""});
                   $('#gifOpen').css({"opacity":""});
                   $('#bottom').css({"opacity":""});
                   $('button').removeAttr("disabled");
                   $('#spinner').addClass("d-none");
                    console.log(response)
                }
              }
              $('#spinner').addClass('d-none');
            }
        });
       e.preventDefault();
    });

  });

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

function gotoBottom(id){
    var element = document.querySelector('html');
    target_top = element.scrollHeight - element.clientHeight;
    $('html').animate({scrollTop:target_top});
   }

function displayError(message) {
   alert("Error accessing the server! " +
    (debugMode ? message : ""));
 }
function displayPHPError(error){
    displayError ("Error number :" + error.errno + "\r\n" +
    "Text :"+ error.text + "\r\n" +
    "Location :" + error.location + "\r\n" +
    "Line :" + error.line + + "\r\n");
   }

function retrieveOnlineUser() {
    var pageName;
        pageName = "messaging_online.php";
     $.ajax({
        url: pageName,
        type: "POST",
        data: {"userloggedin":userloggedin, "user_to":user_to},
        cache:false,
        success:function(data, textStatus){
            $("#onlineNow").html(data);
                setTimeout("retrieveOnlineUser();", 5100);
             }
         });
      }

function retrieveNewMessages1() {
   var loader_icon = '<center><img style="width:100px; margin-top:27%;" src="../../../assets/images/icon/loading.gif"/></center>';
   var mode = 'RetrieveNew';
   var pageName;
       pageName = message_url,
        $.ajax({
           url: pageName,
           type: "POST",
           data: {"user_to": user_to, "userloggedin":userloggedin, "mode":mode, "id": lastMessageId},
           beforeSend: function(){
               $('.loaded_messagesM').html(loader_icon);
             },
           "success":function(response, textStatus){
               var loader_icon = '';
               $('.loaded_messagesM').html(loader_icon);
               readMessages(response, textStatus);
               retrieveNewMessages();
                }
           });
        }

function retrieveNewMessages() {
   var mode = 'RetrieveNew';
   var pageName;
       pageName = message_url,
    $.ajax({
       url: pageName,
       type: "POST",
       data: {"user_to": user_to, "userloggedin":userloggedin, "mode":mode, "id": lastMessageId},
       cache:false,
       "success":function(response, textStatus){
               readMessages(response, textStatus);
               setTimeout("retrieveNewMessages();", 2100);
            }
         });
       }

function readMessages(response, textStatus){
     clearChat = response.clear;
     if (clearChat == true) {
        $('.loaded_messagesM')[0].innerHTML = "";
        lastMessageId = -1;
       }

      if (response.messages.length > 0) {
        if(lastMessageId > response.messages[0].id ){
          return;
         }
         lastMessageId = response.messages[response.messages.length-1].id;
       }

     $.each(response.messages, function(i, message) {

         var $content = "";
         var imageUrlDiv = "";
         var titleUrlDiv = "";
         var decriptUrlDiv = "";
         var urlExtract = "";
         var optionDiv = "";
         var delete_button="";
         var imgGif = "";
         var imageDivL="";
         var imageDivR="";
         var bodyUserto ="";
         var bodyUserloggedin="";
         var imageGifuseFrom_removed="";
         var imageGifuseTo_removed="";
         var htmlMessage = "";
         var delete_button="";
         var user_to = message.user_to;
         var user_from = message.user_from;

         var option = '<i class="fa fa-ellipsis-v" style="color:#dae0e5"></i>';
         var imageUrlDiv = '<div class="postImgMessage"><img src="'+message.image_url+'" alt="Unable to display the photo" style="max-width:50%;" class="rounded" loading="lazy"></div>';

         if(message.image_url == ''){
             imageUrlDiv = ' ';
         }

         if(message.title_url == ''){
             titleUrlDiv = '';
             } else {
             titleUrlDiv = '<a style="color:#007bff" href="'+message.body_cleared+'" target="_blank">'+message.title_url+'</a>';
           }

         if(message.descript_url == ''){
             decriptUrlDiv = '';
             } else {
             decriptUrlDiv = "<p>"+message.descript_url+"l</p>";
             }

         if(message.deleted == 'no'){
           if(message.title_url == ''){
                       urExtract=' ';
               }else{

                   urlExtract = '<div id="urlext'+message.id+'">'+imageUrlDiv+titleUrlDiv+decriptUrlDiv+'</div>';
                     }
         }else{
             urlExtract="";
           }

         if(message.user_to != userloggedin){
             if(message.deleted=='no'){
               optionDiv = "<div class='CnewsfeedPostOption Moption"+message.id+" option_div text-muted'>"+option+"</div>";
               delete_button="<button class='delete_button btn-secondary' id='message"+message.id+"'>Remove message</button>";
             }else{
               optionDiv="";
               delete_button="";
             }
         }else{
             optionDiv = "";
         }

         if(message.gif==""){
           imgGif=" ";
         }else{
           if(message.user_from1 == userloggedin){
             imgGif='<img src="../../../assets/images/icon/'+message.gif+'" loading="lazy" style="width:50%">';
           }else{
               imgGif='<img src="../../../assets/images/icon/'+message.gif+'" loading="lazy" style="width:50%">';
             }
           message.body = "";
         }

         if(message.deleted =='no'){
           if(message.image != ""){
             file=message.image;
                 var extension = file.substr((file.lastIndexOf('.') +1));
                 var filename = file.substr((file.lastIndexOf('/') +1));
                     filename = filename.substr(13);
                   switch(extension) {
                       case 'jpg':
                       case 'jpeg':
                       case 'png':
                       case 'gif':
                       case 'PNG':
                         imageDiv= "<img src='../../../"+message.image+"' class='rounded' loading='lazy'>";
                         var  imageDivMod = "<a data-fancybox href='../../../"+message.image+"'>"+imageDiv+"</a>";
                       break;
                       case 'pdf':
                         imageDiv= "<img src='../../../assets/images/icon/pdf.png' width='inherit' loading='lazy'>";
                         imageDivMod = "<a href='../books_reader/post_pdf_reader?title="+message.image+"' target='_blank'>"+imageDiv+"</a><div>"+filename+"</div>";
                       break;
                     }

             imageDivL = "<div class='postedImageMessageL"+message.id+" postedImageMessageRight'>"+imageDivMod+"</div>";
             imageDivR = "<div class='postedImageMessageR"+message.id+" postedImageMessageLeft'>"+imageDivMod+"</div>";
           }


           if(message.body != ""){
             bodyUserto  = '<div id="user_msge'+message.id+'"><section>'+message.body+'</section></div>';
             bodyUserloggedin= '<section style="color:#343a40" id="user_tomsge'+message.id+'">'+message.body+'</section>';
           }

           if(message.gif != ""){
             imageGifuseFrom_removed = "<span id='user_gif"+message.id+"' style=''>"+imgGif+"</span>";
             imageGifuseTo_removed = "<span id='user_gif"+message.id+"' style=''>"+imgGif+"</span>";
           }

         }else {

             if(message.image != ''){
               imageDivR = "<small class='text-white border p-1'>image removed</small>";
               imageDivL =  "<small class='text-muted border p-1'>image removed</small>";
             }

             else if(message.body != ""){
               bodyUserto  = "<small class='text-white border p-1'>message removed</small>";
               bodyUserloggedin= "<small class='text-muted border p-1'>message removed</small>";
             }

             else if(message.gif != ""){
               imageGifuseFrom_removed = "<small class='text-white border p-1'>icon removed</small>";
               imageGifuseTo_removed = "<small class='text-muted border p-1'>icon removed</small>";
             }
         }


         var div_top = (message.user_to == userloggedin);
         if(div_top){
           if(message.body !=" "){
             content = bodyUserloggedin + imageGifuseTo_removed + urlExtract;
           }else{
             content = imageGifuseTo_removed + urlExtract;
           }

           htmlMessage += "<div class='message content-green sbr' id='green'>";
           htmlMessage += "<div class='position-relative'><div /*class='border-bottom pb-1'*/>";

           htmlMessage += "<small class='text-muted'>"+message.date+"</small>";
           htmlMessage += "</div>";

           if (content.length > 0) {
             htmlMessage += "<div class='content-green rounded d-inline-block'>"+content+"</div>";
            }
           if(message.image != ''){
             htmlMessage += "<div class='p-2 rounded'>"+imageDivL+"</div>";
           }

           htmlMessage += "</div></div>";

         }else{
           if(message.body!=" "){
             content = bodyUserto + imageGifuseFrom_removed + urlExtract;
           }else{
             content = imageGifuseFrom_removed + urlExtract;
           }

             htmlMessage += "<div class='message content-blue text-white sbl' id='blue'>";
             htmlMessage += "<div class='position-relative'><div /*class='border-bottom pb-1'*/>";
             htmlMessage += "<small  class='text-white'>"+message.date+"</small>";

             htmlMessage += optionDiv;
             htmlMessage += "<div class='Mpost_option' id='MtoggleOption"+message.id+"' style='z-index:2; display:none;'>";
             htmlMessage +=   "<div id='Coption_section'>";
             htmlMessage +=     "<div>"+delete_button+"</div>";
             htmlMessage +=   "</div>";
             htmlMessage += "</div></div>";

             if (content.length > 0) {
             htmlMessage += "<div class='content-blue rounded d-inline-block'>"+content+"</div>";
             }
             if(message.image != ''){
               htmlMessage += "<div class='p-2 rounded'>"+imageDivR+"</div>";
             }
             htmlMessage += "</div></div>";
          }


         var isScrolledDown = (($('#scroll_messages')[0].scrollHeight - $('#scroll_messages')[0].scrollTop) <= $('#scroll_messages')[0].offsetHeight);
         var div = document.getElementById('scroll_messages');
         $('.loaded_messagesM')[0].innerHTML += htmlMessage;
         $('.loaded_messagesM')[0].scrollTop = isScrolledDown ? $('.loaded_messagesM')[0].scrollHeight : $('.loaded_messagesM')[0].scrollTop;
         div.scrollTop = div.scrollHeight;


       $(document).ready(function() {
           $('.Moption'+message.id).click(function(e){
               e.stopPropagation();
               $('#MtoggleOption'+message.id).slideToggle(300);
               });

           $('#message'+message.id).on('click', function() {
               $.post("../../includes/form_handlers/delete_message.php?msge_id="+message.id);

               $("#user_msge"+message.id).text('message removed').addClass("text-muted border p-1");
               $("#user_gif"+message.id).text('message removed').addClass("text-muted border p-1");
               $(".postedImageMessageR"+message.id).text('message removed').addClass("text-muted border p-1");

               $('#urlext'+message.id).fadeOut();
               $('.Moption'+message.id).click();
               $('.Moption'+message.id).fadeOut();
             });

           $(document).click(function() {
               $('#MtoggleOption'+message.id).hide();
             });
           $(document).scroll(function() {
               $('#MtoggleOption'+message.id).hide();
             });

           });

         });

      }


function retrieveMessageSound() {
  var pageName;
      pageName = "messaging_new_msge_sound_detect.php";
   $.ajax({
      url: pageName,
      type: "POST",
      data: {"userloggedin":userloggedin},
      "success":function(data, textStatus){
          $("#audioBox").append(data);
               setTimeout("retrieveMessageSound()", 5100);
           }
      });
   }

</script>
</body>
</html>
