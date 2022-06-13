<div class='btn-group bg-white main pb-5' id='bottom'>
  <form id="icon_group_list" class="d-inline-block" action="" method="post" enctype="multipart/form-data" >
    <button type="submit" style='background:none;border:none;' id='gif2' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/4-snowmen-animated.gif'></button>
    <button type="submit" style='background:none;border:none;' id='gif4' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/christmas-tree-flashing-stars.gif'></button>
    <button type="submit" style='background:none;border:none;' id='gif5' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/happybirthday.gif'></button>
    <button type="submit" style='background:none;border:none;' id='gif6' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/coffeetime.gif'></button>
    <button type="submit" style='background:none;border:none;' id='gif10' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/reading.gif'></button>
    <button type="submit" style='background:none;border:none;' id='gif11' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/congratulation.gif'></button>
    <button type="submit" style='background:none;border:none;' id='gif12' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/congrats2.gif'></button>
    <button type="submit" style='background:none;border:none;' id='gif3' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/2019-snowman-merry-christmas-glitter.gif'></button>
    <button type="submit" style='background:none;border:none;' id='gif1' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/busy.gif'></button>
  </form>

</div>

<script>
$(function(){
    let bot_g1 = document.getElementById('gif1');
    let bot_g2 = document.getElementById('gif2');
    let bot_g3 = document.getElementById('gif3');
    let bot_g4 = document.getElementById('gif4');
    let bot_g5 = document.getElementById('gif5');
    let bot_g6 = document.getElementById('gif6');
    let bot_g10 = document.getElementById('gif10');
    let bot_g11 = document.getElementById('gif11');
    let bot_g12 = document.getElementById('gif12');
    let gif;
    let user_to =  '<?php echo $latestUser; ?>'
    let userloggedin = '<?php echo $userloggedin; ?>'
    let group_to = '<?php echo $group_to; ?>'
    let mode = 'IconSend'
    let url = 'messages_refresher_group.php'

    bot_g1.addEventListener('click', function(){
      gif  = 'busy.gif';
    });
    bot_g2.addEventListener('click', function(){
      gif  = '4-snowmen-animated.gif';
    });
    bot_g3.addEventListener('click', function(){
      gif  = '2019-snowman-merry-christmas-glitter.gif';
    });
    bot_g4.addEventListener('click', function(){
      gif  = 'christmas-tree-flashing-stars.gif';
    });
    bot_g5.addEventListener('click', function(){
      gif  = 'happybirthday.gif';
    });
    bot_g6.addEventListener('click', function(){
      gif  = 'coffeetime.gif';
    });
    bot_g10.addEventListener('click', function(){
      gif  = 'reading.gif';
    });
    bot_g11.addEventListener('click', function(){
      gif  = 'congratulation.gif';
    });
    bot_g12.addEventListener('click', function(){
       gif  = 'congrats2.gif';
    });

    $("#icon_group_list").on('submit', function(e){
        sendIcon_group(url, user_to, userloggedin, group_to, gif, mode, lastMessageID)
        e.preventDefault()
    });


});

  </script>
