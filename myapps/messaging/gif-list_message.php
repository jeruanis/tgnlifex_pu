<div class='btn-group bg-white main py-3' id='bottom'>
  <form id="icon_list" class="d-inline-block" action="" method="post" enctype="multipart/form-data">
    <button type="submit" style='background:none;border:none;' id='gif1' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/busy.gif'></button>
    <button type="submit" style='background:none;border:none;' id='gif2' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/4-snowmen-animated.gif'></button>
    <button type="submit" style='background:none;border:none;' id='gif3' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/2019-snowman-merry-christmas-glitter.gif'></button>
    <button type="submit" style='background:none;border:none;' id='gif4' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/christmas-tree-flashing-stars.gif'></button>
    <button type="submit" style='background:none;border:none;' id='gif5' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/happybirthday.gif'></button>
    <button type="submit" style='background:none;border:none;' id='gif6' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/coffeetime.gif'></button>
    <button type="submit" style='background:none;border:none;' id='gif10' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/reading.gif'></button>
    <button type="submit" style='background:none;border:none;' id='gif11' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/congratulation.gif'></button>
    <button type="submit" style='background:none;border:none;' id='gif12' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/congrats2.gif'></button>

     <!-- chritstmas gifs -->
    <button type="submit" style='background:none;border:none;' id='gif13' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/christmas-wreath1.gif'></button>
    <button type="submit" style='background:none;border:none;' id='gif14' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/christmas-wreath2.gif'></button>
    <button type="submit" style='background:none;border:none;' id='gif15' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/merry-christmas1.gif'></button>
    <button type="submit" style='background:none;border:none;' id='gif16' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/merry-christmas2.gif'></button>

    <button type="submit" style='background:none;border:none;' id='gif18' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/merry-christmas4.gif'></button>
    <button type="submit" style='background:none;border:none;' id='gif19' class='item-gif'><img width='50' height='50' src='../../../assets/images/icon/merry-christmas5.gif'></button>
  </form>

</div>

<script>

$(function(){
    let bot1 = document.getElementById('gif1');
    let bot2 = document.getElementById('gif2');
    let bot3 = document.getElementById('gif3');
    let bot4 = document.getElementById('gif4');
    let bot5 = document.getElementById('gif5');
    let bot6 = document.getElementById('gif6');
    let bot10 = document.getElementById('gif10');
    let bot11 = document.getElementById('gif11');
    let bot12 = document.getElementById('gif12');
    let bot13 = document.getElementById('gif13');
    let bot14 = document.getElementById('gif14');
    let bot15 = document.getElementById('gif15');
    let bot16 = document.getElementById('gif16');
    // var bot17 = document.getElementById('gif17');
    let bot18 = document.getElementById('gif18');
    let bot19 = document.getElementById('gif19');

    let user_to ='<?php echo $user_to; ?>';
    let gif;
    let mode = 'IconSend';
    let userloggedin ='<?php echo $userloggedin; ?>';
    let url = 'messages_refresher.php';

    bot1.addEventListener('click', function(){
      gif  = 'busy.gif';
    });
    bot2.addEventListener('click', function(){
      gif  = '4-snowmen-animated.gif';
    });
    bot3.addEventListener('click', function(){
      gif  = '2019-snowman-merry-christmas-glitter.gif';
    });
    bot4.addEventListener('click', function(){
      gif  = 'christmas-tree-flashing-stars.gif';
    });
    bot5.addEventListener('click', function(){
      gif  = 'happybirthday.gif';
    });
    bot6.addEventListener('click', function(){
      gif  = 'coffeetime.gif';
    });
    bot10.addEventListener('click', function(){
      gif  = 'reading.gif';
    });
    bot11.addEventListener('click', function(){
      gif  = 'congratulation.gif';
    });
    bot12.addEventListener('click', function(){
       gif  = 'congrats2.gif';
    });
    bot13.addEventListener('click', function(){
       gif  = 'christmas-wreath1.gif';
    });
    bot14.addEventListener('click', function(){
       gif  = 'christmas-wreath2.gif';
    });
    bot15.addEventListener('click', function(){
       gif  = 'merry-christmas1.gif';
    });
    bot16.addEventListener('click', function(){
       gif  = 'merry-christmas2.gif';
    });
    bot18.addEventListener('click', function(){
       gif  = 'merry-christmas4.gif';
    });
    bot19.addEventListener('click', function(){
       gif  = 'merry-christmas5.gif';
    });

    $("#icon_list").on('submit', function(e){
        sendIcon(url, user_to, gif, mode, userloggedin, lastMessageId)
        e.preventDefault()
    });


  });


  </script>
