<?php
session_start(); 
$_SESSION = [];
session_destroy();
session_unset();
header("Refresh: 2; url=giris.php");
?>