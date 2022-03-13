<?php
$page_title = "Write a Blog Post";

require_once('includes/database.php');
require_once ('includes/header.php');

$error = $blog_title = $blog_content = $blog_img = '';

if($isLoggedIn){

  if(isset($_POST['submit'])){

    $blog_title = $_POST['blog_title'];
    $blog_content = $_POST['blog_content'];
    $blog_img = $_POST['blog_img'];
    
    $sql_query1 = "INSERT INTO $tblBlogs (btitle,bcontent,bimg,uid) VALUES ('$blog_title','$blog_content','$blog_img','$uid')";
    
    $error =  !mysqli_query($conn,$sql_query1) && "There was an error while publishing your Blog.";
    
    header("Location:showblogs.php");
  } 
}else{
  $error = "There's an error. You're not Logged in. <br /> Please Log In to write a Blog.";
  header( "Refresh:4; url=login.php", true, 303);
}
	
?>

<div class="container-fluid d-flex p-0">

<!-- Include Sidebar -->
<?php include('includes/sidebar.php') ?>


<!-- Right Side Content -->
	<div class="container wrapper my-5 d-flex align-items-center flex-column justify-content-center">

  <h1 class="text-center my-3">Write a Blog</h1>
  <?php if($error){ ?>
    <p class="lead text-center text-danger my-5"><?php echo $error; ?></p>
    <?php } else{ ?>

    <p class="lead text-center">Please Write your Blog below</p>
    <div class="col-xs-8 col-xs-offset-2 w-75">
    <!-- Add House Form -->
    <form class="form-horizontal" role="form" action="" method="POST">
      <div class="form-group my-2">
        <label for="blog_title" class="control-label">Title</label>
        <div class="col-sm-9 w-100">
          <input type="text" class="form-control" id="blog_title" name="blog_title" placeholder="Enter Title of your Blog" required>
        </div>
      </div>
      <div class="form-group my-2">
        <label for="blog_content" class="control-label">Blog Content</label>
        <div class="col-sm-9 w-100">
          <textarea type="text" class="form-control" id="blog_content" name="blog_content" placeholder="Enter Content of your Blog here" required></textarea>
        </div>
      </div>
      <div class="form-group my-2">
        <label for="blog_img" class="control-label">Blog Image URL</label>
        <div class="col-sm-9 w-100">
          <input type="text" class="form-control" id="blog_img" name="blog_img" placeholder="Enter Blog Image URL" required>
        </div>
      </div>
      <div class="form-group my-3">
        <div class="col-sm-offset-3 col-sm-9">
          <button type="submit" name='submit' class="btn btn-primary">Publish</button>
        </div>
      </div>
    </form>
    <!-- End of Add house form -->
    </div>
    <?php } ?>  
</div>
<!-- End of Right Side Content -->

</div>

<?php	include_once('includes/footer.php'); ?>