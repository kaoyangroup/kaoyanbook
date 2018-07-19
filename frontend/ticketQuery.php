<?php
	include_once "../backend/includes/dbh.inc.php";
?>

<?php
	include_once "header.php";
?>

<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>余票查询</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <link rel="stylesheet" href="css/marco/bootstrap.min.css">
    <link rel="stylesheet" href="css/marco/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/marco/fontAwesome.css">
    <link rel="stylesheet" href="css/marco/hero-slider.css">
    <link rel="stylesheet" href="css/marco/owl-carousel.css">
    <link rel="stylesheet" href="css/marco/datepicker.css">
    <link rel="stylesheet" href="css/marco/tooplate-style.css">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

	 <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<!-----------------------------css样式------------------------ -->
    <style type="text/css"> 
        .banner{
			background-image: url("image/tour.jpg");
    	}
	</style>
	<style type="text/css">
        html, body {width:100%;height:100%;} /*非常重要的样式让背景图片100%适应整个屏幕*/
        .my-navbar {padding:20px 0;transition: background 0.5s ease-in-out, padding 0.5s ease-in-out;}
        .my-navbar a{background:transparent !important;color:#fff !important}
        .my-navbar a:hover {color:#45bcf9 !important;background:transparent;outline:0}
        .my-navbar a {transition: color 0.5s ease-in-out;}/*-webkit-transition ;-moz-transition*/
        .top-nav {padding:0;background:#000;}
        button.navbar-toggle {background-color:#fbfbfb;}/*整个背景都是transparent透明的，会看不到，所以再次覆盖一下*/
        button.navbar-toggle > span.icon-bar {background-color:#dedede}
	</style>

<!-----------------------------css样式------------------------ -->



</head>

<body>
	<section class="banner" id="top">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
					<section id="first-tab-group" class="tabgroup">
						<div id="tab-1">
							<div class="submit-form">
								<h4>余票查询</h4>
								<form id="form-submit" action="ticketTable.html" method="post">
									<div class="row">
										<!-- from-->
										<div class="col-md-12">
											<fieldset>
                                                <!--<label for="from">出发地:</label>-->
                                                <!-- 出发地 -->
                                                <select required name='from' onchange='this.form.()'>
                                                    <option value="">出发地..</option>
                                                    <option value="北京">北京</option>
                                                    <option value="石家庄">石家庄</option>
                                                    <option value="郑州">郑州</option>
                                                    <option value="武汉">武汉</option>
                                                    <option value="长沙">长沙</option>
                                                    <option value="广州">广州</option>
                                                    <option value="西安">西安</option>
                                                    <option value="重庆">重庆</option>
                                                    <option value="成都">成都</option>
                                                    <option value="沈阳">沈阳</option>
                                                    <option value="长春">长春</option>
                                                    <option value="哈尔滨">哈尔滨</option>
                                                    <option value="济南">济南</option>
                                                    <option value="青岛">青岛</option>
                                                    <option value="南京">南京</option>
                                                    <option value="上海">上海</option>
                                                    <option value="西宁">西宁</option>
                                                    <option value="拉萨">拉萨</option>
                                                    <option value="合肥">合肥</option>
                                                    <option value="杭州">杭州</option>
                                                </select>
                                        	</fieldset>
										</div>
										<!-- to-->
										<div class="col-md-12">
                                            <fieldset>
                                                <!--<label for="to">目的地:</label>-->
                                                <!-- 目的地 -->
                                                <select required name='to' onchange='this.form.()'>
                                                    <option value="">目的地..</option>
                                                    <option value="北京">北京</option>
                                                    <option value="石家庄">石家庄</option>
                                                    <option value="郑州">郑州</option>
                                                    <option value="武汉">武汉</option>
                                                    <option value="长沙">长沙</option>
                                                    <option value="广州">广州</option>
                                                    <option value="西安">西安</option>
                                                    <option value="重庆">重庆</option>
                                                    <option value="成都">成都</option>
                                                    <option value="沈阳">沈阳</option>
                                                    <option value="长春">长春</option>
                                                    <option value="哈尔滨">哈尔滨</option>
                                                    <option value="济南">济南</option>
                                                    <option value="青岛">青岛</option>
                                                    <option value="南京">南京</option>
                                                    <option value="上海">上海</option>
                                                    <option value="西宁">西宁</option>
                                                    <option value="拉萨">拉萨</option>
                                                    <option value="合肥">合肥</option>
                                                    <option value="杭州">杭州</option>
                                                </select>
                                            </fieldset>
										</div>
										<!-- date-->
										<div class="col-md-12">
											<fieldset>
                                                <!--<label for="departure">出发时间:</label>-->
                                                <input name="departure" type="date" class="form-control date" id="deparure" placeholder="Select date..." required onchange='this.form.()' />
                                        	</fieldset>
										</div>

										<div class="col-md-12">
											<fieldset>
                                            	<button type="submit" id="form-submit" class="btn">预订</button>
                                        	</fieldset>
										</div>
									</div>
								</form>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</section>
	
<!--                    --------------------------------footer----------------------------                   -->
<?php
	include_once "footer.php";
?>

<script>
    $(window).scroll(function () {
        if ($(".navbar").offset().top > 50) {$(".navbar-fixed-top").addClass("top-nav");
        }else {$(".navbar-fixed-top").removeClass("top-nav");}
    })
</script>
</body>
</html>
