<?php
session_start();
$_SESSION = array();
session_destroy();
setcookie('usercook', '' , time() - 3600 ,'/');
header('Location: index.php');
