<?php
 include("../main/base.php");
  include("../main/navbar.php");

if(isset($_GET['q'])) {
    $query = $_GET['q'];
    }
 else {
     $query = " ";
   }

  // if(isset($_GET['group'])){
  //   $gname = $_GET['group'];
  //   $url_name = 'gname';
  // }elseif(isset($_GET['inventory'])){
  //   $gname = $_GET['inventory'];
  //   $url_name = 'inventory_name';
  // }else{
  //   $gname = '';
  //   $url_name = '';
  // }

    $names = explode(" ", $query);

      $usersReturnedQuery = mysqli_query($conn, "SELECT id, body FROM posts WHERE body LIKE '$query%' AND user_closed='no' LIMIT 8");

          echo "<div class='card'><div class='card-body'>";
          echo "<div class='liveSearchWrap'>";
            if($query != " ") {
                while($row = mysqli_fetch_array($usersReturnedQuery)) {
                  $id = $row['id'];
                  $body = $row['body'];
                    // if($user_name != $userloggedin) {
                           echo "<div class='resultDisplayLiveSearch'>
                                 <a  href='../community/post?id=$id' style='color: #1485bd' >
                                      <div class='liveSearchText'>
                                       $body
                                      </div>
                                  </a>
                                <div><br>";

                             // }
                          }
                      }

            else {
                echo " ";
            }
        echo "</div>";
        echo '</div></div>';
