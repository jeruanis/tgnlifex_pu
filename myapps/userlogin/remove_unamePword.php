<?php

$v=$_GET['v'];
    setcookie('QTSSTYU','',time()-34500000, '/');
    setcookie('PTSSPOL','',time()-34500000, '/');
    setcookie('pword','',time()-34500000, '/');
    setcookie('uname','',time()-34500000, '/');
	header("Location: registration_signup_page?v=$v");

?>
