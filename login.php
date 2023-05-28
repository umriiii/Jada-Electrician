<?php include 'Include/connection.php'; ?>
<?php 
session_start();
if(isset($_SESSION['type']))
{
    header("location:index.php");
}
$message = '';
if(isset($_POST["login"]))
{
    $query = "
    SELECT * FROM user_details 
        WHERE user_email = :user_email
    ";
    $statement = $pcon->prepare($query);
    $statement->execute(
        array(
                'user_email'    =>  $_POST["user_email"]
            )
    );
    $count = $statement->rowCount();
    if($count > 0)
    {
        $result = $statement->fetchAll();
        foreach($result as $row)
        {
            if($row['user_status'] == 'Active')
            {
                if(password_verify($_POST["user_password"], $row["user_password"]))
                {
                
                    $_SESSION['type'] = $row['user_type'];
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['user_name'] = $row['user_name'];
                    header("location:index.php");
                }
                else
                {
                     $message = '<div class="alert alert-danger" role="alert">
  <strong>Oh!</strong> Wrong Password.
</div>';
                }
            }
            else
            {
                  $message = '<div class="alert alert-danger" role="alert">
  <strong>Ops!</strong> Your account is disabled, Contact Master.
</div>';
            }
        }
    }
    else
    {
        $message = '<div class="alert alert-danger" role="alert">
  <strong>Oh!</strong> Wrong Email Address.
</div>';
    }
}

 ?>





<!doctype html>
<html lang="en">


<!-- Mirrored from codervent.com/synadmin/demo/vertical/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 04 Jan 2022 12:18:51 GMT -->
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
	<title>RTF</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<div class="authentication-header"></div>
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="mb-4 text-center">
							<img src="assets/images/logo-img.png" width="180" alt="" />
						</div>
						<div class="card">
							<div class="card-body">
								<div class="p-4 rounded">
									<div class="text-center">
										<h3 class="">Login in</h3>
										
									</div>
									<div class="login-separater text-center mb-4"> <span>OR SIGN IN WITH EMAIL</span>
										<hr/>
									</div>
									<div class="form-body">
										<form class="row g-3" method="POST">
											<div class="col-12">
												<label for="inputEmailAddress" class="form-label">Email Address</label>
												<input type="text" class="form-control" name="user_email" placeholder="Enter your email address" />
											</div>
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Enter Password</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" class="form-control" name="user_password" placeholder="Enter your password" /> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
													<label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
												</div>
											</div>
											<div class="col-md-6 text-end">	<a href="#">Forgot Password ?</a>
											</div>
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" name="login" class="btn btn-primary btn-block"><i class="bx bxs-lock-open"></i>Log In</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
</body>


<!-- Mirrored from codervent.com/synadmin/demo/vertical/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 04 Jan 2022 12:18:52 GMT -->
</html>