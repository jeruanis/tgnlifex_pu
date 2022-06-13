$(document).ready(function() {
    $(".menu").click(function() {
        $("nav ul").toggleClass("active")
    });
    $(".button_holder").on("click", function() {
        document.search_form.submit()
    });
    $("#submit_profile_post").click(function() {
        $.ajax({
            type: "POST",
            url: "includes/handlers/ajax_submit_profile_post.php",
            data: $("form.profile_post").serialize(),
            success: function(msg) {
                $("#post_form").modal("hide");
                location.reload()
            },
            error: function() {
                alert("Failure")
            }
        })
    })


    $('.back-to-top').fadeOut();
         $(window).scroll(function() {
             var showAfter = 600;
             if ($(this).scrollTop() > showAfter ) {
                 $('.back-to-top').fadeIn();
             } else {
                 $('.back-to-top').fadeOut();
                 }

         });

         $('.back-to-top').click(function(){
             $('html, body').animate({scrollTop : 0});
         });

       if((window.location.pathname === '/tgnlifex_prod/tgn_proj/tgnlifex/myapps/community/post' || window.location.pathname === '/tgnlifex/myapps/community/post') == false){
         $(window).scroll(function() {
             $("iframe").each(function() {
                 if ($(this).visible(true)) {

                 } else {
                 jQuery(this)[0].contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*')
                     }
                 });

             $('video').each(function() {
                 if ($(this).visible(true)) {
                 } else {
                     $(this)[0].pause();
                 }
             });
         });
       }


     //make full screen functionality
      $("#normal-screen").hide();
      $("#full-screen").click(function(){
          $(".container").css({'max-width':'100%'});
          $("#normal-screen").show();
          $("#f-screen").hide();
          $(this).hide();
       });

      $("#normal-screen").click(function(){
          $(".container").css({'max-width':'960px'});
          $("#f-screen").show();
          $("#full-screen").show();
          $(this).hide();
       });

});

$(document).click(function(e) {
    if (e.target.class != "search_results" && e.target.id != "search_text_input") {
        $(".search_results").html("");
        $(".search_results_footer").html("");
        $(".search_results_footer").toggleClass("search_results_footer_empty");
        $(".search_results_footer").toggleClass("search_results_footer")
    }
    if (e.target.class != "dropdown_data_window") {
        $(".dropdown_data_window").html("");
        $(".dropdown_data_window").css({
            padding: "0",
            height: "0",
            border: "0"
        })
    }

});

function getDropdownData(user, type) {
    if ($(".dropdown_data_window").css("height") == "0px") {
        var pageName;
        if (type == "notifications") {
            pageName = "ajax_load_notifications.php";
            $("span").remove("#unread_notifications")
        } else if (type == "message") {
            pageName = "ajax_load_messages.php";
            $("span").remove("#unread_message")
        }
        var ajaxreq = $.ajax({
            url: "../../includes/handlers/" + pageName,
            type: "POST",
            data: "page=1&userloggedin=" + user,
            cache: false,
            success: function(response) {
                $(".dropdown_data_window").html(response);
                $(".dropdown_data_window").css({
                    padding: "0 6px",
                    height: "280px",
                    width: "317px",
                    position: "absolute",
                    top: "0",
                    bottom: "0",
                    transform: "translate(-16%, 28%)",
                    right: "0",
                    border: "1px solid lightgrey",
                    background: "white",
                    left: "50%",
                    margin: "0 0 0 -104px",
                });
                $("#dropdown_data_type").val(type)
            }
        })
    } else {
        $(".dropdown_data_window").html("");
        $(".dropdown_data_window").css({
            padding: "0",
            height: "0"
        })
    }
}


const messageNotif = (time=5100) => {
      $('#unread_message').load('../../myapps/utilities/messageNotification.php');
      setTimeout("messageNotif();", time);
    }

function retrieveMessageSound() {
     //var userloggedin = '<?php //echo $userloggedin; ?>';
     var pageName;
         pageName = "../myapps/profile/messaging_new_msge_sound_detect.php";
      $.ajax({
         url: pageName,
         type: "POST",
         data: {"userloggedin":userloggedin},
         cache:false,
         "success":function(data, textStatus){
             $("#audioBox").html(data);
                  setTimeout("retrieveMessageSound();", 2100);
              }
         });
      }


function getUsers(value, user) {
    $.post("includes/handlers/ajax_friend_search.php", {
        query: value,
        userloggedin: user
    }, function(data) {
        $(".results").html(data)
    })
}

function getLiveSearchUsers(value, user) {
    $.post("../../includes/handlers/ajax_search.php", {
        query: value,
        userloggedin: user
    }, function(data) {
        if ($(".search_results_footer_empty")[0]) {}
        $(".search_results").html(data);
        $(".search_results_footer").html("<a href='search.php?q=" + value + "'><p style='color: #fff;'><br>See Friend Resuls</p></a>");
        if (data == "") {
            $(".search_results_footer").html("")
        }
        $(".search_results").html(data);
        $(".search_results_footer").html("<a href='search.php?q=" + value + "'><p>See All Results</p></a>")
    })
}

function getLiveSearchUsersGroup(value, user, group) {
    $.post("../../includes/handlers/ajax_searchGroup.php", {
        query: value,
        userloggedin: user,
        group: group
    }, function(data) {
        if ($(".search_results_footer_empty")[0]) {}
        $(".search_results").html(data);
        $(".search_results_footer").html("<a href='search.php?q=" + value + "&ampgroup=" + group + "'><p style='color: #fff;'><br>See Friend Resuls</p></a>");
        if (data == "") {
            $(".search_results_footer").html("")
        }
        $(".search_results").html(data);
        $(".search_results_footer").html("<a href='search.php?q=" + value + "&ampgroup=" + group + "'><p>See All Results</p></a>")
    })
}

function getLiveSearchUsersInv(value, user, inventory) {
    $.post("../../includes/handlers/ajax_searchInventory.php", {
        query: value,
        userloggedin: user,
        inventory: inventory
    }, function(data) {
        $('#inv_search_result').html(data);
        // if ($(".search_results_footer_empty")[0]) {}
        // $(".search_results").html(data);
        // $(".search_results_footer").html("<a href='search.php?q=" + value + "&ampinve_name=" + inventory + "'><p style='color: #fff;'><br>See Friend Resuls</p></a>");
        // if (data == "") {
        //     $(".search_results_footer").html("")
        // }
        // $(".search_results").html(data);
        // $(".search_results_footer").html("<a href='search.php?q=" + value + "&ampinve_name=" + inventory + "'><p>See All Results</p></a>")
    })
}

// group_loader inside copy
const group_loader = (gp_name, gp_nameP, userloggedin, classname, gname, url_linkg) => {
  bootbox.confirm("Delete this group? You will also be tagged as left the group.", function(result){
    if(result){
      $.ajax({
        url: url_linkg,
        method: "POST",
        data: {"gp_nameP": gp_nameP, "gp_name" : gp_name , "userloggedin" : userloggedin, "result":result},
        cache:false,
        "success": function(data) {
            $(classname).fadeOut()
         }
      })
    }
  })
}
// inventory_group loader inside
const inventory_loader = (classname, gname, inv_name, inv_nameP, userloggedin, url_link_inv) => {
  bootbox.confirm("Delete "+inv_name+" inventory?", function(result){
    if(result){
      $.ajax({url: url_link_inv,
      method: "POST",
      data:{ "inv_nameP": inv_nameP, "inv_name" : inv_name , "userloggedin" : userloggedin, "result":result},
      cache:false,
      "success": function(data){
         if(data.substr(0,6) == 'danger'){
           $('#inv-delete-alert').html('<div class="alert alert-danger" role="alert">'+ data.substr(6) +'<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button></div>');
         }else{
           $(classname).fadeOut();
           $('#inv-delete-alert').html('<div class="alert alert-success" role="alert">Successfully deleted <b>' + inv_nameP + '</b><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button></div>');
         }
      }
    })
  }
  })
}
// message_icon sending function
const sendIcon = (url, user_to, gif, mode, userloggedin, lastMessageId) => {
  $.ajax({
    url: url,
    type: "POST",
    data: {"mode":mode, "user_to": user_to, "userloggedin":userloggedin, "id": lastMessageId, 'gif': gif},
    cache:false,
    "success":function(response){
        console.log(response)
       }
  });
}
// group_mesage icon
const sendIcon_group = (url, user_to, userloggedin, group_to, gif, mode, lastMessageID) => {
  $.ajax({
    url: url,
    type: "POST",
    data: {"user_to": user_to, "userloggedin":userloggedin, "group_to" : group_to, "mode":mode, "id": lastMessageID, "gif":gif},
    cache:false,
    success:function(response, textStatus){
        console.log(response)
      }
    });
   }

   
