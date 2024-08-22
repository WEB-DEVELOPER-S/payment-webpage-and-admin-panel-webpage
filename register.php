<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'earn');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing the password

    // Set default status as Inactive and payment_status as Unpaid
    $status = 'Inactive';
    $payment_status = 'Unpaid';

    // Insert the new user into the users table
    $query = "INSERT INTO users (username, email, phone_number, password, status, payment_status) 
              VALUES ('$username', '$email', '$phone_number', '$password', '$status', '$payment_status')";
    
    if ($conn->query($query) === TRUE) {
        // Redirect to payment instructions page
        header("Location: payment.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form method="POST" action="">
        <label>Username:</label><br>
        <input type="text" name="username" required ><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required  ><br><br>

        <label>Phone Number:</label><br>
        <input type="text" name="phone_number" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</body>
</html>
