<?php

    if ($qty == 2){

        $imageDiv .= "<div stle='width:810px;height:410px;border:1px solid green;position:relative'><div style=' width: 100%; padding-bottom: 6px; margin: 0 auto;'><center>";

        if (mysqli_num_rows($result3) > 0) {
            while ($row = mysqli_fetch_assoc($result3)) {
                $images = $row['image'];
                $imageDiv .= "<a href='$images' target='_self' data-fancybox='$aid' data-caption='Album name: $gname'> <img src='$images' style='padding:3px 0;margin:0;max-height:210px;max-width:100%;'></a>";
            }

            $imageDiv .= "</center></div></div>";
        }

    } elseif ($qty == 3) {
        $imageDiv .= "<div stle='width:810px;height:410px;border:1px solid green;position:relative'><div style=' width: 100%; padding-bottom: 6px; margin: 0 auto;'><center>";

        if (mysqli_num_rows($result3) > 0) {
            while ($row = mysqli_fetch_assoc($result3)) {
                $images = $row['image'];
                $imageDiv .= "<a href='$images' target='_self' data-fancybox='$aid' data-caption='Album name: $gname'> <img src='$images' style='padding:2px 0;margin:0;max-height:210px;max-width:100%;'></a>";
            }

            $imageDiv .= "</center></div></div>";
        }

    } elseif ($qty == 4) {

        $imageDiv .= "<div stle='width:810px;height:410px;border:1px solid green;position:relative'><div style=' width: 100%; padding-bottom: 6px; margin: 0 auto;'><center>";

        if (mysqli_num_rows($result3) > 0) {
            while ($row = mysqli_fetch_assoc($result3)) {
                $images = $row['image'];
                $imageDiv .= "<a href='$images' target='_self' data-fancybox='$aid' data-caption='Album name: $gname'> <img src='$images' style='padding:3px 0;margin:0;max-height:162px;max-width:100%;'></a>";
            }

            $imageDiv .= "</center></div></div>";
        }

    } elseif ($qty == 5) {

        $imageDiv .= "<div stle='width:810px;height:410px;border:1px solid green;position:relative'><div style=' width: 100%; padding-bottom: 6px; margin: 0 auto;'><center>";

        if (mysqli_num_rows($result3 > 0) {
            $counter = 0;
            while ($row = mysqli_fetch_assoc($result3)) {
                $images = $row['image'];
                if ($counter == 0) {
                    $imageDiv .= "<a href='$images' target='_self' data-fancybox='$aid' data-caption='Album name: $gname'> <img src='$images' style='padding:0;margin:0;display:block;margin:0 auto;max-height:388px;max-width:100%;'></a>";

                    $counter++;
                } else {
                    $imageDiv .= "<a href='$images' target='_self' data-fancybox='$aid' data-caption='Album name: $gname'> <img src='$images' style='padding:3px 0;margin:0;height:144px;width:24%;max-width:100%;'></a>";
                }
            }

            $imageDiv .= "</center></div></div>";
        }

    } elseif ($qty == 6) {

        $imageDiv .= "<div stle='width:810px;height:410px;border:1px solid green;position:relative'><div style=' width: 100%; padding-bottom: 6px; margin: 0 auto;'><center>";

        if (mysqli_num_rows($result3) > 0) {
            while ($row = mysqli_fetch_assoc($result3)) {
                $images = $row['image'];
                $imageDiv .= "<a href='$images' target='_self' data-fancybox='$aid' data-caption='Album name: $gname'> <img src='$images' style='padding:3px 0;margin:0;height:162px;width:31.6%;max-width:100%;'></a>";
            }

            $imageDiv .= "</center></div></div>";
        }

    } elseif ($qty > 6) {

        $balance = $qty - 4;
        $imageDiv .= "<div stle='width:810px;height:410px;border:1px solid green;position:relative'><div style=' width: 100%; padding-bottom: 6px; margin: 0 auto;'><center>";

        if (mysqli_num_rows($result3) > 0) {
            $counter = 0;
            while ($row = mysqli_fetch_assoc($result3)) {
                $images = $row['image'];
                if ($counter == 0) {
                    $imageDiv .= "<a href='$images' target='_self' data-fancybox='$aid' data-caption='Album name: $gname'> <img src='$images' style='padding:0;margin:3px 0;display:block;margin:0 auto;max-height:388px;max-width:100%;'></a>";

                    $counter++;
                } elseif ($counter < 4) {

                    $imageDiv .= "<a href='$images' target='_self' data-fancybox='$aid' data-caption='Album name: $gname'> <img src='$images' style='padding:6px;margin:0;height:144px;width:24%;max-width:100%;'></a>";
                    $counter++;

                } elseif ($counter == 4) {
                    $imageDiv .= "<div class='d-inline-block' style='width:24%;'><div class='position-relative'><span style='position: absolute;font-size: 47px;left:50%;top: 50%;margin-top:-40px;margin-left:-40px;' class='text-muted'>+$balance </span>
                           <span style='opacity:0.1;border:1px solid red;display:inline-block;width:100%'>
                             <a href='$images' target='_self' data-fancybox='$aid' data-caption='Album name: $gname'>
                               <img src='$images' style='padding:6px;margin:0;height:144px;width:100%;max-width:100%;'>
                             </a>
                           </span></div></div>";
                    $counter++;

                } elseif ($counter > 4) {

                    $imageDiv .= "<a href='$images' target='_self' data-fancybox='$aid' data-caption='Album name: $gname'> <img src='$images' style='padding:3px 0;margin:0;display:block;margin:0 auto;display:none;max-width:100%;'></a>";
                }
            }
            $imageDiv .= "</center></div></div>";
        }
    }



?>
