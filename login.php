<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'earn');

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user data based on the username
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);
    $user = $result->fetch_assoc();

    // Check if the user exists and the password is correct
    if ($user && password_verify($password, $user['password'])) {
        // Check if the account is active
        if ($user['status'] == 'Inactive') {
            // If the account is inactive, redirect to payment page
            header("Location: payment.php");
        } 
        // Check if the payment status is unpaid
        elseif ($user['payment_status'] == 'Unpaid') {
            // If the payment is not complete, redirect to payment page
            header("Location: payment.php");
        } 
        // If the account is active and payment is completed, allow login
        else {
            $_SESSION['user_id'] = $user['id'];
            header("Location: dashboard.php"); // Redirect to dashboard or any other page
        }
    } else {
        echo "Invalid username or password.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register</a></p>
</body>
</html>
