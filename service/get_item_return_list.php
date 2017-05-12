<?php 

// var_dump($_POST);

include '../config_DB/DB_connect.php';

$sql_select_item = "SELECT * FROM sport_inventory INNER JOIN `borrow_detail` ON sport_inventory.item_id=borrow_detail.item_id  WHERE `ref_borrow_id` = '{$_POST['br_id']}'";
//echo $sql_select_item;


?>
<form id="return-form" method="post" br-id=<?=$_POST['br_id'] ?>>
	<table class="table">
	<tr>
		<th></th>
		<th>ชื่ออุปกรณ์</th>
		<th>จำนวนที่ยืม</th>
		<th>จำนวนที่คืนแล้ว</th>
		<th>จำนวนที่ต้องการคืน</th>
		<th>จำนวนที่ชำรุด</th>
		
	</tr>
	<?php

	if($res = mysqli_query($connect,$sql_select_item)){
		while ($row = mysqli_fetch_assoc($res)) {
			echo "<tr>";
			echo "<td><img style='width: 80px;height: 80px;' src='../img_item/{$row['item_img']}'></td>";
			echo "<td>{$row['item_name']}</td>";
			echo "<td>{$row['item_amount']}</td>";
			echo "<td>{$row['item_return_amount']}</td>";
			$max = $row['item_amount']*1 - $row['item_return_amount']*1;
			$dis = ($row['item_amount']*1 == $row['item_return_amount']*1) ? "disabled" : "" ;
			echo "<td><input class='form-control' type='number' min='1' max = '{$max}' name='{$row['item_id']}' {$dis}></td>";
			echo "<td><input class='form-control' type='number' min='1' max = '{$row['item_amount']}' name='bad-{$row['item_id']}' value='0'></td>";
			// var_dump($row);
			
			echo "</tr>";
		}
	}
	?>
	</table>

<button type="button" id="submit" class="btn btn-info" >ยืนยัน</button>
</form>
<script type="text/javascript">
$("#submit").click(function() {

	var data = $("#return-form").serializeArray();
	var br_id = $("#return-form").attr('br-id');

	$.post('../service/save_item_return.php', {data:data,br_id:br_id }, function() {
		/*optional stuff to do after success */
	}).done(function(res){
		try {
			var json_res = jQuery.parseJSON(res);
			console.log(json_res);
			if(json_res.status == true){
				swal({
				   text: json_res.message,
  				   type: 'success',
  				   confirmButtonText:'ตกลง'
				});
				get_table_list();
				$("#return-modal-list").modal('toggle');
				$(".modal-backdrop").hide();
			}else{
				swal({
				   text: json_res.message,
  				   type: 'error',
  				   confirmButtonText:'ตกลง'

				});
			}

		} catch(e) {
			// statements
			console.log(e);
		}
		//alert(res);
	});
	

});
	
	
</script>


