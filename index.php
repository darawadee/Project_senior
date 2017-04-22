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
 			<img src="img/comsci1.png" style="width:inherit; height:inherit;" >
 		</div>
 	</div>

 <?php 
 
 ?>
 		<div class="col-md-12" style="background-color: #c8bece;">
 			
 			<div style="float: right; padding-right: 20px;" >
 				<b>ชื่อผู้ใช้ </b><?php echo $_SESSION["data_user"]["fname"]." ".$_SESSION["data_user"]["lname"];?>
 				<b>สถานะผู้ใช้</b>

 				<?php 
 					if($_SESSION['data_user']["user_type"] == "3"){
 						echo "Admin";
 					}elseif($_SESSION['data_user']["user_type"] == "2"){
 						echo "Teacher";
 					}else{
 						echo "Student";
 					}

 				 ?>
 				 <button class="btn btn-info"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"> </span>(<b id="count-item">0</b>) </button>
 				<a href="action_logout.php" type="button" class="btn btn-default">ออกจากระบบ</a>
 			
 			</div>
 			
 			
 		</div>
 	
 	<div class="row" >

 		<div class="col-md-3" id="manu-L">
 			<ul class="nav nav-pills nav-stacked" style="margin-right: 1px;">
			  	<li class="active"><a href="#">Home</a></li>
			  	<?php if($_SESSION['data_user']["user_type"] == "3"){?>
				<!-- for admin -->
			  	<li>
					<a href="#" class="main_manu">ผู้ดูแลระบบ<i class="fa fa-chevron-down pull-right"></i></a>
					<ul class="nav nav-show">
					<li><a id="btn-manager" href="#">จัดการอุปกรณ์กีฬา</a></li>
					<li><a id="btn-usermanager">จัดการข้อมูลสมาชิก</a></li>
					<li><a href="#">อัพเดทสถานะยืม/คืนอุปกรณ์</a></li>
					<li><a href="#">ทั้งหมด</a></li>
					</ul>
				</li>
				<!-- for admin -->
				<?php }?>
				<li>
					<a href="#" class="main_manu">รายการอุปกรณ์<i class="fa fa-chevron-down pull-right"></i></a>
					<ul class="nav nav-show">
					<li><a href="#" class="item-list" item-type="1">กีฬาในร่ม</a></li>
					<li><a href="#" class="item-list" item-type="2">กีฬกลางแจ้ง</a></li>
					<li><a href="#" class="item-list" item-type="3">อื่นๆ</a></li>
					<li><a href="#" class="item-list" item-type="0">ทั้งหมด</a></li>
					</ul>
				</li>
				<li>
					<a href="#" class="main_manu">ตารางเรียน<i class="fa fa-chevron-down pull-right"></i></a>
					<ul class="nav nav-show">
					</ul>
				</li>
				<li>
					<a href="#" class="main_manu">ยื่นคำร้องขออุปกรณ์กีฬา<i class="fa fa-chevron-down pull-right"></i></a>
					<ul class="nav nav-show">
					</ul>
				</li>
			</ul>		
 		</div>
 		<div class="col-md-9" id="content" style="max-height: 600px;overflow: scroll;">
 			
 		</div>
 		<form>
			<input type="hidden" name="cart">
		</form>
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

 		$("#btn-usermanager").click(function(event) {
 			get_usermanager();
 			//alert(444);
 		});

 		$(".item-list").click(function(event) {
 			var item_type = $(this).attr('item-type');

 			$.post('show_item.php', 
 				{
 					item_type: item_type
 				},
 				 function() {
 				/*optional stuff to do after success */
 				}
 			).done(function(data){
 				$("#content").html(data);
 			});
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

function get_usermanager(){
	$.get('manager_user.php', function() {
		/*optional stuff to do after success */
	}).done(function(data){
		$("#content").html(data);
	});
}
 	
 </script>

 </html>