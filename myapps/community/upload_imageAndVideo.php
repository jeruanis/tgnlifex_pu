<!-- <head>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
</head> -->

 <?php
  require_once("../../../configuration/config.php");
  include("../../includes/classes/User.php");
  include("../../includes/classes/Post.php");

 if (isset($_SESSION[ 'username'])){
     if(isset($_POST['fileToUpload']) ||
     isset($_POST['post_text']) ||
     isset($_POST['userloggedin']) ||
     isset($_POST['bitrate'])){

function checkEmoji($str){
    $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
    preg_match($regexEmoticons, $str, $matches_emo);
    if (!empty($matches_emo[0])) {
        return false;
    }

    $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
    preg_match($regexSymbols, $str, $matches_sym);
    if (!empty($matches_sym[0])) {
        return false;
    }

    $regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
    preg_match($regexTransport, $str, $matches_trans);
    if (!empty($matches_trans[0])) {
        return false;
    }

    $regexMisc = '/[\x{2600}-\x{26FF}]/u';
    preg_match($regexMisc, $str, $matches_misc);
    if (!empty($matches_misc[0])) {
        return false;
    }

    $regexDingbats = '/[\x{2700}-\x{27BF}]/u';
    preg_match($regexDingbats, $str, $matches_bats);
    if (!empty($matches_bats[0])) {
        return false;
    }
    return true;
}

    $file_name = $_FILES['fileToUpload']['name'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $imageName = htmlspecialchars($file_name);

    $imageTmp_Name = $file_tmp;
    $imageTmp_Name = htmlspecialchars($file_tmp);


$body = $_POST['post_text'];
$userloggedin = $_POST['userloggedin'];
$response = array();
$post = new Post($conn, $userloggedin);
    $uploadOk = 1;
	if($imageName != "") {
            if($_FILES['fileToUpload']['size'] <= 30000000) {
                $targetDir = "../../../assets/posts/";

                $imageName = 'tmp_folder/'.uniqid().basename($imageName);
                $file_name_content = $targetDir . uniqid(). basename($imageName);

                $imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);
                if(strtolower($imageFileType) == "jpeg" || strtolower($imageFileType) == "png" || strtolower($imageFileType) == "jpg"){

                     if(move_uploaded_file($imageTmp_Name, $imageName)){

                         include('../utilities/compimg.php');
                         $imageName = substr($imageNameOut, 9);

                         $body = $_POST["post_text"];
                         $body = str_replace("http"," http", $body);
                         if(substr($body, 0, 4) == "http"){
                            $body =htmlspecialchars(strip_tags(nl2br($body)));}
                         elseif(checkEmoji($body) !== false){
                             $body =ucfirst(htmlspecialchars(strip_tags(nl2br($body))));
                          }else{
                             $body =htmlspecialchars(strip_tags(nl2br($body)));}

                          echo json_encode($post->submitPost($body, 'none', $imageName, 'none','', ''));

                        }else{
                            $response['message'] = 'Sorry, there was an error uploading your file.';
                           }

                }elseif(strtolower($imageFileType) == "gif") {
                    $imageName = $targetDir . uniqid() . basename($imageName);
                    if(move_uploaded_file($imageTmp_Name, $imageName)) {
                        $imageName = substr($imageName, 9);
                        $body = $_POST['post_text'];
                        $body = str_replace("http"," http", $body);
                        if(substr($body, 0, 4) == "http"){
                              $body =htmlspecialchars(strip_tags(nl2br($body)));}
                            elseif(checkEmoji($body) !== false){
                                $body =ucfirst(htmlspecialchars(strip_tags(nl2br($body))));
                            }else{
                              $body =htmlspecialchars(strip_tags(nl2br($body)));}

                        $post->submitPost($body, 'none', $imageName, 'none', '', '');
                    } else{
                        $response['message'] = 'Sorry, there was an error uploading your file.';
                     }

                }elseif(strtolower($imageFileType) == "mp4"){
                    $bitrate = "2500k";
                    $rd = rand();
                    $targetDirVid = '../../../assets/posts/'.uniqid() . $rd . basename($imageName, '.tmp');
                    $command = "ffmpeg -i $imageTmp_Name -b:v $bitrate -bufsize $bitrate $targetDirVid.mp4";
                    system($command);
                    $screenshot="ffmpeg -ss 00:00:06 -i $targetDirVid.mp4 -vf scale=800:-1 -vframes 2 $targetDirVid.jpg";
                    system($screenshot);

                    $vidposter = substr($targetDirVid.'.jpg', 9);
                    $vidContent = substr($targetDirVid.'.mp4', 9);
                    unlink($imageName);

                        $body = $_POST['post_text'];
                        $body = str_replace("http"," http", $body);
                        if(substr($body, 0, 4) == "http"){
                            $body =htmlspecialchars(strip_tags(nl2br($body)));}
                            elseif(checkEmoji($body) !== false){
                                $body =ucfirst(htmlspecialchars(strip_tags(nl2br($body))));
                            }else{
                            $body =htmlspecialchars(strip_tags(nl2br($body)));}
                        $post = new Post($conn, $userloggedin);
                        $post->submitPost($body, 'none', 'none', $vidContent, '', $vidposter);

                }elseif(strtolower($imageFileType) == "avi"){

                        $bitrate = "2500k";
                        $rd = rand();
                        $targetDirVid = '../../../assets/posts/'.uniqid() . $rd . basename($imageName, '.avi');
                        $command = "ffmpeg -i $imageTmp_Name -b:v $bitrate -bufsize $bitrate $targetDirVid.mp4";
                        system($command);
                        $screenshot="ffmpeg -ss 00:00:06 -i $targetDirVid.mp4 -vf scale=800:-1 -vframes 2 $targetDirVid.jpg";
                        system($screenshot);
                        $vidposter = substr($targetDirVid.'.jpg', 9);
                        $vidContent = substr($targetDirVid.'.mp4', 9);
                        unlink($imageName);

                            $body = $_POST['post_text'];
                            $body = str_replace("http"," http", $body);

                            if(substr($body, 0, 4) == "http"){
                                $body =htmlspecialchars(strip_tags(nl2br($body)));}
                                elseif(checkEmoji($body) !== false){
                                    $body =ucfirst(htmlspecialchars(strip_tags(nl2br($body))));
                                }else{
                                $body =htmlspecialchars(strip_tags(nl2br($body)));}
                            $post = new Post($conn, $userloggedin);
                            $post->submitPost($body, 'none', 'none', $vidContent, '', $vidposter);

                }elseif(strtolower($imageFileType) == "flv"){

                        $bitrate = "2500k";
                        $rd = rand();
                        $targetDirVid = '../../../assets/posts/'.uniqid() . $rd . basename($imageName, '.flv');
                        $command = "ffmpeg -i $imageTmp_Name -b:v $bitrate -bufsize $bitrate $targetDirVid.mp4";
                        system($command);
                        $screenshot="ffmpeg -ss 00:00:06 -i $targetDirVid.mp4 -vf scale=800:-1 -vframes 2 $targetDirVid.jpg";
                        system($screenshot);
                        $vidposter = substr($targetDirVid.'.jpg', 9);
                        $vidContent = substr($targetDirVid.'.mp4', 9);
                        unlink($imageName);

                            $body = $_POST['post_text'];
                            $body = str_replace("http"," http", $body);

                            if(substr($body, 0, 4) == "http"){
                                $body =htmlspecialchars(strip_tags(nl2br($body)));}
                                elseif(checkEmoji($body) !== false){
                                    $body =ucfirst(htmlspecialchars(strip_tags(nl2br($body))));
                                }else{
                                $body =htmlspecialchars(strip_tags(nl2br($body)));}

                            $post = new Post($conn, $userloggedin);
                            $post->submitPost($body, 'none', 'none', $vidContent, '', $vidposter);

                }elseif(strtolower($imageFileType) == "webm"){

                        $bitrate = "2500k";
                        $rd = rand();
                        $targetDirVid = '../../../assets/posts/'.uniqid() . $rd . basename($imageName, '.webm');
                        $command = "ffmpeg -i $imageTmp_Name -b:v $bitrate -bufsize $bitrate $targetDirVid.mp4";
                        system($command);
                        $screenshot="ffmpeg -ss 00:00:06 -i $targetDirVid.mp4 -vf scale=800:-1 -vframes 2 $targetDirVid.jpg";
                        system($screenshot);
                        $vidposter = substr($targetDirVid.'.jpg', 9);
                        $vidContent = substr($targetDirVid.'.mp4', 9);
                        unlink($imageName);

                            $body = $_POST['post_text'];
                            $body = str_replace("http"," http", $body);

                            if(substr($body, 0, 4) == "http"){
                                $body =htmlspecialchars(strip_tags(nl2br($body)));}
                                elseif(checkEmoji($body) !== false){
                                    $body =ucfirst(htmlspecialchars(strip_tags(nl2br($body))));
                                }else{
                                $body =htmlspecialchars(strip_tags(nl2br($body)));}

                            $post = new Post($conn, $userloggedin);
                            $post->submitPost($body, 'none', 'none', $vidContent, '', $vidposter);

                }else{
                  $response = 'Sorry, this type of file cannot be upladed';
                  echo json_encode($response);
                  exit();
                  }

           }else{
               $response = 'Sorry, your file must be 30MB or lower.';
               echo json_encode($response);
                  exit();
              }

        }else{
            if(!empty($_POST["post_text"])) {
                $body = $_POST["post_text"];
                $body = str_replace("http"," http", $body);
                     if(substr($body, 0, 4) == "http"){
                          $body =htmlspecialchars(strip_tags(nl2br($body)));}
                        elseif(checkEmoji($body) !== false){
                            $body =ucfirst(htmlspecialchars(strip_tags(nl2br($body))));
                        }else{
                          $body =htmlspecialchars(strip_tags(nl2br($body)));}

                 $post->submitPost($body, 'none', 'none', 'none', '', '');
                    }

               }

        if(ob_get_length()) ob_clean();
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
        header('Cache-Control: no-cache, must-revalidate');
        header('Pragma: no-cache');
        header('Content-Type: application/json');

        echo json_encode($response);

    }

  }else{
     echo ' <script>
          $(document).ready(function(){
            alert("You have to login to to make a post")
          </script>';
       }


?>
