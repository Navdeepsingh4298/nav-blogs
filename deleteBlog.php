<?php
$page_title = "Delete a Blog";

require_once ('includes/header.php');
require_once('includes/database.php');

$error = '';

//retrieve user id from a querystring
$blog_id = $_GET['id'];

if($isLoggedIn){

  $sql = "SELECT uid FROM $tblBlogs WHERE bid = '$blog_id'";
  $result = mysqli_query($conn,$sql);
  $blog = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  $author_id = $blog['uid'];

  if($uid == $author_id || $role == 1){

    $query_str = "DELETE FROM $tblBlogs WHERE bid = '$blog_id'";
    $result = $conn->query($query_str);
    
    if (!$result) {
      $errno = $conn->errno;
      $errmsg = $conn->error;
      echo "Selection failed with: ($errno) $errmsg<br/>\n";
      $conn->close();
      exit;
    }
  }
}else{
  $error = "You can't Delete the blog. <br> Please Log In to Delete this blog.";
}
?>

<div class="container wrapper text-center text-danger display-6 my-5">
  <?php if(!$error){ ?>
  <p>Your Blog is Deleting.... </p>
  <?php }else{ echo $error; }?>
</div>

<?php
$conn->close();
header( "Refresh:2; url=myblogs.php", true, 303);
include ('includes/footer.php');
?>

