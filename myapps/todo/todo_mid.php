<?php

  // loading todos from database
     function url($text)
{

        $text = html_entity_decode($text);

        $text = " " . $text;

        $text = preg_replace('/(https{0,1}:\/\/[\w\-\.\/#?&=+%]*)/', '<a style="color:#0088cc;text-decoration:underline" href="$1" target="_blank">$1</a>', $text);

        return $text;

    }



   $todo_query = mysqli_query($conn, "SELECT * FROM todo WHERE username = '$userloggedin'");

       $forSun='';

       $forMon='';

       $forTue='';

       $forWed='';

       $forThu='';

       $forFri='';

       $forSat='';

       $forPlanning='';

   if(mysqli_num_rows($todo_query) > 0) {

      while($row = mysqli_fetch_assoc($todo_query)){

         $id = $row['id'];

         $mon = $row['mon'];

         $tue = $row['tue'];

         $wed = $row['wed'];

         $thu = $row['thu'];

         $fri = $row['fri'];

         $sat = $row['sat'];

         $sun = $row['sun'];

         $planning = $row['planning'];



         $mon = decryptthis($mon, $key);

         $tue = decryptthis($tue, $key);

         $wed = decryptthis($wed, $key);

         $thu = decryptthis($thu, $key);

         $fri = decryptthis($fri, $key);

         $sat = decryptthis($sat, $key);

         $sun = decryptthis($sun, $key);

         $planning = decryptthis($planning, $key);



          if($mon != ""){

              $forMon .= '<li id="'.$id.'" style="margin-left:24px;padding:6px 0;width:96%">'.$mon.'</li>';
                }



          if($tue != ""){

              $forTue .= '<li id="'.$id.'" style="margin-left:24px;padding:6px 0;width:96%">'.$tue.'</li>';

             }



          if($wed != ""){

              $forWed .= '<li id="'.$id.'" style="margin-left:24px;padding:6px 0;width:96%">'.$wed.'</li>';



             }



          if($thu != ""){

              $forThu .= '<li id="'.$id.'" style="margin-left:24px;padding:6px 0;width:96%">'.$thu.'</li>';

             }



          if($fri != ""){

              $forFri .= '<li id="'.$id.'" style="margin-left:24px;padding:6px 0;width:96%">'.$fri.'</li>';

             }



          if($sat != ""){

              $forSat .= '<li id="'.$id.'" style="margin-left:24px;padding:6px 0;width:96%">'.$sat.'</li>';

             }



          if($sun != ""){

              $forSun .= '<li id="'.$id.'" style="margin-left:24px;padding:6px 0;width:96%">'.$sun.'</li>';



             }

          if($planning != ""){

              $forPlanning .= '<li id="'.$id.'" style="margin-left:24px;padding:6px 0;width:96%">'.$planning.'</li>';



             }



       }

   }



?>
