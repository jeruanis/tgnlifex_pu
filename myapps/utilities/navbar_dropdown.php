<li class="nav-item dropdown">
  <a class="nav-link text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="more">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff"><path d="M0 0h24v24H0z" fill="none"/><path d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"/></svg>
  </a>
  <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="width:300px;max-height:400px;overflow:auto;">

    <?php
       if ($curPageName != 'inventory_create_form.php' )
           echo'<a class="dropdown-item" href="../inventory/inventory_create_form">Create new inventory</a>';
       if($curPageName != 'group_create_form.php' )
           echo'<a class="dropdown-item" href="../group_messaging/group_create_form">Create new chat group</a>';

          echo '<hr>';

          include( 'inventory_name_loader.php');
          echo '<hr>';

          include( 'group_name_loader.php');
          echo '<hr>';

          if($username == 'support-service'){
              echo "<div class='p-2 pb-2'><a class='d-block' href='../insights/insights'>Insights</a>
              <a class='d-block' href='../mov_player/player'>Learning Video</a>
              <a class='d-block' href='../electrical/electrical_engineering'>Electrical Engineering</a>
              <a class='d-block' href='../electrical/electrical_engineering_drawing'>Electrical Drawing</a>
              </div>";
            }

       ?>
  </div>
</li>
