<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>

<div class=displaytable>
    <p>常用联系人:</p>
    <table border="1" cellpadding="3" cellspacing="20">
      <thead>
        <tr>
          <th>姓名</th>
          <th>证件类型</th>
          <th>证件号码</th>
          <th>手机号码</th>
          <th>旅客类型</th>
        </tr>
      </thead>
      <?php
      $uid = $_COOKIE["cur_uid"];
      $con = mysqli_connect("localhost","root","123456","train");
      if(!$con)
      {
        die('Count not connect');
      }
      $sql = "select * from Contacts where uid='$uid'";
      $result = mysqli_query($con,$sql);
      while($row = mysqli_fetch_array($result))
      {
        $no = $row["cid"];
        $sql2 = "select * from user where cardNo='$no'";
        $res = mysqli_query($con,$sql2);
        $r = mysqli_fetch_array($res);
            echo "<tbody>";
            echo  "<tr>";
            echo    "<td>".$r["name"]."</td>";
            echo    "<td>二代身份证</td>";
            echo    "<td>".$no."</td>";
            echo    "<td>".$r["mobile"]."</td>";
            echo    "<td>".$r["email"]."</td>";
            echo  "</tr>";
            echo  "</tbody>";
      }
      mysqli_close($con);
      ?>
      <tfoot>
        <tr>
          
        </tr>
      </tfoot>
    </table>
	</div>

</body>
</html>
