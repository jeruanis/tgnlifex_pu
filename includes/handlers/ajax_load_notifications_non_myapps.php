<?php
require_once("../../../configuration/config.php");
include("../classes/User.php");
include("../classes/Notification.php");

$limit = 10;
$notifications = new Notification($conn, $_REQUEST['userloggedin']);
echo $notifications->getNotifications($_REQUEST, $limit);

?>
