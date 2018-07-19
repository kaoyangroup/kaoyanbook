<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>常用联系人</title>
<style type="text/css">
@import url("css/user.css");
</style>
</head>

<body id="pep">
<div id="topP">
<div id="t"><h3>常用联系人</h3></div>

<div id="r">
<ul>
	<li>
    	<a href="index.html" target="_blank"><div>首页</div></a>
    </li>
	<li>
    	<a href="Buy.html" target="_blank"><div>购票</div></a>
    </li>
    <li>
    	<a href="order.html" target="_blank"><div>查看历史订单</div></a>
    </li>
    <li>
    	<a href="login2.php" target="_self"><div>退出登录</div></a>
    </li>
</ul>
</div>
</div>

<div id="c" class="displaytable">
    <table width="1000" border="1" cellpadding="8" cellspacing="0.1">
      <thead>
        <tr>
          <th width="100">姓名</th>
          <th width="150">证件类型</th>
          <th width="300">证件号码</th>
          <th width="200">手机号码</th>
          <th width="100">旅客类型</th>
        </tr>
      </thead>
      <?php
	  require_once '../backend/includes/dbh.inc.php';
      $uid = $_COOKIE["cur_uid"];
      $sql = "select * from Contacts where uid='$uid'";
      $result = mysqli_query($con,$sql);
      while($row = mysqli_fetch_array($result))
      {
        $no = $row["cid"];
        $sql2 = "select * from user where uid='$no'";
        $res = mysqli_query($con,$sql2);
        $r = mysqli_fetch_array($res);
		$type = '普通';
		if($r["email"] == '1'){
			$type = '学生';
		}
            echo "<tbody>";
            echo  "<tr>";
            echo    "<td>".$r["name"]."</td>";
            echo    "<td>二代身份证</td>";
            echo    "<td>".$r["cardNo"]."</td>";
            echo    "<td>".$r["mobile"]."</td>";
            echo    "<td>".$type."</td>";
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
	<table>
		<form name='peo' action='addContacts.php' method='post'>
		<p>姓名： <input type="text" name="name" /></p>
		<p>身份证号：<input type="text" name="cardNo" /></p>
		<div> 
			<input type="submit" value="添加联系人"/>
		</div>
		</form>
	</table>
	</div>

</body>
</html>
