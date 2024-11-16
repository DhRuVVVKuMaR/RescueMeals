<?php
// Start the session to manage user login
session_start();

// Database connection parameters
$host = "localhost"; // Adjust if using a different host
$db_user = "root";   // Default username for XAMPP/WAMP
$db_password = "";   // Default password (leave blank for XAMPP)
$db_name = "rescue_meals"; // Name of your database

// Establish database connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve and sanitize user inputs
    $email = $conn->real_escape_string($_POST["email"]);
    $password = $conn->real_escape_string($_POST["password"]);

    // Check if the email exists in the database
    $query = "SELECT id, password FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify the hashed password
        if (password_verify($password, $row["password"])) {
            // Save user details in session
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["email"] = $email;

            // Redirect to the dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            // Incorrect password
            echo "<script>alert('Incorrect password.'); window.history.back();</script>";
        }
    } else {
        // Email not found
        echo "<script>alert('Email not registered.'); window.history.back();</script>";
    }
}

// Close database connection
$conn->close();
?>
