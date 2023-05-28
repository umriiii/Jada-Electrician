<?php 
$con=mysqli_connect('localhost','root','','test_ajax');

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
			            <h1 class="text-center" > <i class='bx bx-category'></i>Add New Category</h1>
			            <div class="col-md-6"  >
			                <!-- STEP 1 -->
			               
			                    <form id="myform">
			                        <div class="form-group">
			                            <br>
			                            <i class='bx bx-category'></i>
			                            <label>Add New Category</label>
			                            <input type="text" placeholder="Enter Add New Category" id="cat_name" name="cat_name" class="form-control">
			                             <input type="hidden" name="hid" id="hid">
			                             <br>
			                             <input type="submit" class="btn btn-primary" id="btn1"  value="Save Data" >
			                        </div>
			                    </form>
			               
			             </div>
			        </div>
			        <br>
			        <br>
			        <div class="table-responsive">
                        <table id="user_data" class="table table-striped table-bordered" >
                           <thead>
                            <tr>
                            <th>#</th>
                            <th>Catigory Name</th>
                            <th>Delete</th>
                          </tr>
                          </thead>
                        </table>
                     </div>	
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
          $('#open').click(function(){    
           $('#cat_name').val('');
           $('#hid').val('');
           $('#btn1').val('Insert Data');
      });


   var dataTable = $('#user_data').DataTable({
          "processing":true,
          "serverSide":true,
          "order":[],
          "searching" : true,
          "ajax":{
           url:"req/category/fetch.php",
           type:"POST"
           // data: { category_id : category_id , year_id : year_id }
    }
   });
 


 // $.ajax({
 //    url: "req/cat.php",
 //    method:"Post",
 //    success: function(data){
 //    $("#myform")[0].reset(); 
 //        $("#d2").html(data);
 //    }
 //   });

  $(document).on('click','.del',function() {
        if (confirm('Are you sure you want to delete this?')) {

     var delid = $(this).attr("id");
     var el = this;
          
     $.ajax({
    url: "req/cat.php",
    method:"Post",
    data:{del_id:delid},
    success: function(data){
      $(el).closest('tr').css('background','#d31027');
      $(el).closest('tr').fadeOut(100, function(){      
                    $(this).remove();
                }); 
    }
   });
  }
});



 $(document).on('click','#upd',function() {
     var updid = $(this).val();
    
          
     $.ajax({
 url: "req/cat.php",
    method:"Post",
    data:{upd_id:updid},
    dataType:"json",
    success: function(data){

      $('#btn1').val('Update Data');
         $('#cat_name').val(data.cat_name); 
         $('#hid').val(data.cat_id);                  
    }
   });
  
});

      $("#myform").submit(function(event){
         event.preventDefault();

     // ajexfunction
     $.ajax({
     url: "req/cat.php",
       method:"Post",
       data:$(this).serialize(),
       success:function(data){
      
     			$('#user_data').DataTable().ajax.reload();
      
       }
     })

      });

    });   
 </script>