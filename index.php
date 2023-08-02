
<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ma";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the SQL query to fetch product data
$sql = "SELECT * FROM products";
$result = $conn->query($sql);


      
?>
<?php
    // Query to retrieve cart items from the database
    $sql1 = "SELECT p.product_id, p.name, p.image, p.price, c.quantity
            FROM cart c
            JOIN products p ON c.product_id = p.product_id";

    $results = $conn->query($sql1);

    // Create an array to store cart items data
    $cartItems = array();
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            $cartItems[] = $row;
        }
    }

          function calculateTotalProduct($cartItems) {
              $totalProduct = 0;

              foreach ($cartItems as $item) {
                  // Assuming the 'quantity' key exists in the cart items array
                  $quantity = intval($item['quantity']);
                  $totalProduct += $quantity;
              }

              return $totalProduct;
          }
          ?>
          <?php
          // Assuming you have fetched the $cartItems array from the database
          $totalProduct = calculateTotalProduct($cartItems);
        
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<style>
        .carousel-item {
        height: 50vh;
        }
        .card {
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }
        .footer-cta {
        box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px;
        }
        .price {
        color: #263238;
        font-size: 24px;
        }

        .card-title {
        color:#263238
        }

        .sale {
        color: #E53935
        }

        .sale-badge {
        background-color: #E53935
        }
</style>




</head>
<body>
    
<?php include 'navbar.php'; ?> 


 <!--Main layout-->
<main  style="margin-top: 100px;">
<div class="container mt-5" style="margin-top: 500px;">

  
<!-- Products -->
 <section class="mt-5">
  <div class="text-center mt-5">
    <div class="row">
   <?php
            if ($result->num_rows > 0) {
        // Loop through the fetched rows and display product cards
        while ($row = $result->fetch_assoc()) {
            $product_id = $row['product_id'];
            $name = $row["name"];
            $description = $row["description"];
            $price = $row["price"];
            $image = $row["image"];
            $category = $row["category_id"];
            
        ?>
        <div class="col-lg-3 col-md-6 mb-4">
        <div class="card">
            <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
                <img src="<?php echo $image ?>" class="w-100" />
                <a href="#!">
                <div class="mask">
                    <div class="d-flex justify-content-start align-items-end h-100">
                    <h5><span class="badge bg-dark ms-2">NEW</span></h5>
                    </div>
                </div>
                <div class="hover-overlay">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </div>
                </a>
            </div>
            <div class="card-body">
                <a href="" class="text-reset">
                <h5 class="card-title mb-2"><?php echo $name ?></h5>
                <h5 class="card-title mb-2"><?php echo $product_id ?></h5>
                </a>
                <a href="" class="text-reset ">
                <p><?php $category ?></p>
                </a>
                <h6 class="mb-3 price"><?php echo "$". $price ?></h6>
                <form action="addToCart.php" method="post">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    <input type="hidden" name="quantity" id="quantity" min="1" value="1" required>
                    <button type="submit" name="add_to_cart" class="btn btn-info">Add To Cart</button>
                </form>
            </div>
        </div>
        </div>
        <?php
        }
    } else {
        echo "No products found.";
    }

    // Close the database connection
    $conn->close();
    ?>



    
  

    </div>
  </div>
</section>
  
<!-- Pagination -->
<nav aria-label="Page navigation example" class="d-flex justify-content-center mt-3">
  <ul class="pagination">
    <li class="page-item disabled">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">4</a></li>
    <li class="page-item"><a class="page-link" href="#">5</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>  
<!-- Pagination -->  
</div>
</main>
 <!--Main layout-->

<?php include("footer.php");?>































<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"
></script>
</body>
</html>