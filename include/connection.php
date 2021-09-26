<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'BlogWebSite';
$connect = mysqli_connect($host , $user , $password , $db);

if ( isset($connect) ) 
    echo "database connected";
else
    echo ("Not Connected!");
?>