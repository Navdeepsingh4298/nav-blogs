<?php
$page_title = "Dashboard";

require_once ('includes/header.php');
require_once ('includes/database.php');

if($isLoggedIn){
	$query_str1 = "SELECT * FROM users WHERE uid = '$uid'";
	$result = mysqli_query($conn,$query_str1);
	$result_row = $result->fetch_assoc();
	$name = $result_row['name'];
	$email = $result_row['email'];
	$phone = $result_row['phone'];
	$password = $result_row['password'];	
	$confirm_password = $result_row['password'];	
	$error = '';
	if(isset($_POST['update'])){
		$name = mysqli_real_escape_string($conn,$_POST['name']);
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		$phone = mysqli_real_escape_string($conn,$_POST['phone']);
		$password = mysqli_real_escape_string($conn,$_POST['password']);	
		$confirm_password = mysqli_real_escape_string($conn,$_POST['confirmpassword']);	
		
		if($name == 'admin' || $name == 'ADMIN'){
			$error = "Name 'admin' is Reserved for ADMIN. <br /> Please Try with Different Name.";
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
		if($password != $confirm_password){
			$error = "Password not matched with the confirm password. Please Enter Both passwords again.";
		}

		if(empty($error)){
			$query_str2 = "UPDATE $tblUsers SET name = '$name', email = '$email', password = '$password', phone = '$phone' WHERE uid = $uid; ";      			
			(mysqli_query($conn, $query_str2)) ?	header("Location: dashboard.php") : $error = "Something went wrong!!!";			
		}		
	}

	if(isset($_POST['delete'])){
		$query_str3 = "DELETE FROM $tblUsers WHERE uid = '$uid'";
		$query_str4 = "DELETE FROM $tblBlogs WHERE uid = '$uid'";
		(mysqli_query($conn, $query_str3)) ?	$error = "" : $error = "Something went wrong!!!";
		(mysqli_query($conn, $query_str4)) ?	$error = "Your Account is Deleting...." : $error = "Something went wrong!!!";
		session_destroy();
		setcookie(session_name(), '', time()-3600);
		$_SESSION = array();
		header( "Refresh:3; url=index.php", true, 303);
	}
}else{
	header("Location:login.php");
}

if (!$result) {
	$errno = $conn->errno;
	$errmsg = $conn->error;
	$error = $conn->error;
	echo "Selection failed with: ($errno) $errmsg<br/>\n";
	$conn->close();
	exit;
} else { 
	
?>

<div class="container-fluid d-flex p-0">
<?php include('includes/sidebar.php') ?>
	<div class="container wrapper my-4 d-flex flex-column align-items-center justify-content-center">
		<?php if(empty($error)){ ?>
		<h1 class="text-center my-3">Update Your Profile</h1>
		<?php } else { ?>
		<div class="container-fluid lead text-center text-danger display-6">
			<?php echo $error; ?>
		</div>
		<?php } ?>
			<div class="col-xs-8 col-xs-offset-2 col-md-6">
				<form name="edituser" class="form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<div class="form-group my-3">
						<label for="newName" class="col-sm-2 control-label w-100">Name</label>
						<div class="col-sm-10 w-100">
							<input type="text" class="form-control" id="newName" name="name" value="<?php echo $name; ?>" required>
						</div>
					</div>
					<div class="form-group my-3">
						<label for="newEmail" class="col-sm-2 control-label w-100">Email</label>
						<div class="col-sm-10 w-100">
							<input type="email" class="form-control" id="newEmail" name="email" value="<?php echo $email; ?>" required>
						</div>
					</div>
					<div class="form-group my-3">
						<label for="newPhone" class="col-sm-2 control-label w-100">Phone/Mobile Number</label>
						<div class="col-sm-10 w-100">
							<input type="tel" class="form-control" id="newPhone" name="phone" value="<?php echo $phone; ?>" required>
						</div>
					</div>
					<div class="form-group my-3">
						<label for="newPassword" class="col-sm-2 control-label w-100">Password</label>
						<div class="col-sm-10 w-100">
							<input type="password" class="form-control" id="newPassword" name="password" value="<?php echo $password;?>"required>
						</div>
					</div>
					<div class="form-group my-3">
						<label for="newConfirmPassword" class="col-sm-2 control-label w-100">Confirm Password</label>
						<div class="col-sm-10 w-100">
							<input type="password" class="form-control" id="newConfirmPassword" name="confirmpassword" value="<?php echo $confirm_password;?>" required>
						</div>
					</div>
					<div class="form-group my-3">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-warning" name="update">UPDATE</button>
							<button type="submit" class="btn btn-danger" name="delete">DELETE ACCOUNT</button>
						</div>
					</div>
				</form>
			</div>
		</div>
</div>

<?php
}
	$conn->close();
	include_once('includes/footer.php');
?>