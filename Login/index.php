<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include "datacon.php";
?>
<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
			<link rel="stylesheet" href="stylesheet.css">
			<title>User | Login </title>
		</head>
		<body>
		<?php
			if (isset($_SESSION['UserName']) && isset($_SESSION['Account_Type'])) {
				echo"<script> alert('User Already Logged In'); window.location='../Dashboard'; </script>";
			} else {
				
				if (mysqli_connect_errno()) {
					echo"<script> alert('No connection to database!!!'); window.location='../HomePage'</script>";
				} else {
					$querychlog = "SELECT * FROM `Landlord_Details`";
					$resultadminlog = mysqli_fetch_assoc(mysqli_query($conn,$querychlog));
					if (!$resultadminlog) {
						echo"<script> alert('There are no registered landlords yet Please try again later'); </script>";
					} else { ?>
							<h1 style=" margin-top: 10vh; " >User Login Page</h1>
							<form style="margin-top: 5vh;" name="login" method="post">
								<label style=" margin-top:20px; " for="username">Username:</label>
								<input type="text" id="username" placeholder="Username" name="UserName" required>

								<label for="password">Password:</label>
								<input type="password" placeholder="Password" id="password" name="PassWord" required>

								<input style="margin-bottom:20px" name="LogIn" type="submit" value="Log In">

								<p><a href="forgot-password.php">Forgot password?</a></p>
								<p>Not Registered yet? <u style="cursor:pointer;" class="btn btn-primary" data-toggle="modal" data-target="#fullScreenModal">Register</u></p>
							</form>
							<!-- The Full-Screen Popup Modal -->
							<div class="modal fade" id="fullScreenModal" tabindex="-1" role="dialog" aria-labelledby="fullScreenModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-xl">
									<div class="modal-content">
										<div class="modal-header">
											<h1 class="modal-title text-center" id="fullScreenModalLabel">Register new Account</h1>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body text-center">
											<p>Select Your Account type below:</p>
											<button class="btn btn-primary" onclick="redirectToOption1()">LandLord</button>
											 <button class="btn btn-secondary ml-5" onclick="redirectToOption2()">Tenant</button> 
										</div>
									</div>
								</div>
							</div>

							<!-- Include Bootstrap JS from a CDN -->
							<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
							<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
							<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

							<script>
								// JavaScript functions to redirect to different URLs
								function redirectToOption1() {
									window.location.href = '../Register/LandLord';
								}

								function redirectToOption2() {
									window.location.href = '../Register/LandLord';
								}
							</script>
							<?php
							if (isset($_POST['LogIn'])) {
								$User__Name = mysqli_real_escape_string($conn,$_POST['UserName']);
								$passwordhash = mysqli_real_escape_string($conn,$_POST['PassWord']);
								$sql = "SELECT * FROM adminLogins WHERE username = '$User__Name'";
								$result = mysqli_query($conn, $sql);

								if(mysqli_num_rows($result) > 0){
									$row = mysqli_fetch_assoc($result);
									$pass_db = $row['password'];
									$Account_Type = "Admin";

									if(password_verify($passwordhash,$pass_db)){
										$_SESSION["UserName"] = $User__Name;
										$_SESSION["Account_Type"] = $Account_Type;
										header("Location:../Dashboard");
									} else {
										echo(" <script>alert('Invalid Credentials !!!')</script>");
									}
								} else {
									echo(" <script>alert('Invalid Credentials !!!')</script>");
								}
							}
						}
				}
			}
				
				
			?>
			
		</body>
	</html>