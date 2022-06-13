<?php

    require_once("../../../configuration/config.php");

    if(isset($_POST['gp_name']))
       $gp_name= $_POST['gp_name'];

    if(isset($_POST['gp_nameP']))
       $gp_nameP= $_POST['gp_nameP'];

     if(isset($_POST['userloggedin']))
        $userlog = $_POST['userloggedin'];

    //the counting of the if all left the group must be done before reaching here to ask if going to proceed or not, informing
    //that all the members left the group if you leave this group will be dissolved.
    if(isset($_POST['result'])) {

        if($_POST['result'] == 'true'){   //answer from bootbox

             // remove the group name from loggedin use group array
             $group_array_extract = mysqli_query($conn, "SELECT group_array FROM users WHERE username='$userlog'");
             $result = mysqli_fetch_array($group_array_extract);
             $array_res = $result['group_array'];
             $to_search = $gp_name;
             $array_explode =explode(",", $array_res);
             $a = str_replace($gp_name,"",$array_res);
             $reindexed_array = mysqli_query($conn, "UPDATE users SET group_array='$a' WHERE username='$userlog'"); //removing group concatenation


             //set the logeedin to unjoined
             $gp_nameP = htmlspecialchars($gp_nameP);
             $userloggedin = htmlspecialchars($userloggedin);
             $last_message_query  = mysqli_query($conn, "SELECT id, user_from, body, date FROM messages_group WHERE id IN (SELECT MAX(id) FROM messages_group WHERE user_from='$userlog' AND group_name='$gp_nameP' GROUP BY user_from) ORDER BY date DESC"); //getting the last id
             $res= mysqli_fetch_array($last_message_query);
             $id = $res['id'];

             $update_unjoined =mysqli_query($conn, "UPDATE messages_group SET unjoined='yes', left_group='yes' WHERE id='$id' and user_from ='$userlog'");


             // removing all the conversation
             //here there will be a checking if all the group left group is set to yes if so the delete all rows containing this group will be executed
             //feature to add about deleting the group for each member
             // that can be done by showing all the members and delete them one by one like in inventory
             //If all the members delete or left the group then the group including all the conversation will be
             //deleted

            // $all_left_the_group_query=mysqli_query($conn, "SELECT count(*) FROM messages_group WHERE group_name='$gp_nameP'");
            // $rowcount1 = mysqli_fetch_row($all_left_the_group_query);
            // $total_records1 = $rowcount1[0];
            // $current_left_the_group_query = mysqli_query($conn, "SELECT count(*) FROM messages_group WHERE group_name='$gp_nameP' AND left_group='yes'");
            // $rowcount2 = mysqli_fetch_row($all_left_the_group_query);
            // $total_records2 = $rowcount2[0];
            // if($total_records1 == $total_records2);
            //it can be prompt that all the records will be deleted do you want to proceed or cancel
                  //mysqli_query($conn, "DELETE FROM messages_group WHERE group_name='$gp_nameP'");

           }

          }















?>
