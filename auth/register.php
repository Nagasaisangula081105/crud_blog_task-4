<?php
include("../config/db.php");

if (isset($_POST['register'])) {

    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = mysqli_prepare($conn, "INSERT INTO users(username, password) VALUES(?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
                alert('Registration Successful!');
                window.location='login.php';
              </script>";
        exit();
    } else {
        echo "<script>alert('Registration Failed! Username may already exist.');</script>";
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CRUD Blog | Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    margin:0;
    padding:0;
    min-height:100vh;
    background:linear-gradient(135deg,#4f46e5,#06b6d4);
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:Arial,sans-serif;
}

.register-card{
    width:420px;
    background:rgba(255,255,255,0.15);
    backdrop-filter:blur(15px);
    border-radius:20px;
    padding:35px;
    color:white;
    box-shadow:0 8px 30px rgba(0,0,0,.3);
}

.logo{
    width:80px;
    height:80px;
    background:white;
    color:#4f46e5;
    border-radius:50%;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:35px;
    margin:auto;
    margin-bottom:20px;
}

.form-control{
    height:48px;
    border-radius:12px;
}

.btn-register{
    height:48px;
    border:none;
    border-radius:12px;
    font-weight:bold;
    background:#22c55e;
}

.btn-register:hover{
    background:#16a34a;
}

.btn-login{
    height:48px;
    border-radius:12px;
    font-weight:bold;
}

</style>

</head>

<body>

<div class="register-card">

<div class="logo">
📝
</div>

<h2 class="text-center mb-4">
Create Account
</h2>

<form method="POST">

<div class="mb-3">
<label class="form-label">Username</label>
<input
type="text"
name="username"
class="form-control"
placeholder="Enter Username"
required>
</div>

<div class="mb-4">
<label class="form-label">Password</label>
<input
type="password"
name="password"
class="form-control"
placeholder="Enter Password"
required
minlength="6">
</div>

<button
type="submit"
name="register"
class="btn btn-register w-100">
Create Account
</button>

</form>

<hr class="text-white">

<a href="login.php" class="btn btn-light btn-login w-100">
Already have an account? Login
</a>

</div>

</body>
</html>