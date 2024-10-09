<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/OwnerDashboard.css">
    <title>Owner Dashboard</title>
</head>
<body>
    <nav class="OwnerDashboardNav">
        <h1>PG Accommodation Booking System</h1>
        <div class="OwnerContainer">

        <a href="../html/OwnerProfile.php">
                Profile
            </a>


            <a href="../html/ManageHomes.php">
                Manage Homes
            </a>

            <a href="home.html">
                Home
            </a>

            <a href="logout.php">
                Logout
            </a>
            

        </div>

    </nav>
    <h1 class="DashboardHeading">Owner Dashboard</h1>
    
</body>
</html>

<div class="ManageHomesPhp">
<?php

$conn = mysqli_connect("localhost","root","","pg_accomodation");
if(!$conn){
    echo "database not connected";
}
$sql = "SELECT * FROM `properties`";
$data = mysqli_query($conn,$sql);
if(mysqli_num_rows($data)>0){

    echo "<table border=1 >";
    echo "<tr>";
    echo "<th>Title</th>";
    echo "<th>Type</th>";
    echo "<th>Description</th>";
    echo "<th>Price</th>";
    echo "<th>District</th>";
    echo "<th>City</th>";
    echo "<th>Property Image</th>";


    echo "</tr>";

    while($row=mysqli_fetch_assoc($data)){
        $id = $row['title'];
        echo "<tr>";
        echo "<td>".$row['title']."</td>";
        echo "<td>".$row['type']."</td>";
        echo "<td>".$row['description']."</td>";
        echo "<td>".$row['price']."</td>";
        echo "<td>".$row['district']."</td>";
        echo "<td>".$row['city']."</td>";
        echo "<td>".$row['image']."</td>";
        echo "<td>
        <form method='POST'>
        <button value='$id' name='propertydel' type='submit'>DELETE</button>
        </form>
        </td>";
        echo "</tr>";

    }
    echo "</table>";

} 
?>
</div>
</html>

<?php

$conn = mysqli_connect("localhost","root","","pg_accomodation");
if(!$conn){
    echo "database not connected";
}

if(isset($_POST['propertydel'])){
    $id = $_POST['propertydel'];
    if(!empty($_POST['propertydel'])){
        $sql = "DELETE FROM `properties` WHERE `title`='$id'";
        $data = mysqli_query($conn,$sql);
    
       
        echo "<script>window.location.replace('../html/OwnerDashboard.php');</script>";
    }
}
?>
