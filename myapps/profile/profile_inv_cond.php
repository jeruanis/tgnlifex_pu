<?php
 if ($inv_name != ''){
  $inv_creator_query = mysqli_query($conn, "SELECT creator FROM inventory_des WHERE inventory_name='$inv_name'");
        $row = mysqli_fetch_assoc($inv_creator_query);
        $crtor = $row['creator'];

        if($userloggedin == $crtor){
          if($username != $userloggedin && $inv_name != ""){
            $inv_nameMod = str_replace('_', ' ', $inv_name);
            $inv_nameMod = ucwords($inv_nameMod);

            $logged_in_user_obj = new User($conn, $userloggedin);
            if($logged_in_user_obj->isFriend($username)){
            $inv_query = mysqli_query($conn, "SELECT member_array FROM inventory_des WHERE inventory_name = '$inv_name'");
            $user_array = mysqli_fetch_array($inv_query);
            $num_inv = (substr_count($user_array['member_array'], ","))-1;
            $invList =  $user_array['member_array'];
            $invList2 = explode("," ,$invList);

            if(array_search($username, $invList2, true) == false){
                echo
                    '<form action="" method="POST">
                    <input type="submit" name="addTOinv" value="ADD TO '.$inv_nameMod.'" style="font-size: 18px;padding: 12px;" class="btn btn-sm btn-outline-info">
                    </form>';

                }else{
                    echo
                      '<p class="mt-2">'.ucwords($username).' is already a member of '.$inv_nameMod.'</p>';

                    echo
                    '<form action="" method="POST">
                    <input type="submit" name="delTOinv" value="DELETE FROM '.$inv_nameMod.' ?" style="font-size: 18px;padding: 12px;" class="btn btn-sm btn-outline-info">
                    </form>';
                  }
             }else{ ?>

                <script>
                  $(document).ready(function(){
                       $('#myInput').click();
                   });
                </script>
              <?php  echo'<div class="modal" tabindex="-1" role="dialog" id="myModal">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Notice</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>You should be friends in order to make him added in the members list.</p>
                      </div>
                      <div class="modal-footer">
                        <a href="'.$username.'" class="btn btn-primary">Close</a>
                      </div>
                    </div>
                  </div>
                </div>'; ?>
                <input type="hidden" data-toggle="modal" data-target="#myModal" id="myInput"/>
          <?php   }

          }
       }
 }
  ?>
