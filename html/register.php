<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register Page</title>
    <link rel="stylesheet" href="../css/register.css">
    
</head>
<body>
<nav class="RegisterNav">
        <h1>PG Accommodation Booking System</h1>
        <div class="RegisterNavContainer">
            <a href="home.html">Home</a>
            <!-- <a href="login.php">Login</a> -->
            <!-- <a href="register.php">Register</a> -->

        </div>
    </nav>
<div class="RegisterContainer">

    <form class="RegisterForm" action="" method="post" name="registration">
        <h1 class="RegisterHeading"><u>Register</u></h1>
        <input class="RegisterInput" type="text" name="name" placeholder="Enter your username">
        <input class="RegisterInput" type="email" name="email" placeholder="Enter your email">
        <input class="RegisterInput" type="text" name="mobile" placeholder="Enter your mobile">
        <select class="RegisterInput" name="user_type">
            <option value=""disabled selected>Select your user type</option>
            <option value="pg_owner">Pg Owner</option>
            <option value="student">Student</option>

        </select>
        <input class="RegisterInput" type="password" name="password" placeholder="Enter a password">
        <input class="RegisterInput" type="password" name="confirm" placeholder="Confirm password">
        <input class="RegisterSubmit" type="submit" value="Register" name="submit"> 
        <p>Already have an account?</p>
        <a href="login.php">Login here</a>
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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $user_type = $_POST['user_type'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    if($password===$confirm){
        $sql = "INSERT INTO `users`(`name`, `email`, `mobile`, `user_type`, `password`) VALUES ('$name','$email','$mobile','$user_type','$password')";
        $data = mysqli_query($conn,$sql);

        if($user_type=== "pg_owner"){
            $user_code = 0;
        }
        else if($user_type==="student"){
            $user_code = 1;
        }
        

        $sql2 = "INSERT INTO `login`(`email`, `password`, `user_code`) VALUES ('$email','$password','$user_code')";
        $data2 = mysqli_query($conn,$sql2);
        if($data){
            echo "<script>alert('Registration Completed')</script>";
        }
        else{
            echo "<script>alert('Registration Not Completed')</script>";
        }
    }
    else{
        echo "<script>alert('Password doesnt match')</script>";
    }
}

?>