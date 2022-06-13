

$(document).ready(function(){
    $("#bot1").on('submit', function(e){
      var user_to ='<?php echo $user_to; ?>';
      var gif = 'busy.gif';
      var mode = 'IconSend';
      var userloggedin ='<?php echo $userloggedin; ?>';
      $.ajax({
        url: 'messages_refresher.php',
        type: "POST",
        data: {"user_to": user_to, "userloggedin":userloggedin, "mode":mode, "id": lastMessageID, 'gif': gif},
        cache:false,
            error: function(xhr, textStatus, errorThrown) {
             displayError(textStatus);
             },
        "success":function(response, textStatus){
                if(response.errno != null)
                     displayPHPError(response);
                 else{}


             }
          });
        e.preventDefault();
     });
    $("#bot2").on('submit', function(e){
      var user_to ='<?php echo $user_to; ?>';
      var gif = '4-snowmen-animated.gif';
      var mode = 'IconSend';
      var userloggedin ='<?php echo $userloggedin; ?>';
      $.ajax({
        url: 'messages_refresher.php',
        type: "POST",
        data: {"user_to": user_to, "userloggedin":userloggedin, "mode":mode, "id": lastMessageID, 'gif': gif},
        cache:false,
            error: function(xhr, textStatus, errorThrown) {
             displayError(textStatus);
             },
        "success":function(response, textStatus){
                if(response.errno != null)
                     displayPHPError(response);
                 else{}


             }
          });
        e.preventDefault();
     });
    $("#bot4").on('submit', function(e){
      var user_to ='<?php echo $user_to; ?>';
      var gif = 'christmas-tree-flashing-stars.gif';
      var mode = 'IconSend';
      var userloggedin ='<?php echo $userloggedin; ?>';
      $.ajax({
        url: 'messages_refresher.php',
        type: "POST",
        data: {"user_to": user_to, "userloggedin":userloggedin, "mode":mode, "id": lastMessageID, 'gif': gif},
        cache:false,
            error: function(xhr, textStatus, errorThrown) {
             displayError(textStatus);
             },
        "success":function(response, textStatus){
                if(response.errno != null)
                     displayPHPError(response);
                 else{}


             }
          });
        e.preventDefault();
     });
    $("#bot5").on('submit', function(e){
      var user_to ='<?php echo $user_to; ?>';
      var gif = 'happybirthday.gif';
      var mode = 'IconSend';
      var userloggedin ='<?php echo $userloggedin; ?>';
      $.ajax({
        url: 'messages_refresher.php',
        type: "POST",
        data: {"user_to": user_to, "userloggedin":userloggedin, "mode":mode, "id": lastMessageID, 'gif': gif, 'gif': gif},
        cache:false,
            error: function(xhr, textStatus, errorThrown) {
             displayError(textStatus);
             },
        "success":function(response, textStatus){
                if(response.errno != null)
                     displayPHPError(response);
                 else{}


             }
          });
        e.preventDefault();
     });
    $("#bot6").on('submit', function(e){
      var user_to ='<?php echo $user_to; ?>';
      var gif = 'coffeetime.gif';
      var mode = 'IconSend';
      var userloggedin ='<?php echo $userloggedin; ?>';
      $.ajax({
        url: 'messages_refresher.php',
        type: "POST",
        data: {"user_to": user_to, "userloggedin":userloggedin, "mode":mode, "id": lastMessageID, 'gif': gif},
        cache:false,
            error: function(xhr, textStatus, errorThrown) {
             displayError(textStatus);
             },
        "success":function(response, textStatus){
                if(response.errno != null)
                     displayPHPError(response);
                 else{}


             }
          });
        e.preventDefault();
     });
    $("#bot10").on('submit', function(e){
      var user_to ='<?php echo $user_to; ?>';
      var gif = 'reading.gif';
      var mode = 'IconSend';
      var userloggedin ='<?php echo $userloggedin; ?>';
      $.ajax({
        url: 'messages_refresher.php',
        type: "POST",
        data: {"user_to": user_to, "userloggedin":userloggedin, "mode":mode, "id": lastMessageID, 'gif': gif},
        cache:false,
            error: function(xhr, textStatus, errorThrown) {
             displayError(textStatus);
             },
        "success":function(response, textStatus){
                if(response.errno != null)
                     displayPHPError(response);
                else{}


             }
          });
        e.preventDefault();
     });
    $("#bot11").on('submit', function(e){
      var user_to ='<?php echo $user_to; ?>';
      var gif = 'congratulation.gif';
      var mode = 'IconSend';
      var userloggedin ='<?php echo $userloggedin; ?>';
      $.ajax({
        url: 'messages_refresher.php',
        type: "POST",
        data: {"user_to": user_to, "userloggedin":userloggedin, "mode":mode, "id": lastMessageID, 'gif': gif},
        cache:false,
            error: function(xhr, textStatus, errorThrown) {
             displayError(textStatus);
             },
        "success":function(response, textStatus){
                if(response.errno != null)
                     displayPHPError(response);
                 else{}


             }
          });
        e.preventDefault();
     });
    $("#bot12").on('submit', function(e){
      var user_to ='<?php echo $user_to; ?>';
      var gif = 'congrats2.gif';
      var mode = 'IconSend';
      var userloggedin ='<?php echo $userloggedin; ?>';
      $.ajax({
        url: 'messages_refresher.php',
        type: "POST",
        data: {"user_to": user_to, "userloggedin":userloggedin, "mode":mode, "id": lastMessageID, 'gif': gif},
        cache:false,
            error: function(xhr, textStatus, errorThrown) {
             displayError(textStatus);
             },
        "success":function(response, textStatus){
                if(response.errno != null)
                     displayPHPError(response);
                 else{}


             }
          });
        e.preventDefault();
     });
    $("#bot3").on('submit', function(e){
      var user_to ='<?php echo $user_to; ?>';
      var gif = '2019-snowman-merry-christmas-glitter.gif';
      var mode = 'IconSend';
      var userloggedin ='<?php echo $userloggedin; ?>';
      $.ajax({
        url: 'messages_refresher.php',
        type: "POST",
        data: {"user_to": user_to, "userloggedin":userloggedin, "mode":mode, "id": lastMessageID, 'gif': gif},
        cache:false,
            error: function(xhr, textStatus, errorThrown) {
             displayError(textStatus);
             },
        "success":function(response, textStatus){
                if(response.errno != null)
                     displayPHPError(response);
                 else{}


             }
          });
        e.preventDefault();
     });
    $("#bot13").on('submit', function(e){
      var user_to ='<?php echo $user_to; ?>';
      var gif = 'crylough.PNG';
      var mode = 'IconSend';
      var userloggedin ='<?php echo $userloggedin; ?>';
      $.ajax({
        url: 'messages_refresher.php',
        type: "POST",
        data: {"user_to": user_to, "userloggedin":userloggedin, "mode":mode, "id": lastMessageID, 'gif': gif},
        cache:false,
            error: function(xhr, textStatus, errorThrown) {
             displayError(textStatus);
             },
        "success":function(response, textStatus){
                if(response.errno != null)
                     displayPHPError(response);
                else{}


             }
          });
        e.preventDefault();
     });
    $("#bot14").on('submit', function(e){
      var user_to ='<?php echo $user_to; ?>';
      var gif = 'dizzzysmile.PNG';
      var mode = 'IconSend';
      var userloggedin ='<?php echo $userloggedin; ?>';
      $.ajax({
        url: 'messages_refresher.php',
        type: "POST",
        data: {"user_to": user_to, "userloggedin":userloggedin, "mode":mode, "id": lastMessageID, 'gif': gif},
        cache:false,
            error: function(xhr, textStatus, errorThrown) {
             displayError(textStatus);
             },
        "success":function(response, textStatus){
                if(response.errno != null)
                     displayPHPError(response);
                 else{}


             }
          });
        e.preventDefault();
     });
    $("#bot15").on('submit', function(e){
      var user_to ='<?php echo $user_to; ?>';
      var gif = 'lovesmile.PNG';
      var mode = 'IconSend';
      var userloggedin ='<?php echo $userloggedin; ?>';
      $.ajax({
        url: 'messages_refresher.php',
        type: "POST",
        data: {"user_to": user_to, "userloggedin":userloggedin, "mode":mode, "id": lastMessageID, 'gif': gif},
        cache:false,
            error: function(xhr, textStatus, errorThrown) {
             displayError(textStatus);
             },
        "success":function(response, textStatus){
                if(response.errno != null)
                     displayPHPError(response);
                 else{}


             }
          });
        e.preventDefault();
     });
    $("#bot16").on('submit', function(e){
      var user_to ='<?php echo $user_to; ?>';
      var gif = 'moneysmile.PNG';
      var mode = 'IconSend';
      var userloggedin ='<?php echo $userloggedin; ?>';
      $.ajax({
        url: 'messages_refresher.php',
        type: "POST",
        data: {"user_to": user_to, "userloggedin":userloggedin, "mode":mode, "id": lastMessageID, 'gif': gif},
        cache:false,
            error: function(xhr, textStatus, errorThrown) {
             displayError(textStatus);
             },
        "success":function(response, textStatus){
                if(response.errno != null)
                     displayPHPError(response);
                 else{}


             }
          });
        e.preventDefault();
     });
    $("#bot17").on('submit', function(e){
      var user_to ='<?php echo $user_to; ?>';
      var gif = 'thumbup.PNG';
      var mode = 'IconSend';
      var userloggedin ='<?php echo $userloggedin; ?>';
      $.ajax({
        url: 'messages_refresher.php',
        type: "POST",
        data: {"user_to": user_to, "userloggedin":userloggedin, "mode":mode, "id": lastMessageID, 'gif': gif},
        cache:false,
            error: function(xhr, textStatus, errorThrown) {
             displayError(textStatus);
             },
        "success":function(response, textStatus){
                if(response.errno != null)
                     displayPHPError(response);
                 else{}


             }
          });
        e.preventDefault();
     });

});
