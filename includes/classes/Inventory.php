<?php

class Inventory{
    private $user_obj;
    private $conn;

    public function __construct($conn, $user){
        $this->conn = $conn;
        $this->user_obj = new User($conn, $user);
    }

    // public function __destruct(){
    //     mysqli_close($this->conn);
    // }

    public function getMostRecentUserInv($invName){
        $userloggedin = $this->user_obj->getUsername();
        $query = mysqli_query($this->conn, "SELECT user_to, user_from FROM inventory_des WHERE inventory_name = '$invName' AND user_to='$userloggedin' OR user_from='$userloggedin'");
        if (mysqli_num_rows($query) == 0) return false;
        $row = mysqli_fetch_array($query);
        $user_to = $row['user_to'];
        $user_from = $row['user_from'];
        if ($user_to != $userloggedin) return $user_to;
        else return $user_from;
        mysqli_close($this->conn);

    }

    public function getUser(){
        $userloggedin = $this->user_obj->getUsername();
        $query = mysqli_query($this->conn, "SELECT user_to, user_from FROM messages_group WHERE group_name = '$groupName' AND (user_to='$userloggedin' OR user_from='$userloggedin') ORDER BY id DESC LIMIT 1");
        $row = mysqli_fetch_array($query);
        $user_to = $row['user_to'];
        $user_from = $row['user_from'];
        return $userloggedin;
        mysqli_close($this->conn);
    }

    public function getInventory($invName){
        $str = '';
        $userloggedin = $this->user_obj->getUsername();

        $inventory_con_query = mysqli_query($this->conn, "SELECT * FROM inventory_con WHERE inventory_name = '$invName'");
        $row = mysqli_fetch_assoc($inventory_con_query);
                $inv_acon=$row['inv_acon']; $inv_bcon=$row['inv_bcon']; $inv_ccon=$row['inv_ccon']; $inv_dcon=$row['inv_dcon']; $inv_econ=$row['inv_econ']; $inv_fcon=$row['inv_fcon']; $inv_gcon=$row['inv_gcon']; $inv_hcon=$row['inv_hcon']; $inv_icon=$row['inv_icon']; $inv_jcon=$row['inv_jcon']; $inv_kcon=$row['inv_kcon']; $inv_lcon=$row['inv_lcon']; $inv_mcon=$row['inv_mcon']; $inv_ncon=$row['inv_ncon']; $inv_ocon=$row['inv_ocon']; $inv_pcon=$row['inv_pcon']; $inv_qcon=$row['inv_qcon']; $inv_rcon=$row['inv_rcon']; $inv_scon=$row['inv_scon']; $inv_tcon=$row['inv_tcon']; $inv_ucon=$row['inv_ucon']; $inv_vcon=$row['inv_vcon']; $inv_wcon=$row['inv_wcon']; $inv_xcon=$row['inv_xcon']; $inv_ycon=$row['inv_ycon']; $inv_zcon=$row['inv_zcon']; $aacon=$row['aacon']; $abcon=$row['abcon']; $accon=$row['accon']; $adcon=$row['adcon']; $aecon=$row['aecon']; $afcon=$row['afcon']; $agcon=$row['agcon']; $ahcon=$row['ahcon']; $aicon=$row['aicon']; $ajcon=$row['ajcon']; $akcon=$row['akcon']; $alcon=$row['alcon'];

        $inventory_des_query = mysqli_query($this->conn, "SELECT * FROM inventory_des WHERE inventory_name = '$invName'");
        $row1 = mysqli_fetch_assoc($inventory_des_query);
                $inv_ades=$row1['inv_ades']; $inv_bdes=$row1['inv_bdes']; $inv_cdes=$row1['inv_cdes']; $inv_ddes=$row1['inv_ddes']; $inv_edes=$row1['inv_edes']; $inv_fdes=$row1['inv_fdes']; $inv_gdes=$row1['inv_gdes']; $inv_hdes=$row1['inv_hdes']; $inv_ides=$row1['inv_ides']; $inv_jdes=$row1['inv_jdes']; $inv_kdes=$row1['inv_kdes']; $inv_ldes=$row1['inv_ldes']; $inv_mdes=$row1['inv_mdes']; $inv_ndes=$row1['inv_ndes']; $inv_odes=$row1['inv_odes']; $inv_pdes=$row1['inv_pdes']; $inv_qdes=$row1['inv_qdes']; $inv_rdes=$row1['inv_rdes']; $inv_sdes=$row1['inv_sdes']; $inv_tdes=$row1['inv_tdes']; $inv_udes=$row1['inv_udes']; $inv_vdes=$row1['inv_vdes']; $inv_wdes=$row1['inv_wdes']; $inv_xdes=$row1['inv_xdes']; $inv_ydes=$row1['inv_ydes']; $inv_zdes=$row1['inv_zdes']; $aades=$row1['aades']; $abdes=$row1['abdes']; $acdes=$row1['acdes']; $addes=$row1['addes']; $aedes=$row1['aedes']; $afdes=$row1['afdes']; $agdes=$row1['agdes']; $ahdes=$row1['ahdes']; $aides=$row1['aides']; $ajdes=$row1['ajdes']; $akdes=$row1['akdes']; $aldes=$row1['aldes']; $date=$row1['date']; $creator=$row1['creator']; $recent_user=$row1['recent_user'];

                // the one editing the inventory list
                if($recent_user == 'no'){
                  $recent_user =  $creator;
                }else{
                    $user_obj = new User($this->conn, $recent_user);
                    $recent_user = $user_obj->getFirstAndLastName();
                }

        $date = date("M / d / Y", strtotime("+8 hour", strtotime($date))) ." "." ". date("l, \a\\t g.i a", strtotime("+8 hour", strtotime($date)));

        $str ="
            <h3 class=test-body'>$invName</h3>
            <p class='text-body'>Last Time Edited: $date by <span style='color:orange;'>$recent_user</span>
            </p>
            <table border='1' cellpadding='6px' cellspacing='0' class='inv w-100'> 
            <tr>
            <th class='text-center'>Item Name</th>
            <th class='text-center'>Qty or Description</th>
            </tr><tr><td>$inv_acon</td><td>$inv_ades</td></tr><tr><td>$inv_bcon</td><td>$inv_bdes</td></tr><tr><td>$inv_ccon</td><td>$inv_cdes</td></tr><tr><td>$inv_dcon</td><td>$inv_ddes</td></tr><tr><td>$inv_econ</td><td>$inv_edes</td></tr><tr><td>$inv_fcon</td><td>$inv_fdes</td></tr><tr><td>$inv_gcon</td><td>$inv_gdes</td></tr><tr><td>$inv_hcon</td><td>$inv_hdes</td></tr><tr><td>$inv_icon</td><td>$inv_ides</td></tr><tr><td>$inv_jcon</td><td>$inv_jdes</td></tr><tr><td>$inv_kcon</td><td>$inv_kdes</td></tr><tr><td>$inv_lcon</td><td>$inv_ldes</td></tr><tr><td>$inv_mcon</td><td>$inv_mdes</td></tr><tr><td>$inv_ncon</td><td>$inv_ndes</td></tr><tr><td>$inv_ocon</td><td>$inv_odes</td></tr><tr><td>$inv_pcon</td><td>$inv_pdes</td></tr><tr><td>$inv_qcon</td><td>$inv_qdes</td></tr><tr><td>$inv_rcon</td><td>$inv_rdes</td></tr><tr><td>$inv_scon</td><td>$inv_sdes</td></tr><tr><td>$inv_tcon</td><td>$inv_tdes</td></tr><tr><td>$inv_ucon</td><td>$inv_udes</td></tr><tr><td>$inv_vcon</td><td>$inv_vdes</td></tr><tr><td>$inv_wcon</td><td>$inv_wdes</td></tr><tr><td>$inv_xcon</td><td>$inv_xdes</td></tr><tr><td>$inv_ycon</td><td>$inv_ydes</td></tr><tr><td>$inv_zcon</td><td>$inv_zdes</td></tr><tr><td>$aacon</td><td>$aades</td></tr><tr><td>$abcon</td><td>$abdes</td></tr><tr><td>$accon</td><td>$acdes</td></tr><tr><td>$adcon</td><td>$addes</td></tr><tr><td>$aecon</td><td>$aedes</td></tr><tr><td>$afcon</td><td>$afdes</td></tr><tr><td>$agcon</td><td>$agdes</td></tr><tr><td>$ahcon</td><td>$ahdes</td></tr><tr><td>$aicon</td><td>$aides</td></tr><tr><td>$ajcon</td><td>$ajdes</td></tr><tr><td>$akcon</td><td>$akdes</td></tr><tr><td>$alcon</td><td>$aldes</td>
            </tr>
            </table>";

          return ($str);
          mysqli_close($this->conn);
     }

 }

?>
