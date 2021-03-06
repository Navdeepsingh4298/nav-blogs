<?php
$page_title = "Register | Create new user";

require_once('includes/header.php');
require_once('includes/database.php');

$name = $email = $phone = $password = $error = '';
$register_status = 0; 

if(!$isLoggedIn){	
	if(isset($_POST['register'])){	
		$name = strtolower(mysqli_real_escape_string($conn,trim($_POST['name'])));
		$email = strtolower(mysqli_real_escape_string($conn,trim($_POST['email'])));
		$phone = mysqli_real_escape_string($conn,$_POST['phone']);
		$password = mysqli_real_escape_string($conn,$_POST['password']);	

		if($name == 'admin' || $name == 'ADMIN'){
			$error = "'admin' is Reserved Name. <br /> Please Try with Different Name.";
		}
		if(!ctype_alpha($name)){
			$error = "Invalid Name. <br /> Please Try with Different Name. <br />* should contain Alphabets only with no spaces";
		}
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$error = "Not A Valid Email Address. <br> Please Enter a valid email address and Try Again.";
		}
		if(strlen($phone) < 10){
			$error = "Invalid Phone/Mobile Number. <br> Please Enter a valid one.";
		}
		settype($phone,"integer");
		if(!is_numeric($phone)){
			$error = "Invalid Phone/Mobile Number. <br> Please Enter a valid one.";
		}
		if(strlen($password) <= 8){
			$error = "Password must be at least 8 characters long. Please Enter a valid one.";
		}
		
		if(empty($error)){
			$query_str = "SELECT * FROM $tblUsers WHERE email='$email' && phone='$phone'";
			$result = mysqli_query($conn,$query_str);
			if(!$result) {
				$errno = $conn->errno;
				$errmsg = $conn->error;
				$error = $conn->error;
				// echo "Selection failed with: ($errno) $errmsg<br/>\n";
				$conn->close();
				exit;
			}
			if($result -> num_rows == 0) {
				$query_stry = "INSERT INTO $tblUsers (name,email,phone,password) VALUES ('$name', '$email','$phone', '$password')";
				$result = mysqli_query($conn,$query_stry);
				if(!$result) {
					$errno = $conn->errno;
					$errmsg = $conn->error;
					$error = $conn->error;
					// echo "Selection failed with: ($errno) $errmsg<br/>\n";
					$conn->close();
					exit;
				}
				
				$new_result = mysqli_query($conn,$query_str);
				$result_row = $new_result->fetch_assoc();
				$_SESSION['role'] = $result_row['role'];
				$_SESSION['uid'] = $result_row['uid'];
				$_SESSION['name'] = $result_row['name'];
				$_SESSION['isLoggedIn'] = true; 
				$register_status = 1;
				$isLoggedIn = true;
				
			}else{
				$error = "User Already Registered.<br /> Try Logging In";
			}
		}
	}
}else{
		header("Location:dashboard.php");
}
?>

<div class="container wrapper my-5 d-flex align-items-center flex-column justify-content-center">

	<?php if($register_status == 0 && !$isLoggedIn && empty($error)){ ?>
	<h1 class="text-center my-2">REGISTER</h1>
	<p class="lead text-center">Please register to your account</p>
	<div class="col-xs-8 col-xs-offset-2 col-md-7">

		<!-- Registeration Form -->
		<form class="form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<div class="form-group my-2">
				<label for="newName" class="col-sm-2 control-label">Name</label>
				<div class="col-sm-10 w-100">
					<input type="text" class="form-control" id="newName" name="name" value="<?php echo $name; ?>" placeholder="Enter your Name" required>
				</div>
			</div>
			<div class="form-group my-2">
				<label for="newEmail" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-10 w-100">
					<input type="email" class="form-control" id="newEmail" name="email" value="<?php echo $email; ?>" placeholder="Enter your Email address" required>
				</div>
			</div>
			<div class="form-group my-2">
				<label for="newPhone" class="col-sm-2 control-label">Phone Number</label>
				<div class="col-sm-10 w-100">
					<input type="tel" class="form-control" id="newPhone" name="phone" value="<?php echo $phone; ?>" placeholder="Enter your Phone/Mobile Number" required>
				</div>
			</div>
			<div class="form-group my-2">
				<label for="newPassword" class="col-sm-2 control-label">Password</label>
				<div class="col-sm-10 w-100">
					<input type="password" class="form-control" min="8" id="newPassword" name="password" value="<?php echo $password; ?>" placeholder="Enter your Password" required>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" name="register" class="btn btn-primary">Register</button>
				</div>
			</div>
		</form>
		<!-- End of Registeration Form -->

		<!-- Login error message if any -->
		<?php if($error && $isLoggedIn){ ?>
			<div class="container-fluid lead text-center text-danger">
				<?php echo $error; ?>
			</div>
		<?php } ?>	

		<!-- User Successfully Registered -->
		<?php } else if($register_status == 1 && $isLoggedIn && empty($error)){ ?>
		<div class="container-fluid">
				<p class='lead text-success text-center display-4'>User Registered Successfully. <br/> Redirecting to Dashboard...</p>
				<?php header( "Refresh:3; url=dashboard.php", true, 303);?>
		</div>

		<!-- Error message if any -->
		<?php } else if($error && !$isLoggedIn){ ?>
		<div class="container-fluid">
				<p class='lead text-danger text-center display-4'><?php echo $error; ?></p>
				<?php header( "Refresh:3; url=register.php", true, 303); ?>
		</div>
		<?php } ?>
		<!-- End of login if else ladder -->

	</div>
</div>

<?php	include_once('includes/footer.php'); ?>