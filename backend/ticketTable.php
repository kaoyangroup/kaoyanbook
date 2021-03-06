<?php
/*
----------------------------------------------------------------------------------   车票列表 ------------------------------------------------------------------------------------------
*/
session_start();
$start = $_POST["from"];
$end = $_POST["to"];
$_SESSION["start"] = $start;
$_SESSION["end"] = $end;
$departure_date = $_POST["departure"];
if ($start == $end){
    $selectErr = "出发地不能和目的地相同!";
    echo "<script>alert('$selectErr')</script>";
    header('Refresh:1,Url=../frontend/ticketQuery.php');
}

//$_SESSION["start"] = $start;
?>


<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>欢迎购票!</title>
	<link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<!-- <link rel="stylesheet" href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"> -->
	<link href="css/marco/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="css/marco/daterangepicker.css" rel="stylesheet" media="screen">


	<script src="js/marco/jquery-3.1.1.min.js"></script>
	<script src="js/marco/jquery.dataTables.min.js"></script>
	<script src="js/marco/dataTables.bootstrap.min.js"></script>
	<script src="js/marco/moment.min.js"></script>
	<script src="js/marco/daterangepicker.js" charset="UTF-8"></script>
    

	<style>
		.classA:hover{ text-decoration:none;}
		td.highlight {
			background-color: red !important;
		}
		tr.am-primary{
			background-color: yellow !important;
		}

		.showul label {
            display: block;
            margin: 3px 0;
        }

        .showul {
            padding: 10px 15px;
        }

        .graph i {
            display: inline-block;
            width: 15px;
            height: 15px;
        }

        ul.showul li:not(:last-child) {
            border-bottom: 1px dashed #ccc;
        }
	</style>
</head>

<body>
	<nav class="navbar navbar-default "></nav>
	<div class="container">
        <!--
		<div class="well">
			<form class="form-inline" action="javascript:void(0);" id="search_form" role="form">

		      	<div class="input-group" id="id_search_date" style="width:41%">
		            <span>选择日期：</span>
		            <span class="add-on input-group-addon">
		            	<i class="glyphicon glyphicon-calendar fa fa-calendar" style="font-size: 18px"></i>
		            </span>
		            <input type="text" readonly style="width:220px" name="reportrange" id="reportrange" class="form-control" value=""/>
		            &nbsp;&nbsp;
		            <button type="button" id="reset" class="btn-sm btn-primary">复位</button>
		        </div>
                -->

                <!--
		        <div class="form-group">
                    <label class="sr-only" for="key_value">关键字</label>
                    <input type="text" class="form-control fa fa-dashboard" id="key_value" name="kw" value="" placeholder="请输入关键字">
                </div>

                <button type="submit" id="search_submit" class="btn btn-success">搜索</button>
                
     
                <div style="position:relative; z-index:9999; height:100%; width: 200px; float: right; margin-left: 12px;">
                    <button class="btn btn-default showcol">列段显示/隐藏</button>
                    <ul class="showul" style=" list-style:none; display:none; position:absolute; left:118px; top:10px; background:#FFFFFF; border:1px solid #ccc; width:106px;">
                        <li><label><input type="checkbox" class="toggle-vis" checked data-column="3"/>出发时间</label></li>
                        <li><label><input type="checkbox" class="toggle-vis" checked data-column="5"/>到达时间</label></li>
                        <li><label><input type="checkbox" class="toggle-vis" checked data-column="6"/>途经时间</label></li>
                        <li><label><input type="checkbox" class="toggle-vis" checked data-column="8"/>一等座价格</label></li>
                        <li><label><input type="checkbox" class="toggle-vis" checked data-column="10"/>二等座价格</label></li>
                        <li><label><input type="checkbox" class="toggle-vis" checked data-column="12"/>卧铺价格</label></li>
                        <li><label><input type="checkbox" class="toggle-vis" checked data-column="14"/>硬座价格</label></li>
                    </ul>
                </div>
                
	    	</form>
        
	    </div>
        -->
        <!-- 异常：可以订已经开过的车 -->
        <div style="clear:both">
            <ol class="breadcrumb">
            当前位置：
                <li><a href="../frontend/index.html">首页</a></li>
                <li><a href="../frontend/ticketQuery.php">在线订票</a></li>
                <li class="active">车次查询</li>
            </ol>
        </div>
    	<table id="DataTable" class="display table table-striped table-bordered">
    	    <thead>
                <tr style="background:#64a7af;">
                <!--	<th><input type="checkbox" name="checklist" id="checkAll"></th>  -->
                    <th>车次</th>
                    <th>出发站</th>
                    <th>出发时间</th>
                    <th>目的站</th>                
                    <th>到达时间</th>
                    <th>途经时间</th>
                    <th>一等座余票</th>
                    <th>一等座价格</th>
                    <th>二等座余票</th>
                    <th>二等座价格</th>
                    <th>卧铺余票</th>
                    <th>卧铺价格</th>
                    <th>硬座余票</th>
                    <th>硬座价格</th>
                    <th>预订</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include_once "ticketQuerySql.php";
                ?>
            </tbody>
        </table>
	</div>
</body>
    
</html>




