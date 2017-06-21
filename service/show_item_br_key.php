<?php 
	require '../config_DB/DB_connect.php';
	$config = parse_ini_file("../config_DB/sport_type.ini");
	//var_dump($connect);
if($_POST['word'] == "null"){
	$item_list =  array(1,2,3);
	foreach ($item_list as $key => $value) {
			$sql ="SELECT * FROM `sport_inventory` WHERE `item_type` = '{$value}' ";
			if($res = mysqli_query($connect, $sql)){
				echo "<h2>{$config[$value]}</h2><hr>";
				echo "<div class='row'>";
				while ($row = mysqli_fetch_assoc($res)) {
					if($row['item_total'] * 1 <= 0){
					    $disabled = "disabled";
					}else{
					     $disabled = "";
					}
					echo "<div class='col-md-4 '>";
					echo "<div class='item' align='center'>";
					echo "<img id='{$row['item_id']}'  src='img_item/{$row['item_img']}' style='height:150px;width: 150px;' > </img>";
					
					echo "<p id='Name-{$row['item_id']}'>{$row['item_name']} จำนวน (<b>{$row['item_total']}</b>) ชิ้น</p>";
					echo "<button class='btn btn-info borrow' {$disabled} item-id='{$row['item_id']}'>ยืมอุปกรณ์</button>";
					echo "</div>";

					echo "</div>";
				}//while
				echo "</div>";
			}// if
	}//loop for
}// if
else{
	
	$word = $_POST['word'];
	$sql = "SELECT * FROM `sport_inventory` WHERE `item_name` LIKE '%{$word}%'";

	if($res = mysqli_query($connect, $sql)){
		echo "<div class='row'>";
				while ($row = mysqli_fetch_assoc($res)) {
					if($row['item_total'] * 1 <= 0){
					    $disabled = "disabled";
					}else{
					     $disabled = "";
					}
					echo "<div class='col-md-4 '>";
					echo "<div class='item' align='center'>";
					echo "<img id='{$row['item_id']}'  src='img_item/{$row['item_img']}' style='height:150px;width: 150px;' > </img>";
					
					echo "<p id='Name-{$row['item_id']}'>{$row['item_name']} จำนวน (<b>{$row['item_total']}</b>) ชิ้น</p>";
					echo "<button class='btn btn-info borrow' {$disabled} item-id='{$row['item_id']}'>ยืมอุปกรณ์</button>";
					echo "</div>";

					echo "</div>";
				}//while
		echo "</div>";
	}

}//else
?>
<script type="text/javascript">
	$('.borrow').click(function(event) {
		var item_id = $(this).attr('item-id');
		$("#item-hide-id").val(item_id);
		$("#num-item").val('');
		var url_img =  $("#"+item_id).attr('src');
		var name_item = $('#Name-'+item_id).text();
		$("#modal-name").text(name_item);
		var total = $('#Name-'+item_id+' b').text(); 
		$("#alert").text(total);
		$("#num-item").attr('max', total);
		$("#modal-img").attr('src', url_img);
		$("#modal-borrow").modal('toggle');

	});

	$("form#modal-item").submit(function(event) {
		let item_id = $("#item-hide-id").val();
		let amount = $("#num-item").val();
		var note = $("#note").val();
		$.post('service/service_session_cart.php', {item_id: item_id,amount:amount,method:'set',note:note}, function() {
			
		}).done(function(data){
			if(data == 'true'){
				get_count_item();
				$("#modal-borrow").modal('toggle');
			}else{
				alert(data);
			}
		});
		//alert($("#item-hide-id").val()+" num "+$("#num-item").val());
	});
</script>