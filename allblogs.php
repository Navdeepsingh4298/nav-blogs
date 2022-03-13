<?php 
$page_title = "All Houses";

require_once ('includes/header.php');
require_once ('includes/database.php');

if($isLoggedIn && $role == 1){

$query_str1 = "SELECT * FROM $tblBlogs";
$result = mysqli_query($conn,$query_str1);
$blogs = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (!$result) {
	$errno = $conn->errno;
	$errmsg = $conn->error;
	echo "Selection failed with: ($errno) $errmsg<br/>\n";
	$conn->close();
	exit;
}
	
}else{
  header("Location: index.php");
}
?>

<div class="container-fluid d-flex p-0">

<?php include('includes/sidebar.php') ?>

<!-- Right Side Content -->
	<div class="container wrapper">
	
	<h1 class="text-center my-4">All Houses For Sale</h1>

	<?php if(count($blogs) > 0) { ?>

		<div class="row my-2">
			<div class="col-xs-4 col-xs-offset-8">
				<form action="searchblogs.php" method="get" class="form-inline search-form" role="form">
					<div class="input-group">
						<input type="text" name="title_or_keyword" placeholder="Search Blogs by Title or Keyword" id="blogSearch" class="form-control"/>
						<button type="submit" class="btn btn-primary">Go!</button>
					</div>
				</form>
			</div>
		</div>

  <div class="blog-list">
			<div class="row mx-auto">
				<?php	foreach( $blogs as $blog): ?>
					<div class="col my-4 md-3">			

							<div class="card" style="width: 20rem;">
								<img src="<?php echo $blog['bimg']?>" class="card-img-top img-thunbnail" alt="blog_image">
								<div class="card-body">
									<p class="card-text">
										<?php 
										$authorId = $blog['uid'];
										$query_str2 = "SELECT * FROM $tblUsers WHERE uid = '$authorId'";
										$result = mysqli_query($conn, $query_str2);
										$author = mysqli_fetch_assoc($result);
										?> <br />
										<strong>Title:</strong> <?php echo $blog['btitle'];?> <br />
										<strong>Content:</strong> <?php echo $blog['bcontent'];?> <br />
										<strong>Author:</strong> <?php echo $author['name'];?> <br />
										<strong>Date:</strong> <?php echo $blog['bdate'];?> <br />
										<a href="editblog.php?id=<?php echo $blog['bid']; ?>" class="btn btn-warning">EDIT</a>
										<a href="deleteblog.php?id=<?php echo $blog['bid']; ?>" class="btn btn-danger">DELETE</a>
									</p>
								</div>
							</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		
		<?php }else { ?>
			<div class="container-fluid lead text-center text-danger my-4">
				<p>No blogs Available at the moment <br> Please try again later.</p>
			</div>
		<?php } ?>	
	</div>
<!-- End of Right Side Content -->
</div>

<?php include_once('includes/footer.php'); ?>