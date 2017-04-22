<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php  
		require 'config_DB/DB_connect.php';
	?>
</head>
<body>
	
	<table class="table table-hover">
	  <tr>
	    <th class="">รหัสนักเรียน</th>
	    <th class="">ชื่อ</th>
	    <th class="">นามสกุล</th>
	    <th class="">Email</th>
	    <th class="">User</th>
	    <th class="">Password</th>
	    <th class="">ชั้นปี</th>
	    <th class="">ห้อง</th>
	    <th class="">เพศ</th>
	    <th class="">Telephone</th>
	     <th class=""></th>
	  </tr> 
	  <?php 
	  	$sql="SELECT * FROM `user_acount`";
	  	$res=mysqli_query($connect, $sql);
	  	while ($row=mysqli_fetch_assoc($res)) {
	   ?>
	   	<tr>
	   		<td><?=$row['sudent_id'] ?></td>
	   		<td><?=$row['fname'] ?></td>
	   		<td><?=$row['lname'] ?></td>
	   		<td><?=$row['email'] ?></td>
	   		<td><?=$row['username'] ?></td>
	   		<td><?=$row['password'] ?></td>
	   		<td><?=$row['class'] ?></td>
	   		<td><?=$row['sec'] ?></td>
	   		<td><?=$row['gender'] ?></td>
	   		<td><?=$row['telephone'] ?></td>
	   		<td>
	   		 <a href='#'  class='edit-btn btn btn-warning'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
			<a id= href='#' uid="<?=$row['sudent_id'] ?>" class='btn_delete_user btn btn-danger'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span>
			</td>
	   	</tr>
	   	 
	   <?php 
	  	
	  	}

	   ?>
	</table>
	<a href="user_equipment.php" class="btn btn-success">
		
		 <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
		เพิ่มข้อมูลสมาชิก
	</a>
</body>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".btn_delete_user").click(function(event) {
				var uid = $(this).attr("uid");
				//alert(uid);

				$.post('delete_user_action.php', {uid: uid}, 
					function() {
					/*optional stuff to do after success */
				}
				).done(function(data){
					//alert(data);
					if(data == "true"){
						get_usermanager();
					}else{
						alert("error");
					}
				});

				
			});
		});
	</script>
</html>
