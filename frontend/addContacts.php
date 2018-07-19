<?php 
	require_once '../backend/includes/dbh.inc.php';
	$uid = $_COOKIE["cur_uid"];
	$cid = $_POST["name"];
	$cardNo = $_POST["cardNo"];
	$sql = "select * from user where uid='$cid' and cardNo='$cardNo'";
	$res = mysqli_query($con,$sql);
	$num = mysqli_num_rows($res);
	
	$sql2 = "select * from Contacts where uid='$uid' and cid='$cid'";
	$res2 = mysqli_query($con,$sql2);
	$num2 = mysqli_num_rows($res2);
	if($num2 != 0){
		echo "<script>alert('该用户已是联系人！');window.location.href='people.php'; </script>";
	}
	else if($num == 0){
		echo "<script>alert('该用户未注册！');window.location.href='people.php';</script>";
	}
	else
	{
		$sql3 = "insert into Contacts (uid,cid) values ('$uid','$cid')";
		$res3 = mysqli_query($con,$sql3);
		if($res3){
			echo "<script>alert('添加成功！');window.location.href='people.php';</script>";
		}
	}
	
?>