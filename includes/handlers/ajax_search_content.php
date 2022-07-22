<?php

require_once("../../../configuration/config.php");
include('../../includes/classes/User.php');
include('../../includes/classes/Post.php');

$query = $_POST['query'];

//ermove result upon clearing the textarea
if($query==''){
    echo ""; exit;
}

// if(isset($_GET['q'])) {
//     $query = $_GET['q'];
//     }
//  else {
//      $query = " ";
//    }

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

      $usersReturnedQuery = mysqli_query($conn, "SELECT id, body, youtube, title_url, descript_url FROM posts WHERE (body LIKE '%$query%' OR youtube LIKE '%$query%' OR title_url LIKE '%$query%' OR descript_url LIKE '%$query%') AND (user_closed='no' AND deleted='no') LIMIT 30");

          echo "<div class='card'><div class='card-body'>";
          echo "<div class='liveSearchWrap'>";
            if($query != " ") {
                while($row = mysqli_fetch_array($usersReturnedQuery)) {
                  $id = $row['id'];
                  $body = $row['body'];
                  if(substr($body,0,1) == "<"){
                    $body = substr(substr($body, 4), 0, 30);
                  }else{
                    $body = substr($body, 0, 30);
                  }
                           echo "<div class='resultDisplayLiveSearch'>
                                 <a  target='_blank' href='../community/post?id=$id' style='color: #1485bd' >
                                      <div class='liveSearchText mb-2'>
                                       ".$body."...
                                      </div>
                                  </a>
                                <div>";
                          }
                      }

            else {
                echo " ";
            }
        echo "</div>";
        echo '</div></div>';
