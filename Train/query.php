<html>
<body>
<?php 
$con = mysqli_connect("localhost","root","123456","train");
if(!$con)
{
	die('Count not connect');
}
echo "link success";
$sql = "select * from user";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result))
{
echo $row["uid"];
}
mysqli_close($con);
#跳转到登陆成功界面

?>

</body>
</html>