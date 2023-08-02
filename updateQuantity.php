<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ma";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the item id and quantity are provided via POST method
if (isset($_POST['item_id']) && isset($_POST['quantity'])) {
    // Sanitize the input to prevent SQL injection
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];

    if (isset($_POST['increment'])) {
        $quantity++;
    } elseif (isset($_POST['decrement'])) {
        $quantity = max(0, $quantity - 1);
    }

    // Update the quantity in the cart table using prepared statement
    $sql = "UPDATE cart SET quantity = ? WHERE cart_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ii", $quantity, $item_id);
        if ($stmt->execute()) {
            header('location:showCart.php');
            exit(); // It's a good practice to add an exit after header redirection
        } else {
            echo "Error updating quantity: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error in prepared statement: " . $conn->error;
    }
} else {
    echo "Item ID or quantity not provided.";
}

$conn->close();
?>
