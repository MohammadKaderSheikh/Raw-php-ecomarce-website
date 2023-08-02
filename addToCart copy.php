<?php
session_start();



// Function to add an item to the cart and store it in the database
function addToCart($user_id,$product_id, $quantity = 1) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ma";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("INSERT INTO cart( user_id,product_id, quantity) VALUES (?, ?,?)");
    $stmt->bind_param("iii", $user_id, $product_id, $quantity);
     $result = $stmt->execute();
    if($result){
        header('location:index.php');
    }
    $stmt->close();
    $conn->close();
}

// Function to get all cart items from the database
// Function to get all cart items from the database
function getCartItems() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ma";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Assuming you have already started the session, you can directly access $_SESSION['user_id']
    // Make sure to sanitize the user input or use prepared statements to prevent SQL injection.
    $user_id = $_SESSION['user_id'];

    // Update the SQL query to use the correct equal sign for comparison (=, not ==).
    $sql = "SELECT * FROM cart WHERE user_id = $user_id";
    $result = $conn->query($sql);

    $cart_items = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cart_items[$row['product_id']] = array(
                'id' => $row['id'],
                'quantity' => $row['quantity'],
            );
        }
    }

    $conn->close();
    return $cart_items;
}


// Function to calculate the total price of the cart
function calculateTotalPrice() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ma";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT SUM(p.price * ci.quantity) AS total_price
            FROM cart_items ci
            JOIN products p ON ci.product_id = p.id";
    $result = $conn->query($sql);

    $total_price = 0;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total_price = $row['total_price'];
    }

    $conn->close();
    return $total_price;
}
function updateCartItemQuantity($product_id, $quantity) {
    // Perform database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ma";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("UPDATE cart_items SET quantity = ? WHERE product_id = ?");
    $stmt->bind_param("ii", $quantity, $product_id);
    $stmt->execute();
    $stmt->close();

    $conn->close();
}

// Function to remove a cart item from the database
function removeFromCart($product_id) {
    // Perform database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ma";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("DELETE FROM cart_items WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->close();

    $conn->close();
}
// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_cart'])) {
        $user_id = $_POST['user_id'];
        $product_id = $_POST['product_id'];
        $quantity = (int)$_POST['quantity'];
        addToCart($user_id, $product_id, $quantity);
    } elseif (isset($_POST['update_cart'])) {
        $product_id = $_POST['product_id'];
        $quantity = (int)$_POST['quantity'];
        updateCartItemQuantity($product_id, $quantity);
    } elseif (isset($_POST['remove_from_cart'])) {
        $product_id = $_POST['product_id'];
        removeFromCart($product_id);
    }
}
?>
