<?php
$page_title = "Log Out";

include('includes/header.php');

$logout_status = 0;

if(isset($_POST['logout'])){    
    session_destroy();
    setcookie(session_name(), '', time()-3600);   
    $_SESSION = array();
    session_unset();
    $isLoggedIn = false;
    $logout_status = 1;
    header( "Refresh:2; url=index.php", true, 303);
}
?>

<div class="container wrapper my-5 text-center">    
    <h1 class="text-center my-2">LOG OUT</h1>
    <?php if($logout_status == 1){ ?>
        <p class="lead text-center text-danger display-5 my-5">Logging out.....</p>
    <?php } else{ ?>
        <p class="lead text-center text-danger display-5 my-5">Are you sure, Log Out?</p>
        <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <button name="logout" class="btn btn-lg btn-danger">LOG OUT</button>
            <a href="dashboard.php" class="btn btn-lg btn-primary">Cancel</a>
        </form>
    <?php } ?>

</div>

<?php include('includes/footer.php'); ?>

