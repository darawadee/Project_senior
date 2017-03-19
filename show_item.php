<style type="text/css">
	.item{
		background-color: #83a2d3;
		height:auto;
		padding: 20px;

	}
</style>

<?php 
	require 'config_DB/DB_connect.php';
	if(isset($_POST['item_type'])){
		$sql ="SELECT * FROM `sport_inventory` WHERE `item_type` = '{$_POST['item_type']}' ";

		if($res = mysqli_query($connect, $sql)){
			while ($row = mysqli_fetch_assoc($res)) {
				echo "<div class='col-md-3 '>";
				echo "<div class='item' align='center'>";
				echo "<img src='img_item/{$row['item_img']}' style='height:150px;width: 150px;' > </img>";
				
				echo "<p>{$row['item_name']} ({$row['item_total']})</p>";
				echo "<a class='btn btn-info'>ยืมอุปกรณ์</a>";
				echo "</div>";

				echo "</div>";
			}
		}
	}



?>