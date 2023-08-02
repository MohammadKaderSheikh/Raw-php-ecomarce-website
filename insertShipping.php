<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $details_address = $_POST['details_address'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Validate the data (you can add more validation as needed)

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

    // Prepare and execute the SQL query
    $sql = "INSERT INTO sipping_address (details_address, country, city, email, phone) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $details_address, $country, $city, $email, $phone);

    if ($stmt->execute()) {
        // Data inserted successfully
        echo "Data inserted successfully!";
    } else {
        // Failed to insert data
        echo "Error: " . $stmt->error;
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}
?>
