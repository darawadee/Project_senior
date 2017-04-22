<style type="text/css">
	.item{
		background-color: #83a2d3;
		height:auto;
		padding: 20px;
		margin-top: 10px;

	}
</style>

<?php 
	require 'config_DB/DB_connect.php';
	$config = parse_ini_file("config_DB/sport_type.ini");
	if(isset($_POST['item_type'])){
		if($_POST['item_type']!="0"){
			$sql ="SELECT * FROM `sport_inventory` WHERE `item_type` = '{$_POST['item_type']}' ";

			$disable = "";



			if($res = mysqli_query($connect, $sql)){
				echo "<h2>{$config[$_POST['item_type']]}</h2><hr>";
				while ($row = mysqli_fetch_assoc($res)) {
					if($row['item_total'] * 1 <= 0){
					    $disabled = "disabled";
					}else{
					     $disabled = "";
					}

					echo "<div class='col-md-3 '>";
					echo "<div class='item' align='center'>";
					echo "<img id='{$row['item_id']}'  src='img_item/{$row['item_img']}' style='height:150px;width: 150px;' > </img>";
					
					echo "<p id='Name-{$row['item_id']}'>{$row['item_name']} (<b>{$row['item_total']}</b>)</p>";
					echo "<button class='btn btn-info borrow' {$disabled} item-id='{$row['item_id']}'>ยืมอุปกรณ์</button>";
					echo "</div>";

					echo "</div>";
				}
			}
		}else{
			$item_list =  array(1,2,3);
			foreach ($item_list as $key => $value) {
				$sql ="SELECT * FROM `sport_inventory` WHERE `item_type` = '{$value}' ";
				if($res = mysqli_query($connect, $sql)){
				echo "<h2>{$config[$value]}</h2><hr>";
				echo "<div class='row'>";
				while ($row = mysqli_fetch_assoc($res)) {
					echo "<div class='col-md-3 '>";
					echo "<div class='item' align='center'>";
					echo "<img id='{$row['item_id']}' src='img_item/{$row['item_img']}' style='height:150px;width: 150px;' > </img>";
					
					echo "<p id='Name-{$row['item_id']}'>{$row['item_name']} (<b>{$row['item_total']}</b>)</p>";
					echo "<a class='btn btn-info borrow' item-id='{$row['item_id']}'>ยืมอุปกรณ์</a>";
					echo "</div>";

					echo "</div>";
				}
				echo "</div>";
			}
			}

		}
		
	}



?>

<div class="modal fade" id="modal-borrow" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">อุปกรณ์</h4>
        </div>
        <div class="modal-body">
        	<div class="row">
        		<div class="col-md-3">
        			<img id="modal-img" style="width:100%;height: 100%;" />
        		</div>
        		<div class="col-md-9">
        		     <form action="#">
        			<p id="modal-name">name</p>
        			<p style="color: red">**ไม่ควรยืมอุปกรณ์เกิน <b id="alert">90</b> ชิ้น**</p>
        			<p>
        			<input class="form-control" type="number" id="num-item" min="1" required="">
        			</p>
        			<p><button type="submit" class="btn btn-info">ok</button></p>
        		     </form>
        		</div>
        	</div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<script type="text/javascript">
	$('.borrow').click(function(event) {
		var item_id = $(this).attr('item-id');
		//$(".modal-title").html(item_id);
		//$("#num-item").val('');
		var url_img =  $("#"+item_id).attr('src');
		var name_item = $('#Name-'+item_id).text();
		$("#modal-name").text(name_item);
		var patt = /\(\s?(\d.?)\s?\)/gm;
		var number_patt = /\d+/g;
		//name_item.replace(patt, "$1");
		var total = $('#Name-'+item_id+' b').text(); 
		$("#alert").text(total);
		$("#num-item").attr('max', total);
		
		// var total_num = total.match(patt);
		//alert(total);
		$("#modal-img").attr('src', url_img);
		$("#modal-borrow").modal('toggle');

	});

	$("form").submit(function(event) {
		alert(555);
	});
</script>