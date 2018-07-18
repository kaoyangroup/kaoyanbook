<?php

$dbServer = "localhost";
$userName = "root";
$dbPwd = "bupt0123";
$dbName = "kaoyan";

$con = mysqli_connect($dbServer,$userName,$dbPwd,$dbName);

if(!$con){
    die('Could not connect: '.mysqli_connect_error());
}

?>
