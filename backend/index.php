<?php
	include_once 'includes/dbh.inc.php';
?>

<html>
<head>
	<title></title>
</head>

<body>

	<?php
		//echo "<p>hello</p>";
		$sql = "select * from Route;";
		$result = mysqli_query($conn,$sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0){
			while($row = mysqli_fetch_assoc($result)){
				echo $row[0]." ";
				echo $row[1]." ";
				echo $row[2]." ";
				echo $row[3]." ";
				echo $row[4]." ";
				echo "<br>";
			}
		}
	?>
</body>

</html>
