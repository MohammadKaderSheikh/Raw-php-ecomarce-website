<?php
session_start();

// Function to add an item to the cart and store it in the database
function addToCart($user_id, $product_id, $quantity = 1) {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ma";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $user_id, $product_id, $quantity);
    $result = $stmt->execute();
    
    $stmt->close();
    $conn->close();
    
    if ($result) {
        header('location:index.php');
    }
}

// Function to get all cart items from the database for a specific user
function getCartItems($user_id) {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ma";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Make sure to sanitize the user input or use prepared statements to prevent SQL injection.
    $user_id = $_SESSION['user_id'];

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

// Function to calculate the total price of the cart for a specific user
function calculateTotalPrice($user_id) {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ma";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT SUM(p.price * ci.quantity) AS total_price
            FROM cart ci
            JOIN products p ON ci.product_id = p.id
            WHERE ci.user_id = $user_id";

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
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ma";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE product_id = ?");
    $stmt->bind_param("ii", $quantity, $product_id);
    $stmt->execute();
    $stmt->close();

    $conn->close();
}

// Function to remove a cart item for a specific user from the database
function removeFromCart($user_id, $product_id) {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ma";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $user_id, $product_id);
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
        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];
        removeFromCart($user_id, $product_id);
    }
}
?>
