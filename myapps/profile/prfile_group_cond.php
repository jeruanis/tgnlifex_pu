<?php
if($username != $userloggedin && $gname != ""){
    $gnameMod = str_replace('_', ' ', $gname);
    $gnameMod = ucwords($gnameMod);

    $last_message_query  = mysqli_query($conn, "SELECT id, unjoined, left_group FROM messages_group WHERE id IN (SELECT MAX(id) FROM messages_group WHERE user_from='$userloggedin' AND group_name='$gname' GROUP BY user_from) ORDER BY date DESC");
    $res= mysqli_fetch_array($last_message_query);
    $id = $res['id'];
    $unjoined = $res['unjoined'];
    $left_group = $res['left_group'];

    if($unjoined == 'yes' || $left_group == 'yes'){
      header("Location: ../../");
      exit();
        }
    $last_message_query  = mysqli_query($conn, "SELECT id, unjoined, left_group FROM messages_group WHERE id IN (SELECT MAX(id) FROM messages_group WHERE user_from='$username' AND group_name='$gname' GROUP BY user_from) ORDER BY date DESC");
    if(mysqli_num_rows($last_message_query) > 0) {
    $res= mysqli_fetch_array($last_message_query);
    $id = $res['id'];
    $unjoined = $res['unjoined'];
    $left_group = $res['left_group'];

            if($unjoined == 'yes' && $left_group == 'yes'){
                echo
                    '<form action="" method="POST">
                    <input type="submit" name="addTOgroup" value="ADD TO '.$gnameMod.'" class="btn btn-sm btn-outline-info mb-2" style="padding: 12px;max-width:100%;border-radius:7px">
                    </form>';

              }elseif($unjoined == 'yes' || $left_group == 'yes'){
                echo
                    '<form action="" method="POST">
                    <input type="submit" name="addTOgroupRevive" value="ADD TO '.$gnameMod.'" class="btn btn-sm btn-outline-info mb-2" style="padding: 12px;max-width:100%;border-radius:7px">
                    </form>';

            }else{

                  $last_message_query  = mysqli_query($conn, "SELECT id, unjoined, left_group FROM messages_group WHERE id IN (SELECT MAX(id) FROM messages_group WHERE user_from='$username' AND group_name='$gname' GROUP BY user_from) ORDER BY date DESC");
                  if(mysqli_num_rows($last_message_query) > 0 ){
                  $res= mysqli_fetch_array($last_message_query);
                  $id = $res['id'];
                  $unjoined = $res['unjoined'];
                  $left_group = $res['left_group'];
                        if($unjoined == 'no' || $left_group == 'no'){

                                echo
                                  '<div class="btn btn-sm btn-outline-info mb-2" style="padding: 12px;max-width:100%;border-radius:7px">
                                    <p>'.ucwords($username).' is already a member of '.$gnameMod.'</p>
                                    </div>';
                          }

                      }else{
                        $member_query = mysqli_query($conn, "SELECT user_from FROM messages_group WHERE user_from = '$username' AND group_name='$gname'");
                        if(($results = mysqli_num_rows($member_query)) < 1 ){

                              echo
                                '<form action="" method="POST">
                                <input type="submit" name="addTOgroup" value="ADD TO THE GROUP '.$gnameMod.'" class="btn btn-sm btn-outline-info mb-2" style="padding: 12px;max-width:100%;border-radius:7px">
                                </form>';
                        }
                    }
                }
          }else{
            echo
                '<form action="" method="POST">
                <input type="submit" name="addTOgroup" value="ADD TO THE GROUP '.$gnameMod.'" class="btn btn-sm btn-outline-info mb-2" style="padding: 12px;max-width:100%;border-radius:7px">
                </form>';
          }

  }

  ?>
