<?php
	$page_title = "Nav Blogs";
	include_once('includes/header.php');
?>

<!-- Carousel -->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/img/welcomeblog.png" class="d-block w-100" alt="blog image">
      <div class="carousel-caption d-none d-md-block bg-dark opacity-75 rounded-3">
        <h5 class="display-3">Welcome to <strong>Nav Blogs</strong></h5>
        <p class="lead">Have a look around for amazing Blogs.</p>
				<a href="showblogs.php" class="btn btn-primary">Explore Now</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/img/readblog.png" class="d-block w-100" alt="blog image">
      <div class="carousel-caption d-none d-md-block bg-dark opacity-75 rounded-3">
        <h5 class="display-4">Want to Read Blogs?</h5>
        <p class="lead">You can Read amazing blogs for free.</p>
        <a href="showblogs.php" class="btn btn-primary">Read Blogs</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/img/writeblog.png" class="d-block w-100" alt="blog image">
      <div class="carousel-caption d-none d-md-block bg-dark opacity-75 rounded-3">
        <h5 class="display-4">Want to Write a Blogs?</h5>
        <p class="lead">You can Write blogs freely at this website.</p>
				<a href="login.php" class="btn btn-primary">Write Now</a>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!-- End of Carousel -->

<hr>

<?php include('showblogs.php'); ?>

