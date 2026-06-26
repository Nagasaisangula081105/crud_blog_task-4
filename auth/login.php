<?php
session_start();
include("../config/db.php");

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){

        $user = mysqli_fetch_assoc($result);

        if(password_verify($password, $user['password'])){

            $_SESSION['username'] = $username;
            header("Location: ../dashboard.php");
            exit();

        }else{
            echo "Invalid Password!";
        }

    }else{
        echo "User Not Found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Blog | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-primary bg-gradient">

<div class="container vh-100 d-flex justify-content-center align-items-center">

<div class="card shadow-lg p-4" style="width:400px; border-radius:15px;">

<h2 class="text-center mb-4 text-primary">Login</h2>

<form method="POST">

<div class="mb-3">
<label class="form-label">Username</label>
<input type="text" name="username" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button class="btn btn-primary w-100" name="login">
Login
</button>

</form>

<hr>

<a href="register.php" class="btn btn-success w-100">
Create New Account
</a>

</div>

</div>

</body>
</html>