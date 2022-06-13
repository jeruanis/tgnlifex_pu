<?php


       if(in_array("<span style='color:#14c800'>You are all set! Go ahead and login!</span><br>", $error_array)){
          echo'
              <script>
                $(document).ready(function(){
                     $("#myInput").click();
                 });
              </script>
              <div class="modal" tabindex="-1" role="dialog" id="myModal">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Success</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>You are all set! Go ahead and login. Your username is <span style="color:magenta">'.$_SESSION['username'].'</span></p>
                  </div>
                  <div class="modal-footer">
                    <a href="registration_signup_page" class="btn btn-primary">Ok</a>
                  </div>
                </div>
              </div>
            </div>
            <input type="hidden" data-toggle="modal" data-target="#myModal" id="myInput"/>';
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
