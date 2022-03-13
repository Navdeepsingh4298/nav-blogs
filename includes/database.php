<?php
	$hostname = "localhost";
	$port;
	$username = "blog_admin";
	$password = "admin12345";
	$database = "blog_db";
	$tblUsers = "users";
	$tblBlogs = "blogs";
  
	$conn = mysqli_connect($hostname, $username, $password, $database);

	if (mysqli_connect_errno() != 0) {
		$errno = mysqli_connect_errno();
		$errmsg = mysqli_connect_error();
		die("Connect Failed with: ($errno) $errmsg<br/>\n");
	}
?>

