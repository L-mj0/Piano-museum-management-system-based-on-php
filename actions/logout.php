<?php
session_start();
//清除session/cookie
$_SESSION['username'] = null;
setcookie("username", "", time() - 3600);
header("Location:../index.php");
?>