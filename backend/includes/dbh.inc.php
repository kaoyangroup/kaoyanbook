<?php

$dbServer = "localhost";
$userName = "root";
$dbPwd = "123456";
$dbName = "kaoyan";

$con = mysqli_connect($dbServer,$userName,$dbPwd,$dbName);
mysqli_set_charset($con,'utf8');

if(!$con){
    die('Could not connect: '.mysqli_connect_error());
}

?>
