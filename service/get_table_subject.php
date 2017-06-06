<?php 
session_start();
include '../config_DB/DB_connect.php';


// var_dump($_SESSION);
if($_SESSION['data_user']["user_type"] == 1){
	 $where = "AND subjects_table.class = {$_SESSION['data_user']['class']}  AND subjects_table.sec = {$_SESSION['data_user']['sec']}";
	
	// $where = "";
}else{
	 $where = "";
}
$timeArr = array( 
			0 => array( "start" => "08:00", "stop" => "09:00"), 
			1 => array( "start" => "09:00", "stop" => "10:00"), 
			2 => array( "start" => "10:00", "stop" => "11:00"), 
			3 => array( "start" => "11:00", "stop" => "12:00"), 
			4 => array( "start" => "13:00", "stop" => "14:00"), 
			5 => array( "start" => "14:00", "stop" => "15:00"), 
			6 => array( "start" => "15:00", "stop" => "16:00"),
			7 => array( "start" => "16:00", "stop" => "17:00")
);


$day_array = array(
	1 => "จันทร์",
	2 => "อังคาร",
	3 => "พุธ",
	4 => "วันพฤหัส",
	5 => "วันศุกร์"
	);

for ($day = 1 ;$day<=5;$day++ ){
	$timeTeach[$day] = array();

	$sql = "SELECT CONCAT(`time_start`,'-',`time_end`) as time , CONCAT(subjects_table.class,'/',subjects_table.sec,' (',item_name,') ','<br>',master_name_table.Master_name,' ',subjects_table.room) as title ,item_id FROM sport_inventory INNER JOIN subjects_table ON sport_inventory.item_id=subjects_table.ref_item_id INNER JOIN master_name_table ON subjects_table.ref_master_id=master_name_table.Master_id WHERE subjects_table.teach_day = '{$day}' {$where}";
	// echo $sql."<br>";
	$res = mysqli_query($connect,$sql);

	while ($rows = mysqli_fetch_assoc($res)) {
		$timeTeach[$day][] = $rows;
	}
	
}
// echo "<pre>";
// var_dump($timeTeach);
// die();
//End การจัดรูปแบบข้อมูล

/* Head Column */
function createCol($arr){
	$row = "";
	foreach( $arr as $data )
	{
		$row .= '<th style="text-align: center;">' . $data['start'] . '-' . $data['stop'] . '</th>';
	}
	return $row;
}

/* Key Positon */
function getCol($haystack, $keyNeedle)
{
    $i = 0;
    foreach($haystack as $arr)
    {
        if($arr['start'] == $keyNeedle)
        {
            return $i;
        }
        $i++;
    }
}

/* Time Range */
function getTimeRange($timeT, $timeCol){
	$data = array();
	foreach($timeT as $timeA){
		$time = $timeA['time'];
		if(!$time) continue;
		$tm = explode("-", $time);
		//echo '<pre>', print_r($tm,true) ,'</pre>';
		$start = getCol($timeCol, $tm[0]);
		$end = getCol($timeCol, $tm[1] );
		$colspan = $end - $start;
		$data[$tm[0]] = array('colspan' => $colspan, 'title' => $timeA['title'] , 'item_id' =>$timeA['item_id']);
	}
	return $data;
}
echo " <center><h1 style='color: #4286f4'>ตารางเรียนวิชา พละ </h1></center>";
$list = "";
echo '<table class="table" border="1" width="90%" align="center" cellspacing="0" style="margin-top: 30px">';
echo '<tr><td>&nbsp;</td>'. createCol( $timeArr ) .'</tr>';
foreach($timeTeach as $i=>$arr){

	//ค้นหาข้อมูลในตารางลงทะเบียน
	//นับช่วงเวลา start_time กับ stop_time ว่ามีกี่ช่อง
	$timeT = $timeTeach[$i];
	
	$arrRange = getTimeRange($timeT, $timeArr);
	
	// echo '<pre>', print_r($arrRange,true) ,'</pre>';
	
	$no = $day_array [$i] ;

	$list = '<tr>';
	$list.= '<td rowspan="2" class="no">'.$no.'</td>';
	// $list.= '<td>ลายเซ็น</td>';
	$chkCol = 0;
	$col = 0;
	foreach( $timeArr as $timeA )
	{	
		$highlight = "";
		$colspan = "";
		if($chkCol < ($col-1) && $col != 0){
			$chkCol++;
			continue;
		}
		$col = 0;
		$chkCol = 0;
		if(!empty($arrRange[trim($timeA['start'])])){
			$col = $arrRange[trim($timeA['start'])]['colspan'];
			$highlight = "highlight";
			$colspan = 'colspan="'.$col.'"';
		}
		// $list.= '<td '.$colspan.' class="'. $highlight .'">&nbsp;</td>';
	}
	$list.= '</tr>';
	
	$list.= '<tr>';
	//$list.= '<td>เอก/รุ่น/ห้อง</td>';
	foreach( $timeArr as $timeA )
	{	
		$highlight = "";
		$colspan = "";
		if($chkCol < ($col-1) && $col != 0){
			$chkCol++;
			continue;
		}
		$title = "&nbsp;";
		$col = 0;
		$chkCol = 0;
		if(!empty($arrRange[trim($timeA['start'])])){
			$col = $arrRange[trim($timeA['start'])]['colspan'];
			$title = $arrRange[trim($timeA['start'])]['title'];
			$highlight = "highlight";
			$colspan = 'colspan="'.$col.'"';
			$id_item = $arrRange[$timeA['start']]['item_id'];
		}

		if(!isset($id_item)){
			$id_item="";
		}else{

		}
		// echo "<pre>";
		// var_dump($arrRange);
		$list .= '<td '.$colspan.' class="'. $highlight .' title" id_item="'.$id_item.'">' . $title . '</td>';
	}
	$list .= '</tr>';
	echo $list;
	
}
echo '</table>';


?>
<div class="modal fade" id="modal-borrow-table" role="dialog">
    <div class="modal-dialog">
   
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">อุปกรณ์</h4>
        </div>
        <div class="modal-body">
        	<div class="row">
        		<div class="col-md-3" >
        			<img id="modal-img-table" style="width:100%;height: 100%;" />
        		</div>
        		<div class="col-md-9">
        		     <form action="#" id="modal-item-table">
	        			<p id="modal-name-table">name</p>
	        			<p style="color: red">**ไม่ควรยืมอุปกรณ์เกิน <b id="alert-table">90</b> ชิ้น**</p>
	        			<p>
	        			<input class="form-control" type="number" id="num-item-table" min="1" required="">
	        			<input type="hidden" id="item-hide-id-table">
	        			<input type="hidden" id="note" value="inclass">
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
	$(function(){
		$(".highlight.title").click(function(event) {
			var _item_id = $(this).attr('id_item');
			$("#item-hide-id-table").val(_item_id);
			
			$.post('service/get_item_by_id.php', {itemp_id: _item_id}, function() {
				/*optional stuff to do after success */
			}).done(function(data){
				try{
					var json = jQuery.parseJSON(data);
					//alert(data);
					$("#num-item-table").val('');

					$("#modal-img-table").attr('src',"img_item/"+json.item_img);
					$("#modal-name-table").html(json.item_name);
					$("#alert-table").html(json.item_total);
					$("#num-item-table").attr("max",json.item_total);
					$("#modal-borrow-table").modal('toggle');
				}catch(e){
					//alert(data);
					swal({
					  title: 'คำเตือน?',
					  text: data,
					  type: 'error',
					  
					  confirmButtonColor: '#3085d6',
					  
					  confirmButtonText: 'ตกลง',
					  animation: true,
  					customClass: 'animated tada'
					})
				}
				//alert(data);
			});
			// $("#modal-borrow-table").modal("toggle");
		});


		$("form#modal-item-table").submit(function(event) {
			let item_id = $("#item-hide-id-table").val();
			let amount = $("#num-item-table").val();
			var note = $("#note").val();
			$.post('service/service_session_cart.php', {item_id: item_id,amount:amount,method:'set',note:note}, function() {
				
			}).done(function(data){
				if(data == 'true'){
					get_count_item();
					$("#modal-borrow-table").modal('toggle');
				}else{
					alert(data);
				}
			});
			//alert($("#item-hide-id").val()+" num "+$("#num-item").val());
		});
	});
</script>
