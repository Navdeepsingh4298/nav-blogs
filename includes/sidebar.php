
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
		<span class="lead">Hello, <strong class="text-uppercase"><?php echo $name; ?></strong></span>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto text-left">
      <li class="nav-item mb-2 lead">
        <a href="index.php" class="nav-link text-white" aria-current="page">
          Home
        </a>
      </li>
			<li class="nav-item mb-2 lead">
        <a href="dashboard.php" class="nav-link text-white" aria-current="page">
          Dashboard
        </a>
      </li>
      <li class="nav-item mb-2 lead">
        <a href="updateprofile.php" class="nav-link text-white" aria-current="page">
          Update Profile
        </a>
      </li>
			<li class="nav-item mb-2 lead">
        <a href="myblogs.php" class="nav-link text-white">
          My Blogs
				</a>
			</li>
      <?php if($role == 1){ ?>
      <li class="nav-item mb-2 lead">
        <a href="allblogs.php" class="nav-link text-white">
          All Blogs
				</a>
			</li>  
      <?php } ?>  
      <li class="nav-item mb-2 lead">
        <a href="addblog.php" class="nav-link text-white">
          Write New Blog
        </a>
      </li>
      <li class="nav-item mb-2 lead">
        <a href="showblogs.php" class="nav-link text-white">
          Blogs
        </a>
      </li>
			<hr class="m-0 p-0">
      <li class="nav-item mb-2 lead">
        <a href="about.php" class="nav-link text-white">
          About US
        </a>
      </li>
			<li class="nav-item mb-2 lead">
        <a href="logout.php" class="nav-link text-white btn bg-danger">
          LOG OUT
        </a>
      </li>
    </ul>    
  </div>