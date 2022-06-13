<?php
   define('DEBUG', false);
    error_reporting(E_ALL);
    if (DEBUG)
    {
        ini_set('display_errors', 'On');
    }
    else
    {
        ini_set('display_errors', 'Off');
    }

   include('../main/base.php');
   include('../main/navbar.php');
   $inventory_to = $_REQUEST['inventory'];

  ?>

<center>

    <div class="container">

      <div class="col-sm">

        <div class="card card-body">
          <form class="form-group" action="../utilities/search" method="GET" name="search_form" style="border: none;display: inline-block;">

          <span class="se-ico"></span>

            <div class="form-group">

              <input class="form-control" type="text" onkeyup="getLiveSearchUsersInv(this.value,'<?php echo $userloggedin; ?>','<?php echo $inventory_to; ?>')" name="q" placeholder="Search username here" autocomplete="off" id="search_text_input" style='width:100%;'>
              <input type="hidden" name="inventory" value="<?php echo $inventory_to; ?>">

            </div>

          </form>

          <div class="search_results gp_search_rightMost" style="z-index:3;margin-top:-9px"></div><br>

          <p>Search member that you would like to allow to make changes in your inventory: <?php echo '<span style="color:#8c188e">'.$inventory_to.'</span>'; ?></p>

          <div class="">
            <div class="card-body" id="inv_search_result">

            </div>
          </div>

      </div>

    </div>

    </div><br><br>
 </center>

</body>
</html>
