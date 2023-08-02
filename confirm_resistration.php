<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data
    $userName = $_POST["userName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $fullName = $_POST["fullName"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];

    // Validate the data (you can add more validation as needed)
    // For example, check if required fields are not empty and validate email format.

    // Establish a database connection (replace 'your_host', 'your_username', 'your_password', and 'your_db_name' with your actual database credentials)
    $conn = new mysqli('localhost', 'root', '', 'ma');

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the email is already registered in the database
    $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
    $stmtCheckEmail = $conn->prepare($checkEmailQuery);
    $stmtCheckEmail->bind_param("s", $email);
    $stmtCheckEmail->execute();
    $result = $stmtCheckEmail->get_result();
    if ($result->num_rows > 0) {
        // Email is already registered, display an error message or redirect to a failure page
        echo "Error: Email already registered.";
        exit();
    }
    $stmtCheckEmail->close();

    // Hash the password using password_hash() before storing it in the database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL query to insert data into the 'users' table
    $sql = "INSERT INTO users (username, email, password, full_name, address, phone) VALUES (?, ?, ?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind parameters to the statement
    $stmt->bind_param("ssssss", $userName, $email, $hashedPassword, $fullName, $address, $phone);

    // Execute the statement to insert the data into the database
    if ($stmt->execute()) {
        // After successful registration, set a message to indicate registration success
        $successMessage = "Registration successful. Now you can log in.";

        // Redirect to the login page with the success message as a query parameter in the URL
        header('Location: login.php?message=' . urlencode($successMessage));
        exit(); // Make sure to exit after redirecting
    } else {
        // Registration failed
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}
?>
