<?php 
$con = mysqli_connect("localhost","root","123456","train");
if(!$con)
{
	die('Count not connect');
}
$mon = $_POST["textfield"];
$uid = $_COOKIE["cur_uid"];
$sql = "update user set account=account+'$mon' where uid='$uid'";
$result = mysqli_query($con,$sql);
mysqli_close($con);
?>
