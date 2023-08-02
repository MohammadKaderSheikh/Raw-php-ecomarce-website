<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white">
  <!-- Container wrapper -->
  <div class="container">    
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent1"
      aria-controls="navbarSupportedContent1"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent1">      
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-sm-0" href="http://localhost/ecomarce/">
        <img
          src="https://icms-image.slatic.net/images/ims-web/bfe8de2c-b737-42ab-b1f1-576042ab0412.png"
          height="25"
          alt="MDB Logo"
          loading="lazy"
        />
      </a>
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item active">
          <a class="nav-link " href="http://localhost/ecomarce/">Home</a>
        </li>
      </ul>
      <!-- Left links -->      
    </div>
    <!-- Collapsible wrapper -->
    
    <!-- Right elements -->
    <div class="d-flex align-items-center">
      <!-- Icon -->
      <a class="nav-link me-3" href="http://localhost/ecomarce/showCart.php">
        <i class="fas fa-shopping-cart"></i>
        <span class="badge rounded-pill badge-notification bg-danger"> <?php echo $totalProduct; ?>    </span>
      </a>

     
      <a href="http://localhost/ecomarce/login.php" class="m-1 text-white btn btn-success border rounded px-1 nav-link">
        login
       </a> 
       <a href="http://localhost/ecomarce/resistration.php" class="m-1 text-white btn btn-primary border rounded px-1 nav-link">
        sinup
       </a> 
    </div>
    <!-- Right elements -->
    <form action="http://localhost/ecomarce/logout.php" method="post">
      <button type="submit" class="btn btn-danger">Logout</button>
    </form>
       <a href="http://localhost/ecomarce/userProfile.php" class="m-1 text-white btn btn-primary border rounded px-1 nav-link">
        profile
       </a> 
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->
