<?php
session_start(); // Start the session

// Check if the user is logged in
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    // Prepare the SQL statement
    $updateSQL = "UPDATE users SET name = ?, mobile = ? WHERE email = ?";
    
    // Update the user's name and mobile
    $stmt = $conn->prepare($updateSQL);
    $stmt->bind_param("sss", $name, $mobile, $email);
    
    if ($stmt->execute()) {
        // Update the password if provided
        if (!empty($password)) {
            $updatePasswordSQL = "UPDATE login SET password = ? WHERE email = ?";
            $stmtPassword = $conn->prepare($updatePasswordSQL);
            $stmtPassword->bind_param("ss", $password, $email);
            $stmtPassword->execute();
        }
        header("Location: UserProfile.php?success=1");
        exit;
    } else {
        echo "<script>alert('Error updating profile.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="../css/UpdateUserProfile.css"> <!-- Adjust path as necessary -->
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
    <h1 class="DashboardHeading">Edit Your Profile</h1>
    <?php if (isset($_GET['success'])): ?>
        <p style="color: green;">Profile updated successfully!</p>
    <?php endif; ?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required readonly>
        </div>
        <div class="form-group">
            <label for="mobile">Mobile:</label>
            <input type="text" id="mobile" name="mobile" value="<?php echo htmlspecialchars($user['mobile']); ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Leave blank to keep current password">
        </div>
        <div class="action-buttons">
            <button type="submit" class="button">Update Profile</button>
        </div>
    </form>
</div>
</body>
</html>
