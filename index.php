<?php 
	session_start();
	// var_dump($_SESSION);
	// echo $_SESSION['["data_user"']['["fname"'];
	// echo $_SESSION['["data_user"']['["lname"'];
	if(isset($_SESSION['data_user'])){
		// login แล้ว	
	}else{
		header('Location: login_from.html');
	}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
 	<script type="text/javascript" src="lib/js/jquery-3.2.0.js"></script>
 	<style type="text/css">
 		
 		#banner{
 			/*background-image:url("img/comsci.png");
 			background-size: cover;*/
 			/*background-color: blue;*/
 			height: 150px;			
 		}
 		#manu-L{
 			
 			/*background-color: pink;*/
 			height:auto;
 		}
 		#content{
 			/*background-color: green;*/
 			height: auto;
 		}
 		.main_manu{
 			background-color: #b3bdce;
 		}
 		.sub_menu{
 			background-color: #5774a5;
 		}
 	</style>
 </head>
 <body class="containers">
 	<div class="row">
 		<div  class="col-md-12"  id="banner">
 			<img src="img/comsci.png" style="width: inherit;height: inherit;" >
 		</div>
 	</div>

 	
 		<div class="col-md-12" style="background-color: #c3b1ce;">
 			
 			<div style="float: right; padding-right: 20px;" >
 				<b>ชื่อผู้ใช้ </b><?php echo $_SESSION["data_user"]["fname"]." ".$_SESSION["data_user"]["lname"];?>
 				<b>สถานะผู้ใช้</b>

 				<?php 
 					if($_SESSION['data_user']["user_type"] == "3"){
 						echo "Admin";
 					}elseif($_SESSION['data_user']["user_type"] == "2"){
 						echo "teacher";
 					}else{
 						echo "student";
 					}

 				 ?>
 				<a href="action_logout.php" type="button" class="btn btn-default">Logout</a>
 			
 			</div>
 			
 			
 		</div>
 	
 	<div class="row" >

 		<div class="col-md-2" id="manu-L">
 			<ul class="nav nav-pills nav-stacked" style="margin-right: 5px;">
			  	<li class="active"><a href="#">Home</a></li>
				<li>
					<a href="#" class="main_manu">รายการอุปกรณ์<i class="fa fa-chevron-down pull-right"></i></a>
					<ul class="nav nav-show">
					<li><a href="#">กีฬาในร่ม</a></li>
					<li><a href="#">กีฬกลางแจ้ง</a></li>
					<li><a href="#">อื่นๆ</a></li>
					<li><a href="#">ทั้งหมด</a></li>
					</ul>
				</li>
				<li>
					<a href="#">ยื่นคำร้องขออุปกรณ์กีฬา<i class="fa fa-chevron-down pull-right"></i></a>
					<ul class="nav nav-show">
					</ul>
				</li>
				<?php if($_SESSION['data_user']["user_type"] == "3"){?>
				<!-- for admin -->
				<li>
					<a href="#" class="main_manu">ผู้ดูแลระบบ<i class="fa fa-chevron-down pull-right"></i></a>
					<ul class="nav nav-show">
					<li><a id="btn-manager" href="#">จัดการอุปกรณ์กีฬา</a></li>
					<li><a href="#">จัดการข้อสมาชิก</a></li>
					<li><a href="#">อัพเดทสถานะยืม/คืนอุปกรณ์</a></li>
					<li><a href="#">ทั้งหมด</a></li>
					</ul>
				</li>
				<!-- for admin -->
				<?php }?>
			</ul>		
 		</div>
 		<div class="col-md-10" id="content">
 			
 		</div>
 	</div>
 </body>
 <script type="text/javascript" src="lib/js/bootstrap.js"></script>
 <script type="text/javascript">
 	$(document).ready(function() {
 		$('.nav-show').hide();

		$("li:has(ul)").click(function(){
		  if($(this).hasClass('open')) {
		    $(this).removeClass('open').find('ul').slideUp();
		  }
		  else {
		   $(this).addClass('open').find('ul').slideDown();
		  }
		});
		////////////////////////////////////////////////////////
 		$("#btn_login").click(function(event) {
 			/* Act on the event */
 			//alert(54444);
 			$.get('login_from.html', function() {
 				/*optional stuff to do after success */
 			}).done(function(data){
 				$("#content").html(data);
 			});
 		});
 		///////////////////////////////////////////////////////

 		$("#btn-manager").click(function(event) {
 			get_manager();
 		});
 	});

function get_manager(){
	/* Act on the event */
	$.get('manager.php', function() {
		/*optional stuff to do after success */

	}).done(function(data){
		$("#content").html(data);
	});
}
 	
 </script>

 </html>