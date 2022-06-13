<?php

include('../main/base.php');
include('../main/navbar.php');

  if($userloggedin != "support-service")
      header("Location: ../../index");
  else{
      $title = $_REQUEST['title'];
      $file = '../../../assets/electrical_engineering_box/electrical_installation_standard_drawing/F_Cable_Tray/'.$title.'.pdf';
      $fp = fopen($file, "r") ;

      header("Cache-Control: maxage=1");
      header("Pragma: public");
      header("Content-type: application/pdf");
      header("Content-Disposition: inline; filename=".$myFileName."");
      header("Content-Description: PHP Generated Data");
      header("Content-Transfer-Encoding: binary");
      header('Content-Length:' . filesize($file));
      ob_clean();
      flush();
      while (!feof($fp)) {
         $buff = fread($fp, 1024);
         print $buff;
      }
      exit;
    }
?>
