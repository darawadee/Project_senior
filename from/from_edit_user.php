<?php 
include '../config_DB/DB_connect.php';
$user_id = $_POST['uid'];
$sql_select_user = "SELECT * FROM `user_acount` WHERE `sudent_id` = '{$user_id}'";
$array_class = array(
 "1" => "ม.1",
 "2" => "ม.2",
 "3" => "ม.3",
 "4" => "ม.4",
 "5" => "ม.5",
 "6" => "ม.6"
 );
$array_sec = array(
	"1" => "ห้อง 1",
	"2" => "ห้อง 2",
	"3" => "ห้อง 3"
);

$array_gender = array(
"M" => "ผู้ชาย",
"F" => "ผู้หญิง"
);
if($res = mysqli_query($connect,$sql_select_user)){
	$row = mysqli_fetch_assoc($res);

?>

<!DOCTYPE html>
<head>
	<title></title>
	
</head>
<body>
      <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <form role="form" id="from-edit-user"  method="post">
                <div class="form-group">
                    <label for="name">ชื่อ</label>
                    <input type="text" class="form-control" name="fname" 
                    placeholder="กรอกชื่อ" value="<?=$row['fname'] ?>">
                </div>
                <div class="form-group">
                    <label for="last name">นามสกุล</label>
                    <input type="text" class="form-control" name="lname" 
                    placeholder="นามสกุล" value="<?=$row['lname'] ?>">
                </div>
                <div class="form-group">
                    <label for="id">รหัส</label>
                    <input type="text" class="form-control" name="sudent id" 
                    placeholder="รหัสนักเรียน" value="<?=$row['sudent_id'] ?>">
                </div>
                <div class="form-group">
                    <label for="class">ชั้นปี</label>
                      <select class="form-control" name="class">
		                  
		                 <?php 
		                 	foreach ($array_class as $key => $value) {
		                  		$selected =  ($key == $row['class']) ? "selected" : "" ;
		                 ?>
		                 	 <option value="<?=$key ?>" <?= $selected ?>  ><?=$value ?></option>
		                 <?php
		                 	}

		                 ?>

		              </select>
                </div>
                <div class="form-group">
                    <label for="sec">ห้อง</label>
                      <select class="form-control" name="sec">
		                  <?php 
		                 	foreach ($array_sec as $key => $value) {
		                  		$selected =  ($key == $row['sec']) ? "selected" : "" ;
		                 ?>
		                 	 <option value="<?=$key ?>" <?= $selected ?>  ><?=$value ?></option>
		                 <?php
		                 	}

		                 ?>
		                 
		              </select>
                </div>
                 <div class="form-group">
                    <label for="sec">เพศ</label>
                    <?php foreach ($array_gender as $gender_key => $gender_value) {
                    	$checked = ($gender_key == $row['gender']) ? "checked" : "" ;
                     ?>
                      <label class="radio-inline">
                          <input type="radio" name="gender" <?=$checked ?> value="<?=$gender_key ?>"><?=$gender_value ?>
              		  </label>
              		<?php } ?>
              
                </div>
                <div class="form-group">
                    <label for="user name">ชื่อผู้ใช้</label>
                    <input type="text" class="form-control" name="user_name" 
                    placeholder="ชื่อผู้ใช้" value="<?=$row['username'] ?>">
                </div>
                <div class="form-group">
                    <label for="password">รหัสผ่าน</label>
                    <input type="text" class="form-control" 
                    name="password" placeholder="รหัสผ่าน" value="<?=$row['password'] ?>">
                </div>
                <div class="form-group">
                    <label for="email">อีเมล์</label>
                    <input type="email" class="form-control" 
                    name="email" placeholder="อีเมล์" value="<?=$row['email'] ?>">
                </div>
                <div class="form-group">
                    <label for="telephone">เบอร์โทรศัพท์</label>
                    <input type="tel" class="form-control" name="telephone" 
                    placeholder="หมายเลขโทรศัพท์" value="<?=$row['telephone'] ?>">
                </div>
                <input name="user_id" type="hidden" value="<?=$row['sudent_id'] ?>">
            </form>
                <button id="ok"  class="btn btn-default"> บันทึก </button>
          </div>
        </div>
</body>
</html>
<script type="text/javascript">
	$(function(){
		$("#ok").click(function(event) {
			var data = $("#from-edit-user").serializeArray();
			$.post('../service/service_edit_user.php', {data: data}, function() {
				/*optional stuff to do after success */
			}).done(function(res){
				if(res == "true"){
					get_user_manager();
					alert('แก้ไขข้อมูลผู้ใช้ เสร็จสิ้น');
					$("#edit_user_modal").modal("toggle");
					$(".modal-backdrop").hide();
				}else{
					alert("อัพเดท ล้มเหลว");
				}

			});
		});
	});
</script>
<?php
}
?>