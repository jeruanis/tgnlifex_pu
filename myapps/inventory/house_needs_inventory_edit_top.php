<?php
$inventory_name = $_REQUEST['invname'];

if(isset($_POST['update'])){

   function validateFormData($formData) {
        $formData = trim( stripslashes( htmlspecialchars( strip_tags($formData), ENT_QUOTES ) ) );
        return $formData;
      }

    //for description begin
    if ($_POST["inv_ades"]){
       $inv_ades = validateFormData($_POST['inv_ades']);
    }
     $_SESSION['inv_ades'] = $inv_ades;

    if ($_POST["inv_bdes"]){
       $inv_bdes = validateFormData($_POST['inv_bdes']);
    }
     $_SESSION['inv_bdes'] = $inv_bdes;

    if($_POST["inv_cdes"]){
       $inv_cdes = validateFormData($_POST['inv_cdes']);
    }
     $_SESSION['inv_cdes'] = $inv_cdes;

    if($_POST["inv_ddes"]){
       $inv_ddes = validateFormData($_POST['inv_ddes']);
    }
    $_SESSION['inv_ddes'] = $inv_ddes;

    if ($_POST["inv_edes"]){
       $inv_edes = validateFormData($_POST['inv_edes']);
    }
    $_SESSION['inv_edes'] = $inv_edes;

    if($_POST["inv_fdes"]){
       $inv_fdes = validateFormData($_POST['inv_fdes']);
    }
    $_SESSION['inv_fdes'] = $inv_fdes;

    if ($_POST["inv_gdes"]){
       $inv_gdes = validateFormData($_POST['inv_gdes']);
    }
    $_SESSION['inv_gdes'] = $inv_gdes;

    if ($_POST["inv_hdes"]){
       $inv_hdes = validateFormData($_POST['inv_hdes']);
    }
    $_SESSION['inv_hdes'] = $inv_hdes;

    if ($_POST["inv_ides"]){
       $inv_ides = validateFormData($_POST['inv_ides']);
    }
    $_SESSION['inv_ides'] = $inv_ides;

    if($_POST["inv_jdes"]){
       $inv_jdes = validateFormData($_POST['inv_jdes']);
    }
    $_SESSION['inv_jdes'] = $inv_jdes;

    if($_POST["inv_kdes"]){
       $inv_kdes = validateFormData($_POST['inv_kdes']);
    }
    $_SESSION['inv_kdes'] = $inv_kdes;

    if ($_POST["inv_ldes"]){
       $inv_ldes = validateFormData($_POST['inv_ldes']);
    }
    $_SESSION['inv_ldes'] = $inv_ldes;

    if ($_POST["inv_mdes"]){
       $inv_mdes = validateFormData($_POST['inv_mdes']);
    }
    $_SESSION['inv_mdes'] = $inv_mdes;

    if($_POST["inv_ndes"]){
       $inv_ndes = validateFormData($_POST['inv_ndes']);
    }
    $_SESSION['inv_ndes'] = $inv_ndes;

    if($_POST["inv_odes"]){
       $inv_odes = validateFormData($_POST['inv_odes']);
     }
    $_SESSION['inv_odes'] = $inv_odes;

    if($_POST["inv_pdes"]){
       $inv_pdes = validateFormData($_POST['inv_pdes']);
    }
    $_SESSION['inv_pdes'] = $inv_pdes;

    if ($_POST["inv_qdes"]){
       $inv_qdes = validateFormData($_POST['inv_qdes']);
    }
    $_SESSION['inv_qdes'] = $inv_qdes;

    if ($_POST["inv_rdes"]){
       $inv_rdes = validateFormData($_POST['inv_rdes']);
    }
    $_SESSION['inv_rdes'] = $inv_rdes;

      if($_POST["inv_sdes"]){
       $inv_sdes = validateFormData($_POST['inv_sdes']);
    }
    $_SESSION['inv_sdes'] = $inv_sdes;

    if ($_POST["inv_tdes"]){
       $inv_tdes = validateFormData($_POST['inv_tdes']);
    }
    $_SESSION['inv_tdes'] = $inv_tdes;

    if ($_POST["inv_udes"]){
       $inv_udes = validateFormData($_POST['inv_udes']);
    }
    $_SESSION['inv_udes'] = $inv_udes;

    if($_POST["inv_vdes"]){
       $inv_vdes = validateFormData($_POST['inv_vdes']);
    }
    $_SESSION['inv_vdes'] = $inv_vdes;

    if($_POST["inv_wdes"]){
       $inv_wdes = validateFormData($_POST['inv_wdes']);
     }
    $_SESSION['inv_wdes'] = $inv_wdes;

    if($_POST["inv_xdes"]){
       $inv_xdes = validateFormData($_POST['inv_xdes']);
    }
    $_SESSION['inv_xdes'] = $inv_xdes;

    if ($_POST["inv_ydes"]){
       $inv_ydes = validateFormData($_POST['inv_ydes']);
    }
    $_SESSION['inv_ydes'] = $inv_ydes;

    if ($_POST["inv_zdes"]){
       $inv_zdes = validateFormData($_POST['inv_zdes']);
    }
    $_SESSION['inv_zdes'] = $inv_zdes;




    //desc entension
    if ($_POST["aades"]){
        $aades = validateFormData($_POST['aades']);
    }
    $_SESSION['aades'] = $aades;

    if ($_POST["abdes"]){
        $abdes = validateFormData($_POST['abdes']);
    }
    $_SESSION['abdes'] = $abdes;

    if ($_POST["acdes"]){
        $acdes = validateFormData($_POST['acdes']);
    }
    $_SESSION['acdes'] = $acdes;

    if ($_POST["addes"]){
        $addes = validateFormData($_POST['addes']);
    }
    $_SESSION['addes'] = $addes;

    if ($_POST["aedes"]){
        $aedes = validateFormData($_POST['aedes']);
    }
    $_SESSION['aedes'] = $aedes;

    if ($_POST["afdes"]){
        $afdes = validateFormData($_POST['afdes']);
    }
    $_SESSION['afdes'] = $afdes;

    if ($_POST["agdes"]){
        $agdes = validateFormData($_POST['agdes']);
    }
    $_SESSION['agdes'] = $agdes;

    if ($_POST["ahdes"]){
        $ahdes = validateFormData($_POST['ahdes']);
    }
    $_SESSION['ahdes'] = $ahdes;

    if ($_POST["aides"]){
        $aides = validateFormData($_POST['aides']);
    }
    $_SESSION['aides'] = $aides;

    if ($_POST["ajdes"]){
        $ajdes = validateFormData($_POST['ajdes']);
    }
    $_SESSION['ajdes'] = $ajdes;

    if ($_POST["akdes"]){
        $akdes = validateFormData($_POST['akdes']);
    }
    $_SESSION['akdes'] = $akdes;

    if ($_POST["aldes"]){
        $aldes = validateFormData($_POST['aldes']);
    }
    $_SESSION['aldes'] = $aldes;




//for con begin
    if ($_POST["inv_acon"]){
       $inv_acon = validateFormData($_POST['inv_acon']);
    }
     $_SESSION['inv_acon'] = $inv_acon;

    if ($_POST["inv_bcon"]){
       $inv_bcon = validateFormData($_POST['inv_bcon']);
    }
     $_SESSION['inv_bcon'] = $inv_bcon;

    if($_POST["inv_ccon"]){
       $inv_ccon = validateFormData($_POST['inv_ccon']);
    }
     $_SESSION['inv_ccon'] = $inv_ccon;

    if($_POST["inv_dcon"]){
       $inv_dcon = validateFormData($_POST['inv_dcon']);
    }
    $_SESSION['inv_dcon'] = $inv_dcon;

    if ($_POST["inv_econ"]){
       $inv_econ = validateFormData($_POST['inv_econ']);
    }
    $_SESSION['inv_econ'] = $inv_econ;

    if($_POST["inv_fcon"]){
       $inv_fcon = validateFormData($_POST['inv_fcon']);
    }
    $_SESSION['inv_fcon'] = $inv_fcon;

    if ($_POST["inv_gcon"]){
       $inv_gcon = validateFormData($_POST['inv_gcon']);
    }
    $_SESSION['inv_gcon'] = $inv_gcon;

    if ($_POST["inv_hcon"]){
       $inv_hcon = validateFormData($_POST['inv_hcon']);
    }
    $_SESSION['inv_hcon'] = $inv_hcon;

    if ($_POST["inv_icon"]){
       $inv_icon = validateFormData($_POST['inv_icon']);
    }
    $_SESSION['inv_icon'] = $inv_icon;

    if($_POST["inv_jcon"]){
       $inv_jcon = validateFormData($_POST['inv_jcon']);
    }
    $_SESSION['inv_jcon'] = $inv_jcon;

    if($_POST["inv_kcon"]){
       $inv_kcon = validateFormData($_POST['inv_kcon']);
    }
    $_SESSION['inv_kcon'] = $inv_kcon;

    if ($_POST["inv_lcon"]){
       $inv_lcon = validateFormData($_POST['inv_lcon']);
    }
    $_SESSION['inv_lcon'] = $inv_lcon;

    if ($_POST["inv_mcon"]){
       $inv_mcon = validateFormData($_POST['inv_mcon']);
    }
    $_SESSION['inv_mcon'] = $inv_mcon;

    if($_POST["inv_ncon"]){
       $inv_ncon = validateFormData($_POST['inv_ncon']);
    }
    $_SESSION['inv_ncon'] = $inv_ncon;

    if($_POST["inv_ocon"]){
       $inv_ocon = validateFormData($_POST['inv_ocon']);
     }
    $_SESSION['inv_ocon'] = $inv_ocon;

    if($_POST["inv_pcon"]){
       $inv_pcon = validateFormData($_POST['inv_pcon']);
    }
    $_SESSION['inv_pcon'] = $inv_pcon;

    if ($_POST["inv_qcon"]){
       $inv_qcon = validateFormData($_POST['inv_qcon']);
    }
    $_SESSION['inv_qcon'] = $inv_qcon;

    if ($_POST["inv_rcon"]){
       $inv_rcon= validateFormData($_POST['inv_rcon']);
    }
    $_SESSION['inv_rcon'] = $inv_rcon;

      if($_POST["inv_scon"]){
       $inv_scon = validateFormData($_POST['inv_scon']);
    }
    $_SESSION['inv_scon'] = $inv_scon;

    if ($_POST["inv_tcon"]){
       $inv_tcon = validateFormData($_POST['inv_tcon']);
    }
    $_SESSION['inv_tcon'] = $inv_tcon;

    if ($_POST["inv_ucon"]){
       $inv_ucon = validateFormData($_POST['inv_ucon']);
    }
    $_SESSION['inv_ucon'] = $inv_ucon;

    if($_POST["inv_vcon"]){
       $inv_vcon = validateFormData($_POST['inv_vcon']);
    }
    $_SESSION['inv_vcon'] = $inv_vcon;

    if($_POST["inv_wcon"]){
       $inv_wcon = validateFormData($_POST['inv_wcon']);
     }
    $_SESSION['inv_wcon'] = $inv_wcon;

    if($_POST["inv_xcon"]){
       $inv_xcon = validateFormData($_POST['inv_xcon']);
    }
    $_SESSION['inv_xcon'] = $inv_xcon;

    if ($_POST["inv_ycon"]){
       $inv_ycon = validateFormData($_POST['inv_ycon']);
    }
    $_SESSION['inv_ycon'] = $inv_ycon;

    if ($_POST["inv_zcon"]){
        $inv_zcon = validateFormData($_POST['inv_zcon']);
    }
    $_SESSION['inv_zcon'] = $inv_zcon;


    //extension of con
    if ($_POST["aacon"]){
        $aacon = validateFormData($_POST['aacon']);
    }
    $_SESSION['aacon'] = $aacon;

    if ($_POST["abcon"]){
        $abcon = validateFormData($_POST['abcon']);
    }
    $_SESSION['abcon'] = $abcon;

    if ($_POST["accon"]){
        $accon = validateFormData($_POST['accon']);
    }
    $_SESSION['accon'] = $accon;

    if ($_POST["adcon"]){
        $adcon = validateFormData($_POST['adcon']);
    }
    $_SESSION['adcon'] = $adcon;

    if ($_POST["aecon"]){
        $aecon = validateFormData($_POST['aecon']);
    }
    $_SESSION['aecon'] = $aecon;

    if ($_POST["afcon"]){
        $afcon = validateFormData($_POST['afcon']);
    }
    $_SESSION['afcon'] = $afcon;

    if ($_POST["agcon"]){
        $agcon = validateFormData($_POST['agcon']);
    }
    $_SESSION['agcon'] = $agcon;

    if ($_POST["ahcon"]){
        $ahcon = validateFormData($_POST['ahcon']);
    }
    $_SESSION['ahcon'] = $ahcon;

    if ($_POST["aicon"]){
        $aicon = validateFormData($_POST['aicon']);
    }
    $_SESSION['aicon'] = $aicon;

    if ($_POST["ajcon"]){
        $ajcon = validateFormData($_POST['ajcon']);
    }
    $_SESSION['ajcon'] = $ajcon;

    if ($_POST["akcon"]){
        $akcon = validateFormData($_POST['akcon']);
    }
    $_SESSION['akcon'] = $akcon;

    if ($_POST["alcon"]){
        $alcon = validateFormData($_POST['alcon']);
    }
    $_SESSION['alcon'] = $alcon;

     $date = date("Y-m-d H:i:s");

    $update_query_des = mysqli_query($conn, "UPDATE inventory_des SET inv_ades='$inv_ades', inv_bdes='$inv_bdes', inv_cdes='$inv_cdes', inv_ddes='$inv_ddes', inv_edes='$inv_edes', inv_fdes='$inv_fdes', inv_gdes='$inv_gdes', inv_hdes='$inv_hdes', inv_ides='$inv_ides', inv_jdes='$inv_jdes', inv_kdes='$inv_kdes', inv_ldes='$inv_ldes', inv_mdes='$inv_mdes', inv_ndes='$inv_ndes', inv_odes='$inv_odes', inv_pdes='$inv_pdes', inv_qdes='$inv_qdes', inv_rdes='$inv_rdes', inv_sdes='$inv_sdes', inv_tdes='$inv_tdes', inv_udes='$inv_udes', inv_vdes='$inv_vdes', inv_wdes='$inv_wdes', inv_xdes='$inv_xdes', inv_ydes='$inv_ydes', inv_zdes='$inv_zdes',
    aades='$aades', abdes='$abdes', acdes='$acdes', addes='$addes', aedes='$aedes', afdes='$afdes', agdes='$agdes', ahdes='$ahdes', aides='$aides', ajdes='$ajdes', akdes='$akdes', aldes='$aldes', date='$date', recent_user='$userloggedin' WHERE inventory_name='$inventory_name'");

    $update_query_con = mysqli_query($conn, "UPDATE inventory_con SET inv_acon='$inv_acon', inv_bcon='$inv_bcon', inv_ccon='$inv_ccon', inv_dcon='$inv_dcon', inv_econ='$inv_econ', inv_fcon='$inv_fcon', inv_gcon='$inv_gcon', inv_hcon='$inv_hcon', inv_icon='$inv_icon', inv_jcon='$inv_jcon', inv_kcon='$inv_kcon', inv_lcon='$inv_lcon', inv_mcon='$inv_mcon', inv_ncon='$inv_ncon', inv_ocon='$inv_ocon', inv_pcon='$inv_pcon', inv_qcon='$inv_qcon', inv_rcon='$inv_rcon', inv_scon='$inv_scon', inv_tcon='$inv_tcon', inv_ucon='$inv_ucon', inv_vcon='$inv_vcon', inv_wcon='$inv_wcon', inv_xcon='$inv_xcon', inv_ycon='$inv_ycon', inv_zcon='$inv_zcon', aacon='$aacon', abcon='$abcon', accon='$accon', adcon='$adcon', aecon='$aecon', afcon='$afcon', agcon='$agcon', ahcon='$ahcon', aicon='$aicon', ajcon='$ajcon', akcon='$akcon', alcon='$alcon' WHERE inventory_name='$inventory_name'");


    $user_friend_query = mysqli_query($conn, "SELECT creator, member_array FROM inventory_des WHERE inventory_name='$inventory_name'");
    $user_array = mysqli_fetch_array($user_friend_query);
    $creator = $user_array['creator'];
    $num_friends = (substr_count($user_array['member_array'], ",")) - 1;
    $friendsList = $user_array['member_array'];
    $friendsList2 = explode(",", $friendsList);

    $returned_id = mysqli_insert_id($conn);
      for ($i = 1;$i <= $num_friends;$i++) {
         if($friendsList2[$i]==$userloggedin)
            $friendsList2[$i]=$creator;

         $notifications->insertNotification($inventory_name, $friendsList2[$i], 'inv_update');
       }

      header("Location: house_needs_inventory?inventory=".$inventory_name);
      exit;


}

   $inventory_query = mysqli_query($conn, "SELECT * FROM inventory_con WHERE inventory_name='$inventory_name'");
   $row = mysqli_fetch_assoc($inventory_query);
    $inv_acon = $row['inv_acon'];
    $inv_bcon = $row['inv_bcon'];
    $inv_ccon = $row['inv_ccon'];
    $inv_dcon = $row['inv_dcon'];
    $inv_econ = $row['inv_econ'];
    $inv_fcon = $row['inv_fcon'];
    $inv_gcon = $row['inv_gcon'];
    $inv_hcon = $row['inv_hcon'];
    $inv_icon = $row['inv_icon'];
    $inv_jcon = $row['inv_jcon'];
    $inv_kcon = $row['inv_kcon'];
    $inv_lcon = $row['inv_lcon'];
    $inv_mcon = $row['inv_mcon'];
    $inv_ncon = $row['inv_ncon'];
    $inv_ocon = $row['inv_ocon'];
    $inv_pcon = $row['inv_pcon'];
    $inv_qcon = $row['inv_qcon'];
    $inv_rcon = $row['inv_rcon'];
    $inv_scon = $row['inv_scon'];
    $inv_tcon = $row['inv_tcon'];
    $inv_ucon = $row['inv_ucon'];
    $inv_vcon = $row['inv_vcon'];
    $inv_wcon = $row['inv_wcon'];
    $inv_xcon = $row['inv_xcon'];
    $inv_ycon = $row['inv_ycon'];
    $inv_zcon = $row['inv_zcon'];

    $aacon = $row['aacon'];
    $abcon = $row['abcon'];
    $accon = $row['accon'];
    $adcon = $row['adcon'];
    $aecon = $row['aecon'];
    $afcon = $row['afcon'];
    $agcon = $row['agcon'];
    $ahcon = $row['ahcon'];
    $aicon = $row['aicon'];
    $ajcon = $row['ajcon'];
    $akcon = $row['akcon'];
    $alcon = $row['alcon'];
//for con end

   $inventory_query_des = mysqli_query($conn, "SELECT * FROM inventory_des WHERE inventory_name='$inventory_name'");
   $row = mysqli_fetch_assoc($inventory_query_des);
    $inv_ades = $row['inv_ades'];
    $inv_bdes = $row['inv_bdes'];
    $inv_cdes = $row['inv_cdes'];
    $inv_ddes = $row['inv_ddes'];
    $inv_edes = $row['inv_edes'];
    $inv_fdes = $row['inv_fdes'];
    $inv_gdes = $row['inv_gdes'];
    $inv_hdes = $row['inv_hdes'];
    $inv_ides = $row['inv_ides'];
    $inv_jdes = $row['inv_jdes'];
    $inv_kdes = $row['inv_kdes'];
    $inv_ldes = $row['inv_ldes'];
    $inv_mdes = $row['inv_mdes'];
    $inv_ndes = $row['inv_ndes'];
    $inv_odes = $row['inv_odes'];
    $inv_pdes= $row['inv_pdes'];
    $inv_qdes = $row['inv_qdes'];
    $inv_rdes = $row['inv_rdes'];
    $inv_sdes = $row['inv_sdes'];
    $inv_tdes = $row['inv_tdes'];
    $inv_udes = $row['inv_udes'];
    $inv_vdes = $row['inv_vdes'];
    $inv_wdes = $row['inv_wdes'];
    $inv_xdes= $row['inv_xdes'];
    $inv_ydes = $row['inv_ydes'];
    $inv_zdes = $row['inv_zdes'];

    $aades = $row['aades'];
    $abdes = $row['abdes'];
    $acdes = $row['acdes'];
    $addes = $row['addes'];
    $aedes = $row['aedes'];
    $afdes = $row['afdes'];
    $agdes = $row['agdes'];
    $ahdes = $row['ahdes'];
    $aides = $row['aides'];
    $ajdes = $row['ajdes'];
    $akdes = $row['akdes'];
    $aldes = $row['aldes'];


    $inv_query = mysqli_query($conn, "SELECT inv_array FROM users WHERE username = '$userloggedin'");
    $user_array = mysqli_fetch_array($inv_query);

    $num_inv = (substr_count($user_array['inv_array'], ","))-1;
    $invList =  $user_array['inv_array'];
    $invList2 = explode("," ,$invList);
    if(array_search($inventory_name, $invList2, true) == false){
        header('Location: ../../');
     }


?>
