<?php
include("../../../configuration/config.php");
include("../../includes/classes/User.php");
include("../../includes/classes/Message.php");

$mode = $_POST['mode'];
$id = 0;
$userloggedin = $_POST['userloggedin'];
$post = new Message($conn, $userloggedin);

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
        $user_to = $_POST['user_to'];
        $id = $_POST['id'];

        if(ob_get_length()) ob_clean();
        // header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        // header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
        header('Cache-Control: no-cache, must-revalidate');
        header('Pragma: no-cache');
        header('Content-Type: application/json');

        // need json_encode to populate it
        echo json_encode($post->retrieveNewMessages($user_to, $id));

    }elseif($mode == 'IconSend'){
          $date = date("Y-m-d H:i:s");
          $user_to = $_POST['user_to'];
          $gif = $_POST['gif'];
          $lastMessageId=$_POST['id'];
          $post ->sendMessageGif($user_to, '', $date, $gif, $lastMessageId);

    }elseif($mode == 'SendAndRetrieveNew') {
        $file_name = $_FILES['fileToUpload']['name'];
        $file_tmp = $_FILES['fileToUpload']['tmp_name'];
        $imageName = htmlspecialchars($file_name);
        $imageTmp_Name = $file_tmp;
        $imageTmp_Name = htmlspecialchars($file_tmp);

        $body = $_POST["post_text"];
        $user_to = $_POST['user_to'];
        $lastMessageId = $_POST['id'];

        $response = array();
        $uploadOk = 1;
    	  if($imageName != "") {
            if($_FILES['fileToUpload']['size'] <= 12000000) {
                $targetDir = "../../../assets/posts/";

                $imageName = 'tmp_folder/'.uniqid().basename($imageName);
                $file_name_content = $targetDir . uniqid(). basename($imageName);

                $imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);
                if(strtolower($imageFileType) == "jpeg" || strtolower($imageFileType) == "png" || strtolower($imageFileType) == "jpg" || strtolower($imageFileType) == "pdf" || strtolower($imageFileType) == "doc" || strtolower($imageFileType) == "docx"){

                    if($uploadOk) {
                        if(move_uploaded_file($imageTmp_Name, $imageName)) {

                            $filename_out= $imageName;
                            include('../utilities/compimg.php');

                            $imageName = substr($imageNameOut, 6);

                            $body = $_POST["post_text"];
                            $body = str_replace("http"," http", $body);
                              if(substr($body, 0, 4) == "http"){
                                  $body =htmlspecialchars(strip_tags(nl2br($body), "<br>"));}
                                   elseif(checkEmoji($body) !== false){
                                        $body =ucfirst(htmlspecialchars(strip_tags(nl2br($body), "<br>")));
                                    }else{
                                  $body =htmlspecialchars(strip_tags(nl2br($body)));}
                            echo json_encode($post->submitMediaMessage($body, $user_to, $imageName, '', ''));
                        }
                      }
                }elseif(strtolower($imageFileType) == "gif") {
                 if($uploadOk) {
                    $imageName = $targetDir . uniqid() . basename($imageName);
                    if(move_uploaded_file($imageTmp_Name, $imageName)) {
                        $imageName = substr($imageName, 6);

                        $body = $_POST["post_text"];
                        $body = str_replace("http"," http", $body);
                             if(substr($body, 0, 4) == "http"){
                              $body =htmlspecialchars(strip_tags(nl2br($body), "<br>"));}
                               elseif(checkEmoji($body) !== false){
                                    $body =ucfirst(htmlspecialchars(strip_tags(nl2br($body), "<br>")));
                                }else{
                              $body =htmlspecialchars(strip_tags(nl2br($body)));}
                        echo json_encode($post->submitMediaMessage($body, $user_to, $imageName, '', ''));
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
                        $body =htmlspecialchars(strip_tags(nl2br($body)));}
                        echo json_encode($post->submitMediaMessage($body, $user_to, '', '', $lastMessageId));
                        exit;
                      }else{
                         $response['warning'] = "you sent an empty message";
                         echo json_encode($response['warning']);exit;
                       }
                 }
          }


?>
