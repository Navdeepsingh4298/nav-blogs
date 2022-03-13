<?php
$page_title = "Dashboard";

require_once ('includes/header.php');
require_once ('includes/database.php');

$query_str = "SELECT * FROM $tblUsers WHERE uid = '$uid'";
$result = mysqli_query($conn,$query_str);
$result_row = $result->fetch_assoc();

if (!$result) {
	$errno = $conn->errno;
	$errmsg = $conn->error;
	echo "Selection failed with: ($errno) $errmsg<br/>\n";
	$conn->close();
	exit;
} else if($isLoggedIn){	
?>

<div class="container-fluid d-flex p-0">

<?php include('includes/sidebar.php') ?>

<!-- Right Side Content -->
	<div class="container lead wrapper mt-3 mb-5 d-flex flex-column align-items-center justify-content-center">
		
		<h1 class="text-success text-center display-4">Dashboard</h1>
		<p class="text-center">Welcome to your dashboard! <br> Here you can edit your information, Buy, Sell and see your own houses!</p>
	
			<div class="col-xs-8 col-xs-offset-2 col-md-6">

			<div class="my-3">
				<p class="display-6">Your Current Details</p><br>
				<span><strong>Name: </strong><?php echo $result_row['name']; ?></span><br>
				<span><strong>Email Id: </strong> <?php echo $result_row['email']; ?></span><br>
				<span><strong>Phone/Mobile No. </strong><?php echo $result_row['phone']; ?></span><br>
			</div>
			<a href="updateprofile.php" class="btn btn-primary">Update Profile</a>
			</div>
		</div>
<!-- End of Right Side Content -->

</div>

<?php
}else{
  header("Location: index.php");
}
	include_once('includes/footer.php');
?>