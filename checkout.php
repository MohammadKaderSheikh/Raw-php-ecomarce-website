<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_email'])) {
    // User is not logged in; redirect them to the login page or display an error message
    header('Location: login.php');
    exit(); // Make sure to exit after redirecting
}

// The user is logged in; you can now show the content of the authenticated page
// Access the user information from the session (e.g., $_SESSION['user_id'], $_SESSION['user_name'], etc.)

// ... Your dashboard content here ...

// Optionally, you can provide a logout link or button to allow users to log out
?>

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

<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ma";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the shipping_address table
$sql = "SELECT * FROM sipping_address";
$result = $conn->query($sql);
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
            <h5 class="mb-0">Shipping Address</h5>
          </div>
          <div class="card-body">
           <hr class="my-4" />

            <!-- Single item -->
            <!-- Default radio -->
            <div class="form-check">
             
                <label class="form-check-label" for="flexRadioDefault1">  
                    <?php
                        // Check if there are any rows returned
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Generate the HTML markup for each shipping address
                                echo '<div class="form-check">';
                                echo '<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />';
                                echo '<label class="form-check-label" for="flexRadioDefault1">';
                                echo '<p class="card p-1 m-1 mt-0">' . $row['details_address'] . ' ' . $row['country'] . ' ' . $row['city'] . ' ' . $row['email'] . ' ' . $row['phone'] . '</p>';
                                echo '</label>';
                                echo '</div>';
                            }
                        } else {
                            echo "No shipping addresses found.";
                        }

                        // Close the connection
                     
                    ?>
              </label>
            </div>
          <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#exampleModal">
               Add New Shipping Address 
            </button>

            <!-- Modal -->
            <div class="modal top fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
            <div class="modal-dialog modal-lg  modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                  <div class="modal-body">
                    <form action="http://localhost/ecomarce/insertShipping.php" method="post">    
                            <!-- Text input -->
                            <div class="form-outline mb-4">
                                <input name="details_address" type="text" id="form6Example4" class="form-control" />
                                <label class="form-label" for="form6Example4">Details Adress</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input name="country" type="text" id="form6Example4" class="form-control" />
                                <label class="form-label" for="form6Example4">Country</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input name="city" type="text" id="form6Example4" class="form-control" />
                                <label class="form-label" for="form6Example4">City </label>
                            </div>
                            <div class="form-outline mb-4">
                                <input name="email" type="text" id="form6Example4" class="form-control" />
                                <label class="form-label" for="form6Example4">Email </label>
                            </div>


                            <!-- Number input -->
                            <div class="form-outline mb-4">
                                <input name="phone" type="text" id="form6Example6" class="form-control" />
                                <label class="form-label" for="form6Example6">Phone</label>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                                Close
                                </button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                    </form>
                   </div>
                  
                </div>
            </div>
            </div>
          </div>
        </div>
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Shipping/ Delivery Methods</h5>
          </div>
          <div class="card-body">
           <hr class="my-4" />
            <?php

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch data from the delivery_method table
                $sql = "SELECT * FROM delivary_method";
                $result = $conn->query($sql);

                // Check if there are any rows returned
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Generate the HTML markup for each delivery method
                        echo '<div class="form-check">';
                        echo '<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />';
                        echo '<label class="form-check-label" for="flexRadioDefault1">';
                        echo '<p class="card p-1 m-1 mt-0">' . $row['delivary_place'] . ' ' . $row['estimate_time'] .   $row['price'] .'</p>';
                        echo '</label>';
                        echo '</div>';
                    }
                } else {
                    echo "No delivery methods found.";
                }

                // Close the connection
          
            ?>
   
            <!-- Single item -->
          </div>
        </div>
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Payment Method</h5>
          </div>
          <div class="card-body">
           <hr class="my-4" />
           <?php

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch data from the database
                $sql = "SELECT * FROM payment_method"; // Replace 'your_table_name' with the actual table name containing your data
                $result = $conn->query($sql);

                // Check if there are any rows returned
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Generate the HTML markup for each data row
                        echo '<div class="form-check">';
                        echo '<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault6" />';
                        echo '<label class="form-check-labe6" for="flexRadioDefault6">';
                        echo '<p class="card p-1 m-1 mt-0">' . $row['pay_title'] . ' ' .  ' ' . '</p>'; // Replace 'column1', 'column2', etc., with the actual column names from your table
                        echo '</label>';
                        echo '</div>';
                    }
                } else {
                    echo "No data found.";
                }
           ?>
      </div>
        </div>
        <div class="card mb-4">
          <div class="card-body">
            <p><strong>Expected shipping delivery</strong></p>
            <p class="mb-0">12.10.2020 - 14.10.2020</p>
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

            <a type="button" href="/" class="btn btn-primary btn-lg btn-block">
                place order
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"
></script>
</body>
</html>

<?php
$conn->close();
?>