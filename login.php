<?php
$page_title = "Log In";

require_once('includes/header.php');
require_once('includes/database.php');

$emailorphone = $password = '';
$login_status = 0;

if(!$isLoggedIn){
	if(isset($_POST['login'])){
		$emailorphone = mysqli_real_escape_string($conn,trim($_POST['emailorphone']));
    $password = mysqli_real_escape_string($conn,trim($_POST['password']));
		if (filter_var($emailorphone, FILTER_VALIDATE_EMAIL)) {
			$query_stry = "SELECT * FROM $tblUsers WHERE email='$emailorphone' AND password='$password'";
			$result = mysqli_query($conn,$query_stry);
			$result_row = mysqli_fetch_assoc($result);
			if($result -> num_rows){
        $_SESSION['role'] = $result_row['role'];
				$_SESSION['name'] = $result_row['name'];
        $_SESSION['uid'] = $result_row['uid'];
				$_SESSION['isLoggedIn'] = true;
        $login_status = 1;
				$isLoggedIn = true;        
			}else if($result -> num_rows == 0) {
        $login_status = 2;
			}
		}
		else{
			$query_stry = "SELECT * FROM $tblUsers WHERE phone='$emailorphone' AND password='$password'";
			$result = mysqli_query($conn,$query_stry);
			$result_row = mysqli_fetch_assoc($result);
			if($result -> num_rows){
        $_SESSION['role'] = $result_row['role'];
        $_SESSION['uid'] = $result_row['uid'];
				$_SESSION['isLoggedIn'] = true;
        $login_status = 1;
				$isLoggedIn = true;
			}else if($result -> num_rows == 0) {
        $login_status = 2;
			}
		}
		$conn->close();
	}
} else{
		header("Location:dashboard.php");
	}  
?>

<div class="container wrapper my-5 d-flex align-items-center flex-column justify-content-center">
	<?php if ($login_status == 0 && !$isLoggedIn) { ?>
	<h1 class="text-center my-2">LOG IN</h1>
	<p class="lead text-center">Please login to your account</p>
	<div class="col-xs-6 col-xs-offset-2 col-md-5">		
		<form class="form-horizontal my-5 mb-5" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="form-group my-3">
						<label for="emailorphone" class="col-sm-2 control-label w-100">Email or Phone</label>
						<div class="col-sm-10 w-100">
								<input type="text" class="form-control" id="emailorphone" name="emailorphone" value="<?php echo $emailorphone; ?>" placeholder="Enter Email or Phone" required>
						</div>
				</div>
				<div class="form-group my-3">
						<label for="password" class="col-sm-2 control-label w-100">Password</label>
						<div class="col-sm-10 w-100">
								<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
						</div>
				</div>
				<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" name='login' class="btn btn-primary">LOG IN</button>
						</div>
				</div>
		</form>
		<?php } else if($login_status == 1 && $isLoggedIn){ ?>
		<div class="container-fluid text-center my-5">
				<p class='lead display-5'>Logging in...</p>
				<?php header( "Refresh:3; url=dashboard.php", true, 303);?>
		</div>
		<?php }else if($login_status == 2 && !$isLoggedIn){ ?>
		<div class="container text-center my-5">
				<p class='lead text-danger display-6'>Wrong Credentials.<br> Or</p>
				<p class='lead text-danger display-6'>No Such User was found. Try Again later.</p>
				<?php header( "Refresh:3; url=login.php", true, 303);?>
		</div>
		<?php } ?>
	</div>
</div>

<?php
	include_once('includes/footer.php');
?>
