<?php
include('../main/base.php');
include('../main/navbar.php');
include('inventory_create_form_top.php');
 ?>

  <div class="container">
    <div class="row">
      <div class="col-sm">
         <div class="card card-body">
          <div class="p-2 mb-2 text-success">
            <h5 >Inventory create form</h5>
          </div>

           <?php
              if (in_array("Only letters, numbers and white space allowed for inventory name..<br>", $error_array)) {
                  echo " <div style='color:#e5e5e5;padding: 6px;background: #bc4558;text-align: center;font-size: 21px;margin: 0 auto;';>Only letters, numbers and white space allowed for inventory name..<br></div><br>";
              } elseif (in_array("Only one inventory per user is allowed..<br>", $error_array)) {
                  echo " <div style='color:#e5e5e5;padding: 6px;background: #bc4558;text-align: center;font-size: 21px;margin: 0 auto;';>Only one inventory per user is allowed..<br></div><br>";
              }
            ?>
              <form action="" method="POST" class="form-group">
                <div class="form-group">
                  <input class="form-control"type="text" name="invName" placeholder="Enter inventory name">
                </div>
                <div class="py-2 d-flex justify-content-end">
                 <input class="btn btn-sm-block btn-info" type="submit" name="submit" placeholder="submit">
               </div>
              </form>

            </div>
      </div>
    </div>
   </div>
   </body>
   </html>
