<style type="text/css">
	#dash1,#dash2,#dash3{
		height: 300px;
		background-color: #8190a8;

	}
</style>

<div class="row" style="text-align: center;">
	<div class="col-md-6" id="dash1">
		dash1
	</div>
	<div class="col-md-6" id="dash2">
		dash2
	</div>
</div>

<div class="row" style="text-align: center;">
	<div class="col-md-12" id="dash3">dash3</div>
	
</div>


<script type="text/javascript">
$(function(){
	var data = [];
	


	$.get('service_admin/get_data.php', function() {
		/*optional stuff to do after success */
	}).done(function(data){
		try {
			var json_data = jQuery.parseJSON(data);
			//alert(json_data);

			chart_user("dash1",json_data.data_user,"จำนวนสมาชิก");

			chart_user("dash2",json_data.data_item,"จำนวนชนิดของอุปกรณ์");

		} catch(e) {
			// statements
			console.log(e);
		}
		//alert(data);
	});
});

	function chart_user(target_,data , title){

		Highcharts.chart(target_, {
		    chart: {
		        type: 'pie',
		        options3d: {
		            enabled: true,
		            alpha: 45,
		            beta: 0
		        }
		    },
		    title: {
		        text: title
		    },
		    tooltip: {
		        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		    },
		    plotOptions: {
		        pie: {
		            allowPointSelect: true,
		            cursor: 'pointer',
		            depth: 35,
		            dataLabels: {
		                enabled: true,
		                format: '{point.name}'
		            }
		        }
		    },
		    series: [{
		        type: 'pie',
		        name: 'Browser share',
		        data:data
		        // data: [
		        //     ['อาจารย์ 1', 1],
		        //     ['นักเรียน 2', 2]
		          
		            
		        // ]
		    }]
		});
	}
	


</script>