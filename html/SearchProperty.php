<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search properties</title>
    <link rel="stylesheet" href="../css/SearchProperty.css">
</head>
<body>
    <h1>Search for Properties</h1>
<form action="SearchProperties.php" method="GET">
    <label for="location">Location:</label>
    <input type="text" id="location" name="location" required>

    <label for="price_range">Price Range:</label>
    <select id="price_range" name="price_range" required>
        <option value="" disabled selected>Select a price range</option>
        <option value="0-2000">Up to ₹2000</option>
        <option value="2000-6000">₹2000 - ₹6000</option>
        <option value="6000-10000">₹6000 - ₹10000</option>
        <option value="10000+">₹10000 and above</option>
    </select>

    <label for="amenities">Amenities:</label>
    <input type="text" id="amenities" name="amenities" placeholder="e.g., pool, wifi">

    <button type="submit">Search</button>
</form>

</body>
</html>
    
</body>
</html>