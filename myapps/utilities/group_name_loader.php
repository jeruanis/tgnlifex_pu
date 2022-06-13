<?php if (isset($_SESSION['username'])){
    $userloggedin = $_SESSION['username'];
    $group_query = mysqli_query($conn, "SELECT group_array FROM users WHERE username = '$userloggedin'");
    $user_array = mysqli_fetch_array($group_query);
    $num_groups = (substr_count($user_array['group_array'], ","))-1;
    $groupsList =  $user_array['group_array'];
    $groupsList2 = explode("," ,$groupsList);


    for($i=1; $i<=$num_groups; $i++){
      $strLenght = strlen($groupsList2[$i]);
      if($strLenght > 20) {
         $friendsList3 = substr($groupsList2[$i], 0, 24)."...";

         $friendsList3a = ucwords(str_replace('_',' ', $friendsList3));
         if ($curPageName == 'index.php' || $curPageName == 'wob.php')
            $group_link = "<a href='myapps/group_messaging/messages_group?groupchat=".$groupsList2[$i]."' style='text-decoration:none'>$friendsList3a&nbsp;</a>";
         else
            $group_link = "<a href='../group_messaging/messages_group?groupchat=".$groupsList2[$i]."' style='text-decoration:none'>$friendsList3a&nbsp;</a>";

         $friendsList5 = "<div class='mehdiv_b".$groupsList2[$i]." main'>
           <div class='item'>"
            .$group_link.
           "</div>
           <div class='item'>
              <span class='meb".$groupsList2[$i]." float-right text-muted' title='delete'><i class='fa fa-trash' aria-hidden='true'></i></span>
            </div>
          </div>";
       echo $friendsList5;

          }else{

         $friendsList3a = ucwords(str_replace('_',' ', $groupsList2[$i]));
         if ($curPageName == 'index.php' || $curPageName == 'wob.php')
            $group_link = "<a href='myapps/group_messaging/messages_group?groupchat=".$groupsList2[$i]."' style='text-decoration:none'>$friendsList3a&nbsp;</a>";
         else
            $group_link = "<a href='../group_messaging/messages_group?groupchat=".$groupsList2[$i]."' style='text-decoration:none'>$friendsList3a&nbsp;</a>";

         $friendsList5 = "<div class='mehdiv_b".$groupsList2[$i]." main'>
           <div class='item'>"
             .$group_link.
           "</div>
            <div class='item'>
               <span class='meb".$groupsList2[$i]." float-right text-muted' title='delete'><i class='fa fa-trash' aria-hidden='true'></i></span>
            </div>

          </div>";
         echo $friendsList5;
          }
        ?>

      <script>
       $(function(){
         let url = '<?php echo $curPageName; ?>'
         if(url == 'index.php')
           url_linkg = "includes/form_handlers/delete_group.php";
         else
           url_linkg = "../../includes/form_handlers/delete_group.php";
         let gp_name = '<?php echo $groupsList2[$i].','; ?>'
         let gp_nameP = '<?php echo $groupsList2[$i]; ?>'
         let userloggedin = '<?php echo $userloggedin; ?>'
         let classname = 'mehdiv_b<?php echo $groupsList2[$i]; ?>'
         let gname=document.getElementsByClassName(classname)[0]
         gname.addEventListener('mouseover', (e) => {gname.style.background='skyblue'})
         gname.addEventListener('mouseout', (e) => {gname.style.background='white'})
         $('.meb<?php echo $groupsList2[$i]; ?>').on('click', function(){
           group_loader(gp_name, gp_nameP, userloggedin, classname, gname, url_linkg)
         })

       });
      </script>
    <?php
    }
  }?>
