<?php

$page_title = "Search Blogs";

require_once ('includes/header.php');
require_once('includes/database.php');

$keyword = $_GET['key'];

//select statement
$query_str = "SELECT * FROM $tblBlogs WHERE btitle LIKE '%" .$keyword. "%' OR bcontent LIKE '%" .$keyword. "%'";

$result = $conn->query($query_str);
$blogs = mysqli_fetch_all($result, MYSQLI_ASSOC);

//Handle selection errors
if (!$result) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg<br/>\n";
    $conn->close();
    exit;
} 
?>

	<div class="container wrapper">
		<h1 class="text-center my-2">Search Results</h1>
		<!-- Search Box -->
		<div class="row">
			<div class="col-xs-4 col-xs-offset-8">
				<form action="<?=$_SERVER['PHP_SELF']?>" class="form-inline search-form" method="get" role="form">
					<div class="input-group">
						<input type="text" name="key" placeholder="Search Blogs by Title or Keyword" id="BlogSearch" class="form-control"/>
						<button type="submit" class="btn btn-primary">Go!</button>
					</div>
				</form>
			</div>
		</div>
		<!-- End of Search Box -->
    <?php 
			if (count($blogs) == 0) {
				echo "<p class='lead text-center'>No results found for <strong>". $keyword . "</strong>. Please search again with different keyword.</p>";
			} else { 
        //insert a row into the table for each row of data
		?>

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
									</p>
								</div>
							</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php } ?>
	</div>

<?php require_once('includes/footer.php'); ?>