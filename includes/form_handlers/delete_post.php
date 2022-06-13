<?php
    require_once('../../../configuration/config.php');

    $userloggedin = $_SESSION['username'];
    if(isset($_GET['post_id']) || isset($_GET['aid'])){
      $post_id= $_GET['post_id'];
      $aid= $_GET['aid'];

      $get_comments = "SELECT * FROM comments WHERE post_id =?";
      $stmt =mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $get_comments);
      mysqli_stmt_bind_param($stmt, 'i', $post_id);
      mysqli_stmt_execute($stmt);
      $res_count=mysqli_stmt_get_result($stmt);
      $count=mysqli_fetch_row($res_count);

      if($count) {
       $del_comments = "DELETE FROM comments WHERE post_id=?";
       $stmt =mysqli_stmt_init($conn);
       mysqli_stmt_prepare($stmt, $del_comments );
       mysqli_stmt_bind_param($stmt, 'i', $post_id);
       mysqli_stmt_execute($stmt);

       if($del_comments){

       }else{
         echo json_encode(mysqli_error($del_comments));
       }
      }

      $deleted = 'yes';
      $posting = 'no';

       $queryId = "UPDATE posts SET deleted=?, posting=? WHERE id=?;";
       $stmt =mysqli_stmt_init($conn);
       mysqli_stmt_prepare($stmt, $queryId);
       mysqli_stmt_bind_param($stmt, 'ssi', $deleted, $posting, $post_id);
       mysqli_stmt_execute($stmt);

       if($queryId){

       }else{
         echo json_encode(mysqli_error($queryId));
       }

       if($aid == 0 || $aid == ""){

       }else{
         $queryaidP = "UPDATE posts SET deleted=?, posting=? WHERE aid=?;";
         $stmt =mysqli_stmt_init($conn);
         mysqli_stmt_prepare($stmt, $queryaidP);
         mysqli_stmt_bind_param($stmt, 'ssi', $deleted, $posting, $aid);
         mysqli_stmt_execute($stmt);
         if($queryaidP){
         }else{
           echo json_encode(mysqli_error($queryaidP));
         }
       }

     header("Location: ../../myapps/community/delmessageExtractorPost.php");
     mysqli_stmt_close($stmt);
     mysqli_close($conn);

     }
?>
