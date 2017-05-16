<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h3 style="text-align: center;">รายการคำร้องขออุปกรณ์</h3>
	<div style="text-align: right;">
	<input type="date" id="datePicker" >
		
	</div>
	<div id="sub-content">
		
	</div>
</body>
<script type="text/javascript">
	$("#datePicker").change(function(event) {
		
		ajax_page_request($(this).val());
	});

	ajax_page_request(null);
	function ajax_page_request(date){
		$.post('service_admin/get_reauest_table.php', {date: date}, function(data, textStatus, xhr) {
			$("#sub-content").html(data);
		});
	}
</script>
</html>
