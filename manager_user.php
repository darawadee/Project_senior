<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php  
		require 'config_DB/DB_connect.php';
	?>

</head>
<body>
	
	<table class="table table-hover" id="table-user">
	  <tr>
	    <th >รหัสนักเรียน</th>
	    <th >ชื่อ</th>
	    <th >นามสกุล</th>
	    <th >อีเมล์</th>
	    <th >ชื่อผู้ใช้</th>
	    <th >รหัสผ่าน</th>
	    <th >ชั้นปี</th>
	    <th >ห้อง</th>
	    <th >เพศ</th>
	    <th >เบอร์โทรศัพท์</th>
	     <th ></th>
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
	   		 <a href='#' uid="<?=$row['sudent_id'] ?>"  class='btn_edit_user btn btn-warning'><span class='fa fa-cog fa-lg' aria-hidden='true'></span>
			<a  href='#' uid="<?=$row['sudent_id'] ?>" class='btn_delete_user btn btn-danger'><span class='fa fa-trash-o' aria-hidden='true'></span>
			</td>
	   	</tr>
	   	 
	   <?php 
	  	
	  	}

	   ?>
	</table>
	<a href="../from_register.php" class="btn btn-success">
		
		 <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
		เพิ่มข้อมูลสมาชิก
	</a>
</body>

<!-- Modal -->
<div class="modal fade" id="edit_user_modal" role="dialog">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">แก้ไขข้อมูลผู้ใช้</h4>
    </div>
    <div class="modal-body">
      <p>This is a large modal.</p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
    </div>
  </div>
</div>
</div>
<!-- Modal -->
	
<script type="text/javascript">
$(document).ready(function() {
	// ___________________________________________
	$(".btn_delete_user").click(function(event) {
		var uid = $(this).attr("uid");
		//alert(uid);
		var conf = confirm("คุณแน่ใจหรือไม่");
			if(conf){
				$.post('../delete_user_action.php', {uid: uid}, 
					function() {
					/*optional stuff to do after success */
				}
				).done(function(data){
					//alert(data);
					if(data == "true"){
						get_user_manager();
					}else{
						alert("error");
					}
				});
				
			}	
	});
	// ___________________________________________

	$(".btn_edit_user").click(function(event) {
		var UID =  $(this).attr('uid');

		$.post('../from/from_edit_user.php', {uid: UID}, function() {
			/*optional stuff to do after success */
		}).done(function(data){
			$(".modal-body").html(data);
			$("#edit_user_modal").modal("toggle");

		});
	});
});
</script>
</html>
