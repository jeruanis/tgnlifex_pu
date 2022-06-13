<?php
$v=$_GET['v'];
session_start();
session_unset();
session_destroy();
header("Location: remove_unamePword?v=$v");

?>
