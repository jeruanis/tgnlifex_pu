$(document).ready(function() {          
                                           
    $('#signup').click(function() {
        $('#first').slideUp('slow', function() {
            $('#second').slideDown('slow');
        });  
    });

    $('#signin').click(function() {
        $('#second').slideUp('slow', function() {
            $('#first').slideDown('slow');
        });  
    }); 


    /*****************************************/
         function functionAlert(msg, myYes) {
            var confirmBox = $("#confirm");
            var wrapper = $(".wrapper");
            confirmBox.find(".message").text(msg);
            confirmBox.find(".yes").unbind().click(function() {
            confirmBox.hide();
            open('registration_signup_page?=youhavesuccessfullycreatedanewaccount&uname','_self');
        });
        confirmBox.find(".yes").click(myYes);
            confirmBox.show();
            wrapper.hide();
        }
        $(document).ready(function() {
            $('#insightLife').css({'top':'20%','position':'relative'});
            $('#cannotEmpty').hide();
            $('#Signup').click(function() {
                $('#cannotEmpty').show();
                $('#insightLife').css({'top':'5%','position':'relative'});
            });
            $('#signin').click(function() {
                $('#cannotEmpty').hide();
                $('#insightLife').css({'top':'20%','position':'relative'});
            });
            $('#writeWords').hide();
            $('.read').click(function(){
               $('#writeWords').slideToggle();
               $('html').animate({
                 scrollTop: $(document).height()});
            });

        });    
    
});