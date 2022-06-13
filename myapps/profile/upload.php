<?php include('../main/base.php'); ?>
<style>
    .container{
        padding: 30px;
    }
    form{
        display:inline-block;
    }
    @media(max-width:600px){
      .CroppingContainer{
         width:100%;
         height:100%;
      }
    }
</style>
</head>
<?php

$profile_id = $user['username'];
$imgSrc = "";
$result_path = "";
$msg = "";
    if (!isset($_POST['x']) && !isset($_FILES['image']['name']) ){
            $temppath = '../../../assets/images/profile_pics/'.$profile_id.'_temp.jpeg';
            if (file_exists ($temppath)){ @unlink($temppath); }
    }

if(isset($_FILES['image']['name'])){


        $ImageName = $_FILES['image']['name'];
        $ImageSize = $_FILES['image']['size'];
        $ImageTempName = $_FILES['image']['tmp_name'];

        $ImageType = @explode('/', $_FILES['image']['type']);
        $type = $ImageType[1];

        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
          $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/assets/images/profile_pics';
        }else{
          $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/tgnlifex_prod/tgn_proj/assets/images/profile_pics';
        }

        $file_temp_name = $profile_id.'_original.'.md5(time()).'n'.$type;
        $fullpath = $uploaddir."/".$file_temp_name;
        $file_name = $profile_id.'_temp.jpeg';
        $fullpath_2 = $uploaddir."/".$file_name;

        $move = move_uploaded_file($ImageTempName ,$fullpath) ;
        chmod($fullpath, 0777);

        if (!$move) {
            die ('File didnt upload');
        } else {
            $imgSrc= "../../../assets/images/profile_pics/".$file_name;
            $msg= "Upload Complete!";
            $src = $file_name;
        }

            clearstatcache();
            list($width, $height, $type) = getimagesize($fullpath);
            $original_width = $width;
            $original_height = $height;

            $main_width = 500;
            $main_height = $original_height / ($original_width / $main_width);

            if( $type == IMAGETYPE_JPEG ) {
            $src2 = imagecreatefromjpeg($fullpath);
            }
            elseif( $type == IMAGETYPE_PNG ) {
            $src2 = imagecreatefrompng($fullpath);
            }
            elseif( $type == IMAGETYPE_GIF ) {
            $src2 = imagecreatefromgif($fullpath);
            }else{
                $msg .= "There was an error uploading the file. Please upload a .jpg, .gif or .png file. <br />";
            }

            $main = imagecreatetruecolor($main_width,$main_height);
            imagecopyresampled($main,$src2,0, 0, 0, 0,$main_width,$main_height,$original_width,$original_height);

            $main_temp = $fullpath_2;
            imagejpeg($main, $main_temp, 60);
            chmod($main_temp,0777);

            imagedestroy($src2);
            imagedestroy($main);

            @ unlink($fullpath);
        }

if (isset($_POST['x'])){


        $type = $_POST['type'];

        $src = '../../../assets/images/profile_pics/'.$_POST['src'];
        $finalname = $profile_id.md5(time());

    if($type == 'jpg' || $type == 'jpeg' || $type == 'JPG' || $type == 'JPEG'){

            $targ_w = $targ_h = 1080;

            $jpeg_quality = 100;

            $img_r = imagecreatefromjpeg($src);
            $dst_r = imagecreatetruecolor( $targ_w, $targ_h );
            imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
            $targ_w,$targ_h,$_POST['w'],$_POST['h']);

            imagejpeg($dst_r, "../../../assets/images/profile_pics/".$finalname."n.jpeg", 90);

    }else if($type == 'png' || $type == 'PNG'){

            $targ_w = $targ_h = 1080;

            $jpeg_quality = 100;

            $img_r = imagecreatefrompng($src);
            $dst_r = imagecreatetruecolor( $targ_w, $targ_h );
            imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
            $targ_w,$targ_h,$_POST['w'],$_POST['h']);

            imagejpeg($dst_r, "../../../assets/images/profile_pics/".$finalname."n.jpeg", 90);

    }else if($type == 'gif' || $type == 'GIF'){

            $targ_w = $targ_h = 1080;

            $jpeg_quality = 100;

            $img_r = imagecreatefromgif($src);
            $dst_r = imagecreatetruecolor( $targ_w, $targ_h );
            imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
            $targ_w,$targ_h,$_POST['w'],$_POST['h']);

            imagejpeg($dst_r, "../../../assets/images/profile_pics/".$finalname."n.jpeg", 90);

         }

            imagedestroy($img_r);
            imagedestroy($dst_r);
            @ unlink($src);


        $result_path ="assets/images/profile_pics/".$finalname."n.jpeg";

        // profile picture updated here
        $insert_pic_query = mysqli_query($conn, "UPDATE users SET profile_pic='$result_path' WHERE username='$userloggedin'");


        // create  a notification instead of post
        $user_friend_query = mysqli_query($conn, "SELECT friend_array FROM users WHERE username='$userloggedin'");
        $user_array = mysqli_fetch_array($user_friend_query);
        $num_friends = (substr_count($user_array['friend_array'], ",")) - 1;
        $friendsList = $user_array['friend_array'];

        // list of friends
        $friendsList2 = explode(",", $friendsList);

        // define notification instant
        for ($i = 1;$i <= $num_friends;$i++) {
            $notifications->insertNotification('pro_pic', $friendsList2[$i], 'profile_pic');
           } //for

    // $post = new Post($conn, $userloggedin);
    // $post->submitPost('Profile picture updated!!!', 'none' , $result_path, 'none', 'friends', '');
    mysqli_close($conn);
    header("Location: ".$userloggedin);

}

    include('../main/navbar.php');
?>

<div id="Overlay" style=" width:100%; height:100%; border:0px #990000 solid; position:absolute; top:0px; left:0px; z-index:2000; display:none;"></div>
<div class="main_column column1">

     <script>
        $(document).ready(function() {
             $('#process').hide();
            $('#image').click(function() {
                $("#process").delay(2000).fadeIn();
            })
        });
    </script>

    <div id="formExample">
        <div class="container">
            <center><div class="col-md-6">
                <div class="row">
                    <div class="card card-body">

                    <p><b> <?=$msg?> </b></p>

                    <form action="upload" method="post"  enctype="multipart/form-data" class="form-group">
                        <p>Upload your profile picture</p>
                        <div class="form-group">
                          <input type="file" id="image" name="image" accept="image/*"/>
                        </div>
                        <div class="mb-2 mt-3">
                          <input type="submit" id="process" value="Proceed" class="btn btn-warning" /></div>
                    </form>

                        <a href='settings_key?change=settings'>
                            <button class="btn btn-primary">Back</button>
                        </a>

                 </div>
                </div>
            </div>
        </center>
        </div>
    </div>


    <?php
    if($imgSrc){ ?>
        <script>
            $('#Overlay').show();
            $('#formExample').hide();
        </script>

        <div id="CroppingContainer" style="max-width:600px; height:600px; background-color:#FFF; margin-left: 3px; position:relative; overflow:hidden; border:2px #600 solid; z-index:2001; padding-bottom:0px;margin-top: 56px;">

            <div id="CroppingArea" style="max-width:603px; max-height:402px; position:relative; overflow:hidden; margin:18px; border:2px #666 solid;">
                <img src="<?=$imgSrc?>" border="0" id="jcrop_target" style="border:0px #990000 solid; position:relative; margin:0px 0px 0px 0px; padding:0px; " />
            </div>

            <div id="InfoArea" style="margin:40px 0px 0px 40px;">
                    <h6>Crop Profile Image</h6>
            </div>

            <div id="CropImageForm" style="width:400px; height:30px; margin:10px 0px 0px 40px;" >
                <form action="upload" method="post" enctype="multipart/form-data" onsubmit="return checkCoords();">
                    <input type="hidden" id="x" name="x" />
                    <input type="hidden" id="y" name="y" />
                    <input type="hidden" id="w" name="w" />
                    <input type="hidden" id="h" name="h" />
                    <input type="hidden" value="jpeg" name="type" /> <?php ?>
                    <input type="hidden" value="<?=$src?>" name="src" />
                    <input type="submit" value="Save" class="btn btn-warning" />
                </form>
                <a href="upload?update-propic"><button class="btn btn-info">Cancel Crop</button></a>

               </div>
        </div>

    <?php
    } ?>
</div>
   <script src="../../static/js/jcrop_bits.min.js"></script>
   <script src="../../static/js/jquery.Jcrop.min.js"></script>
</body>
</html>
