<script>
  $(document).ready(function(){
      $.fn.toggle<?php echo $id; ?> =function() {
          var element = $('#toggleComment<?php echo $id; ?>');
          $(element).slideToggle(630);
      }

      $('.comment<?php echo $id ?>').click(function(e){
           e.stopPropagation();
          $.fn.toggle<?php echo $id; ?>();
          $('#comFrame1').fadeIn();
          $('html').animate({
               scrollTop: $(".comment<?php echo $id ?>").offset().top -200
              }, 630);

        });


      $.fn.toggleOp<?php echo $id; ?> =function() {
          var ele = $('#toggleOption<?php echo $id; ?>');
          $(ele).slideToggle(810);
      }

      $('.option<?php echo $id ?>').click(function(e){
           e.stopPropagation();
          $.fn.toggleOp<?php echo $id; ?>();
          $('.option<?php echo $id ?>').hide();
      });

      $(window).scroll(function(){
        $('.post_option').hide(810);
        $('.option<?php echo $id ?>').show();
       })

      $(document).click(function() {
        $('#toggleOption<?php echo $id; ?>').hide();
        $('.option<?php echo $id ?>').show();
       });

  });
  </script>