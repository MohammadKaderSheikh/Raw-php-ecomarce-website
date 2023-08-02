<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daraz</title>
    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css"
    rel="stylesheet"
    />
</head>
<body>
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
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->

<h1  class="text-center mt-5">Resistration</h1>
<div class="conatianer mt-5">
    <div class="row mt-5">
        <div class="col-md-3"></div>
        <div class="col-md-5">
        <form action="confirm_resistration.php" method="post">
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="form-outline mb-4">
                <input name="userName" type="text" id="form3Example4" class="form-control" />
                <label class="form-label" for="form3Example4">userName</label>
            </div>

            <!-- Email input -->
            <div class="form-outline mb-4">
                <input name="email" type="email" id="form3Example3" class="form-control" required />
                <label class="form-label" for="form3Example3">Email address</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input name="password" type="password" id="form3Example4" class="form-control" />
                <label class="form-label" for="form3Example4">Password</label>
            </div>
            <div class="form-outline mb-4">
                <input name="fullName" type="text" id="form3Example4" class="form-control" />
                <label class="form-label" for="form3Example4">Full Name</label>
            </div>
            <div class="form-outline mb-4">
                <input name="address" type="text" id="form3Example4" class="form-control" />
                <label class="form-label" for="form3Example4"> Address </label>
            </div>
            <div class="form-outline mb-4">
                <input name="phone" type="text" name="phone" id="form3Example4" class="form-control" />
                <label class="form-label" for="form3Example4">Phone</label>
            </div>
           <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Sign up</button>
      
        </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>





<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"
></script>
</body>
</html>