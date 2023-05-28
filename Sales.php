<?php 
	$connect=mysqli_connect('localhost','root','','test_ajax');
?>
<?php 
  include 'Include/to-web.php';
?>
<?php 
 include 'Include/head.php';
?>
<!--wrapper-->
<div class="wrapper">
	<!--sidebar wrapper -->
	<?php 
	include 'Include/sidebar.php';
	?>
	<!--end sidebar wrapper -->
	<!--start header -->
	<?php 
	include 'Include/header.php';
	?>
	<!--end header -->
	<!--start page wrapper -->
	<div class="page-wrapper">
		<div class="page-content">

			<div class="container">
				<br>

				<h1 class="text-center"><i class="fadeIn animated bx bx-coin-stack"></i>Sale Products</h1>
				<div class="col-md-6"  >
					<!-- STEP 1 -->
					<div>
						<form id="myform" method="post">
							<div class="form-group">
								<br>
								<label>-Select Products-</label>
								<div class="input-group">
									<select class="form-control" id="name" name="name">
										<option value="" selected="" >Select Products</option>
										<?php 
										$qurie=mysqli_query($connect,"SELECT * FROM items ");
										while ($fet=mysqli_fetch_array($qurie)) {
											?>
											<option value="<?php echo $fet['id'] ?>"> <?php echo $fet['item_name']; ?></option>
											<?php  
										}
										?>
									</select>
								</div>								
								<label>Unit Price</label>
								<input type="text"  id="unit_price" name="unit_price"  class="form-control">
								<label>Sale Quantity</label>
								<input type="number"  id="s_quantity" name="s_quantity" class="form-control">
								<label>Net Amount</label>
								<input type="number"  id="net_amount" name="net_amount" class="	form-control">
								<br>
								<input type="hidden" name="hid" id="hid">
								<input type="submit" class="btn btn-primary" id="updbtn" name="save" value="Save">
								<a class="btn btn-primary" href="req/pdf.php">Print_pdf</a>
							</div>
						</form>
					</div>
				</div>
			</div>
			<br>
			<div class="table-responsive">
                        <table id="user_data" class="table table-striped table-bordered" >
                           <thead>
                            <tr>
                            <th>#</th>
                            <th>Sale Products</th>
                            <th>Unit Price</th>
                            <th>Sale Quantity</th>
                            <th>Net Amount</th>
                            <th>Delete</th>
                            <th>Update</th>
                          </tr>
                          </thead>
                        </table>
                     </div>
			<br>
		</div>
	</div>
	<!--end page wrapper -->
	<!--start overlay-->
	<div class="search-overlay"></div>
	<div class="overlay toggle-icon"></div>
	<!--end overlay-->
	<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
	<!--End Back To Top Button-->
	<footer class="page-footer">
		<p class="mb-0">Copyright © 2021. All right reserved.</p>
	</footer>
</div>
<!--end wrapper-->
<!--start switcher-->
<?php 
 include 'Include/switcher.php';
?>
<!--end switcher-->
<!-- Bootstrap JS -->
<?php 
 include 'Include/jslink.php';
?>
<script type="text/javascript">
	$(document).ready(function(){
		// $.ajax({
		// 	url:"req/fetch.php",
		// 	method:"Post",
		// 	success: function(data){	
		// 		$("#d2").html(data);
		// 	}
		// });

   var dataTable = $('#user_data').DataTable({
          "processing":true,
          "serverSide":true,
          "order":[],
          "searching" : true,
          "ajax":{
           url:"req/sales/fetch.php",
           type:"POST"
           // data: { category_id : category_id , year_id : year_id }
    }
   });


		$(document).on('click','.del',function() {
			var delid = $(this).attr("id");
			var el = this;
			$.ajax({
				url: "req/fetch.php",
				method:"Post",
				data:{del_id:delid},
				success: function(data){
					$(el).closest('tr').css('background','#d31027');
					$(el).closest('tr').fadeOut(800, function(){      
						$(this).remove();
					}); 
				}
			});
		});
		$(document).on('click','.upd',function() {
			var updid = $(this).attr("id");
			$.ajax({
				url: "req/saleup.php",
				method:"Post",
				data:{upd_id:updid},
				dataType:"json",
				success: function(data){
					$('#updbtn').val('Update Data');
					$('#name').val(data.s_products); 
					$('#unit_price').val(data.unit_price);
					$('#s_quantity').val(data.s_quantity);
					$('#net_amount').val(data.net_amount);
					$('#hid').val(data.s_id);					
				}
			});
		});
		$(document).on("change","#name",function(){
			var updid = $(this).val();
			$.ajax({
				url: "req/fetch.php",
				method:"Post",
				data:{upd_id:updid},
				dataType:"json",
				success: function(data){
					$('#unit_price').val(data.item_price);	
				}
			});
		});
		$("#myform").submit(function(event){
			event.preventDefault();
		     // ajexfunction
		     $.ajax({
		     	url:"req/fetch.php",
		     	method:"Post",
		     	data:$(this).serialize(),
		     	success:function(data){
     			$('#user_data').DataTable().ajax.reload();
		     		
		     	}
		     })
		   });
	});

	$(document).on("keyup","#s_quantity",function(){

		var a=parseFloat($('#unit_price').val()),
		b=parseFloat($('#s_quantity').val());
		var c=a*b;
		$('#net_amount').val(c);
	})
</script>