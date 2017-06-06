<!DOCTYPE html>
<html style="margin-left: -10px">
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css">
 	<script type="text/javascript" src="lib/js/jquery-3.2.0.js"></script>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6"> <br />
      <h4 align="center"> ฟอร์มเพิ่มอุปกรณ์กีฬา </h4>
      <hr />
      <form action="add_item.php" method="POST" enctype="multipart/form-data"  name="addprd" class="form-horizontal" id="addprd">
        <div class="form-group">
          <div class="col-sm-12">
            <p> ชื่ออุปกรณ์</p>
            <input type="text"  name="p_name" class="form-control" required placeholder="ชื่ออุปกรณ์" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> รหัสอุปกรณ์ </p>
         <input type="text"  name="p_code" class="form-control" required placeholder="รหัสอุปกรณ์" />
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-12">
            <p> ชนิดอุปกรณ์ </p>
       	 <select class="form-control"  name="p_code_type">
       	 <?php  
       	 	$config = parse_ini_file("config_DB/sport_type.ini");
       	 	//var_dump(5555);

       	 ?>
       	 <?php   
       	 	foreach ($config as $key => $value) {
       	 		# code...
       	 	
       	 ?>
	    <option value="<?=$key ?>"><?php echo $value;?></option>
	   
	    <?php }?>
	  </select>
        </div>
        <div class="form-group" >
          <div class="col-sm-12" style="margin-top: 10px;">
          	         <div class="col-md-8">
		            <p> ภาพอุปกรณ์ </p>
		            <input type="file" name="p_img" class="form-control" required />
	          </div>
	          <div class="col-md-4">
		            <p> จำนวน (ชิ้น) </p>
		            <input type="number"  name="p_unit" class="form-control" required placeholder="จำนวน" />
	          </div>
          </div>
         	
          
        </div>
        <div class="form-group">
	          <div class="col-md-12" style="padding-left: 30px;">
	            <button type="submit" class="btn btn-primary" > + เพิ่มอุปกรณ์ </button>
	          </div>
	 </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>