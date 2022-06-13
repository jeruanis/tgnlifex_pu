<?php
require_once("../../../configuration/config.php");
include("../classes/User.php");
include("../classes/Message.php");

// if(isset($_POST['limit']))
$limit = 6;

$message = new Message($conn, $_REQUEST['userloggedin']);
echo $message->getScrollMessages($_REQUEST, $limit);

?>
