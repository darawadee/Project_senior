
<head>
<?php 
require 'config_DB/DB_connect.php';

$sql  = " SELECT * FROM `sport_inventory` WHERE `item_id` = '{$_POST['product_id']}' ";
//echo " <h3>".$sql."</h3>";

$res =  mysqli_query($connect,$sql);
$row=  mysqli_fetch_assoc($res);
//var_dump($row);
?>



</head>


  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6"> <br />
      <h4 align="center"> ฟอร์มแก้ไขอุปกรณ์กีฬา </h4>
      <hr />
      <form action="action_edit_item.php" method="POST" enctype="multipart/form-data"  name="addprd" class="form-horizontal" id="addprd">
        <div class="form-group">
          <div class="col-sm-12">
            <p> ชื่ออุปกรณ์</p>
            <input type="text"  name="p_name" class="form-control" required placeholder="ชื่ออุปกรณ์" value="<?php echo $row['item_name'];?>" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> รหัสอุปกรณ์ </p>
         <input type="text"  name="p_code" class="form-control" required placeholder="รหัสอุปกรณ์" value="<?php echo $row['item_id'];?>" />
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-12">
            <p> ชนิดอุปกรณ์ </p>
         <select class="form-control"  name="p_code_type">
               <?php  
                $config = parse_ini_file("config_DB/sport_type.ini");
                //var_dump(5555);
                $item_type=$row['item_type'];
                $select ="";
               ?>
               <?php   
                foreach ($config as $key => $value) {
                  # code...
                  if($key == $item_type){
                    $select="selected";
                  }else{
                  $select ="";
                  }
                
               ?>
      <option value="<?=$key?>"  <?=$select ?> ><?php echo $value ;?></option>
     
      <?php }?>
    </select>
        </div>
        <div class="form-group" >
          <div class="col-sm-12" style="margin-top: 10px;">
                     <div class="col-md-8">
                <p> ภาพอุปกรณ์ </p>
                <input type="file" name="p_img" class="form-control"   />
            </div>
            <div class="col-md-4">
                <p> จำนวนอุปกรณ์ (ชิ้น) </p>
                <input type="number"  name="p_unit" class="form-control" required placeholder="จำนวน" value="<?php echo $row['item_total'];?>"  />
            </div>
          </div>
          
          
        </div>
        <div class="form-group">
            <div class="col-md-12" style="padding-left: 30px;">
              <button type="submit" id="btn_submit_edit" class="edit-btn btn btn-warning" > <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> แก้ไขอุปกรณ์ </button>
           

            </div>
   </div>
      </form>
    </div>


  
</div>
