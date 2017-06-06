<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php 
		require 'config_DB/DB_connect.php';
		$config = parse_ini_file("config_DB/sport_type.ini"); 
	?>
<style type="text/css">
	.myinput{
		width: 80px;
	}
	.myinputfile{
		width: 150px;
	}
	.item{
		background-color: #83a2d3;
		height: 200px;
		padding: 20px;
	}
</style>
</head>
<body>

<div class="row">
	<div class="col-md-12"  style="height: 400px;overflow: scroll;">
		
		<table class="table">

			<tr>
				<td>รหัสอุปกรณ์</td>
				<td>ชื่อ</td>
				<td>รูป</td>
				<td>จำนวนทั้งหมด</td>
				<td>จำนวนคงเหลือ</td>
				<td>จำนวนที่ชำรุด</td>
				<td>ชนิดอุปกรณ์</td>
				<td></td>
			</tr>
			<?php 
				$select_item = "SELECT * FROM `sport_inventory`  ORDER BY `item_type`";
				if($res = mysqli_query($connect, $select_item)){
					
					while ($row = mysqli_fetch_assoc($res)) {
						 
						echo "<tr id='{$row['item_id']}'>";
						echo "<td>{$row['item_id']}</td>";
						echo "<td>{$row['item_name']}</td>";
						echo "<td><img src='../img_item/{$row['item_img']}' style='width: 50px;height: 50px;'></td>";
						echo "<td>{$row['item_all']}</td>";
						echo "<td>{$row['item_total']}</td>";
						echo "<td>{$row['item_bad']}</td>";
						echo "<td>{$config[$row['item_type']]}</td>";
						echo "<td>";
						echo "<a href='#' class='edit-btn btn btn-warning' p-code='{$row['item_id']}'><span class='fa fa-cog fa-lg' aria-hidden='true'></span>";
						echo "<a href='#' class='delete-btn btn btn-danger' p-code='{$row['item_id']}'><span class='fa fa-trash-o' aria-hidden='true'></span>";
						echo"</td>";
						echo "</tr>";

						
						//echo "</form>";
					}	
					//echo "</form>"	;
				}

			?>
		</table>
		</form>

	</div>
	<a href="../sport_equipment.php" class="btn btn-success">
		
		 <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
		เพิ่มอุปกรณ์
	</a>
</div>


<!-- /model -->
<!-- Modal -->
<div class="modal fade" id="myModal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="content-modal">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>

<!-- /model -->
</body>
<script type="text/javascript">
	$(document).ready(function() {
		$(".delete-btn").click(function(event) {
			var conf = confirm("คุณแน่ใจหรือไม่");
			var p_code = $(this).attr("p-code");
			if(conf == true){
				$.post('../delete_item.php', 
				{
					p_code: p_code
				}, 
					function() {
					/*optional stuff to do after success */
					}
				).done(function(data){
					if(data == true){
						$("#"+p_code).remove();
						$("#edit"+p_code).remove();
					}else{
						alert("ลบไม่สำเร็จ");
					}
				});	
			}
			
			//alert(p_code);
			//console.log(conf);
		});
		$(".edit-btn").click(function(event) {
			var p_code = $(this).attr('p-code');
			//alert(p_code);
			$.post('../edit_form_item.php', {product_id: p_code}, 
				function() {
				/*optional stuff to do after success */
				}
			).done(function(data){
				$(".modal-body").html(data);
				//alert(data);
			});
			$("#myModal_edit").modal("show");

		});

		

		//hide edit
	});
</script>
</html>
