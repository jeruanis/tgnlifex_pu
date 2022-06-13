
$(document).ready(function(){
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

// index bullet. need to be called
const bullet_slide = (user)=>{
  let login = user;
  let n = document.querySelectorAll(".lr");
  let o = document.querySelectorAll(".cov");
  let p = document.querySelectorAll(".con");
  if(login != ''){
    n.forEach(function(n){
      n.style.display = 'none';
    });
  }

  let w=100;
  o.forEach(function(o){
    o.classList.add("p-2", "py-3", "mb-2", "rounded");
    o.style.width=w+'%';
    w-=8;
    o.style.hover
  });

  p.forEach(function(p){
    p.classList.add("text-light", "pr-2");
  });
}
// footer msg and notification
const msg_and_notif = (user) => {
  let url = window.location.pathname;
  let filename = url.substring(url.lastIndexOf('/')+1);
  let userloggedin = user
  let inner_height = $('.dropdown_data_window').innerHeight();
  let scroll_top = $('.dropdown_data_window').scrollTop();
  let page = $('.dropdown_data_window').find('.nextPageDropdownData').val();
  let noMoreData = $('.dropdown_data_window').find('.noMoreDropdownData').val();
  let urla;

  if (filename == 'index' ) {
     urla =  "includes/handlers/";
  }else{
     urla =  "../../includes/handlers/";
  }

  if ((scroll_top + inner_height >= $('.dropdown_data_window')[0].scrollHeight) && noMoreData == 'false') {

      var pageName;
      var type = $('#dropdown_data_type').val();

      if(type == 'notification'){
         if (filename == 'index' ) {
           pageName = "ajax_load_notifications_non_myapps.php";
      }else{
           pageName = "ajax_load_notifications.php";
        }
      }else if(type == 'message'){
          if (filename == 'index' ) {
         pageName = "ajax_load_messages_non_myapps.php";
      }else{
         pageName = "ajax_load_messages.php";
        }
         }

      let ajaxReq = $.ajax({
          url: urla + pageName,
          type: "POST",
          data: "page=" + page + "&userloggedin=" + userloggedin,
          cache:false,

          success: function(response) {
              $('.dropdown_data_window').find('.nextPageDropdownData').remove();
              $('.dropdown_data_window').find('.noMoreDropdownData').remove();
              $('.dropdown_data_window').append(response);
          }
      });

  }
  return false;
}
// footer orientation in footer_index
const footer_orientation = ()=>{
  if(window.matchMedia("(min-width:600px)").matches){
   let div_c = document.getElementById('c');
   div_c.classList.add('text-center');
   div_c.classList.remove('col-sm-12');
   let div_l = document.getElementById('l');
   div_l.classList.add('text-right');
   div_l.classList.remove('col-sm-12');
   $("footer").css({"bottom":"0","width":"100%"})

  }else{
   let div_c = document.getElementById('c');
   div_c.classList.remove('text-center');
   div_c.classList.add('col-sm-12');
   let div_l = document.getElementById('l');
   div_l.classList.remove('text-right');
   div_l.classList.add('col-sm-12');
  }
}
// group_loader outise copy
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
// inventory_group loader outside
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

function getDropdownData(user, type) {
    if ($(".dropdown_data_window").css("height") == "0px") {
        var pageName;
        if (type == "notifications") {
            pageName = "ajax_load_notifications_non_myapps.php";
            $("span").remove("#unread_notifications")
        } else if (type == "message") {
            pageName = "ajax_load_messages_non_myapps.php";
            $("span").remove("#unread_message")
        }
        var ajaxreq = $.ajax({
            url: "includes/handlers/" + pageName,
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
                    margin: "0 0 0 -104px"
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
