<?php
session_start(); // Start the session

// Database connection
$conn = mysqli_connect("localhost", "root", "", "pg_accomodation");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch properties from the database
$sql = "SELECT * FROM properties";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/Properties.css">
    <title>View Properties</title>
</head>
<body>
    <nav class="ViewPropertiesNav">
        <h1>PG Accommodation Booking System</h1>
        <div class="ViewPropertiesContainer">
            <a href="home.html">Home</a>
            <a href="ManageHomes.php">Manage Homes</a>
        </div>
    </nav>

    <h1 class="ViewPropertiesHeading"><u>Properties</u></h1>

    <div class="PropertiesGrid">
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($property = mysqli_fetch_assoc($result)) {
                echo '<div class="PropertyCard">';
                echo '<img src="../images/' . htmlspecialchars($property['image']) . '" alt="Property Image" class="PropertyImage">';
                echo '<div class="PropertyDetails">';
                echo '<h2 class="PropertyTitle">' . htmlspecialchars($property['title']) . '</h2>';
                echo '<p class="PropertyType"><strong>Type:</strong> ' . htmlspecialchars($property['type']) . '</p>';
                echo '<p class="PropertyDescription">' . htmlspecialchars($property['description']) . '</p>';
                echo '<p class="PropertyPrice"><strong>Price:</strong> ₹' . htmlspecialchars($property['price']) . '</p>';
                echo '<p class="PropertyLocation"><strong>Location:</strong> ' . htmlspecialchars($property['district']) . ', ' . htmlspecialchars($property['city']) . '</p>';
                echo '<button class="LikeButton" onclick="likeProperty(' . $property['id'] . ')">❤️</button>';
                echo '</div>'; // End of PropertyDetails
                echo '</div>'; // End of PropertyCard
            }
        } else {
            echo '<p>No properties found.</p>';
        }
        ?>
    </div>

    <script>
        function likeProperty(propertyId) {
            alert('You liked property ID: ' + propertyId);
            // Here you can implement additional logic to store likes, e.g., AJAX call to a like endpoint
        }
    </script>
</body>
</html>
