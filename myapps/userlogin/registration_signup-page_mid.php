<?php
        if(in_array("<span style='color:#14c800'>You are all set! Go ahead and login!</span><br>", $error_array)){
           echo'<div id="backgroundDiv">
                    <div id="confirm">
                        <div class="message">Your are all set. Go ahead and Log in with your Password...</div><br>
                        <button class="yes">OK</button>
                    </div>
                  <input type="hidden" id="alertBtn" onclick="functionAlert();"/>';
            echo'<script>
                    $(document).ready(function(){
                        $("#alertBtn").click();
                    });
                 </script>';
        }

        if(isset($_GET['Fail'])) {
            if($_GET['Fail'] == "Only-letters-and-space-allowed-for-First-Name") {
                 echo "<p style='margin: 0 auto;color: red;padding: 5px;border-radius: 5pxbackground:green;border-radius: 5px;border: 1px solid lightgreen;width: 85%;background: lightgreen;font-weight: bold;text-align:center'>Only letters and space allowed for First Name</p>
                  <script>
                   $(document).ready(function() {
                        $('#first').hide();
                        $('#second').show();
                    });
                    </script>";


            }else if($_GET['Fail'] == "Only-letters-and-space-allowed-for-Last-Name") {
                   echo "<p style='margin: 0 auto;color: red;padding: 5px;border-radius: 5pxbackground:green;border-radius: 5px;border: 1px solid lightgreen;width: 85%;background: lightgreen;font-weight: bold;text-align:center'>Only letters and space allowed for Last Name</p>
                    <script>
                       $(document).ready(function() {
                            $('#first').hide();
                            $('#second').show();
                        });
                    </script>";
                }
        }
        if( isset($_POST['register_button'])){
            echo "<script>
                       $(document).ready(function(){
                            $('#first').hide();
                            $('#second').show();
                        });
                  </script>";
        }
    ?>