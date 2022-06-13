<?php

   //this is handler for deleting inventory
    require_once("../../../configuration/config.php");

    if(isset($_POST['inv_name']) || isset($_POST['userloggedin']) || isset($_POST['result'])){
       $inv_name= $_POST['inv_name'];
       $userlog = $_POST['userloggedin'];
       $inv_nameMod= str_replace(',',"",$inv_name);

        //query first if creator or not. Diff method of deleting
        $inv_creator_query = mysqli_query($conn, "SELECT creator FROM inventory_des WHERE inventory_name='$inv_nameMod'");
        $row = mysqli_fetch_assoc($inv_creator_query);
        $crtor = $row['creator'];
        if($userlog != $crtor){

              if($_POST['result'] == 'true'){   //answer from bootbox

                     //as member deleting inventory name from users inv_array, delete as members in des records

                     $inv_array_extract = mysqli_query($conn, "SELECT inv_array FROM users WHERE username='$userlog'");
                     $result = mysqli_fetch_array($inv_array_extract);
                     $array_res = $result['inv_array'];
                     $to_search = $inv_name;
                     $array_explode =explode(",", $array_res);
                     $a = str_replace($inv_name,"",$array_res);
                     //defining the new list of inv_array
                     $reindexed_array = mysqli_query($conn, "UPDATE users SET inv_array='$a' WHERE username='$userlog'");

                     //deleting name from inventory_des member_array. not only the creator can delete the membership the username
                     //can also delete it
                     $inve_nameMod = str_replace(',','', $inv_name);
                     $mem_array_extract = mysqli_query($conn, "SELECT member_array FROM inventory_des WHERE inventory_name='$inve_nameMod'");
                     $userlogMod = $userlog.',';
                     $result = mysqli_fetch_array($mem_array_extract);
                     $array_res = $result['member_array'];
                     $to_search = $inv_name;
                     $array_explode =explode(",", $array_res);
                     $a = str_replace($userlogMod,"",$array_res);
                     //defining the new list of inv_array
                     $reindexed_array = mysqli_query($conn, "UPDATE inventory_des SET member_array='$a' WHERE inventory_name='$inve_nameMod'");


                }

         }else{

                if($_POST['result'] == 'true'){   //answer from bootbox
                      $response['message'] = array();
                      $response = array();

                      //as creator delete inventory_name from inventory list in user inve array, delete con and des records
                      //when the creator will delete the inventory he owns he must need to delete first all the members before deleting the inventory name other wise it will always exist in the user as inventory
                     // select members_array then loop from it for members inv_array to delete inventory with name $inv_name;

                     // to ustilize the inventory delete member make a not continue until they are empty
                      $inv_member_query=mysqli_query($conn, "SELECT member_array FROM inventory_des WHERE inventory_name='$inv_nameMod'");
                      $user_array=mysqli_fetch_assoc($inv_member_query);
                      $num_inv_member=(substr_count($user_array['member_array'], ","))-1;
                      $invMemList=$user_array['member_array'];
                      $invMemList2=explode("," ,$invMemList);
                      if($num_inv_member >=1){

                        $message = 'danger';
                        array_push($response, $message);
                        $message = "You cannot delete <b>" .$inv_nameMod. "</b> because members are not empty, delete them all first. Total members: ".$num_inv_member;

                        array_push($response, $message);
                        foreach($response as $value)
                            echo $value;

                      }else{

                        $inv_nameMod= str_replace(',',"",$inv_name);

                        //deleting inventory name from users inv_array
                        $inv_array_extract = mysqli_query($conn, "SELECT inv_array FROM users WHERE username='$userlog'");
                        $result = mysqli_fetch_array($inv_array_extract);
                        $array_res = $result['inv_array'];
                        $to_search = $inv_name;
                        $array_explode =explode(",", $array_res);
                        $a = str_replace($inv_name,"",$array_res);

                         //defining the new list of inv_array
                        $reindexed_array = mysqli_query($conn, "UPDATE users SET inv_array='$a' WHERE username='$userlog'");
                          //delete the inventory_des
                        $delete_inv_des_query = mysqli_query($conn, "DELETE FROM inventory_des WHERE inventory_name='$inv_nameMod'");
                          //delete the inventory_con
                        $delete_inv_con_query = mysqli_query($conn, "DELETE FROM inventory_con WHERE inventory_name='$inv_nameMod'");

                   }
               }


          }
     }//if isset end

?>
