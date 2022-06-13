<?php if (isset($_SESSION['username']))
{

    $userloggedin = $_SESSION['username'];
    $inv_query = mysqli_query($conn, "SELECT inv_array FROM users WHERE username='$userloggedin'");
    $user_array = mysqli_fetch_array($inv_query);
    $num_inv = (substr_count($user_array['inv_array'], ",")) - 1;
    $invList = $user_array['inv_array'];
    $invList2 = explode(",", $invList);
    for ($i = 1;$i <= $num_inv;$i++){
        $strLenght = strlen($invList2[$i]);
        if ($strLenght > 21){
            $invList3 = substr($invList2[$i], 0, 24) . "...";
            $invList3a = ucwords(str_replace('_', ' ', $invList3));
            if ($curPageName == 'index.php' || $curPageName == 'wob.php' || $curPageName == 'index_home.php')
               $inventory_link = "<a href='myapps/inventory/house_needs_inventory?inventory=" . $invList2[$i] . "' style='text-decoration:none'>$invList3a
               </a>";
            else
              $inventory_link = "<a id='inv' href='../inventory/house_needs_inventory?inventory=" . $invList2[$i] . "' style='text-decoration:none'>$invList3a
              </a>";

            $invList5 = "<div class='mehdiv_b" . $invList2[$i] . " main'>
            <div class='item'>"
               .$inventory_link.
             "</div>
             <div class='item'>
               <span class='meb" . $invList2[$i] . " float-right text-muted' title='delete'><i class='fa fa-trash' aria-hidden='true'></i></span>
             </div>
            </div>";
           echo $invList5;
        }else{

            $invList3a = ucwords(str_replace('_', ' ', $invList2[$i]));
            if ($curPageName == 'index.php' || $curPageName == 'wob.php' || $curPageName == 'index_home.php')
               $inventory_link = "<a href='myapps/inventory/house_needs_inventory?inventory=" . $invList2[$i] . "' style='text-decoration:none'>$invList3a
               </a>";
            else
              $inventory_link = "<a id='inv' href='../inventory/house_needs_inventory?inventory=" . $invList2[$i] . "' style='text-decoration:none'>$invList3a
              </a>";

            $invList5 = "<div class='mehdiv_b" . $invList2[$i] . " main'>
             <div class='item'>"
                .$inventory_link.
              "</div>
              <div class='item'>
                <span class='meb" . $invList2[$i] . " float-right text-muted' title='delete'><i class='fa fa-trash' aria-hidden='true'></i></span>
              </div>
            </div>";
             echo $invList5;
        } ?>

        <script>
        $(document).ready(function(){
          let url = '<?php echo $curPageName; ?>'
          if(url == 'index.php')
            url_link_inv = "includes/form_handlers/delete_inventory.php";
          else
            url_link_inv = "../../includes/form_handlers/delete_inventory.php";
          let classname = "mehdiv_b<?php echo $invList2[$i]; ?>";
          let gname=document.getElementsByClassName(classname)[0];
          let inv_name='<?php echo $invList2[$i] . ','; ?>'
          let inv_nameP='<?php echo $invList2[$i]; ?>'
          let userloggedin='<?php echo $userloggedin; ?>'
          gname.addEventListener('mouseover', (e) => {gname.style.background='skyblue'});
          gname.addEventListener('mouseout', (e) => {gname.style.background='white'});
          $('.meb<?php echo $invList2[$i]; ?>').on('click', function(){
            inventory_loader(classname, gname, inv_name, inv_nameP, userloggedin, url_link_inv)
          })

        });
    </script>
  <?php
    }
} ?>
