<style type="text/css">
	#dash1,#dash2{
		min-height: 300px;
		
		/*background-color: #8190a8;*/

	}
	#dash3{
		min-height: 400px;
	}
</style>

<div class="row" style="text-align: center;">
	<div class="col-md-6">
		
		<div class="panel panel-info ">
		      <div class="panel-heading" style="text-align: right;">
			  </div>
			  <div class="panel-body" id="dash1">
					dash1
			  </div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="panel panel-info ">
		      <div class="panel-heading" style="text-align: right;">
			  </div>
			  <div class="panel-body" id="dash2">
				dash1
			  </div>
		</div>
	</div>
</div>

<div class="row" style=" margin-top: 25px;" >
	<div class="col-md-12" >
		<div class="panel panel-info"">
	      <div class="panel-heading" style="text-align: right;">
	      	<select style="width: 100px;" id="year-select">
	      		<?php 
	      			$year = date('Y')*1;
	      			$min_year = $year-10;
	      			$max_year = $year+10;
	      			for($min_year ; $min_year<= $max_year ;$min_year++ ){
	      				if($min_year == $year){
	      					$select="selected";
	      				}else{
	      					$select="";
	      				}
	      				 
	      			
	      		?>
	      		<option value="<?=$min_year ?>"  <?=$select?>> <?=$min_year ?></option>

	      		<?php }?>
	      	</select>
	      </div>
	      <div class="panel-body" id="dash3">
			dash3
	      	
	      </div>
	    </div>
	</div>
</div>


<div class="row" style=" margin-top: 25px;" >
	<div class="col-md-12" >
		
		<div class="panel panel-info ">
	      <div class="panel-heading" style="text-align: right;"></div>
		  <div class="panel-body" id="dash4">
			dash4
      	
      	  </div>
		</div>
	     
	</div>
</div>

<!-- Modal -->
<div id="modal-dashbord" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="title-modal-dashbord">Modal Header</h4>
      </div>
      <div class="modal-body" id="modal-dashbord-content">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->

<script type="text/javascript">
$(function(){
	var data = [];
	// start 
	$.get('service_admin/get_data.php', function() {
		/*optional stuff to do after success */
	}).done(function(data){
		try {
			var json_data = jQuery.parseJSON(data);
			//alert(json_data);

			chart_user("dash1",json_data.data_user,"จำนวนสมาชิก","user");

			chart_user("dash2",json_data.data_item,"จำนวนชนิดของอุปกรณ์","item");

			get_br_return("dash3",json_data.borrow_report,"รายงานการยืมคืนปีปัจจุบัน");

			get_popular("dash4",json_data.item_popular,"อุปกรณ์ที่ได้รับความนิยม");

		} catch(e) {
			// statements
			console.log(e);
		}
		//alert(data);
	});

	// stop 
	var year = $("#year-select").val();
	$("#year-select").change(function(event) {


		 year = $(this).val();

		$.post('service_admin/get_data.php',{year:year}, function() {
		/*optional stuff to do after success */
		}).done(function(data){
			try {
				var json_data = jQuery.parseJSON(data);
				get_br_return("dash3",json_data.borrow_report,"รายงานการยืมคืน ปี"+year,year);

			} catch(e) {
				// statements
				console.log(e);
			}
			//alert(data);
		});
	});


});


// start function
function chart_user(target_,data , title,method_name){

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
	        name: 'ร้อยละ',
	        data:data,
	        point:{
              events:{
                  click: function (event) {
                      
                      var title_modal = this.name;
                      
                      $.post('service_report/get_list_user.php', {word:title_modal,method:method_name }, function() {
                      	/*optional stuff to do after success */
                      }).done(function(data){
                      	$('#title-modal-dashbord').html(title_modal);
                      	$("#modal-dashbord-content").html(data);

                      	$("#modal-dashbord").modal('toggle');

                      });

                  }
              }
          	}      
	        // data: [
	        //     ['อาจารย์ 1', 1],
	        //     ['นักเรียน 2', 2]
	          
	            
	        // ]
	    }]
	});
}
//end function


//start function

function get_br_return(target_,data,title,year){
	
Highcharts.chart(target_, {
    chart: {
        type: 'column'
    },
    title: {
        text: title
    },plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            },
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function () {
                            // //alert("เดือน "+this.category + "ปี" +data.year);
                            // get_detail(this.category,data.year);
                            // //console.log(this);
                            //alert(this.category+ " "+year+ " "+this.series.name);
                            $.post('service_report/get_list_br.php', {type:this.series.name,month:this.category,year:year }, function() {
                            	
                            }).done(function(data){
                            	$('#title-modal-dashbord').html(title);
		                      	$("#modal-dashbord-content").html(data);

		                      	$("#modal-dashbord").modal('toggle');
		                      	$('#table_br_new').DataTable();
                            });
                        }
                    }
                }
            }
    },
    xAxis: {
        categories: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']
    },
    yAxis: {
    	title: {
            text: 'จำนวนครั้ง'
        }
    },
    credits: {
        enabled: false
    },
    series: data
});
}

function get_popular(target_,data,title){
var sub_title = "";
	// Create the chart
Highcharts.chart(target_, {
    chart: {
        type: 'column'
    },
    title: {
        text: title
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'จำนวนครั้ง'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y} ครั้ง '
            },
            point: {
                    events: {
                        click: function () {
                          sub_title = this.name;
                           $.post('service_report/get_list_item.php', {item: this.name}, function() {

                           	/*optional stuff to do after success */
                           }).done(function(data){
                           		$('#title-modal-dashbord').html(sub_title);
		                      	$("#modal-dashbord-content").html(data);

		                      	$("#modal-dashbord").modal('toggle');
		                      	$('#table_br_new').DataTable();
                           });
                        }
                    }
             }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y} </b> ครั้ง<br/>'
    },

    series: [{
        name: 'อุปกรณ์',
        colorByPoint: true,
        data: data
    }]
});
}

//end function


</script>
