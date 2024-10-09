<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Users</title>
    <link rel="stylesheet" href="../css/ManageUsers.css">
</head>
<body>
    <nav>
        
        <div class="ManageUsersContainer">
           <a href="AdminDashboard.html">
            <img src="../images/icons8-home-50.png" alt="img">
           </a> 
           

        </div>

    </nav>
    <h1 class="heading">Manage Students</h1>
    </body>
<div class="ManageUsersPhp">

<?php
$conn = mysqli_connect("localhost","root","","pg_accomodation");
if(!$conn){
    echo "database not connected";
}
$sql = "SELECT * FROM `users` WHERE `user_type`='student'";
$data = mysqli_query($conn,$sql);
if(mysqli_num_rows($data)>0){

    echo "<table border=1 >";
    echo "<tr>";
    echo "<th>Name</th>";
    echo "<th>Email</th>";
    echo "<th>Mobile</th>";
    echo "<th>User id</th>";
    echo "</tr>";

    while($row=mysqli_fetch_assoc($data)){
        $id = $row['email'];
        echo "<tr>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['mobile']."</td>";
        echo "<td>".$row['user_id']."</td>";
        echo "<td>
        <form method='POST'>
        <button value='$id' name='userdel' type='submit'>DELETE</button>
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

if(isset($_POST['userdel'])){
    $id = $_POST['userdel'];
    if(!empty($_POST['userdel'])){
        $sql = "DELETE FROM `users` WHERE `email`='$id'";
        $data = mysqli_query($conn,$sql);
    
        $sql1 = "DELETE FROM `login` WHERE `email`='$id'";
        $data1 = mysqli_query($conn,$sql1);
        echo "<script>window.location.replace('../html/ManageUsers.php');</script>";
    }
}
?>