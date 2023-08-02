<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Establish a database connection (replace 'your_host', 'your_username', 'your_password', and 'your_db_name' with your actual database credentials)
    $conn = new mysqli('localhost', 'root', '', 'ma');

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL query to select user data based on the provided email
    $sql = "SELECT * FROM users WHERE email = ?";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind the email parameter to the statement
    $stmt->bind_param("s", $email);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if a user with the provided email exists in the database
    if ($result->num_rows === 1) {
        // Fetch the user data
        $user = $result->fetch_assoc();

        // Verify the user's provided password using password_verify()
        if (password_verify($password, $user['password'])) {
            // Password is correct; the user is authenticated

            // Start a session to store user information for subsequent requests
            session_start();

            // Store relevant user information in the session (you can add more data if needed)
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_id'] = $user['user_id'];

            // Redirect the user to the dashboard or any other authenticated page
            header('Location: index.php');
            exit();
        } else {
            // Incorrect password
            echo "Incorrect password. Please try again.";
        }
    } else {
        // User with the provided email does not exist
        echo "User not found. Please check your email or register a new account.";
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}
?>
