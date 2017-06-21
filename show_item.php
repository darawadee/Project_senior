<style type="text/css">
	.item{
		background-color: #e6ecf7;
		height:auto;
		padding: 20px;
		margin-top: 10px;
		border-radius: 10px;

	}
	.item:hover{
		background-color: #becce5;
		-webkit-box-shadow: 10px -9px 23px -10px rgba(0,0,0,0.75);
		-moz-box-shadow: 10px -9px 23px -10px rgba(0,0,0,0.75);
		box-shadow: 10px -9px 23px -10px rgba(0,0,0,0.75);
	}
</style>

<div class="row">
	<div class="form-inline">
	 
	  <div class="form-group pull-right">
	  
	    <input type="text" class="form-control" id="find-item" >
	      <a class="btn btn-info" id="find">ค้นหา</a>
	  </div>
	
	</div>
</div>		
		
	
	
<div id="item-content">



</div>
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
        		     <form action="#" id="modal-item">
	        			<p id="modal-name">name</p>
	        			<p style="color: red">**ไม่ควรยืมอุปกรณ์เกิน <b id="alert">90</b> ชิ้น**</p>
	        			<p>
	        			<input class="form-control" type="number" id="num-item" min="1" required="">
	        			<input type="hidden" id="item-hide-id">
	        			<input type="hidden" id="note" value="outclass">
	        			</p>
	        			<p><button type="submit" class="btn btn-info">ตกลง</button></p>
        		     </form>
        		</div>
        	</div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
        </div>
      </div>
      
    </div>
</div>
<script type="text/javascript">
	
		get_item();
	

	



	$(function(){
		$("#find").click(function() {
			var word = $("#find-item").val();

			if(word!=""){
				 get_item(word);
				
			}else{
				alert("ไม่พบข้อมูล");
			}
		});
	});

	function get_item(word = 'null'){
		
		$.post('service/show_item_br_key.php', {word: word}, function() {
					/*optional stuff to do after success */
		}).done(function(data){
			$("#item-content").html(data);
			//alert(data);
		});
	}
</script>