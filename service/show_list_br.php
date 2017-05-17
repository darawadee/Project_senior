
<?php 
session_start(); 
include '../config_DB/DB_connect.php';
$user_id = $_SESSION["data_user"]["sudent_id"];
$array_type_status = array();
$sql_select_type_msg = "SELECT * FROM `status_type` LIMIT 4";
$res_select_type_msg = mysqli_query($connect, $sql_select_type_msg);
while ($row_type_msg = mysqli_fetch_assoc($res_select_type_msg )) {
	$array_type_status[] = $row_type_msg;
	
}

//var_dump($array_type_status);
?>


<?php if($_SESSION["data_user"]["user_type"] != 3) {?>
<table class="table ">
	<tr >
		<th>เลขที่การยืม</th>
		<th>อุปกรณ์ที่ยืม</th>
		<th>วันเวลาที่ยืม</th>
		<th>วันเวลาที่คืน</th>
		<th>สถานะ</th>
	</tr>
	<?php 
		$sql_br = "SELECT * FROM `borrow_table` INNER JOIN status_type ON(borrow_table.br_status=status_type.status_id) WHERE `ref_user_id` = '{$user_id}' ORDER BY `borrow_id` DESC ;";

		if($res = mysqli_query($connect, $sql_br)){
			while ($row = mysqli_fetch_assoc($res)) {
	?>
			<tr>
				<td ><?=$row['borrow_id'] ?></td>
				<td><?php echo get_item_by_brID($row['borrow_id'],$user_id,$connect); ?></td>
				<td><?=$row['borrow_date'] ?></td>
				<td><?=$row['return_date'] ?></td>
				<td><?=$row['status_msg'] ?></td>
			</tr>
	<?php 
			}
		}
	?>
	<!-- // for admin -->
</table>
<?php }elseif($_SESSION["data_user"]["user_type"] == 3){ ?>
	<table class="table table-hover" id="br_table">
		<tr >
			<th>เลขที่การยืม</th>
			<th>ผู้ยืม</th>
			<th>สถานะผู้ยืม</th>
			<th>อุปกรณ์ที่ยืม</th>
			<th>วันเวลาที่ยืม</th>
			<th>สถานะ</th>
			<th>หมายเหตุ</th>
			<th></th>
			
		</tr>
		<?php 
		$sql_get_br = "SELECT * FROM `user_acount` INNER JOIN borrow_table on(user_acount.sudent_id=borrow_table.ref_user_id) INNER JOIN status_type ON (borrow_table.br_status=status_type.status_id) WHERE borrow_table.br_status != 5 ORDER BY `borrow_table`.`borrow_id` DESC";
		$res_get_br = mysqli_query($connect, $sql_get_br);
		while ($row_br = mysqli_fetch_assoc($res_get_br)) {
			# code...
		
		?>
		<tr>
			<td><?=$row_br['borrow_id'] ?></td>
			<td><?php echo ($row_br['gender'] == 'M') ? 'นาย' : 'น.ส.';?>   <?=$row_br['fname'] ?> <?=$row_br['lname'] ?>  <?=$row_br['class'] ?>/<?=$row_br['sec'] ?></td>
			<td><?= return_status_user($row_br['user_type'])?></td>
			<td><?php echo get_item_by_brID($row_br['borrow_id'],$row_br['sudent_id'],$connect);?></td>
			<td><?=$row_br['borrow_date'] ?></td>
			<td>
				<select class="form-control status_update" >
				<?php 
				error_reporting(0);
					foreach ($array_type_status as $key => $array_type_stu) {
						if($array_type_stu['status_id'] == $row_br['br_status'] ){
							$selected = "selected";
						}else{
							$selected = "";
						}
						if($array_type_stu['status_id'] >= $row_br['br_status'] ){
					
				?>
				<option  value="<?=$array_type_stu['status_id'] ?>" borrow_id ="<?=$row_br['borrow_id'] ?>" <?=$selected ?> > <?=$array_type_stu['status_msg']?> </option>

				<?php 
						}
					}
				?>
				</select>

			</td>
			<td>
				<?=($row_br['br_type'] == 'inclass') ? "ในเวลาเรียน" : "นอกเวลาเรียน" ?>
				
			</td>
			<td>
			<?php if($row_br['br_status'] == '3' || $row_br['br_status'] == 3 || $row_br['br_status'] == '4' || $row_br['br_status'] == 4){?>
				<button class='btn btn-info btn-return' br-id='<?=$row_br['borrow_id'] ?>'>คืน</button>
			<?php }?>
			</td>
			
		</tr>
		<?php }?>
	</table>
<!-- Modal -->
<div class="modal fade" id="return-modal-list" role="dialog">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">รายการยืมอุปกรณ์</h4>
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


<?php }else{ ?>

	


<?php } ?>





<script type="text/javascript">
	$(document).ready(function() {
		 
        // change status______________________________________________

		$('.status_update').change(function(event) {
			var option_selected = $(this).find('option:selected'); 
			var br_id = option_selected.attr('borrow_id');
			var message = option_selected.text();
			var num_status = $(this).val();
				if(num_status != 4){
					// ______________________________________________________________
					swal({
					  title: 'คุณแน่ใจหรือไม่ ที่จะอัพเดทสถานะ เป็น '+message,
					  text: 'กรุณาใส่ Password ของท่าน เพื่อทำการยืนยัน',
					  input: 'password',
					  showCancelButton: true,
					  confirmButtonText: 'ยืนยัน',
					  cancelButtonText: 'ยกเลิก',
					  //showLoaderOnConfirm: true,
					  preConfirm: function (text) {
					   
					      //alert(text);
					      if(text === ''){
					      	swal(
							  'Oops...',
							  'กรุณาป้อน password',
							  'error'
							)
					      }else{
					      		$.post('../service/update_status_br.php', {password: text,br_id:br_id,num_status:num_status}, function() {
					      			/*optional stuff to do after success */
					      		}).done(function(data){
					      			swal({
					      				text:data,
					      				confirmButtonText: 'ตกลง'
					      			});
					      			get_table_list();
					      		});
					      }
					   
					  } 
					});
					// ______________________________________________________________
					
				}else{
					
				}


				//คืนไม่ครบ__________________________________________________________
		




				//คืนไม่ครบ__________________________________________________________
		});
		   // change status______________________________________________


		// event button return
		$(".btn-return").click(function(event) {
			var br_id = $(this).attr('br-id');

			$.post('../service/get_item_return_list.php', {br_id:br_id}, function() {
						/*optional stuff to do after success */
			}).done(function(data){
				$(".modal-body").html(data);
				$("#return-modal-list").modal('show');


				
			});
		
		});
		// event button return
	});
</script>

<!-- SELECT * FROM `borrow_table` INNER JOIN borrow_detail ON borrow_table.borrow_id=borrow_detail.ref_borrow_id WHERE borrow_table.ref_user_id = '1234567883' -->

<?php 
	function get_item_by_brID($br_id,$user_id,$connect){
		$sql = "SELECT * FROM `borrow_table` INNER JOIN borrow_detail ON (borrow_table.borrow_id=borrow_detail.ref_borrow_id) INNER JOIN sport_inventory ON (borrow_detail.item_id=sport_inventory.item_id) WHERE borrow_table.ref_user_id = '{$user_id}' and borrow_table.borrow_id = '{$br_id}'";
		$item_and_amount = array();
		if($res = mysqli_query($connect, $sql)){
			while ($row = mysqli_fetch_assoc($res)) {
				$item_and_amount[] = $row['item_name']." ".$row['item_amount']." ชิ้น";
			}
		}

		return implode(' , ', $item_and_amount);
	}
	function return_status_user($user_type){
		if($user_type == "3"){
			return  "Admin";
		}elseif($user_type == "2"){
			return  "อาจารย์";
		}else{
			return  "นักเรียน";
		}
	}


?>