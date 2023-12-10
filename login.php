<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="./style.css">
    
</head>
<body>

    <form action="login.php" method="post" class='form-container'>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
            include './connection.php';
            $email = $_POST['email'];
            $password = $_POST['password'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<p class='error'>Invalid email format</p>";
            } else {
                // Note: In real-world, use password hashing
                $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    $data= mysqli_fetch_object($result);
              
session_start();
$_SESSION['UserID']=$data->UserID;


                    if ($email == "admin@gmail.com") {
                        // Redirect to admin.php for admin user
                        header("Location: admin.php");
                        exit();
                    } else {
                       
                        header("Location: home.php");
                        exit();
                    }
                } else {
                    echo "<p class='error'>Invalid email or password</p>";
                }
            }
        }
        ?>

        <h1>User Login</h1>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
        <h5>Create new account <a href="./index.php">Register</a></h5>

     

    </form>

</body>
</html>
