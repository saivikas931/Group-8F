<?php
// Remove the session_start() and session-related checks

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include './connection.php'; // Include the database connection

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validation
    $errors = array();

    // Check if username is not empty
    if (empty($username)) {
        $errors[] = "Username is required";
    }

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Check if password is not empty
    if (empty($password)) {
        $errors[] = "Password is required";
    }

    // If there are no validation errors, proceed with database insertion
    if (empty($errors)) {
        // Note: In the real world, use password hashing
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            // Display confirmation alert
            echo "<script>
            if (confirm('Registration successful! Login to your account to book a meal. Click OK to proceed to login.')) {
                window.location.href = 'login.php';
            }
          </script>";
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo "<p class='error'>$error</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <form action="index.php" method="post" class='form-container'>
        <h1>User Registration</h1>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="submit">Register</button>
        <h5>Already have an account? <a href="./login.php">Login</a></h5>
    </form>

    
</body>

</html>
