<?php
	include_once "includes/dbh.inc.php";
?>


<html>
<head><title>Ticket Query Sql</title></head>

<body>
	<?php
		$from = $_POST['from'];
		$to = $_POST['to'];
		$departure = $_POST['departure'];
		echo $from." ",$to." ",$departure." ";
	?>
</body>

</html>
