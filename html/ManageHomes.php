<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/ManageHomes.css">
    <title>Manage Homes</title>
</head>
<body>
    <nav class="ManageHomesNav">
        <h1>PG Accomodation Booking System</h1>
        <div class="ManageHomesContainer">
            <!-- <a href="">
                Manage Homes
            </a> -->

            <a href="home.html">
                Home
            </a>
            

        </div>

    </nav>
   
    <h1 class="ManageHomesHeading"><u>Manage Homes</u></h1>

    <div class="ManageHomesFormContainer">
    <form class="ManageHomesForm" action="" method="post">
        <h2><u>Manage Homes</u></h2>
        <input class="ManageHomesInput" type="text" name="title" placeholder="Enter the title">
        <input  class="ManageHomesInput"  type="text" name="type" placeholder="Enter the type">
        <input  class="ManageHomesInput" type="text" name="description" placeholder="Enter the description">
        <input  class="ManageHomesInput" type="text" name="price" placeholder="Enter the price">
        <input  class="ManageHomesInput" type="text" name="district" placeholder="Enter the district">
        <input  class="ManageHomesInput" type="text" name="city" placeholder="Enter the city">
        <input  class="ManageHomesInput" type="file" name="image" placeholder="Upload images">
        <input  class="ManageHomesSubmit" type="submit" name="submit">


        



    </form>
    </div>
    
</body>
</html>
<?php
$conn = mysqli_connect("localhost","root","","pg_accomodation");
if(!$conn){
    echo "not connected";
}
if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $district = $_POST['district'];
    $city = $_POST['city'];
    $image = $_POST['image'];
    
     $sql = "INSERT INTO `properties`(`title`, `type`, `description`, `price`, `district`, `city`, `image`) VALUES ('$title','$type','$description','$price','$district','$city','$image')";
     $data = mysqli_query($conn,$sql);

        
        if($data){
            echo "<script>alert('Record added')</script>";
        }
        else{
            echo "<script>alert('Record Not Completed')</script>";
        }
    }
    else{
        echo "<script>alert('Cannot be entered')</script>";
    }


?>