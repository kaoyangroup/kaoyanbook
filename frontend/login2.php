
<!DOCTYPE html>
<html>

<!-- Head -->
<head>

	<title>火车购票系统 注册/登录</title>

	<!-- Meta-Tags -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- //Meta-Tags -->
	<script language="javascript">
		function check(){
			if(reg.uid.value == "" || reg.pwd.value == "" || reg.pwd_confirm.value == "" || reg.name.value == "" || reg.cardNo.value == "" || reg.mobile.value == ""){
				alert("注册信息不完整！");
				reg.uid.focus();
				return false;
			}else if(reg.pwd.value != reg.pwd_confirm.value){
				alert("两次密码不一致！");
				reg.uid.focus();
				return false;
			}
			else 
				return true;
		}
	</script>
	<!-- Style --> <link rel="stylesheet" href="css/login.css" type="text/css" media="all">
</head>





<body>

	<h1>火车购票系统 注册/登录</h1>

	<div class="container w3layouts agileits">

		<div class="login w3layouts agileits">
			<h2>登 录</h2>
			<form action="login.php" method="post">
				<input type="text" Name="Userame" placeholder="用户名/邮箱/手机号" required>
				<input type="password" Name="Password" placeholder="密码" required>
			
			<ul class="tick w3layouts agileits">
				<li>
					<input type="checkbox" id="brand1" value="">
					<label for="brand1"><span></span>记住我</label>
				</li>
			</ul>
            
			<div class="send-button w3layouts agileits">
				
					<input type="submit" value="登 录"><br>
					
					<?php 
						if(isset($_GET["loginErr"]))
						{
							echo '<span style="color:white">'.$_GET["loginErr"].'</span>';
						}
					 ?>
                    
				</form>
			</div>
            
			<a href="#">忘记密码?</a>
			
			<div class="clear"></div>
		</div>
		

		<div class="register w3layouts agileits">
			<h2>注 册</h2>
			<form method="post" name="reg" action="reg.php">
            
				<input type="text" Name="uid" placeholder="用户名" required>
                <input type="password" Name="pwd" placeholder="密码" required>
                 <input type="password" Name="pwd_confirm" placeholder="确认密码" required>
                 <input type="text" Name="name" placeholder="真实姓名" required>
        <p>证件类型</p><select name="cardType"><option value="0">二代身份证(默认)</option>
                 <input type="text" Name="cardNo" placeholder="身份证号码" required>
				<input type="text" Name="email" placeholder="邮箱(可选)" required>
                <input type="text" Name="mobile" placeholder="手机号码" required>
                
                
                <div class="choose">
                &nbsp;&nbsp;
   <input type="radio" id="option-0-1" Name="userType" value = "0" class="option-radio" checked />
   <label for="option-0-1"></label>
   <span class="">普通</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
   <input type="radio" id="option-0-2" Name="userType" value = "1" class="option-radio" />
   <label for="option-0-2"></label>
   <span class="">学生</span>  
</div>
			<div class="send-button w3layouts agileits">
					<input type="submit" value="注册" onclick="check()">
			</div>
			<?php 
				if(isset($_GET["regErr"]))
				{
					echo '<span style="color:white">'.$_GET["regErr"].'</span>';
				}
			?>
            </form>
            
			
            
			<div class="clear"></div>
		</div>

		<div class="clear"></div>

	</div>

</body>
<!-- //Body -->

</html>