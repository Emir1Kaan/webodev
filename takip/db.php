<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
</html>
<?php

ob_start();
session_start();
date_default_timezone_set('Europe/Istanbul');

try 
{
    $baglan = new PDO('mysql:host=localhost;dbname=ogrencitakip;charset=utf8', 'root', '');
} 
catch (Exception $e) 
{
    exit($e->getMessage());
}

?>