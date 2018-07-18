
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
	<script>
		function validate_email()
		{
			if(reg.email.value == null || reg.email.value == ""){return true}
			var re=/^\w+@[a-zA-Z0-9]{2,10}(?:\.[a-z]{2,4}){1,3}$/;
			if(re.test(reg.email.value))
			{return true}
			else{alert('邮箱格式不正确！');return false}
		}
		
		function validate_mobile(){
			var re=/^[0-9]{11}$/;   /*定义验证表达式*/
			if(re.test(reg.mobile.value)){return true}
			else{alert('手机号码不正确！');return false}
		}
		
		function validate_cardNo(){
			var re=/^[0-9]{17}([0-9]|x)$/;  
			if(re.test(reg.cardNo.value)){return true}
			else{alert('身份证号格式不正确！');return false}
		}
		
		function validate(){
			if(reg.pwd.value == reg.pwd_confirm.value){
				if(validate_cardNo() && validate_email() && validate_mobile()){return true}
				else{return false}
			}
			alert('两次密码不一致');
			return false
		}
		
	</script>
	<!-- Style --> <link rel="stylesheet" href="css/login.css" type="text/css" media="all">
</head>





<body>

	<h1>火车购票系统 注册/登录</h1>

	<div class="container w3layouts agileits">

		<div class="login w3layouts agileits">
			<h2>登 录</h2>
			<form action="login.php" name="log" method="post">
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
					require_once '../backend/includes/dbh.inc.php';
						if(isset($_GET["loginErr"]))
						{
							$info = $_GET["loginErr"];
							echo "<script>alert($info) </script>";
							//echo '<span style="color:white">'.$_GET["loginErr"].'</span>';
						}
					 ?>
                    
				</form>
			</div>
            
			<a href="#">忘记密码?</a>
			
			<div class="clear"></div>
		</div>
		

		<div class="register w3layouts agileits">
			<h2>注 册</h2>
			<form method="post" name="reg" action="reg.php" onsubmit="return validate()">
            
				<input type="text" Name="uid" placeholder="用户名" required>
                <input type="password" Name="pwd" placeholder="密码" required>
                 <input type="password" Name="pwd_confirm" placeholder="确认密码" required>
                 <input type="text" Name="name" placeholder="真实姓名" required>
        <p>证件类型</p><select name="cardType"><option value="0">二代身份证(默认)</option>
                 <input type="text" Name="cardNo" placeholder="身份证号码" required>
				<input type="text" Name="email" placeholder="邮箱" required>
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
					<input type="submit" value="注册">
			</div>
			<?php 
				if(isset($_GET["regErr"]))
				{
					$info = $_GET["regErr"];
					echo "<script>alert($info) </script>";
					//echo '<span style="color:white">'.$_GET["regErr"].'</span>';
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