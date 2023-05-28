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
							<form id="myform2">
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

				<br><br><br>

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
                            <!-- <th>Update</th> -->
                            <th>Delete</th>
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


   var dataTable = $('#user_data').DataTable({
          "processing":true,
          "serverSide":true,
          "order":[],
          "searching" : true,
          "ajax":{
           url:"req/listitem/fetch.php",
           type:"POST"
           // data: { category_id : category_id , year_id : year_id }
    }
   });
 

        
		 // $.ajax({
		 //    url: "req/listaction.php",
		 //    method:"Post",
		 //    success: function(data){
		   
		 //        $("#d2").html(data);
		 //    }
		 //   });



		 	$("#myform2").submit(function(event){
			event.preventDefault();

     // ajexfunction
		    	 $.ajax({
		     	url:"req/data.php",
		     	method:"Post",
		     	data:$(this).serialize(),
		     	success:function(data){
     			$('#exampleModal').modal('hide');
     			$('#user_data').DataTable().ajax.reload();
     		// location.reload(true);
     	}
     })

 });

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



		 

		      $("#d2").submit(function(event){
		         event.preventDefault();

		     // ajexfunction
		     $.ajax({
		    url: "req/listaction.php",
		       method:"Post",
		       data:$(this).serialize(),
		       success:function(data){
		        $.ajax({
		    url: "req/listaction.php",
		    method:"Post",
		    success: function(data){
		   
		        $("#d2").html(data);
		    }
		   });
		        location.reload(true);
		       }
		     })

		      });

		    });



   
 </script>