<?php 
	function data_thai($date_eng){
		$fulldate =  explode(" ", $date_eng);
		$date = $fulldate[0];
		$time = $fulldate[1];
		$cut_year = explode("-", $date);
		$cut_year[2] = ($cut_year[2]*1)+543;
	
		return implode('-',$cut_year)." ".$time;
	}

 ?>