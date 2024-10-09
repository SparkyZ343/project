<?php
session_start();

// Assuming you store the user's email in session after login
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit;
}

// Database connection
$conn = mysqli_connect("localhost", "root", "", "pg_accomodation");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch user data from database
$email = $_SESSION['user_email'];
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    die("User not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../css/UserProfile.css"> <!-- Adjust path as necessary -->
</head>
<body>
<nav>
    <h1>PG Accommodation Booking System</h1>
    <div class="UserContainer">
        <a href="home.html">Home</a>
        <a href="UserDashboard.html">Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<div class="content">
    <h1 class="DashboardHeading">Student Profile</h1>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <p><strong>Mobile:</strong> <?php echo htmlspecialchars($user['mobile']); ?></p>
    <p><strong>User Type:</strong> <?php echo htmlspecialchars($user['user_type']); ?></p>
    
    <div class="action-buttons">
        <a href="UpdateProfile.php" class="button">Edit Profile</a>
    </div>
</div>
</body>
</html>
