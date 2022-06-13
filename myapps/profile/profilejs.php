<script>
   //create global variable
   var userloggedin = '<?php echo $userloggedin; ?>';
   $(document).ready(function(){
           loadPosts();
           $(window).scroll(function() {
                var bottomElement = $(".status_post").last();
                var noMorePosts = $('.post_area').find('.noMorePosts').val();
                if (isElementInView(bottomElement[0]) && noMorePosts == 'false') {
                    loadPosts();
                }});

                retrieveOnlineUserProfile();
                retrieveOnlineUserProfileUpdater();
                retrieveOnlineUserNumber();
                //for supoprt
                retrieveOnlineAllUserProfile();
                retrieveOnlineAllUserProfileUpdater();
                retrieveAllUserOnlineUserNumber();

     });

       var profileUsername = '<?php echo $username; ?>';
       var inProgress = false;
       function loadPosts() {
            if(inProgress) {
                return;
             }

            inProgress = true;
            $('#loading').show();
            var page = $('.post_area').find('.nextPage').val() || 1;
            $.ajax({
                url  : "../../includes/handlers/ajax_load_profile_posts.php",
                type: "POST",
                data: "page=" + page + "&userloggedin=" + userloggedin + "&profileUsername=" + profileUsername,
                cache:false,
                success: function(response) {
                    $('.post_area').find('.nextPage').remove();
                    $('.post_area').find('.noMorePosts').remove();
                    $('.post_area').find('.noMorePostsText').remove();
                    $('#loading').hide();
                    $(".post_area").append(response);
                    inProgress = false;
                }
              });}

       function isElementInView (el) {
               if(el == null) {
                   return;}
               var rect = el.getBoundingClientRect();
               return (
                  rect.bottom <= (window.innerHeight || document.documentElement.clientHeight)

              );}

       var debugMode = true;
       function displayError(message) {
         debugMode ? alert("Error accessing the server! " + message) : "";
        }
       function displayPHPError(error){
            displayError ("Error number :" + error.errno + "\r\n" +
            "Text :"+ error.text + "\r\n" +
            "Location :" + error.location + "\r\n" +
            "Line :" + error.line + + "\r\n");
           }

       function retrieveOnlineUserProfile() {  //will be loaded only once
           //var userloggedin = '<?php //echo $userloggedin; ?>';
           var pageName;
               pageName = "profile_online.php";
            $.ajax({
               url: pageName,
               type: "POST",
               data: {"userloggedin":userloggedin},
               cache:false,
               "success":function(data, textStatus){
                   $(".friends_online").css({"background":"white"}).html(data);

                    }
               });
            }
       function retrieveOnlineUserProfileUpdater() { //loading the green and the name
           //var userloggedin = '<?php //echo $userloggedin; ?>';
           var pageName;
               pageName = "profile_online_updater.php";
            $.ajax({
               url: pageName,
               type: "POST",
               data: {"userloggedin":userloggedin},
               cache:false,
               "success":function(response, textStatus){
                  $(".friends_onlineR").html(response);
                   setTimeout("retrieveOnlineUserProfileUpdater();", 5100);
                 }
              });
            }

       function retrieveOnlineUserNumber() { //load the number of online friend
           //var userloggedin = '<?php //echo $userloggedin; ?>';
           var pageName;
               pageName = "profile_online_number.php";
            $.ajax({
               url: pageName,
               type: "POST",
               data: {"userloggedin":userloggedin},
               cache:false,
               "success":function(data, textStatus){
                     htmlMessage = "Online "+data;
                     $(".friends_onlineT").html(htmlMessage);
                     setTimeout("retrieveOnlineUserNumber();", 2100);
                 }
              });
           }

       //for supportservice
       function retrieveOnlineAllUserProfile() {  //will be loaded only once
          // var userloggedin = '<?php //echo $userloggedin; ?>';
           var pageName;
               pageName = "profile_alluseronline.php";
            $.ajax({
               url: pageName,
               type: "POST",
               data: {"userloggedin":userloggedin},
               cache:false,
               "success":function(data, textStatus){
                   $(".users_online").css({"background":"white"}).html(data);

                    }
               });
            }
       //for support service
       function retrieveOnlineAllUserProfileUpdater() { //loading the green and the name
          // var userloggedin = '<?php //echo $userloggedin; ?>';
           var pageName;
               pageName = "profile_alluseronline_updater.php";
            $.ajax({
               url: pageName,
               type: "POST",
               data: {"userloggedin":userloggedin},
               cache:false,
               "success":function(response, textStatus){
                  $(".friends_onlineAllUsers").html(response);
                   setTimeout("retrieveOnlineAllUserProfileUpdater();", 5100);
                 }
              });
            }

         //for support service
         function retrieveAllUserOnlineUserNumber() { //load the number of online friend
           //var userloggedin = '<?php //echo $userloggedin; ?>';
           var pageName;
               pageName = "profile_alluseronline_number.php";
            $.ajax({
               url: pageName,
               type: "POST",
               data: {"userloggedin":userloggedin},
               cache:false,
               "success":function(data, textStatus){
                     htmlMessage = "Online "+data;
                     $(".friends_onlineUserCount").html(htmlMessage);
                     setTimeout("retrieveAllUserOnlineUserNumber();", 2100);
                 }
              });
           }


</script>
