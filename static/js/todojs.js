$(document).ready(function(){

          //declare global variable, input fadein and out
           $('input').fadeOut();
            $('.listTitle').on('click', function(){
                $('input').fadeIn();
                $('input').focus();
              });


          // HIGHLIGHT THE GARBAGE BIN
          $( "#trash" ).droppable({
              over: function( event, ui ) {
                $("#trash span").addClass("col");
                $(this).addClass("bor");
                $('#cancel_drag').removeClass("d-none");
              }
            });

            // REMOVE HIGHLIGHTED GARBAGE BIN
        $( "#trash" ).droppable({
              out: function( event, ui ) {
                 $("#trash span").removeClass("col");
                 $(this).removeClass("bor");
                 $('#cancel_drag').addClass("d-none");
               }
            });

        $( "#trash" ).droppable({
               drop: function(event, ui) {
                   ui.draggable.remove();
                   $("#trash span").removeClass("col");
                   $(this).removeClass("bor");
                }
            });


           $('#todoList ul li').draggable({
               revert: true,
               });

           $('.listTitle, .addItem').draggable({
                disabled: true,
                scroll: false,
                containment: "parent.parent"
               });

           $('input').keydown(function(e) {
               if(e.keyCode == 13) {
                    var item = $(this).val();
                    var day =$(this).attr('name');
                   // var username ='<?php //echo $userloggedin; ?>';

                    $(this).parent().parent().append('<li style="margin-left:24px;padding:6px 0;width:96%">' + item + '</li>');
                    $(this).val('');
                    $('input').fadeOut();

                    $.post("save_todo.php",{'day': day, 'item': item, 'username': username})
                    .done(function( data ) {
                        var audioElement = document.createElement('audio');
                        audioElement.setAttribute('src', '../../assets/sounds/when.mp3');
                        audioElement.play();
                        console.log('data', data)

                      });
                 }
            });

            $( "#trash" ).on( "drop", function( event, ui ) {
                var id = ui.draggable.attr('id');
                //var username = '<?php //echo $userloggedin; ?>';
                $.post("delete_todo.php",{id:id, username:username})
                  .done(function( data ) {
                    var audioElement = document.createElement("audio");
                    audioElement.setAttribute("src", "../../../assets/sounds/message_sent.wav");
                    audioElement.play();
                    $('#cancel_drag').addClass("d-none");

                 });
             });


       });
