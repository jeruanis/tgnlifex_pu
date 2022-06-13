
<?php $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
     if($curPageName == 'messages.php' || $curPageName == 'todo.php' || $curPageName == 'messages_group.php' || $curPageName == 'community.php'){
           if($userloggedin == 'support-service'){ ?>
             <body style='background:#f8f8f8'>
           <?php }else{ ?>
       <script>
           if(window.matchMedia("(max-width:600px)").matches){
              var txt = "<body>";
              $("html").append(txt);
           }else{
              var y = isBrave();
              if(y == true){
                    alert('Brave browser is not supported for messaging and todo pages');
                    window.location.href = 'https://www.tgnlife.com';
                 }else{
                     var txt = "<body oncontextmenu='return false;' style='background:#f8f8f8'>";
                      window.onload = function() {
                        document.addEventListener("contextmenu", function(e){
                          e.preventDefault();
                        }, false);
                        document.addEventListener("keydown", function(e) {
                          if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
                            disabledEvent(e);
                          }
                          if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
                            disabledEvent(e);
                          }
                          if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
                            disabledEvent(e);
                          }
                          if (e.ctrlKey && e.keyCode == 85) {
                            disabledEvent(e);
                          }
                          if (event.keyCode == 123) {
                            disabledEvent(e);
                          }
                        }, false);

                        function disabledEvent(e){
                          if (e.stopPropagation){
                            e.stopPropagation();
                           } else if (window.event){
                            window.event.cancelBubble = true;
                           }
                          e.preventDefault();
                          return false;
                        }
                      }
                   }

              function isBrave() {
                if (window.navigator.brave != undefined) {
                  if (window.navigator.brave.isBrave.name == "isBrave") {
                    return true;
                  } else {
                    return false;
                  }
                 } else {
                  return false;
                    }
                  }
              }

       </script>
    <?php
        }
       }else{
         include('../../body.php');
      }
   }else{
      echo"<body style='background:#f8f8f8'>";
    }

?>
<div id='inv-delete-alert'></div>
