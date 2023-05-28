<?php 
include'req/db.php';
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

				<h1 class="text-center"><i class="fadeIn animated bx bx-coin-stack"></i>Add Items</h1>
				<div class="col-md-6"  >
					<!-- STEP 1 -->
					<div>
						<form id="myform" method="post">
							<div class="form-group">
								<br>
								<i class="fadeIn animated bx bx-coin-stack"></i>
								<label>Item_Name</label>
								<input type="text" placeholder="Enter Item Name" id="item_name" name="item_name" class="form-control">
								<i class="fadeIn animated bx bx-coin-stack"></i>
								<label>Item_Quantity</label>
								<input type="number" placeholder="Enter Item Quantity" id="item_quantity" name="item_quantity" class="form-control">
								<i class="fadeIn animated bx bx-coin-stack"></i>
								<label>Item_Price</label>
								<input type="number" placeholder="Enter Item Price" id="item_price" name="item_price" class="form-control">
								<i class="fadeIn animated bx bx-coin-stack"></i>
								<label>Item_Expire</label>
								<input type="Date" placeholder="Enter Item Expire" id="item_expire" name="item_expire" class="form-control">
								<i class='bx bx-category'></i>
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
								<i class="fadeIn animated bx bx-unite"></i>
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
								<br>
								<input type="hidden" name="hid" id="hid">
								<input type="submit" class="btn btn-primary" id="updbtn" name="save" value="Save Data">
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
                            <th>Item Name</th>
                            <th>Item Quantity</th>
                            <th>Item Price</th>
                            <th>Item Expire</th>
                            <th>Item Category</th>
                            <th>Item Units</th>
                            <th>Update</th>
                            <th>Delete</th>
                          </tr>
                          </thead>
                        </table>
                     </div>
			<div id="d3"></div>
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
		// 	url: "req/action.php",
		// 	method:"Post",
		// 	success: function(data){	
		// 		$("#d2").html(data);
		// 	}
		// });

		      fill_datatable();  
       
  function fill_datatable()
  {
   var dataTable = $('#user_data').DataTable({
          "processing":true,
          "serverSide":true,
          "order":[],
          "searching" : true,
          "ajax":{
           url:"req/items/fetch.php",
           type:"POST"
           // data: { category_id : category_id , year_id : year_id }
    }
   });
  }


		$(document).on('click','.del',function() {
        if (confirm('Are you sure you want to delete this?')) {

			var delid = $(this).attr("id");
			var el = this;
			$.ajax({
				url: "req/action.php",
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
				url: "req/action.php",
				method:"Post",
				data:{upd_id:updid},
				dataType:"json",
				success: function(data){
					$('#updbtn').val('Update Data');
					$('#item_name').val(data.item_name); 
					$('#item_quantity').val(data.item_quantity);
					$('#item_price').val(data.item_price);
					$('#item_expire').val(data.item_expire);
					$('#item_cat').val(data.item_cat);
					$('#unit_id').val(data.unit_id);
					$('#hid').val(data.id);		
				}
			});
		});
		$("#myform").submit(function(event){
			event.preventDefault();
		     // ajexfunction
		     $.ajax({
		     	url:"req/action.php",
		     	method:"Post",
		     	data:$(this).serialize(),
		     	success:function(data){
		     		
     			$('#user_data').DataTable().ajax.reload();
		 			
		     	}
		     })
		 });
	});
</script>