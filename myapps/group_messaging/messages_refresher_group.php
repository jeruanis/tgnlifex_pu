<?php
include('../../../configuration/config.php');
include("../../includes/classes/User.php");
include("../../includes/classes/Group.php");

$mode = $_POST['mode'];
$id = 0;
$userloggedin = $_POST['userloggedin'];
$post = new Group($conn, $userloggedin);

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

if($mode == 'RetrieveNew'){

    $id = $_POST['id'];
    $user_to = $_POST['user_to'];
    $group_to = $_POST['group_to'];
    if(ob_get_length()) ob_clean();
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
    header('Cache-Control: no-cache, must-revalidate');
    header('Pragma: no-cache');
    header('Content-Type: application/json');
    echo json_encode($post->retrieveNewMessageGroup($user_to, $group_to, $id));

}elseif($mode == 'SendAndRetrieveNew') {
    $id = $_POST['id'];
    $file_name = $_FILES['fileToUpload']['name'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];

    $imageName = str_replace("(", " ", $file_name);
    $imageName = str_replace(")", " ", $file_name);
    $imageName = str_replace("'", " ", $file_name);
    $imageName = str_replace('\"', ' ', $file_name);

    $imageTmp_Name = $file_tmp;
    $imageTmp_Name = str_replace("(", " ", $file_tmp);
    $imageTmp_Name = str_replace(")", " ", $imageTmp_Name);
    $imageTmp_Name = str_replace("'", " ", $imageTmp_Name);
    $imageTmp_Name = str_replace('\"', ' ', $imageTmp_Name);

    $body = $_POST["post_text"];
    $latestUser = $_POST['latestUser'];
    $group_to = $_POST['group_to'];

    $response = array();
    $uploadOk = 1;
    if($imageName != "") {
        if($_FILES['fileToUpload']['size'] <= 50000000) {
        $targetDir = "../../../assets/posts/group_messages/".str_replace(' ', '_', strtolower($group_to));
          if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
          }

          $imageName = 'tmp_folder/'.uniqid().basename($imageName);
          $file_name_content = $targetDir.'/'. basename($imageName);

          $imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);
          if(strtolower($imageFileType) == "jpeg" || strtolower($imageFileType) == "jpg" || strtolower($imageFileType) == "png" || strtolower($imageFileType) == "PNG"){

              if($uploadOk) {
                    if(move_uploaded_file($imageTmp_Name, $imageName)) {

                        $filename_out= $imageName;
                        include('../utilities/compimg.php');
                        $imageNameDest = substr($imageNameOut, 9);

                        $body = $_POST["post_text"];
                        $body = str_replace("http"," http", $body);
                            if(substr($body, 0, 4) == "http"){
                              $body =htmlspecialchars(strip_tags(nl2br($body), "<br>"));}
                                elseif(checkEmoji($body) !== false){
                                  $body =ucfirst(htmlspecialchars(strip_tags(nl2br($body), "<br>")));
                                }else{
                                  $body =htmlspecialchars(strip_tags(nl2br($body), "<br>"));}

                                  if(ob_get_length()) ob_clean();
                                  header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
                                  header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
                                  header('Cache-Control: no-cache, must-revalidate');
                                  header('Pragma: no-cache');
                                  header('Content-Type: application/json');

                                  echo json_encode($post->MediaMessageGroup($body, $latestUser, $imageNameDest, $group_to, $id));
                    }
                  }

            }elseif(strtolower($imageFileType) == "gif" || strtolower($imageFileType) == "pdf") {

             if($uploadOk) {
               if (!file_exists($targetDir)) {
                 mkdir($targetDir, 0777, true);
               }

               $imageNameDest = $targetDir.'/'. basename($imageName);

                if(move_uploaded_file($imageTmp_Name, $imageNameDest)) {
                    $imageNameDest = substr($imageNameDest, 9);

                    $body = $_POST["post_text"];
                    $body = str_replace("http"," http", $body);
                         if(substr($body, 0, 4) == "http"){
                          $body =htmlspecialchars(strip_tags(nl2br($body), "<br>"));}
                            elseif(checkEmoji($body) !== false){
                              $body =ucfirst(htmlspecialchars(strip_tags(nl2br($body), "<br>")));
                            }else{
                              $body =htmlspecialchars(strip_tags(nl2br($body), "<br>"));}

                              if(ob_get_length()) ob_clean();
                              header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
                              header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
                              header('Cache-Control: no-cache, must-revalidate');
                              header('Pragma: no-cache');
                              header('Content-Type: application/json');
                              echo json_encode($post->MediaMessageGroup($body, $latestUser, $imageNameDest, $group_to, $id));
                }
             }

            }elseif(strtolower($imageFileType) == "mp4" ){
                 $response['warning'] = 'Sorry, there was an error uploading your file.';
                 echo json_encode($response['warning']);exit;
               }
        }else{
           $response['warning'] = 'Sorry, there was an error uploading your file.';
           echo json_encode($response['warning']);exit;
          }
    }else{
        if(!empty($_POST["post_text"])) {
            $body = $_POST["post_text"];
            $body = str_replace("http"," http", $body);
                if(substr($body, 0, 4) == "http"){
                  $body =htmlspecialchars(strip_tags(nl2br($body), "<br>"));}
                    elseif(checkEmoji($body) !== false){
                      $body =ucfirst(htmlspecialchars(strip_tags(nl2br($body), "<br>")));
                    }else{
                      $body =htmlspecialchars(strip_tags(nl2br($body), "<br>"));}

                      if(ob_get_length()) ob_clean();
                      header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
                      header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
                      header('Cache-Control: no-cache, must-revalidate');
                      header('Pragma: no-cache');
                      header('Content-Type: application/json');

                      echo json_encode($post->MediaMessageGroup($body, $latestUser, '', $group_to, $id));
        }else{
                $response['warning'] = "you sent an empty message";
                echo json_encode($response['warning']);exit;
                 }
    }
 }elseif($mode == 'IconSend'){

      $date = date("Y-m-d H:i:s");
      $id = $_POST['id'];
      $user_to = $_POST['user_to'];
      $gif = $_POST['gif'];
      $group_to = $_POST['group_to'];

      $post->sendMessageGif($user_to, '', $date, $gif, $group_to, $id);
    }


?>
