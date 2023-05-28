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
			<?php 
				include 'Include/pagecontent.php';
			 ?>
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