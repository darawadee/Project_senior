<!DOCTYPE html>
<html style="margin-left: -10px">
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
 	<script type="text/javascript" src="lib/js/jquery-3.2.0.js"></script>
</head>
<body>
      <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <form role="form" action="action_register.php" method="post">
                <div class="form-group">
                    <label for="name">ชื่อ</label>
                    <input type="text" class="form-control" name="fname" 
                    placeholder="กรอกชื่อ">
                </div>
                <div class="form-group">
                    <label for="last name">นามสกุล</label>
                    <input type="text" class="form-control" name="lname" 
                    placeholder="นามสกุล">
                </div>
                <div class="form-group">
                    <label for="id">รหัส</label>
                    <input type="text" class="form-control" name="sudent id" 
                    placeholder="รหัสนักเรียน">
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
                    placeholder="ชื่อผู้ใช้">
                </div>
                <div class="form-group">
                    <label for="password">รหัสผ่าน</label>
                    <input type="password" class="form-control" 
                    name="password" placeholder="รหัสผ่าน">
                </div>
                <div class="form-group">
                    <label for="email">อีเมล์</label>
                    <input type="email" class="form-control" 
                    name="email" placeholder="อีเมล์">
                </div>
                <div class="form-group">
                    <label for="telephone">เบอร์โทรศัพท์</label>
                    <input type="tel" class="form-control" name="telephone" 
                    placeholder="หมายเลขโทรศัพท์">
                </div>
                
                <button type="submit" class="btn btn-default"> บันทึก </button>
            </form>
          </div>
        </div>
</body>
</html>