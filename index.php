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
 	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/sweetalert2/6.6.1/sweetalert2.min.css">
<!--  	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"> -->



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

		.no{ width : 100px; text-align : center;}
		.highlight{ background-color :#5ed664; cursor: pointer;}
		.title{ text-align : center;}

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
 		
 		
 			<nav class="navbar navbar-default" style="margin-bottom: 0px;">
			  <div class="container-fluid">
			    <!-- <div class="navbar-header">
			      <a class="navbar-brand" href="#">WebSiteName</a>
			    </div>
			    <ul class="nav navbar-nav">
			      <li class="active"><a href="#">Home</a></li>
			      <li><a href="#">Page 1</a></li>
			      <li><a href="#">Page 2</a></li>
			    </ul> -->
			    <ul class="nav navbar-nav navbar-right">
			    <li>
			    	<a href="#">
					    <b>ชื่อผู้ใช้ </b><?php echo $_SESSION["data_user"]["fname"]." ".$_SESSION["data_user"]["lname"];?>
		 				<b>สถานะผู้ใช้</b>

		 				<?php 
		 					if($_SESSION['data_user']["user_type"] == "3"){
		 						echo "ผู้ดูแลระบบ";
		 					}elseif($_SESSION['data_user']["user_type"] == "2"){
		 						echo "คุณครู";
		 					}else{
		 						echo "นักเรียน";
		 					}

		 				 ?>
 				 	</a>	

			    </li>
			    <li style="margin-left: 5px; margin-right: 5px;">
			       <button   class="btn btn btn-info navbar-btn" id="info-cart"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"> </span> (<b id="count-item">0</b>)</button>
			      <!-- <button class="btn btn-info" id="info-cart"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"> </span>(<b id="count-item">0</b>)</button> -->
				</li>			      
			     <li> <a href="action_logout.php" class="btn btn-default">ออกจากระบบ</a></li>

			   
			    </ul>
			  </div>
			</nav>
 			
 			
 	
 	
 	<div class="row" >

 		<div class="col-md-3" id="manu-L" style="height: 80vh ; background-color: #c8bece" >
 			<ul class="nav nav-pills nav-stacked" style="margin-right: 1px;">
			  	<li class="active"><a href="index.php">หน้าหลัก</a></li>
			  	<?php if($_SESSION['data_user']["user_type"] == "3"){?>
				<!-- for admin -->
			  	<li>
					<a href="#" class="main_manu">ผู้ดูแลระบบ<i class="fa fa-chevron-down pull-right"></i></a>
					<ul class="nav nav-show">
					<li><a id="btn-manager" href="#">จัดการอุปกรณ์กีฬา</a></li>
					<li><a id="btn-usermanager"  href="#">จัดการข้อมูลสมาชิก</a></li>
					<li><a id="btn-manager_br"  href="#">อัพเดทสถานะยืม/คืนอุปกรณ์</a></li>
					
					</ul>
				</li>
				<!-- for admin -->
				<?php }?>
				<li>
					<a href="#" class="main_manu">ระบบยืม<i class="fa fa-chevron-down pull-right"></i></a>
					<ul class="nav nav-show">
					<li><a href="#" id="table_subject">ตารางเรียน</a></li>
					<li><a href="#" class="item-list" item-type="0">อุปกรณ์ทั้งหมด</a></li>
					<!-- <li><a href="#" class="item-list" item-type="1">กีฬาในร่ม</a></li>
					<li><a href="#" class="item-list" item-type="2">กีฬกลางแจ้ง</a></li>
					<li><a href="#" class="item-list" item-type="3">อื่นๆ</a></li>
					<li><a href="#" class="item-list" item-type="0">ทั้งหมด</a></li> -->
					</ul>
				</li>
				<?php if($_SESSION['data_user']["user_type"] != "3"){?>
				<!-- for admin -->
				<li>
					<a href="#" id="list_br" class="main_manu">รายการยืมคืน<i class="fa fa-chevron-down pull-right"></i></a>
				</li>
				<?php }?>

				
				<li>
					<a href="#" class="main_manu">ยื่นคำร้องขออุปกรณ์กีฬา<i class="fa fa-chevron-down pull-right"></i></a>
					<ul class="nav nav-show">
					</ul>
				</li>
			</ul>		
 		</div>
 		<div class="col-md-9" id="content" style="max-height: 600px;overflow: scroll;">
 			
 		</div>
 		
 		<!-- modal start -->
 		<!-- Modal -->
		<div id="Modal-info-cart" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">รายการอุปกรณ์ที่เลือก</h4>
		      </div>
		      <div class="modal-body" id="model-show-cart">
		        
		      </div>
		      <div class="modal-footer">
		      	 <button type="button" class="btn btn-info" id="conf">ยืนยัน</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
		      </div>
		    </div>

		  </div>
		</div>
 		<!-- modal stop -->

 	</div>
 </body>
 <script src="lib/js/jquery-3.2.0.js"></script>
 <!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script> -->
 <script type="text/javascript" src="lib/js/bootstrap.js"></script>
 <script type="text/javascript" src="https://cdn.jsdelivr.net/sweetalert2/6.6.1/sweetalert2.min.js"></script>
 <script type="text/javascript">
 	$(document).ready(function() {
 		
		    
		
 		$('.nav-show').hide();
 		get_count_item();
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
 			get_item(item_type);
 			
 		});

 		$('#info-cart').click(function(event) {
 			mount_info_tomodel();
 		});

 		$("#conf").click(function(event) {
 			$.post('service/save_item_br.php',function() {
 				/*optional stuff to do after success */
 			}).done(function(data){
 				if(data == 'true'){
 					alert("บันทึกข้อมูลเรียบร้อย");
 					get_count_item();
 					$('#Modal-info-cart').modal('toggle');
 				}else{
 					alert(data);
 				}
 			});
 		});

 		//____________________

 		$("#list_br").click(function(event) {
 			//alert("รายการ");
 			$.get('service/show_list_br.php', function() {
 				/*optional stuff to do after success */
 			}).done(function(data){
 				$("#content").html(data);
 			});
 		});
 		//_____________________________________

 		$("#btn-manager_br").click(function(event) {
 			$.get('service/show_list_br.php', function() {
 				/*optional stuff to do after success */
 			}).done(function(data){
 				$("#content").html(data);

 			});
 		});

 		$("#table_subject").click(function(event) {
 			get_table_subject();
 			
 		});
 	});




function mount_info_tomodel(){
	$.get('service/render_table_info_item.php', function() {
		/*optional stuff to do after success */
	}).done(function(data){
		$("#model-show-cart").html(data);
		$('#Modal-info-cart').modal('toggle');
	});


}


function get_item(item_type){
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
}

function get_usermanager(){
	$.get('manager_user.php', function() {
		/*optional stuff to do after success */
	}).done(function(data){
		$("#content").html(data);
	});
}

function get_count_item(){
	$.post('service/service_session_cart.php', {method:'get'}, function() {
			
	}).done(function(data){
		$("#count-item").text(data);
	});
}

function get_table_subject(){
	$.get('service/get_table_subject.php', function() {
		
	}).done(function(data){
		$("#content").html(data);

	});
}
 	

 	$(function(){
 		get_table_subject();
 	});
 </script>

 </html>