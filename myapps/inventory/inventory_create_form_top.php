<?php
        $error_array = array();
        $invname="";
        if (isset($_POST['submit'])) {
            if (!$_POST["invName"]) {
                header("Location: ../../");
                exit();
            } else {
                $invname = $_POST["invName"];

                if (!preg_match("/^[a-zA-Z0-9 ]*$/", ($_POST["invName"]))) {
                    array_push($error_array, "Only letters, numbers and white space allowed for inventory name..<br>");
                } else {

                    $creator_query = mysqli_query($conn, "SELECT creator FROM inventory_con WHERE user_from = '$userloggedin'");
                    if (mysqli_num_rows($creator_query) > 0) {
                          echo'<script>
                          $(document).ready(function(){
                              $(".myInput")[0].click();
                              });
                            </script>

                           <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Notice</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <p>One inventory list is allowed for each user.</p>
                              </div>
                              <div class="modal-footer">
                                <a href="../../index" class="btn btn-primary">Close</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Button trigger modal -->
                        <input type="hidden" data-toggle="modal" data-target="#exampleModal" class="myInput"/>';

                    } else {
                        $invnamePost = ucwords($invname);
                        $invname = str_replace(' ', '_', $invname);

                        $first_invname = $invname;
                        $invname_query=mysqli_query($conn, "SELECT inventory_name FROM inventory_con WHERE inventory_name='$invname'");
                        $i=0;
                        while (mysqli_num_rows($invname_query) !=0 ) {
                            $i++;
                            $invname_split=(str_split($invname, strlen($first_invname)));
                            $invname = $invname_split[0].$i;
                            $invname_query = mysqli_query($conn, "SELECT inventory_name FROM inventory_con WHERE inventory_name = '$invname'");
                        }


                        $invname = htmlspecialchars(strip_tags($invname));
                        $invname = mysqli_real_escape_string($conn, $invname);

                        $invnamePost = ucwords($invname);
                        $inTextBody = "Welcome to ".$invnamePost;
                        $inTextBody = htmlspecialchars($inTextBody);
                        $date = date("Y-m-d H:i:s");
                        $invname = str_replace(' ', '_', $invname);
                        $inventory_des_create_query = mysqli_query($conn, "INSERT INTO inventory_des VALUES ('', '$userloggedin', '$userloggedin', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$date', '$invname', '$userloggedin', ',', 'no')");

                        $inventory_con_create_query = mysqli_query($conn, "INSERT INTO inventory_con VALUES ('', '$userloggedin', '$userloggedin', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$invname', '$userloggedin', 'no', 'no')");

                        $add_inv = mysqli_query($conn, "UPDATE users SET inv_array=CONCAT(inv_array, '$invname,') WHERE username= '$userloggedin'");

                        mysqli_close($conn);
                        echo'<script>
                          $(document).ready(function(){
                              $(".myInput")[0].click();
                              });
                            </script>

                           <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New Inventory Name</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <p>Your new inventory name is: '.$invname.' </p>
                              </div>
                              <div class="modal-footer">
                                <a href="house_needs_inventory?inventory='.$invname.'" class="btn btn-primary">Close</a>
                              </div>
                            </div>
                          </div>
                        </div>
                         <!-- Button trigger modal -->
                        <input type="hidden" data-toggle="modal" data-target="#exampleModal" class="myInput"/>';
                      }
                }
            }
        }

?>
