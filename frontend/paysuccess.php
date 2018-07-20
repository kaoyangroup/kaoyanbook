<?php

    require_once '../backend/includes/dbh.inc.php'; 
    session_start();
    $ticketId = $_SESSION["ticketId"];
    
    $price = $_SESSION["price"];
    $uid = "marco";
    $sql_order = "update Order1 set orderType=1 where ticketId='$ticketId'";
    mysqli_query($con,$sql_order);
    $sql_user = "update user set account=account-'$price' where uid='$uid'";
    mysqli_query($con,$sql_user);
    
    $successInfo = "Pay success!";
    echo "<script>alert('$successInfo')</script>";
    header('Refresh:1,Url=../frontend/index.html');
    
?>
