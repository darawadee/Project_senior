<?php 
	session_start();
	// var_dump($_SESSION);
	// echo $_SESSION['["data_user"']['["fname"'];
	// echo $_SESSION['["data_user"']['["lname"'];

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
 	<script type="text/javascript" src="lib/js/jquery-3.2.0.js"></script>
 	<style type="text/css">
 		
 		#banner{
 			/*background-color: blue;*/
 			padding: 20px 10px 20px 50px;
 		}
 		#manu-L{
 			
 			/*background-color: pink;*/
 			height:auto;
 		}
 		#content{
 			/*background-color: green;*/
 			height: auto;
 		}
 	</style>
 </head>
 <body>
 	<div class="row">
 		<div  class="col-md-12"  id="banner">
 			
 			<img src="img/logobsru.png" style="width: 100px; height: 150px;">
 			<div style="display: inline; float: right;">
 				<p><b>ชื่อผู้ใช้</b><?php echo $_SESSION["data_user"]["fname"]." ".$_SESSION["data_user"]["lname"];?></p>
 				<p><b>สถานะผู้ใช้</b><?php ?></p>

 			</div>
 			
 			
 			
 		</div>
 	</div>
 	<div class="row" >

 		<div class="col-md-3" id="manu-L">
 			<ul class="nav nav-pills nav-stacked" style="margin-right: 5px;">
			  <li class="active"><a href="#">Home</a></li>
			  <li><a href="#" id="btn_timetable">ตารางเรียน</a></li>
			  <li><a href="#" id="btn_Sports gallery">คลังอุปกรณ์กีฬา</a></li>
			</ul>		
 		</div>
 		<div class="col-md-9" id="content">
 			
 		</div>
 	</div>
 </body>
 <script type="text/javascript">
 	$(document).ready(function() {
 		$("#btn_login").click(function(event) {
 			/* Act on the event */
 			//alert(54444);
 			$.get('login_from.html', function() {
 				/*optional stuff to do after success */
 			}).done(function(data){
 				$("#content").html(data);
 			});
 		});
 	});

 	
 </script>

 </html>