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
								<p>Not Registered yet? <u style="cursor:pointer;" Onclick="showModal()">Register</u></p>
							</form>
							<div id="myModal" Style="display:none;" class="modal">
								<div class="modal-content">
									<h1>Choose an Option</h1>
									<p>Click one of the buttons below:</p>
									<button onclick="redirectToOption1()">Option 1</button>
									<button onclick="redirectToOption2()">Option 2</button>
								</div>
							</div>

							<script>
								// JavaScript function to display the modal
								function showModal() {
									var modal = document.getElementById('myModal');
									modal.style.display = 'block';
								}

								// JavaScript function to close the modal
								function closeModal() {
									var modal = document.getElementById('myModal');
									modal.style.display = 'none';
								}

								// JavaScript functions to redirect to different URLs
								function redirectToOption1() {
									window.location.href = 'option1.php';
								}

								function redirectToOption2() {
									window.location.href = 'option2.php';
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