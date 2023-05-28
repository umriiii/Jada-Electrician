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



			<!-- Button trigger modal -->
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New Items</button>
			<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form id="myform1">
								<div class="modal-body">
									<!-- my data -->

									<label>Item_Name</label>
									<input type="text" placeholder="Enter Item Name" id="item_name" name="item_name" class="form-control">
									<label>Item_Quantity</label>
									<input type="number" placeholder="Enter Item Quantity" id="item_quantity" name="item_quantity" class="form-control">
									<label>Item_Price</label>
									<input type="number" placeholder="Enter Item Price" id="item_price" name="item_price" class="form-control">
									<label>Item_Expire</label>
									<input type="Date" placeholder="Enter Item Expire" id="item_expire" name="item_expire" class="form-control">
									<label>Item Category</label>
									<select class="form-control" name="item_cat" id="item_cat" >
										<option value="">Select category</option>
										<?php 
										$qurie=mysqli_query($connect,"SELECT * FROM category");
										while ($fet=mysqli_fetch_array($qurie)) {
											?>
											<option value="<?php echo $fet['cat_id'] ?>"> <?php echo $fet['cat_name']; ?></option>
											<?php  
											
										}
										
										?>
									</select>
									<label>Select Units</label>
									<select class="form-control" name="unit_id" id="unit_id" >
										<option value="">Select Units</option>
										<?php 
										$qurie=mysqli_query($connect,"SELECT * FROM unit");
										while ($fet=mysqli_fetch_array($qurie)) {
											?>
											<option value="<?php echo $fet['unitid'] ?>"> <?php echo $fet['unit_name']; ?></option>
											<?php  
											
										}
										
										?>
									</select>
									
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<input type="submit" class="btn btn-primary" id="btn1" name="save" value="Save Data">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>


			<div class="container">
				<h1 class="text-center"><i class="fadeIn animated bx bx-purchase-tag-alt"></i>Add Purchases</h1>
				<div class="row">

					<div class="col-md-7">
						<form id="myform" method="post">
							<div 6-class="form-group">
								<br>
								<i class="lni lni-producthunt"></i>
								<label>-Select Products-</label>
								<select class="form-control" name="name" id="name" >
									<option value="">Select Products</option>
									<?php 
									$qurie=mysqli_query($connect,"SELECT * FROM items");
									while ($fet=mysqli_fetch_array($qurie)) {
										?>
										<option value="<?php echo $fet['id'] ?>"> <?php echo $fet['item_name']; ?></option>
										<?php  

									}

									?>
								</select>
								<i class="fadeIn animated bx bx-purchase-tag-alt"></i>
								<label>Purchase Price</label>
								<input type="number" placeholder="Enter Purchase_Price" id="p_price" name="p_price"class="form-control">
								<i class="fadeIn animated bx bx-purchase-tag-alt"></i>
								<label>Sale Price</label>
								<input type="number" placeholder="Enter Sale_Price" id="s_price" name="s_price" class="form-control">
								<i class="fadeIn animated bx bx-purchase-tag-alt"></i>
								<label>Purchase Quantity</label>
								<input type="number" placeholder="Enter Purchase_quantity" id="p_quantity" name="p_quantity" class="form-control">
								<i class="fadeIn animated bx bx-timer"></i>
								<label>Purchase Date</label>
								<input type="date" placeholder="Enter Purchase_Date" id="p_date" name="p_date" class="form-control">
								<br>
								<input type="hidden" name="hid" id="hid">
								<input type="hidden" name="txt" id="txt">
								<input type="submit" class="btn btn-primary" id="updbtn" name="save" value="Save Data">
							</div>
						</form>

					</div> 
				</div>
			</div>
			<div class="row">
				
			<div class="col-md-4">
				<h1 style="text-align: right; margin-right: -700px; margin-top: -250px;">Available Quantity</h1>
				<div style="text-align: right; margin-right: -600px; margin-top: -0px;" >
					<h3 id="val-quan"></h3>
				</div>
			</div>
		</div>
		<br>
		<div class="table-responsive">
                        <table id="user_data" class="table table-striped table-bordered" >
                           <thead>
                            <tr>
                            <th>#</th>
                            <th>P_Item</th>
                            <th>P_Price</th>
                            <th>S_Price</th>
                            <th>P_Quantity</th>
                            <th>P_Date</th>
                            <th>Delete</th>
                            <!-- <th>Update</th> -->
                            <th>Update</th>
                          </tr>
                          </thead>
                        </table>
                     </div>
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

		$("#myform1").submit(function(event){
			event.preventDefault();

     
     $.ajax({
     	url:"req/newitem.php",
     	method:"Post",
     	data:$(this).serialize(),
     	success:function(data){
     		$('#exampleModal').modal('hide');
     		
     	}
     })

 });


		      var dataTable = $('#user_data').DataTable({
          "processing":true,
          "serverSide":true,
          "order":[],
          "searching" : true,
          "ajax":{
           url:"req/addpurchase/fetch.php",
           type:"POST"
           // data: { category_id : category_id , year_id : year_id }
    }
   });

		// $.ajax({
		// 	url: "req/addpurchase.php",
		// 	method:"Post",
		// 	success: function(data){	
		// 		$("#d2").html(data);
		// 	}
		// });

		$(document).on('click','.del',function() {
        if (confirm('Are you sure you want to delete this?')) {

			var delid = $(this).attr("id");
			var el = this;

			$.ajax({
				url: "req/addpurchase.php",
				method:"Post",
				data:{del_id:delid},
				success: function(data){
					$(el).closest('tr').css('background','#d31027');
					$(el).closest('tr').fadeOut(800, function(){      
						$(this).remove();
					}); 
				}
			});
}
		});



		$(document).on('click','.upd',function() {
			var updid = $(this).attr("id");
			$.ajax({
				url: "req/addpurchase.php",
				method:"Post",
				data:{upd_id:updid},
				dataType:"json",
				success: function(data){
					$('#updbtn').val('Update Data');
					$('#name').val(data.p_item); 
					$('#p_price').val(data.p_price);
					$('#s_price').val(data.s_price);
					$('#p_quantity').val(data.p_quantity);
					$('#p_date').val(data.p_date);
					$('#val-quan').html(data.item_quantity);
					$('#txt').val(data.item_quantity);
					$('#hid').val(data.p_id);
				}
			});

		});

		$(document).on('change','#name',function() {
			var up = $(this).val();
			// alert(up);
			$.ajax({
				url: "req/addpurchase/select.php",
				method:"Post",
				data:{up:up},
				dataType:"json",
				success: function(data){
					$("#val-quan").html(data);
				}
			});

		});
		$("#myform").submit(function(event){
			event.preventDefault();

		     // ajexfunction
		     $.ajax({
		     	url:"req/addpurchase.php",
		     	method:"Post",
		     	data:$(this).serialize(),
		     	success:function(data){
		     	
     			$('#user_data').DataTable().ajax.reload();
		     	
		     	}
		     })

		 });

	});
</script>