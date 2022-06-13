 <script>

    $(document).ready(function() {
        $('#post<?php echo $id; ?>').on('click', function() {
            $.post("../../includes/form_handlers/delete_post.php?post_id=<?php echo $id; ?>&aid=<?php echo $aid; ?>");
            $(".<?php echo $id ?>").hide(300);
        });


        $('#posthide<?php echo $id; ?>').on('click', function() {
            $.post("../../includes/form_handlers/hide_post.php?post_id=<?php echo $id; ?>&aid=<?php echo $aid; ?>");
            $("#posthide<?php echo $id; ?>").text('Show in general').wrapInner("<em/>"); //how to get the text from data base in jquery
            $(".opsec<?php echo $id; ?>").hide(300);
            $(".<?php echo $id ?>").fadeOut(300);

        });


        $('#postshow<?php echo $id; ?>').on('click', function() {
            $.post("../../includes/form_handlers/show_post.php?post_id=<?php echo $id; ?>&aid=<?php echo $aid; ?>");
            $("#postshow<?php echo $id; ?>").text('Show in profile page only').wrapInner("<em/>");
            $(".opsec<?php echo $id; ?>").hide(300);
        });



        $('[data-fancybox="<?php echo $aid; ?>"]').fancybox({
          afterLoad : function(instance, current) {
          var pixelRatio = window.devicePixelRatio || 1;

          if ( pixelRatio > 1.5 ) {
            current.width  = current.width  / pixelRatio;
            current.height = current.height / pixelRatio;
            }
           }
        });


        $('[data-fancybox]').fancybox({
            protect: true
        });

    });


</script>