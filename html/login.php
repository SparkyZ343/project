<?php
session_start(); // Start the session

$conn = mysqli_connect("localhost", "root", "", "pg_accomodation");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Fetch user data based on email
    $sql = "SELECT * FROM `login` WHERE `email`='$email'";
    $data = mysqli_query($conn, $sql);
    
    if ($data) {
        if (mysqli_num_rows($data) > 0) {
            $value = mysqli_fetch_assoc($data);
            
            // Verify the password (consider using password_hash and password_verify for security)
            if ($value['password'] === $password) {
                // Store user information in session variables
                $_SESSION['user_email'] = $email;
                $_SESSION['user_code'] = $value['user_code'];
                
                // Redirect based on user type
                if ($value['user_code'] == 0) {
                    header('Location: OwnerDashboard.php');
                } else if ($value['user_code'] == 1) {
                    header('Location: UserDashboard.html'); // Changed to .php for consistency
                } else {
                    header('Location: AdminDashboard.html');
                }
                exit();
            } else {
                echo "<script>alert('Incorrect password');</script>";
            }
        } else {
            echo "<script>alert('User not found');</script>";
        }
    } else {
        echo "<script>alert('Query error');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/login.css">
    <title>Login Page</title>
</head>
<body>
    <nav>
        <h1>PG Accommodation Booking System</h1>
        <div class="LoginNavContainer">
            <a href="home.html">Home</a>
        </div>
    </nav>
    <div class="LoginContainer">
        <form class="LoginForm" action="" method="post">
            <h1 class="LoginHeading"><u>Login</u></h1>
            <input class="LoginInput" type="email" name="email" placeholder="Enter your Email" required>
            <input class="LoginInput" type="password" name="password" placeholder="Enter your password" required>
            <input class="LoginSubmit" type="submit" value="Login" name="submit">
            <p>Don't have an account?</p>
            <a href="register.php">Register here</a>
        </form>    
    </div>
</body>
</html>
