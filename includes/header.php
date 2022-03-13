<?php
session_start();

$isLoggedIn = false;
$uid = $name = '';
$role = 0; 

if(isset($_SESSION['isLoggedIn'])){
	$isLoggedIn = $_SESSION['isLoggedIn'];
}
if (isset($_SESSION['uid'])) {
	$uid = $_SESSION['uid'];
}
if(isset($_SESSION['name'])){
	$name = $_SESSION['name'];
}
if (isset($_SESSION['role'])){
	$role = $_SESSION['role'];
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $page_title; ?></title>
	<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">

		<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		
		footer {
			align-items: center;
		}

		.link {
			color: inherit;
		}
		
		.link:hover{
			color: inherit;
			text-decoration: none;
		}

		.carousel-inner img {
			height: 85vh;
			width: 100%;
			object-fit: cover;
		}

	</style>

</head>

<body class="container-fluid p-0">

<nav class="navbar navbar-dark bg-dark sticky-top navbar-expand-lg ">
  <div class="container-fluid p-2">
			<strong><a class="navbar-brand text-white col-md-3 col-lg-2 px-3 w-auto border" href="index.php">Nav Blogs</a></strong>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="showblogs.php">Blogs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>

				<?php if(($role == 1 || $role == 2) && $isLoggedIn){ ?>
					<li class="nav-item">
						<a class="nav-link btn btn-outline-primary text-white" href="dashboard.php">Dashboard</a>
					</li>

				<?php	} else{ ?>
					<li>
						<a href="login.php" class="btn btn-dark">Log In</a>
					</li>
					<li>					
						<a href="register.php" class="btn btn-dark">Register</a>
					</li>
				<?php	} ?>
						
      </ul>
    </div>
  </div>
</nav>