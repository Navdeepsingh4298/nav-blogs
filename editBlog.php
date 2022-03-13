<?php
$page_title = "Edit your Blog";

require_once('includes/database.php');
require_once ('includes/header.php');

$error = $author_id = $blog_title = $blog_content = $blog_image = '';

$blog_id = $_GET['id'];

if($isLoggedIn){

    $query_str1 = "SELECT * FROM $tblBlogs WHERE bid = '$blog_id'";
    $result = mysqli_query($conn,$query_str1);
    $result_row = mysqli_fetch_assoc($result);
    
    $blog_title = $result_row['btitle'];
    $blog_content = $result_row['bcontent'];
    $blog_image = $result_row['bimg'];
    $author_id = $result_row['uid'];

    if(isset($_POST['edit'])){
      if($uid === $author_id || $role == 1){
        $blog_title = $_POST['blog_title'];
        $blog_content = $_POST['blog_content'];
        $blog_image = $_POST['blog_image'];

        $sql_query1 = "UPDATE $tblBlogs SET btitle = '$blog_title', bcontent = '$blog_content', bimg = '$blog_image' WHERE bid = $blog_id";
        
        $error =  !mysqli_query($conn,$sql_query1) && "There was an error";
        
        header("Location:showBlogs.php");
        
      }else{
        $error = "There's an Error. You can't Edit Someone else's Blog.";
        header( "Refresh:200; url=index.php", true, 303);
      }
    }


}else{
  $error = "There's an Error. You're not Logged in. <br /> Please Log In to Edit the Blog.";
  header( "Refresh:3; url=login.php", true, 303);
}
	
?>

<div class="container-fluid d-flex p-0">

<?php include('includes/sidebar.php') ?>

<!-- Right Side Content -->
	<div class="container wrapper my-5 d-flex align-items-center flex-column justify-content-center">

  <h1 class="text-center my-3">Edit Blog</h1>
  <?php if($error){ ?>
    <p class="lead text-center text-danger my-5"><?php echo $error; ?></p>
    <?php } else{ ?>

    <p class="lead text-center">Please edit your Blog.</p>
    <div class="col-xs-8 col-xs-offset-2 w-75">

    <!-- Edit Blog Form -->
    <form class="form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF']."?id=".$blog_id;?>" method="POST">
      <div class="form-group my-2">
        <label for="blog_title" class="control-label">Title</label>
        <div class="col-sm-9 w-100">
          <input type="text" class="form-control" id="blog_title" name="blog_title" value="<?php echo $blog_title?>" required>
        </div>
      </div>
      <div class="form-group my-2">
        <label for="blog_content" class="control-label">Blog Content</label>
        <div class="col-sm-9 w-100">
          <textarea type="text" class="form-control" id="blog_content" name="blog_content" required><?php echo $blog_content?></textarea>
        </div>
      </div>
      <div class="form-group my-2">
        <label for="blog_img" class="control-label">Blog Image URL</label>
        <div class="col-sm-9 w-100">
          <input type="text" class="form-control" id="blog_img" name="blog_img" value="<?php echo $blog_image; ?>" required>
        </div>
      </div>
      <div class="form-group my-3">
        <div class="col-sm-offset-3 col-sm-9">
          <button type="submit" name='edit' class="btn btn-warning">Edit</button>
        </div>
      </div>
    </form>
    <!-- End of Add Blog form -->
    </div>
    <?php } ?>  
</div>
<!-- End of Right Side Content -->

</div>

<?php
// included footer at the end of the page
	include_once('includes/footer.php');
?>