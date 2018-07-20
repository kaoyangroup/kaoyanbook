<?php
    require_once '../backend/inlcudes/dbh.inc.php'; 
    
    $sql_order = "update Order1 set orderType=1 where ticketId='$ticketId'";
    mysqli_query($con,$sql_order);
    $sql_user = "update user set account=account-'$price' where uid='$uid'";
    mysqli_query($con,$sql_user);
    
    echo "<script>alert('支付成功!');window.location.href('index.html');</script>";
    
?>
