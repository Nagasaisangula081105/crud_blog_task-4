<?php
include("../config/db.php");

if(isset($_POST['register'])){

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(username, password) VALUES('$username','$password')";

    if(mysqli_query($conn, $sql)){
        echo "Registration Successful!";
    } else {
        echo "Error!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Blog | Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-success bg-gradient">

<div class="container vh-100 d-flex justify-content-center align-items-center">

<div class="card shadow-lg p-4" style="width:420px; border-radius:15px;">

<h2 class="text-center text-success mb-4">Create Account</h2>

<form method="POST">

<div class="mb-3">
<label class="form-label">Username</label>
<input type="text" name="username" class="form-control" placeholder="Enter Username" required>
</div>

<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" name="password" class="form-control" placeholder="Enter Password" required>
</div>

<button type="submit" name="register" class="btn btn-success w-100">
Register
</button>

</form>

<hr>

<a href="login.php" class="btn btn-primary w-100">
Already have an account? Login
</a>

</div>

</div>

</body>
</html>