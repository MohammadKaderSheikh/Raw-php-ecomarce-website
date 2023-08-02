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

// Check if the item id is provided via POST method
if (isset($_POST['item_id'])) {
    // Sanitize the input to prevent SQL injection
    $item_id = $_POST['item_id'];

    // Delete the item from the cart_items table
    $sql = "DELETE FROM cart WHERE cart_id = $item_id";

    if ($conn->query($sql) === TRUE) {
        header("location:showCart.php");
    } else {
        echo "Error deleting item: " . $conn->error;
    }
} else {
    echo "Item id not provided.";
}

$conn->close();
?>
