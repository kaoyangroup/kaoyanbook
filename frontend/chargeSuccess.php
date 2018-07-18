<?php 
require_once '../backend/includes/dbh.inc.php';
$mon = $_POST["textfield"];
$uid = $_COOKIE["cur_uid"];
$sql = "update user set account=account+'$mon' where uid='$uid'";
$result = mysqli_query($con,$sql);
mysqli_close($con);
?>
