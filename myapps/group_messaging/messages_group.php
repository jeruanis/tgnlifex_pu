<?php
  include("../main/base.php");
  $message_group_obj = new Group($conn, $userloggedin);
  $message_obj = new Message($conn, $userloggedin);

   if( isset($_GET['groupchat']))
     $group_to = $_GET['groupchat'];

   $last_message_query  = mysqli_query($conn, "SELECT unjoined, left_group, date FROM messages_group WHERE id IN (SELECT MAX(id) FROM messages_group WHERE user_from='$userloggedin' AND group_name='$group_to' GROUP BY user_from) ORDER BY date DESC");

   $res= mysqli_fetch_array($last_message_query);
   $unjoined = $res['unjoined'];
   $left_group = $res['left_group'];

   if($unjoined == 'yes' && $left_group == 'yes'){
      header("Location: ../../");
    }elseif($unjoined == 'yes' || $left_group == 'yes'){
       array_push($error_array, "You are either removed or have left the group<br>");
      }

   $latestUser = $message_group_obj->getMostRecentUserGroup($group_to);

   $check_database_query = mysqli_query($conn, "SELECT username FROM users WHERE username = '$latestUser'");
   $check_login_query = mysqli_num_rows($check_database_query);

   if( $check_login_query == 1) {
     $user_to_obj = new User($conn, $latestUser);
   }else{
      header('Location: ../../');
      exit();
    }

   include('../main/navbar.php');
   $lastMessageId = '<script> var lastMessageId = -1; </script>';
   $mode = 'SendAndRetrieveNew';
?>
   <style media="screen">
     .chat-message-input-container{
       flex-grow:1;
     }
   </style>
        <div class="row no-gutters">
      	 <div class="col-sm-9">
      			<div id="id_chatroom_card">
      				<div class="flex-row align-items-center card-header" id="id_room_title" style="background:#516c8a;text-align:center;">
      				<a class="flex-row" target="_blank" id="id_user_info_container" style="word-break:break-word">
                	<h3 class="ml-2 text-white"><?php echo str_replace('_', ' ', $group_to); ?></h3>
      				</a>

      				</div>
                <div class="d-flex flex-column" id="id_chat_log_container">
      						<div class="d-flex flex-row justify-content-center" id="id_chatroom_loading_spinner_container">
      							<center id="spinner" class="d-none"><img style="width:100px; margin-top:27%;" src="../../../assets/images/icon/loading.gif"/></center>
      						</div>
                     <div class="loaded_messagesM group-msg-view p-3" id="scroll_messages" style="overflow-y:auto; overflow-x:hidden;">
                   </div>
                 <form id="fupFormG" action="" method="POST" enctype="multipart/form-data" class="form-group">
                    <div class="d-flex flex-row chat-message-input-container">
                        <textarea name='post_text' id='message_textarea' class="flex-grow-1 chat-message-input form-control type_msg" style="background:#37425e;color:white;overflow-y: auto;" placeholder="Type your message..."></textarea>
                        <div class="input-group-append">
                          <button type='submit' name='post' id='message_submit' class="input-group-text chat-send-arrow" style="background:#37425e"><i class="fa fa-location-arrow" style="font-size:57px;color:white;"></i></button>
                        </div>
                    </div>
                    <input type="hidden" name="userloggedin" value="<?php echo $userloggedin; ?>">
                    <input type="hidden" name="latestUser" value="<?php echo $latestUser; ?>">
                    <input type="hidden" name="group_to" value="<?php echo $group_to; ?>">
                    <input type="hidden" name="id" value="<?php echo $lastMessageId; ?>">
                    <input type="hidden" name="mode" value="<?php echo $mode; ?>">

                    <div id="bot_func">
                      <div class="main_msg_grp border">
                        <input type="file" name="fileToUpload" id="fileToUploadMsge" accept=".jpg, .png, .pdf, .jpeg, .PNG, .gif" />
                        <a id="gifOpen" class="item-gif"><img width="50"  src="../../../assets/images/icon/rsz_gif-document-file-512.png"></a>
                        <a id="gifclose" class="item-gif d-none"><img width="50"  src="../../../assets/images/icon/rsz_gif-document-file-512.png"></a>
                        <div class="item-gif" id="rb">
                          <label>
                            <input type="radio" id="radio_button_disable" name="rb" value="disable"><span class="pl-1 pr-3">Disable Enter</span>
                          </label>
                          <label>
                            <input type="radio" id="radio_button_enable" name="rb" value="enable"> <span class="pl-1" id="rb_default">Default</span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </form>
                  <?php include("gif-list_message_group.php"); ?>
      					</div>
      			</div>
      		</div>
         <div class="col-sm-3 friends-bar">
    		  <div class="card">
    				<div class="d-flex flex-row align-items-center card-header">
    					<h3 class="mb-2">Members</h3>
    				</div>

    					<div class="d-flex flex-column friends-list-container ">
    						<div class="d-flex flex-row p-2 friend-container">
                  <span id='members_profile_pic'></span>
                  <span id='members_name_and_status'></span>
    						</div>
    					</div>

    			</div>
    	   </div>
       </div>

<?php
    $mesge_query = mysqli_query($conn, "SELECT count(*) FROM messages_group WHERE group_name='$group_to'");
    $rowcount=mysqli_fetch_row($mesge_query);
    $total_records =  $rowcount[0];
    include ('../main/footer.php');
?>

<script>
  var lastMessageID = '<?php $lastMessageId; ?>';
  var total = '<?php echo $total_records; ?>';
  var user_to =  '<?php echo $latestUser; ?>';
  var userloggedin = '<?php echo $userloggedin; ?>';
  var group_to = '<?php echo $group_to; ?>';
  var debugMode = false;
  var updateInterval = 5000;
  var message_url_group = "messages_refresher_group.php";

$(document).ready(function(){
    gotoBottom()
    retrieveOnlineUserProfilegroup();
    retrieveOnlineUserProfileUpdatergroup();
    retrieveOnlineUserNumbergroup();
    retrieveNewMessages1();
    retrieveMessageSound();
    raise_messages();
    supportAjaxUploadWithProgress();

    $('#scrollDown').on('click',function(){
      $('.loaded_messagesM').animate({scrollTop : ($('.loaded_messagesM').height() * total)});
     });

    $('.btn-group').hide();
    $('#gifOpen').click(function(){
       $('.btn-group').show();
       $(this).hide();
       $('#gifclose').removeClass('d-none');
       gotoBottomOf('html')
     });
     $('#gifclose').click(function(){
        $('.btn-group').hide();
        $('#gifclose').addClass('d-none');
        $('#gifOpen').show();
      });

    // setInterval(function() {
    //      $('span#unread_message').load('messageNotification.php');
    //   }, 2100);


    x=document.getElementById('radio_button_disable');
    y=document.getElementById('radio_button_enable');
    rb=document.getElementById('rb');
    $('#radio_button_enable').hide();
    $('#rb_default').hide();

    $('input[type=radio][name=rb]').change(function() {
      if(this.value == 'disable'){
         alert('You disabled Enter, use Submit button instead');
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

    $('#message_textarea').keypress(function(e) {
      if(x.checked == false){
          if(e.which == 13) {
            $(this).blur();
            $('#message_submit').focus().click();
           }
       }
     });

    $('#fupFormG').click(function(){
        up();
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

    $("#fupFormG").on('submit', function(e){
      var audioElement = document.createElement('audio');
      audioElement.setAttribute('src', '../../../assets/sounds/message_sent.wav');
        $.ajax({
            method: 'POST',
            url: message_url_group,
            data: new FormData(this),
            // dataType: 'json',
            cache: false,
            contentType: false,
            processData:false,
            beforeSend: function(){
               $('#spinner').removeClass("d-none");
               $('#message_submit').attr("disabled","disabled");
              },
            error: function(xhr, textStatus, errorThrown) {
                  displayError(textStatus);
                  },
            success: function(response, textStatus){
               if(response.errno != null)
                    displayPHPError(response);
                else{

                if(response === null || response == ''){
                      $('.statusMsg').html('');
                      $('textarea').val('');
                      $('#fupFormG').css("opacity","");
                      $("#message_submit").removeAttr("disabled");
                      $('#fupFormG').after('');
                      $('#fileToUploadMsge').val('');
                      $('.loaded_messagesM').css({"opacity":""});
                      $('#gifOpen').css({"opacity":""});
                      $('#bottom').css({"opacity":""});
                      $('button').removeAttr("disabled");
                      $('#message_textarea').focus();
                      $('#spinner').addClass("d-none");

                    }else{
                      audioElement.play();
                      $('.statusMsg').html('');
                      $('#message_textarea').val('');
                      $('#fupFormG').css("opacity","");
                      $("#message_submit").removeAttr("disabled");
                      $('#fupFormG').after('');
                      $('#fileToUploadMsge').val('');
                      $('.loaded_messagesM').css({"opacity":""});
                      $('#gifOpen').css({"opacity":""});
                      $('#bottom').css({"opacity":""});
                      $('button').removeAttr("disabled");
                      $('#message_textarea').focus();
                      $('#spinner').addClass("d-none");
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

    function displayError(message) {
      location.reload();
     }

    function displayPHPError(error){
        displayError ("Error number :" + error.errno + "\r\n" +
        "Text :"+ error.text + "\r\n" +
        "Location :" + error.location + "\r\n" +
        "Line :" + error.line + + "\r\n");
       }

    function gotoBottomOf(id){
      let element = document.querySelector(id);
      target_top = element.scrollHeight - element.clientHeight;
      $('html').animate({scrollTop:target_top}, 1500);
     }

     function gotoBottom(){
         var footer = document.querySelector('#bot_func');
         var element = document.querySelector('html');
         target_top = (element.scrollHeight - footer.offsetHeight) - element.clientHeight;
         $('html').animate({scrollTop:target_top});
        }

     function raise_messages(){
        $('.loaded_messagesM').animate({scrollTop : ($('.loaded_messagesM').height() * total*2)});
     }
     function up(){
       var div = document.getElementById('scroll_messages');
       div.scrollTop = div.scrollHeight;
     }

    function retrieveMessageSound() {
        var pageName;
            pageName = "messaging_new_msge_sound_group.php";
         $.ajax({
            url: pageName,
            type: "POST",
            data: {"userloggedin":userloggedin},
            cache:false,
            "success":function(response, textStatus){
                $("#audioBox").append(response);
                  setTimeout("retrieveMessageSound()", updateInterval);
                 }
            });
         }

     function retrieveNewMessages1() {
         var loader_icon = '<center><img style="width:100px; margin-top:27%;" src="../../../assets/images/icon/loading.gif"/></center>';
         var mode = 'RetrieveNew';
         var pageName;
             pageName = message_url_group,
          $.ajax({
             url: pageName,
             type: "POST",
             data: {"user_to": user_to, "userloggedin":userloggedin, "group_to" : group_to, "mode":mode, "id": lastMessageID},
             beforeSend: function(){
                 $('.loaded_messagesM').html(loader_icon);
               },
             success:function(response, textStatus){
                 var loader_icon = '';
                 $('.loaded_messagesM').html(loader_icon);
                 readMessages(response, textStatus);
                    raise_messages();
                 retrieveNewMessages();
                 console.log(response);
               }
           });
         }


    function retrieveNewMessages() {
        var mode = 'RetrieveNew';
        var pageName;
            pageName = message_url_group,
         $.ajax({
            url: pageName,
            type: "POST",
            data: {"user_to": user_to, "userloggedin":userloggedin, "group_to" : group_to, "mode":mode, "id": lastMessageID},
            cache:false,
            success:function(response, textStatus){
              readMessages(response, textStatus);
              setTimeout("retrieveNewMessages();", 2100);

              }
            });
          }

    function retrieveOnlineUserProfilegroup() {
            var pageName;
                pageName = "profile_online_group.php";
             $.ajax({
                url: pageName,
                type: "POST",
                data: {"userloggedin":userloggedin, "group_to" : group_to, "user_to": user_to},
                cache:false,
                "success":function(response, textStatus){
                    $("#members_profile_pic").css({"background":"white"}).html(response);
                   }
                })
              }

    function readMessages(response, textStatus){
        clearChat = response.clear;
         if (clearChat == true) {
             $('.loaded_messagesM')[0].innerHTML = "";
             lastMessageID = -1;
            }
         if (response.messages.length > 0) {
             if(lastMessageID > response.messages[0].id){
               return;
             }
             lastMessageID = response.messages[response.messages.length-1].id;
            }

         $.each(response.messages, function(i, message) {

                var content = "";
                var delete_button ="";
                var option="";
                var bodyUnjoinedNotCreator="";
                var bodyUnjoined="";
                var userId="";
                var imgGif ="";
                var bodyUserloggedin = "";
                var bodyUserto = "";
                var bodyUnjoinedNotCreator="";
                var imageGifuseTo_removed="";
                var imageDivR="";
                var urlExtract="";
                var imageGifuseFrom_removed="";
                var imageUrlDiv="";
                var optionDiv="";
                var imageDivMod="";
                var imageDivL = "";
                var htmlMessage = "";
                var optionDivMem="";
                var delete_buttonMem="";
                var option = '<i class="fa fa-ellipsis-v"></i>';
                imageUrlDiv = '<div class="postImgMessage"><img src="'+message.image_url+'" alt="Unable to display the photo" style="max-width:50%;" class="rounded"></div>';

                if(message.image_url == ''){
                  imageUrlDiv = '';
                }

                if(message.title_url == ''){
                  titleUrlDiv = '';
                 } else {
                  titleUrlDiv = '<a style="color:#007bff" href="'+message.body_cleared+'" target="_blank">'+message.title_url+'</a>';
                  }

                if(message.descript_url == ''){
                 decriptUrlDiv = '';
                  } else {
                 decriptUrlDiv = "<p class='text-white'>"+message.descript_url+"</p>";
                  }

                if(message.unjoined=='no'){
                   optionDivMem = "<div class='Memoption"+message.id+" option_div_mem text-muted' style='position:relative;bottom:37px;float:right;'>"+option+"</div>";
                   delete_buttonMem="<button class='delete_button' id='member"+message.id+"'>Remove from the group</button>";
                 }

                    if(message.deleted == 'no'){
                        if(message.title_url== ''){
                            urlExtract='';
                        }else{
                            urlExtract = '<div id="urlext'+message.id+'">'+imageUrlDiv+titleUrlDiv+decriptUrlDiv+'</div>';
                        }
                    }else{
                        urlExtract="";
                      }

                    if(message.user_from == userloggedin){
                        if(message.deleted=='no' || message.unjoined=='no'){
                            optionDiv = "<div class='Moption"+message.id+" option_div text-muted' style='position:relative;bottom:37px;float:right;'>"+option+"</div>";

                            if(message.id == message.last_id_query) {
                              delete_button="<button class='delete_button border-bottom btn-secondary' id='message"+message.id+"'>Remove message</button><button class='delete_button btn-secondary' style='width:150px' id='leave"+message.id+"'>Leave the group</button>";
                            }else{
                              delete_button="<button class='delete_button btn-secondary' id='message"+message.id+"'>Remove message</button>";
                             }

                        }else{
                          optionDiv = "";
                        }
                    }else{
                      optionDiv = "";
                    }

                    if(message.gif==""){
                        imgGif="";
                    }else{
                        if(message.user_from == userloggedin){
                          imgGif='<img src="../../../assets/images/icon/'+message.gif+'" loading="lazy" style="width:50%">';
                          message.body = "";
                        }else{
                            imgGif='<img src="../../../assets/images/icon/'+message.gif+'" loading="lazy" style="width:50%">';
                            message.body = "";
                          }
                     }

                    if(message.image==""){
                       imageDiv="";
                    }else{
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
                              imageDivMod = "<a data-fancybox href='../../../"+message.image+"'>"+imageDiv+"</a>";
                            break;
                            case 'pdf':
                              imageDiv= "<img src='../../../assets/images/icon/pdf.png' width='100' loading='lazy'>";
                              imageDivMod = "<a href='../books_reader/post_pdf_reader?title="+message.image+"' target='_blank'>"+imageDiv+"</a><div>"+filename+"</div>";
                            break;
                          }
                      }

                      if(message.deleted=='no'){
                          if(message.image != ''){
                              imageDivL = "<div class='postedImageMessageL"+message.id+" postedImageMessageLeft'>"+imageDivMod+"</div>";
                              imageDivR = "<div class='postedImageMessageL"+message.id+" postedImageMessageRight'>"+imageDivMod+"</div>";
                              }


                          if(message.body != ""){
                             if(userloggedin == message.creator){
                                  bodyUserloggedin= '<section class="text-body" id="user_logmsge'+message.id+'">'+message.body+'</section>';
                                  bodyUserto  = '<section style="color:#343a40" id="user_msge'+message.id+'">'+message.body+'</section>';

                             }else{
                                  bodyUserloggedin= '<section style="color:#343a40" id="user_tomsge'+message.id+'">'+message.body+'</section>';
                                  bodyUserto  = '<section class="text-body" id="user_msge'+message.id+'">'+message.body+'</section>';
                               }
                           }

                        if(imgGif != ""){
                            imageGifuseFrom_removed = "<div id='user_gif"+message.id+"' style=''>"+imgGif+"</div>";
                            imageGifuseTo_removed = "<div id='user_gif"+message.id+"' style=''>"+imgGif+"</div>";
                          }

                    }else{
                        if(message.image != ''){
                            imageDivL = "<small class='text-muted border p-1'>Image removed</small>";
                            imageDivR = "<small class='text-muted border p-1'>Image removed</small>";
                          }
                        else if(message.body != ""){
                            bodyUserto  = "<small class='text-muted border p-1'>message removed</small>";
                            bodyUserloggedin= "<small class='text-muted border p-1'>message removed</small>";

                             imgGif="";
                             }
                        else if(imgGif != ""){
                            imageGifuseFrom_removed = "<small class='text-muted border p-1'>icon message removed</small>";
                            imageGifuseTo_removed = "<small class='text-muted border p-1'>icon message removed</small>";
                            }

                           optionDivMem="";
                           optionDiv="";
                    }

                    if(message.left_group == 'yes'){
                    bodyUnjoined  = "<small class='text-muted border p-1'>Left the group</small>";
                    bodyUnjoinedNotCreator  = "<small class='text-muted border p-1'>Left the group</small>";
                        imageDivR="";
                        imageDivL="";
                        bodyUserto="";
                        bodyUserloggedin="";
                        imageGifuseTo_removed="";
                        imageGifuseFrom_removed="";
                        optionDivMem="";
                        optionDiv="";
                 }else if(message.unjoined=='yes'){
                      bodyUnjoined  = "<small class='text-muted border p-1'>Removed from the group</small>";
                      bodyUnjoinedNotCreator  = "<small class='text-muted border p-1'>Removed from the group</small>";
                      imageDivR="";
                      imageDivL="";
                      bodyUserto="";
                      bodyUserloggedin="";
                      imageGifuseTo_removed="";
                      imageGifuseFrom_removed="";
                      optionDivMem="";
                      optionDiv="";
                    }

                if(userloggedin == message.creator){
                    if(message.user_from != userloggedin ){
                          if(message.body !=" "){
                            content = bodyUnjoinedNotCreator+imageGifuseTo_removed+urlExtract+bodyUserloggedin;
                          }else{
                            content =bodyUnjoinedNotCreator+imageGifuseTo_removed+urlExtract;
                          }

                         htmlMessage += "<div class='rounded message' id='green' style='padding:0; margin:0;'><div id='"+message.id+"' class='position-relative'><div /*class='border-bottom pb-1'*/>";
                         htmlMessage += "<img src='../"+message.profile_pic+"' class='profic_image rounded-circle mr-2' />";
                         htmlMessage += "<span class='pr-2'>";
                         htmlMessage += "<a href='"+message.user_from+"' style='position:relative;bottom:7px;'>"+message.user_from1+"</a>";
                         htmlMessage += "</span><br>";
                         htmlMessage += "<small class='text-muted border-bottom' style='position:relative;bottom:21px;padding-left:44px;'>"+message.date+"</small>";
                         htmlMessage += optionDivMem;
                         htmlMessage += "<div class='Mpost_option' id='MemtoggleOption"+message.id+"' style='z-index:2;display:none;top:24px;'>";
                         htmlMessage +=    "<div id='Coption_section' style='z-index:1;width:160px;'>";
                         htmlMessage +=      "<div>"+delete_buttonMem+"</div>";
                         htmlMessage +=    "</div>";
                         htmlMessage +=  "</div><div>";
                         if (content.length > 0) {
                           htmlMessage += "<div class='p-2 content-green rounded d-inline-block' style='bottom:17px'>"+content+"</div>";
                         }
                         htmlMessage += "<div style='position:relative;bottom:14px;'>"+imageDivR+"</div>";
                         htmlMessage +="</div></div>";

                     }else{
                        if(message.body !=" "){
                            content = bodyUnjoined+imageGifuseFrom_removed+urlExtract+bodyUserto;
                          }else{
                            content = bodyUnjoined+imageGifuseFrom_removed+urlExtract;
                          }

                         htmlMessage += "<div class='rounded message' id='blue' style='padding:0; margin:0;'><div id='"+message.id+"' class='position-relative'><div /*class='border-bottom pb-1'*/>";
                         htmlMessage += "<img src='../"+message.profile_pic+"' class='profic_image rounded-circle mr-2' />";
                         htmlMessage += "<span class='pr-2'>";
                         htmlMessage += "<a href='"+message.user_from+"' style='position:relative;bottom:7px;'>"+message.user_from1+"</a>";
                         htmlMessage += "</span><br>";
                         htmlMessage += "<small class='text-muted' style='position:relative;bottom:21px;padding-left:44px;'>"+message.date+"</small>";
                         htmlMessage += optionDiv;
                         htmlMessage += "<div class='Mpost_option' id='MtoggleOption"+message.id+"' style='display:none;z-index:1;top:24px;'>";
                         htmlMessage += "<div style='z-index:1;width:160px;'>"+delete_button+"</div>";
                         htmlMessage += "</div></div>";
                         if (content.length > 0) {
                           htmlMessage += "<div class='p-2 content-blue rounded d-inline-block' style='bottom:17px'>"+content+"</div>";
                         }
                         htmlMessage += "<div style='position:relative;bottom:14px;'>"+imageDivL+"</div>";
                         htmlMessage += "</div></div>";

                          }
                 }else{

                    if(message.user_from != userloggedin ){
                        if(message.body !=" "){
                            content = bodyUnjoinedNotCreator+imageGifuseTo_removed+urlExtract+bodyUserloggedin;
                          }else{
                            content = bodyUnjoinedNotCreator+imageGifuseTo_removed+urlExtract;
                          }

                          htmlMessage += "<div class='rounded message' id='green' style='padding:0; margin:0;'><div id='"+message.id+"' class='position-relative'><div /*class='border-bottom pb-1'*/>";
                          htmlMessage += "<img src='../"+message.profile_pic+"' class='profic_image rounded-circle mr-2' />";
                          htmlMessage += "<span class='pr-2'>";
                          htmlMessage += "<a href='"+message.user_from+"' style='position:relative;bottom:7px;'>"+message.user_from1+"</a>";
                          htmlMessage += "</span><br>";
                          htmlMessage += "<small class='text-muted' style='position:relative;bottom:21px;padding-left:44px;'>"+message.date+"</small>";
                          htmlMessage += "</div>";
                          if (content.length > 0) {
                             htmlMessage += "<div class='p-2 content-green rounded d-inline-block' style='bottom:17px'>"+content+"</div>";
                          }
                          htmlMessage += "<div style='position:relative;bottom:14px;'>"+imageDivR+"</div>";
                          htmlMessage += "</div></div>";

                     }else{
                        if(message.body !=" "){
                            content = bodyUnjoined+imageGifuseFrom_removed+urlExtract+bodyUserto;
                          }else{
                            content = bodyUnjoined+imageGifuseFrom_removed+urlExtract;
                          }

                        htmlMessage +="<div class='rounded message' id='blue' style='padding:0; margin:0;'><div id='"+message.id+"' class='position-relative'><div /*class='border-bottom pb-1'*/>";
                        htmlMessage += "<img src='../"+message.profile_pic+"' class='profic_image rounded-circle mr-2' />";
                        htmlMessage += "<span class='pr-2'>";
                        htmlMessage += "<a href='"+message.user_from+"' style='position:relative;bottom:7px;'>"+message.user_from1+"</a>";
                        htmlMessage += "</span><br>";
                        htmlMessage += "<small class='text-muted' style='position:relative;bottom:21px;padding-left:44px;'>"+message.date+"</small>";
                        htmlMessage += optionDiv;
                        htmlMessage += "<div class='Mpost_option' id='MtoggleOption"+message.id+"' style='display:none;z-index:1;top:24px;'>";
                        htmlMessage += "<div style='z-index:1;width:160px;'>"+delete_button+"</div>";
                        htmlMessage += "</div></div>";
                        if (content.length > 0) {
                          htmlMessage += "<div class='p-2 content-blue rounded d-inline-block' style='bottom:17px'>"+content+"</div>";
                        }
                        htmlMessage += "<div style='position:relative;bottom:14px;'>"+imageDivL+"</div>";
                        htmlMessage += "</div></div>";
                    }
                }

                     var isScrolledDown = (($('.loaded_messagesM')[0].scrollHeight - $('.loaded_messagesM')[0].scrollTop) <= $('.loaded_messagesM')[0].offsetHeight);
                     var div = document.getElementById('scroll_messages');
                     $('.loaded_messagesM')[0].innerHTML += htmlMessage;
                     $('.loaded_messagesM')[0].scrollTop = isScrolledDown ? $('.loaded_messagesM')[0].scrollHeight : $('.loaded_messagesM')[0].scrollTop;
                     div.scrollTop = div.scrollHeight;
                     gotoBottom()


                 $(document).ready(function() {
                     $('.Moption'+message.id).click(function(e){
                         e.stopPropagation();
                        $('#MtoggleOption'+message.id).slideToggle(300);
                      });
                      $('.Memoption'+message.id).click(function(e){
                          e.stopPropagation();
                          $('#MemtoggleOption'+message.id).slideToggle(300);
                       });

                     $('#message'+message.id).on('click', function() {
                         $.post("../../includes/form_handlers/delete_message_group.php",
                             { msge_id: message.id, image_path:message.image, userlogin:userloggedin },
                             function(data) {
                               $('#'+message.id).fadeOut();
                             }
                          );
                       });

                      $('#leave'+message.id).on('click', function() {
                        bootbox.confirm("Are you sure you want to leave this group?", function(result) {
                             var log_id = message.id;
                             var userloggedin = message.user_from;
                            if(result){
                               $.ajax({
                                    url: "../../includes/form_handlers/leave_group.php",
                                    method: "POST",
                                    data: {"log_id": log_id, "userloggedin" : userloggedin, "result":result},
                                    cache:false,
                                    "success": function(data) {
                                        location.reload();
                                         }
                                 });
                                }
                            });
                        });

                    $('#member'+message.id).on('click', function() {
                        $.post("../../includes/form_handlers/delete_member_group.php?member_id="+message.id);
                        $("#user_logmsge"+message.id).text('Removed from the group').addClass("text-muted border p-1");
                        $("#user_gif"+message.id).text('Removed from the group').addClass("text-muted border p-1");
                        $(".postedImageMessageL"+message.id).text('message removed').addClass("text-muted border p-1");
                         $(".postedImageMessageL"+message.id).text('message removed').addClass("text-muted border p-1");

                        $('#urlext'+message.id).fadeOut();
                        $('.postedImageMessageL'+message.id +'>img').hide();
                        $('.postedImageMessageR'+message.id +'>img').hide();
                        $('.Memoption'+message.id).click();
                        $('.Memoption'+message.id).fadeOut();

                    });

                   $(document).click(function() {
                        $('#MemtoggleOption'+message.id).hide();
                        $('#MtoggleOption'+message.id).hide();
                    });
                    $('.loaded_messagesM').scroll(function() {
                        $('#MemtoggleOption'+message.id).hide();
                        $('#MtoggleOption'+message.id).hide();
                    });

                 });

         });


      }

    function retrieveOnlineUserProfileUpdatergroup() {
        var pageName;
            pageName = "profile_online_updater_group.php";
         $.ajax({
            url: pageName,
            type: "POST",
            data: {"userloggedin":userloggedin, "group_to" : group_to, "user_to": user_to},
            cache:false,
            "success":function(response, textStatus){
                $("#members_name_and_status").html(response);
                setTimeout("retrieveOnlineUserProfileUpdatergroup();", 5100);
              }
           });
         }

    function retrieveOnlineUserNumbergroup() {
       var pageName;
           pageName = "profile_online_number_group.php";
        $.ajax({
           url: pageName,
           type: "POST",
           data: {"userloggedin":userloggedin, "group_to" : group_to, "user_to": user_to},
           cache:false,
           "success":function(response, textStatus){
                 htmlMessage = "Online "+response;
                 $("#members_online_count").html(htmlMessage);
                 setTimeout("retrieveOnlineUserNumbergroup();", 2100);
             }
          });
        }

</script>
</body>
</html>
