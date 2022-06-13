<?php
require_once("../../../configuration/config.php");
include("../classes/User.php");
include("../classes/Message.php");

$limit = 10;
$message = new Message($conn, $_REQUEST['userloggedin']);
echo $message->getConvosDropdown($_REQUEST, $limit);

?>
