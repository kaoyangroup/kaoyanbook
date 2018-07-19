<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>密码修改</title>
<link href="css/change.css" rel="stylesheet" type="text/css" />
</head>

<body id='changePas'>
<h3>账号安全 - 密码修改</h3>
<div id="center">
<form action="../frontend/changePasSQL.php" method="post">
<p>原密码：&nbsp;&nbsp;&nbsp;
<input type="password" name="textfieldA" /></p>
<p>新密码：&nbsp;&nbsp;&nbsp;
<input type="password" name="textfieldB" /></p>
<p>密码确认：
  <input type="password" name="textfieldC" /></p>
    
<div>

<input id="button" type="submit" value="确 认" />
<br/>

</div>
</form>
<?php
if(isset($_GET["pwdErr"]))
echo $_GET["pwdErr"];
?>
</div>
</body>
</html>
