<?php
$from = $_POST["from"];
$to = $_POST["to"];
$date = $_POST["departure"];

if ($from == $to){
    $selectErr = "出发地不能和目的地相同!";
    echo "<script>alert('$selectErr')</script>";
    //header("Location:ticketQuery.php");
}

?>
<?php

?>
