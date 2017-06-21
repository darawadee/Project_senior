<?php 	session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
	<script type="text/javascript" src="lib/js/jquery-3.2.0.js"></script>
</head>
<form  action="action_register.php" method="POST">
<body>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			
			    <div class="form-group">
			        <label for="name">ชื่อ</label>
			        <input type="text" class="form-control" name="fname" 
			        placeholder="กรอกชื่อ" pattern="[ก-๙]{1,}" title="ใส้ตัวอักษรไทยเท่านั้น">
			    </div>
			    <div class="form-group">
			        <label for="last name">นามสกุล</label>
			        <input type="text" class="form-control" name="lname" 
			        placeholder="นามสกุล" pattern="[ก-๙]{1,}" title="ใส้ตัวอักษรไทยเท่านั้น">
			    </div>
			    <div class="form-group">
			        <label for="id">รหัส</label>
			        <input type="number" class="form-control" pattern="[0-9]{10}" name="sudent_id" placeholder="รหัสนักเรียน" title="ใส่แต่ตัวเขลเท่านั้น และ 10 หลัก">
			    </div>
			    <div class="form-group">
			        <label for="class">ชั้นปี</label>
			        	<select class="form-control" name="class">
					  <option value="1">ม.1</option>
					  <option value="2">ม.2</option>
					  <option value="3">ม.3</option>
					  <option value="4">ม.4</option>
					  <option value="5">ม.5</option>
					  <option value="6">ม.6</option>
				</select>
			    </div>
			    <div class="form-group">
			        <label for="sec">ห้อง</label>
			        	<select class="form-control" name="sec">
					  <option value="1">ห้อง 1</option>
					  <option value="2">ห้อง 2</option>
					  <option value="3">ห้อง 3</option>
					 
				</select>
			    </div>
			     <div class="form-group">
			        <label for="sec">เพศ</label>
			        	<label class="radio-inline">
				  <input type="radio" name="gender" id="inlineRadio1" value="M"> ชาย
				</label>
				<label class="radio-inline">
				  <input type="radio" name="gender" id="inlineRadio2" value="F"> หญิง
				</label>
			    </div>
			    <div class="form-group">
			        <label for="user name">ชื่อผู้ใช้</label>
			        <input type="text" class="form-control" name="user_name" 
			        placeholder="ชื่อผู้ใช้" pattern="[a-zA-Z0-9]{6,}" title="ไม่สามารถใส้ภาษาไทยได้">
			    </div>
			    <div class="form-group">
			        <label for="password">รหัสผ่าน</label>
			        <input type="password" class="form-control" 
			        name="password" placeholder="รหัสผ่าน" pattern="[a-zA-Z0-9]{6,}" title="ไม่สามารถใส้ภาษาไทยได้">
			    </div>
			    <div class="form-group">
			        <label for="email">อีเมล์</label>
			        <input type="email" class="form-control" 
			        name="email" placeholder="อีเมล์">
			    </div>
			    <div class="form-group">
			        <label for="telephone">เบอร์โทรศัพท์</label>
			        <input type="tel" class="form-control" name="telephone" 
			        placeholder="หมายเลขโทรศัพท์" >
			    </div>
			    
			    <button type="submit" class="btn btn-success"> บันทึก </button>
			     <button id="reset" class="btn btn-danger"> เริ่มใหม่ </button>
	
		</div>
	</div>

	<script type="text/javascript">
		$(function(){

			$("#reset").click(function(event) {
				$("input").val('');
			});
			$('input').attr('required', '');
		});
	</script>
</body>
		</form>
</html>


