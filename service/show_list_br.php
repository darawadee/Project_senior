
<?php 
session_start(); 
include '../config_DB/DB_connect.php';
$user_id = $_SESSION["data_user"]["sudent_id"];
$array_type_status = array();
$sql_select_type_msg = "SELECT * FROM `status_type`";
$res_select_type_msg = mysqli_query($connect, $sql_select_type_msg);
while ($row_type_msg = mysqli_fetch_assoc($res_select_type_msg )) {
	$array_type_status[] = $row_type_msg;
	
}

//var_dump($array_type_status);
?>
<div style="height: 500px;">
<?php if($_SESSION["data_user"]["user_type"] != 3) {?>
<table class="table ">
	<tr >
		<th>เลขที่การยืม</th>
		<th>อุปกรณ์ที่ยืม</th>
		<th>วันเวลาที่ยืม</th>
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
				<td><?=$row['status_msg'] ?></td>
			</tr>
	<?php 
			}
		}
	?>
</table>
<?php }elseif($_SESSION["data_user"]["user_type"] == 3){ ?>
	<table class="table table-hover">
		<tr >
			<th>เลขที่การยืม</th>
			<th>ผู้ยืม</th>
			<th>สถานะผู้ยืม</th>
			<th>อุปกรณ์ที่ยืม</th>
			<th>วันเวลาที่ยืม</th>
			<th>สถานะ</th>
			<th></th>
		</tr>
		<?php 
		$sql_get_br = "SELECT * FROM `user_acount` INNER JOIN borrow_table on(user_acount.sudent_id=borrow_table.ref_user_id) INNER JOIN status_type ON (borrow_table.br_status=status_type.status_id) ORDER BY `borrow_table`.`borrow_id` DESC";
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
					foreach ($array_type_status as $key => $array_type_stu) {
						if($array_type_stu['status_id'] == $row_br['br_status'] ){
							$selected = "selected";
						}else{
							$selected = "";
						}
					
				?>
				<option  value="<?=$array_type_stu['status_id'] ?>" borrow_id ="<?=$row_br['borrow_id'] ?>" <?=$selected ?> > <?=$array_type_stu['status_msg']?> </option>

				<?php 
					}
				?>
				</select>

			</td>
			<td><button class="btn btn-info" borrow_id ="<?=$row_br['borrow_id'] ?>"> คืน </button></td>
		</tr>
		<?php }?>
	</table>



<?php }else{ ?>

	


<?php } ?>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.status_update').change(function(event) {
			var option_selected = $(this).find('option:selected'); 
			var br_id = option_selected.attr('borrow_id');
			var message = option_selected.text();
			var num_status = $(this).val();
				swal({
				  title: 'คุณแน่ใจหรือไม่ ที่จะอัพเดทสถานะ เป็น '+message,
				  text: 'กรุณาใส่ password ของท่าน เพื่อทำการยืนยัน',
				  input: 'password',
				  showCancelButton: true,
				  confirmButtonText: 'Submit',
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
				      			swal(data);
				      			
				      		});
				      }
				   
				  } 
				})
		});
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