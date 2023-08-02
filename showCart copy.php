<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ma";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
// Query to retrieve cart items from the database
$sql = "SELECT p.product_id, p.name, p.image, p.price, c.cart_id, c.quantity
        FROM cart c
        JOIN products p ON c.product_id = p.product_id";

$result = $conn->query($sql);

// Create an array to store cart items data
$cartItems = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cartItems[] = $row;
    }
}
?>
            <?php
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
<?php include 'navbar.php'; ?>  

<section class="h-100 gradient-custom">
  <div class="container py-5">
    <div class="row d-flex justify-content-center my-4">
      <div class="col-md-8">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Cart  <?php echo $totalProduct; ?> items</h5>
          </div>
          <div class="card-body">
            <!-- Single item -->
            
            <?php foreach ($cartItems as $item) { ?>
            <div class="row">
              <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                <!-- Image -->
                <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                  <img src="<?php echo $item['image']; ?>"
                    class="w-100" alt="Blue Jeans Jacket" />
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                  </a>
                </div>
                <!-- Image -->
              </div>

              <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                <!-- Data -->
                <p><strong><?php echo $item['name']; ?></strong></p>
                <p>Color: blue</p>
                <p>Size: M</p>
                <form action="delete_item.php" method="POST">
                    <input type="hidden" name="item_id" value="<?php echo $item['cart_id']; ?>">
                    <button type="submit" class="btn btn-primary btn-sm me-1 mb-2" 
                      data-mdb-toggle="tooltip" title="Remove item">
                      <i class="fas fa-trash"></i>
                    </button>
                </form>
                <button type="button" class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip"
                  title="Move to the wish list">
                  <i class="fas fa-heart"></i>
                </button>
                <!-- Data -->
              </div>

              <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                  <form action="updateQuantity.php" method="POST">
                    <input type="hidden" name="item_id" value="<?php echo $item['cart_id']; ; ?>">
                    <button type="submit" name="decrement" class="btn btn-primary px-3 me-2">
                      <i class="fas fa-minus"></i>
                    </button>

                    <div class="form-outline"> <label class="form-label" for="form1">Quantity</label>
                      <input id="form1" min="0" name="quantity" value="<?php echo $item['quantity'];  ?>" type="number" class="form-control" />
                     
                    </div>

                    <button type="submit" name="increment" class="btn btn-primary px-3 ms-2">
                      <i class="fas fa-plus"></i>
                    </button>
                  </form>
                <!-- Price -->
                <p class="text-start text-md-center">
                  <strong>$<?php echo $item['price']; ?></strong>
                </p>
                <!-- Price -->
              </div>
            </div>

            <?php }?>
            <!-- Single item -->

            <hr class="my-4" />

            <!-- Single item -->
          
            <!-- Single item -->
          </div>
        </div>
        <div class="card mb-4">
          <div class="card-body">
            <p><strong>Expected shipping delivery</strong></p>
            <p class="mb-0">12.10.2020 - 14.10.2020</p>
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body">
            <p><strong>We accept</strong></p>
            <img class="me-2" width="45px"
              src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
              alt="Visa" />
            <img class="me-2" width="45px"
              src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
              alt="American Express" />
            <img class="me-2" width="45px"
              src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
              alt="Mastercard" />
            <img class="me-2" width="45px"
              src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.webp"
              alt="PayPal acceptance mark" />
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Summary</h5>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li
                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                total Products
                <span><?php echo $totalProduct; ?> </span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                Shipping
                <span>Gratis</span>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                <div>
                <?php
                function calculateTotalPrice($cartItems) {
                    $totalPrice = 0;

                    foreach ($cartItems as $item) {
                        // Assuming the 'price' and 'quantity' keys exist in the cart items array
                        $price = floatval($item['price']);
                        $quantity = intval($item['quantity']);
                        $totalPrice += ($price * $quantity);
                    }

                    // Return the total price with two decimal places
                    return number_format($totalPrice, 2);
                }
                ?>
                <?php
                // Assuming you have fetched the $cartItems array from the database
                $totalPrice = calculateTotalPrice($cartItems);
                ?>


                  <strong>Total amount</strong>
                  <strong>
                    <p class="mb-0">(including VAT)</p>
                  </strong>
                </div>
                <span><span>$<?php echo $totalPrice; ?></span></span>
              </li>
            </ul>
             <a  class="btn btn-primary" href="http://localhost/ecomarce/checkout.php"> checkout </a>
         
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



</body>
</html>

